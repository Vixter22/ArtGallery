<template>
  <nav>
    <div class="navbar-content">
      <div class="navbar-left">
        <h1>Палітра мистецтва</h1>
      </div>
      <div class="navbar-right">
        <ul>
          <li><router-link to="/" exact>Головна</router-link></li>
          <li @mouseover="showDropdown" @mouseleave="hideDropdown" class="dropdown">
            <router-link to="/HomeGallery">Картини</router-link>
            <ul v-if="dropdownVisible" class="dropdown-content">
              <li><router-link to="/LandscapeGallery">Пейзажі</router-link></li>
              <li><router-link to="/PortraitGallety">Портрети</router-link></li>
              <li><router-link to="/AbstractGallery">Абстракція</router-link></li>
              <li><router-link to="/StilllifeGallery">Натюрморти</router-link></li>
              <li><router-link to="/SurrealismGallery">Сюрреалізм</router-link></li>
            </ul>
          </li>
          <li><router-link to="/About">Художники</router-link></li>
        </ul>
      </div>
    </div>
  </nav>
</template>

<script>
import { RouterLink } from 'vue-router';

export default {
  name: 'MainNavbar',
  components: {
    RouterLink
  },
  data() {
    return {
      dropdownVisible: false
    };
  },
  methods: {
    showDropdown() {
      this.dropdownVisible = true;
    },
    hideDropdown() {
      this.dropdownVisible = false;
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
  padding-left: 2rem; /* Доданий відступ для назви зліва */
  color: #fff;
  font-size: 1.5rem;
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
  position: relative; /* Додано для правильного позиціонування dropdown */
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
  display: none; /* Початково приховано */
  position: absolute;
  background-color: #111; /* Темніший фон для списку */
  box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
  z-index: 1;
  min-width: 160px; /* Зменшено ширину списку */
  padding: 0;
  margin: 0;
  list-style: none;
}
.dropdown-content li {
  margin: 0;
}
.dropdown-content li a {
  padding: 0.5rem 1rem; /* Зменшено padding */
  display: block;
  color: #fff;
  text-decoration: none;
  background-color: #111; /* Темніший фон для елементів списку */
  text-align: left; /* Вирівнювання по лівій стороні */
}
.dropdown-content li a:hover {
  background-color: #222; /* Світліший фон при наведенні */
}
.dropdown:hover .dropdown-content {
  display: block; /* Показати при наведенні */
}
</style>
