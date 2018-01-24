import Vue from 'vue';
import Vuex from 'vuex';

Vue.use(Vuex);

const state = {
  me: null,
  lastPublishJoke: null,
  lastHomePos: null
};
export default new Vuex.Store({
  state,
  mutations: {
    UPDATE_ME (state, me) {
      state.me = me;
    },
    UPDATE_LAST_PUBLISH_JOKE (state, joke) {
      state.lastPublishJoke = joke;
    },
    UPDATE_LAST_HOME_POS (state, pos) {
      state.lastHomePos = pos;
    }
  },
  actions: {
    updateMe ({ commit }) {
      Vue.prototype.$http.get('me').then(res => {
        commit('UPDATE_ME', res.data.data);
      });
    }
  }
});
