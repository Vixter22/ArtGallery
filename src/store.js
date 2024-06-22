import { createStore } from 'vuex';
import axios from 'axios';

export default createStore({
  state: {
    isLoggedIn: false
  },
  mutations: {
    SET_LOGGED_IN(state, status) {
      state.isLoggedIn = status;
    }
  },
  actions: {
    async login({ commit }, { username, password }) {
      try {
        const response = await axios.post('http://localhost/artgallery/php/login.php', { username, password });
        if (response.data.success) {
          commit('SET_LOGGED_IN', true);
          return true;
        }
        return false;
      } catch (error) {
        console.error('Login error:', error);
        return false;
      }
    },
    logout({ commit }) {
      commit('SET_LOGGED_IN', false);
    }
  }
});
