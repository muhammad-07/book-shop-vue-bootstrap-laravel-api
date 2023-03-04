import Vuex from 'vuex';

export default new Vuex.Store({
  state: {
    token: 0,
  },
  mutations: {
    update_token(state, token) {
        state.token = token;
    },
  },
  actions: {
    setToken(context, token) {
        context.commit("update_token", token)
    }
  },
  getters:{
    getToken: (state) => state.token
  }
});
