import BaseRequest from './base/BaseRequest'

export default class ChatRequest extends BaseRequest {

  sendMessage(params) {
    const url = `/user-bounties/${params.userBountyId}/messages/send`;
    return this.post(url, params);
  }

  getUserBountyMessages(params) {
    const url = `/user-bounties/${params.userBountyId}/messages`;
    return this.get(url, params);
  }
}
