
// if ((~window.navigator.userAgent.indexOf('MSIE')) ||
//   (~window.navigator.userAgent.indexOf('Trident/')) ||
//   (~window.navigator.userAgent.indexOf('Edge/'))) {
//   window.Promise = require('es6-promise').Promise;
//   require('es6-object-assign').polyfill();
// }

import Vue from 'vue';
// import Echo from 'laravel-echo'
import VueI18n from './VueI18n';
import VueSession from 'vue-session';
import messages from './messages';
import AuthenticationUtils from "./AuthenticationUtils";

window._ = require('lodash');

/**
 * We'll load jQuery and the Bootstrap jQuery plugin which provides support
 * for JavaScript based Bootstrap features such as modals and tabs. This
 * code may be modified to fit the specific needs of your application.
 */

try {
    // window.Popper = require('poppe/r.js').default;
    window.$ = window.jQuery = require('jquery');

    require('bootstrap');
} catch (e) {}

/**
 * We'll load the axios HTTP library which allows us to easily issue requests
 * to our Laravel back-end. This library automatically handles sending the
 * CSRF token as a header based on the value of the "XSRF" token cookie.
 */

window.axios = require('axios');

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

/**
 * Next we will register the CSRF Token as a common header with Axios so that
 * all outgoing HTTP requests automatically have it attached. This is just
 * a simple convenience so we don't have to attach every token manually.
 */

let token = document.head.querySelector('meta[name="csrf-token"]');

if (token) {
    window.axios.defaults.headers.common['X-CSRF-TOKEN'] = token.content;
    window.axios.defaults.headers.common['Authorization'] = 'Bearer ' + AuthenticationUtils.getAccessToken();
} else {
    console.error('CSRF token not found: https://laravel.com/docs/csrf#csrf-x-csrf-token');
}

window.isAuthenticated = AuthenticationUtils.isAuthenticated();

/**
 * Echo exposes an expressive API for subscribing to channels and listening
 * for events that are broadcast by Laravel. Echo and event broadcasting
 * allows your team to easily build robust real-time web applications.
 */

Vue.use(VueI18n);
Vue.use(VueSession, { persist: true });

// window.Echo = new Echo({
//   broadcaster: 'socket.io',
//   host: SOCKET_URL,
//   auth: {
//     headers: {
//       'Authorization': 'Bearer ' + AuthenticationUtils.getAccessToken(),
//     }
//   }
// });

const locale = document.documentElement.lang;
const i18n = new VueI18n({
  locale,
  messages,
});
window.i18n = i18n;
