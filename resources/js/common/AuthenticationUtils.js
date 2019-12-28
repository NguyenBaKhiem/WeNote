export default class AuthenticationUtils {

  static isAuthenticated() {
    AuthenticationUtils.loadDataIfNeed();
    return !!AuthenticationUtils.accessToken;
  }

  static saveAuthenticationData(data) {
    window.localStorage.setItem('access_token', data.access_token || '');
    AuthenticationUtils.accessToken = data.access_token || '';
    AuthenticationUtils.setLocale(data.locale);
  }

  static removeAuthenticationData() {
    AuthenticationUtils.saveAuthenticationData({});
    AuthenticationUtils.accessToken = '';
    AuthenticationUtils.setLocale('en');
  }

  static getAccessToken() {
    AuthenticationUtils.loadDataIfNeed();

    return AuthenticationUtils.accessToken;
  }

  static loadData() {
    AuthenticationUtils.accessToken = window.localStorage.getItem('access_token') || '';
    AuthenticationUtils.dataLoaded = true;
  }

  static loadDataIfNeed() {
    if (AuthenticationUtils.dataLoaded === undefined || !AuthenticationUtils.dataLoaded) {
      AuthenticationUtils.loadData();
    }
  }

  static setLocale(newLocale = null) {
    const locale = newLocale || AuthenticationUtils.getLocale();

    if (locale === AuthenticationUtils.getLocale()) {
      return;
    }

    const html = document.documentElement;
    html.setAttribute('lang', locale);

    window.i18n.locale = locale;
    window.app.$broadcast('UPDATED_LOCALE', locale);

    return window.localStorage.setItem('locale', locale);
  }

  static getLocale(defaultLocale = 'en') {
    return window.localStorage.getItem('locale') || defaultLocale;
  }

};
