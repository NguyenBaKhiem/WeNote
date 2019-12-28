import Vue from 'vue';

const VueRequestCanceler = {
  install (Vue) {
    Vue.prototype.$createCancelToken = function (name) {
      if (!this.$cancelTokens) {
        this.$cancelTokens = {};
      }
      let cancelToken = axios.CancelToken.source();
      this.$cancelTokens[name] = cancelToken;
      return cancelToken;
    };

    Vue.prototype.$cancelRequest = function(name) {
      if (this.$cancelTokens && this.$cancelTokens[name]) {
        this.$cancelTokens[name].cancel();
      }
    }
  }
};

export default VueRequestCanceler;
