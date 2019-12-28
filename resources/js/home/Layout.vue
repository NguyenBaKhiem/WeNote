<template>
  <div id="app-layout">
    <header-page></header-page>
    <div class="clearfix"></div>

    <main>
      <div class="clearfix clearfix-40"></div>
      <transition name="fade" mode="out-in">
        <router-view></router-view>
      </transition>
    </main>

    <!-- ============= Initial Common Components ============= -->
    <message/>
  </div>
</template>
<script>
  import AuthenticationUtils from 'common/AuthenticationUtils';
  import HeaderPage from './HeaderPage.vue';
  import Message from '../components/Message';
  import Const from 'common/Const';;
  
  export default {
    components: {
      Message,
      HeaderPage
    },
    data() {
      return {
        isAuthenticated: window.isAuthenticated,
      }
    },
    methods: {
      onClickedLogout() {
        AuthenticationUtils.removeAuthenticationData();
        window.location.href = '/';
      },

      getSocketEventHandlers() {
        return {
          BountyStarted: this.onBountyStarted,
          MessageUpdated: this.onMessageUpdated
        }
      },

      onMessageUpdated(data) {
        if (!data.meta) {
          return;
        }
        if (data.meta.trigger === Const.BOUNTY_TRIGGER_COMPLETED) {
          if (window._.isEmpty(this.user)) {
            this.$store.dispatch('init');
          }
        }
      },

      getEventHandlers() {
        return {
          UserOnline    : this.onUserOnline,
          UserJoining   : this.onUserJoining,
          UserLeaving   : this.onUserLeaving,
        };
      },

      onUserOnline(data) {
        this.$store.commit('updateUsersOnline', data);
      },

      onUserJoining(userId) {
        this.$store.commit('userJoining', userId);
      },

      onUserLeaving(userId) {
        this.$store.commit('userLeaving', userId);
      }

    }
  }
</script>
<style lang="scss" scoped>
  @import "../../sass/common";
</style>
