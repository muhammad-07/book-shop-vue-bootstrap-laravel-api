import Vuex from 'vuex';
import Welcome from '../components/Welcome.vue'
import BookList from '../components/BookList.vue'

export default new Vuex.Store({
  state: {
    token: 0,
    home: Welcome
  },
  mutations: {
    update_token(state, token) {
        state.token = token;
        state.home = (token == null ?  Welcome : BookList);
    },

  },
  actions: {
    setToken(context, token) {
        context.commit("update_token", token)
    }
  },
  getters:{
    getToken: (state) => state.token,
    getHome: (state) => state.home
  }
});
