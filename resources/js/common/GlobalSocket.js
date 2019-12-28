import Vue from 'vue';
import rf from 'requestfactory';

export default class GlobalSocket {

  constructor() {
    // Public channels
    this.listenForMessage();
    this.listenForBountyStarting();
    this.listenForBountyUpdated();

    // Private channels
    if (window.isAuthenticated) {
      rf.getRequest('UserRequest').getCurrentUser()
        .then(res => {
          this.listenUserOnline();

          const userId = res.data.id;
          this.listenForBalance(userId);
          this.listenForNotification(userId);
        });
    }

    Vue.mixin({
      mounted: function () {
        if (this.getSocketEventHandlers) {
          window._.forIn(this.getSocketEventHandlers(), (handler, eventName) => {
            this.$on(eventName, handler);
          });
        }

        if (this.getEventHandlers) {
          window._.forIn(this.getEventHandlers(), (handler, eventName) => {
            this.$on(eventName, handler);
          });
        }
      },
      beforeDestroy() {
        if (this.getSocketEventHandlers) {
          window._.forIn(this.getSocketEventHandlers(), (handler, eventName) => {
            this.$off(eventName, handler);
          });
        }

        if (this.getEventHandlers) {
          window._.forIn(this.getEventHandlers(), (handler, eventName) => {
            this.$off(eventName, handler);
          });
        }
      }
    });
  }

  listenUserOnline() {
    window.Echo.join('UserOnline')
      .here(data => {
        window.app.$broadcast('UserOnline', data);
      })
      .joining(userId => {
        window.app.$broadcast('UserJoining', userId);
      })
      .leaving(userId => {
        window.app.$broadcast('UserLeaving', userId);
      });
  }

  listenForMessage() {
    window.Echo.channel('App.UserBounty.Message')
      .listen('MessageUpdated', (res) => {
        window.app.$broadcast('MessageUpdated', res.data);
    });
  }

  listenForBountyUpdated() {
    window.Echo.channel('App.BountyUpdated')
      .listen('BountyUpdated', (res) => {
        window.app.$broadcast('BountyUpdated', res.data);
    });
  }


  listenForBountyStarting() {
    window.Echo.channel('App.UserBounty.Started')
      .listen('BountyStartedEvent', (res) => {
        window.app.$broadcast('BountyStarted', res.data);
    });
  }

  listenForBalance(userId) {
    window.Echo.private('App.User.' + userId)
      .listen('BalanceUpdated', (balance) => {
        window.app.$broadcast('BalanceUpdated', balance.data);
      });
  }

  listenForNotification(userId) {
    window.Echo.private('App.User.' + userId)
      .notification((notification) => {
        window.app.$broadcast('NotificationUpdated', notification);
    });
  }
}
