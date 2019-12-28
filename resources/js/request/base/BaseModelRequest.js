import BaseRequest from './BaseRequest';

export default class BaseModelRequest extends BaseRequest {

  getModelName() {
    throw new Error('This method should be implemented in derived method.');
  }

  getOne(id, params) {
    let url = '/' + this.getModelName() + '/' + id;
    return this.get(url, params);
  }

  getList(params) {
    let url = '/' + this.getModelName();
    return this.get(url, params);
  }

  createANewOne(data) {
    let url = '/' + this.getModelName();
    return this.post(url, data);
  }

  updateOne(id, data) {
    let url = '/' + this.getModelName() + '/' + id;
    return this.put(url, data);
  }

  removeOne(id) {
    let url = '/' + this.getModelName() + '/' + id;
    return this.del(url);
  }
}
