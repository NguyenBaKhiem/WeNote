import AuthenticationUtils from 'common/AuthenticationUtils';

export default class BaseRequest {
  getUrlPrefix() {
    return '/api/v1';
  }

  getCurrentLocale() {
    if (window.i18n) {
      return window.i18n.locale;
    }
  }

  appendLocale (data) {
    const lang = this.getCurrentLocale();
    return Object.assign(data, { lang });
  }

  async get(url, params = {}, cancelToken) {
    try {
      const config = {
        params: params,
        cancelToken: cancelToken ? cancelToken.token : undefined
      }
      const response = await window.axios.get(this.getUrlPrefix('GET') + url, config);
      return this._responseHandler(response);
    } catch (error) {
      this._errorHandler(error);
    }
  }

  async put(url, data = {}) {
    try {
      // data = this.appendLocale(data);
      const response = await window.axios.put(this.getUrlPrefix() + url, data);
      return this._responseHandler(response);
    } catch (error) {
      this._errorHandler(error);
    }
  }

  async post(url, data = {}) {
    try {
      // data = this.appendLocale(data);
      const response = await window.axios.post(this.getUrlPrefix() + url, data);
      return this._responseHandler(response);
    } catch (error) {
      this._errorHandler(error);
    }
  }

  async del(url, data = {}) {
    try {
      // data = this.appendLocale(data);
      const response = await window.axios.delete(this.getUrlPrefix() + url, {data});
      return this._responseHandler(response);
    } catch (error) {
      this._errorHandler(error);
    }
  }

  async _responseHandler(response, url) {
    const data = response.data;
    if (response.status === 202) {
      data.redirectUrl = '/';
      window.app.$broadcast('BountyCounterModal', data);
    }
    return data;
  }

  // async download(url, params, fileName) {
  //   const response = await this.get(url, params);
  //   CsvUtils.export(response, fileName);
  // }

  _errorHandler(err) {
    window.app.$broadcast('EVENT_COMMON_ERROR', err);
    if (err.response && err.response.status === 401) { // Unauthorized (session timeout)
      AuthenticationUtils.removeAuthenticationData();
      window.app.$broadcast('UserSessionRegistered');
    }
    // if (err.response && err.response.status === 503) { // maintenance
    //   window.location.reload();
    // }
    throw err;
  }

}
