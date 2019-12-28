import Vue from 'vue';
import Vuex from 'vuex';
import rf from 'requestfactory';

Vue.use(Vuex);

const store = new Vuex.Store({
  state: {
    status          : 'pending',
    user            : {},
    masterdata      : {},
    notifications   : [],
    usersOnline     : {},
  },
  getters: {
    // userLanguages: (state) => {
    //   return window._.filter(state.masterdata.languages, item => {
    //     const languages = state.user.languages || [];
    //     return languages.includes(item.code);
    //   }) || [];
    // },

    // toLanguage: (state) => (code) => {
    //   const filtered = window._.filter(state.masterdata.languages, item => {
    //     return item.code === code;
    //   });
    //   return window._.size(filtered) ? filtered[0].name : '';
    // }
    status: state => state.status,
  },
  mutations: {
    updateStatus(state, status) {
      Vue.set(state, 'status', status);
    },

    updateMasterdata(state, data) {
      state.masterdata = data || {};
    },

    updateUser(state, data) {
      state.user = data || {};
    },

    updateNotifications(state, data) {
      if (window._.isEmpty(data)) {
        return;
      }
      state.notifications = window._.concat(data, state.notifications);
    },

    updateUsersOnline(state, data) {
      const result = {};
      window._.each(data, userId => {
        result[userId] = true;
      });
      state.usersOnline = result;
    },

    userJoining(state, userId) {
      state.usersOnline[userId] = true;
    },

    userLeaving(state, userId) {
      state.usersOnline[userId] = false;
    },

  },
  actions: {
    getMasterdata({ commit }) {
      return new Promise((resolve) => {
        rf.getRequest('MasterdataRequest').getAll().then((res) => {
          commit('updateMasterdata', res.data);
          resolve(res.data);
        });
      });
    },

    async getCurrentUser({ commit }) {
      commit('updateUser', 
        await rf.getRequest('UserRequest').getCurrentUser().then((res) => {
          return res.data
        })
      );   
    },

    getNotifications({ commit }) {
      return new Promise((resolve) => {
        rf.getRequest('NotificationRequest').getNotifications().then((res) => {
          commit('updateNotifications', res.data);
          resolve(res.data);
        });
      });
    },

    async init({ commit }) {
      try {
        // this.dispatch('getMasterdata');
        if (window.isAuthenticated) {
          await this.dispatch('getCurrentUser');
          // this.dispatch('getNotifications');
          commit('updateStatus', 'success');
        }
      } catch (e) {
        console.error(e);

        commit('updateStatus', 'error');
      }
    }
  }
});

export default store;
