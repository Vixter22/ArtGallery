import { createStore } from 'vuex';
import axios from 'axios';

export default createStore({
  state: {
    isLoggedIn: !!localStorage.getItem('token')
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
          localStorage.setItem('token', response.data.token); // Збережіть токен з відповіді сервера
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
      localStorage.removeItem('token'); // Видаліть токен
      commit('SET_LOGGED_IN', false);
    },
    checkAuth({ commit }) {
      const token = localStorage.getItem('token');
      if (token) {
        commit('SET_LOGGED_IN', true);
      } else {
        commit('SET_LOGGED_IN', false);
      }
    }
  }
});
