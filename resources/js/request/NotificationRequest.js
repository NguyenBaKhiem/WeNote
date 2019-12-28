import BaseRequest from './base/BaseRequest'

export default class NotificationRequest extends BaseRequest {

  getNotifications(params) {
    // const url = '/notifications';
    // return this.get(url, params);
  }

  markAsRead(params) {
    const url = '/notifications/mark-as-read';
    return this.put(url, params);
  }

  markAsReadAll() {
    const url = '/notifications/mark-as-read-all';
    return this.put(url);
  }
}
