<template>
  <div class="admin-login-panel" v-if="isLoginVisible">
    <form @submit.prevent="login">
      <div>
        <label for="username">Логін</label>
        <input type="text" id="username" v-model="username" required>
      </div>
      <div>
        <label for="password">Пароль</label>
        <input type="password" id="password" v-model="password" required>
      </div>
      <button type="submit">Увійти</button>
    </form>
    <button @click="logout" v-if="isLoggedIn">Вийти</button>
    <router-link to="/admin" v-if="isLoggedIn">Адмін панель</router-link>
  </div>
</template>

<script>
import { mapState, mapActions } from 'vuex';

export default {
  data() {
    return {
      username: '',
      password: '',
      isLoginVisible: true // Відображаємо форму входу за замовчуванням
    };
  },
  computed: {
    ...mapState(['isLoggedIn'])
  },
  methods: {
    ...mapActions(['login', 'logout']),
    async login() {
      const success = await this.login({ username: this.username, password: this.password });
      if (success) {
        console.log('Login successful, hiding login panel...');
        this.isLoginVisible = false;
      } else {
        alert('Невірний логін або пароль');
      }
    },
    toggleLogin() {
      this.isLoginVisible = !this.isLoginVisible;
    }
  }
};
</script>

<style scoped>
.admin-login-panel {
  position: fixed;
  right: 0;
  top: 0;
  width: 300px;
  padding: 20px;
  background-color: #fff;
  box-shadow: -2px 0 5px rgba(0,0,0,0.5);
  z-index: 1001;
}
</style>
