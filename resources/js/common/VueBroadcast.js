import Vue from 'vue';
const BroadcastHub = new Vue();

const _on = Vue.prototype.$on;
const $on = function (event, callback) {
  _on.call(BroadcastHub, event, callback);
  _on.call(this, event, callback);
  return this;
};

const _off = Vue.prototype.$off;
const $off = function (event, callback) {
  _off.call(BroadcastHub, event, callback);
  _off.call(this, event, callback);
  return this;
};

const _emit = Vue.prototype.$emit;
const $broadcast = function (event, ...agrs) {
  _emit.call(BroadcastHub, event, ...agrs);
  return this;
};

const VueBroadcast = {
  install (Vue) {
    Vue.prototype.$on = $on;
    Vue.prototype.$off = $off;
    Vue.prototype.$broadcast = $broadcast;
  },
  $on,
  $off,
  $broadcast,
};

export default VueBroadcast;
