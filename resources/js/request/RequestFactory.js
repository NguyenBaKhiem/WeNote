import MasterdataRequest from './MasterdataRequest';
import UserRequest from './UserRequest';
import ChatRequest from './ChatRequest';
import NotificationRequest from './NotificationRequest';
// import PaymentRequest from './PaymentRequest';

const requestMap = {
  MasterdataRequest,
  UserRequest,
  ChatRequest,
  NotificationRequest
};

const instances = {};

export default class RequestFactory {

  static getRequest(classname) {
    let RequestClass = requestMap[classname];
    if (!RequestClass) {
      throw new Error('Invalid request class name: ' + classname);
    }

    let requestInstance = instances[classname];
    if (!requestInstance) {
        requestInstance = new RequestClass();
        instances[classname] = requestInstance;
    }

    return requestInstance;
  }

}