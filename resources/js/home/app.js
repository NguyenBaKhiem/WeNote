
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */
import 'common/bootstrap';
import 'common/Filters';

import Vue from 'vue';
import VueBroadcast from 'common/VueBroadcast';
import VueRequestCanceler from  'common/VueRequestCanceler';
import GlobalSocket from 'common/GlobalSocket';
import VueRouter from 'vue-router';
import VeeValidate from 'vee-validate';
import NProgress from 'nprogress';

import store from './store';
import Routers from './routes';

import App from './App.vue';
import AuthenticationUtils from 'common/AuthenticationUtils';

import ClickOutside from 'vue-click-outside';
import 'common/AddOn';

import "common/registerServiceWorker";

Vue.directive('click-outside', ClickOutside);

Vue.use(VueRouter);
Vue.use(VueBroadcast);
Vue.use(VueRequestCanceler);

const i18n = window.i18n;

Vue.use(VeeValidate);

window.GlobalSocket = new GlobalSocket();

// router config
const router = new VueRouter(Routers);
router.beforeResolve((to, from, next) => {
  // If this isn't an initial page load.
  if (to.name) {
      // Start the route progress bar.
      NProgress.start();
  }
  next();
});

router.beforeEach((to, from, next) => {
  window.i18n.locale = AuthenticationUtils.getLocale(document.documentElement.lang);
  document.title = window.i18n.t('common.window_title');

  if (to.meta.auth && !window.isAuthenticated) {
    return next({ path: '/login' });
  }
  if (to.meta.guest && window.isAuthenticated) {
    return next({ path: '/' });
  }
  return next();
});

router.afterEach((to, from) => {
  // Complete the animation of the route progress bar.
  NProgress.done();
})

Vue.mixin({
  data () {
    return {
      tabTitle: 'Gamelancer',
      isSubmitting: false,
    };
  },
  methods: {
    startSubmit () {
      this.isSubmitting = true;
    },

    endSubmit () {
      this.isSubmitting = false;
    },

    getSubmitName (name) {
      return this.isSubmitting ? this.$t('common.processing') : name;
    },

    showError(message) {
      window.Message.error(message, {}, { position: "bottom_left" });
    },

    showSuccess(message) {
      window.Message.success(message, {}, { position: "bottom_left" });
    },
  }
});

window.app = new Vue({
  i18n,
  store,
  router,
  created () {
    this.$store.dispatch('init');
  },
  render: function(createElement) {
    return createElement(App);
  }
}).$mount('#app');