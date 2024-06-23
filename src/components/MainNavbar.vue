<template>
  <nav>
    <div class="navbar-content">
      <div class="navbar-left">
        <router-link to="/" exact>
          <h1>Палітра мистецтва</h1>
        </router-link>
      </div>
      <div class="navbar-right">
        <ul>
          <li><router-link to="/" exact>Головна</router-link></li>
          <li @mouseover="showDropdown" @mouseleave="hideDropdown" class="dropdown">
            <router-link to="/HomeGallery">Картини</router-link>
            <ul v-if="dropdownVisible" class="dropdown-content">
              <li><router-link to="/LandscapeGallery">Пейзаж</router-link></li>
              <li><router-link to="/PortraitGallety">Портрет</router-link></li>
              <li><router-link to="/AbstractGallery">Абстракція</router-link></li>
              <li><router-link to="/StilllifeGallery">Натюрморт</router-link></li>
              <li><router-link to="/SurrealismGallery">Сюрреалізм</router-link></li>
            </ul>
          </li>
          <li><router-link to="/AboutGallery">Художники</router-link></li>
          <li><a @click.prevent="toggleProfile" href="#">Профіль</a></li>
        </ul>
      </div>
    </div>
    <div v-if="showProfilePanel" class="profile-panel">
      <div v-if="!isLoggedIn">
        <h2>Вхід</h2>
        <input type="text" v-model="username" placeholder="Логін" />
        <input type="password" v-model="password" placeholder="Пароль" />
        <button @click="login">Увійти</button>
        <p v-if="errorMessage" class="error">{{ errorMessage }}</p>
      </div>
      <div v-else>
        <button @click="logout">Вийти</button>
        <router-link to="/admin">Адмін панель</router-link> <!-- Оновлений шлях -->
      </div>
    </div>
  </nav>
</template>

<script>
import axios from 'axios';
import { mapState, mapMutations } from 'vuex';

export default {
  name: 'MainNavbar',
  data() {
    return {
      dropdownVisible: false,
      showProfilePanel: false,
      username: '',
      password: '',
      errorMessage: ''
    };
  },
  computed: {
    ...mapState(['isLoggedIn'])
  },
  methods: {
    ...mapMutations(['SET_LOGGED_IN']),
    showDropdown() {
      this.dropdownVisible = true;
    },
    hideDropdown() {
      this.dropdownVisible = false;
    },
    toggleProfile() {
      this.showProfilePanel = !this.showProfilePanel;
    },
    async login() {
      try {
        const response = await axios.post('http://localhost/artgallery/php/login.php', {
          username: this.username,
          password: this.password
        });
        if (response.data.success) {
          this.SET_LOGGED_IN(true);
          localStorage.setItem('token', response.data.token);
          this.errorMessage = '';
          this.showProfilePanel = false;
        } else {
          this.errorMessage = response.data.message || 'Невірний логін або пароль';
        }
      } catch (error) {
        this.errorMessage = 'Помилка при вході';
        console.error('Помилка при вході:', error);
      }
    },
    logout() {
      this.SET_LOGGED_IN(false);
      localStorage.removeItem('token');
      this.username = '';
      this.password = '';
      this.errorMessage = '';
      this.showProfilePanel = false;
    }
  }
}
</script>

<style>
nav {
  position: sticky;
  top: 0;
  background: #000;
  padding: 1rem;
  z-index: 1000;
}
.navbar-content {
  display: flex;
  justify-content: space-between;
  align-items: center;
}
.navbar-left h1 {
  margin: 0;
  padding-left: 2rem;
  color: #fff;
  font-size: 1.5rem;
}

.navbar-left a {
  text-decoration: none;
}

.navbar-right ul {
  list-style: none;
  display: flex;
  justify-content: flex-end;
  padding: 0;
  margin: 0;
}
.navbar-right ul li {
  margin: 0 1rem;
  position: relative;
}
.navbar-right ul li a {
  color: #fff;
  text-decoration: none;
  padding: 0.5rem 1rem;
  transition: color 0.5s, background-color 0.3s;
}
.navbar-right ul li a:hover,
.navbar-right ul li a.router-link-active {
  color: #ff6600;
  border-radius: 5px;
}
.dropdown-content {
  display: none; 
  position: absolute;
  background-color: #111; 
  box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
  z-index: 1;
  min-width: 160px; 
  padding: 0;
  margin: 0;
  list-style: none;
}
.dropdown-content li {
  margin: 0;
}
.dropdown-content li a {
  padding: 0.5rem 1rem; 
  display: block;
  color: #fff;
  text-decoration: none;
  background-color: #111;
  text-align: left; 
}
.dropdown-content li a:hover {
  background-color: #222; 
}
.dropdown:hover .dropdown-content {
  display: block; 
}
.profile-panel {
  position: absolute;
  right: 0;
  top: 60px;
  background: #111;
  padding: 1rem;
  box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
  z-index: 1000;
}
.profile-panel input {
  display: block;
  margin: 0.5rem 0;
  padding: 0.5rem;
  width: 100%;
}
.profile-panel button {
  display: block;
  width: 100%;
  padding: 0.5rem;
  background: #ff6600;
  color: #fff;
  border: none;
  cursor: pointer;
}
.error {
  color: red;
  margin-top: 1rem;
}
</style>
