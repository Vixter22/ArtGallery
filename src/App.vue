<template>
  <div id="app">
    <MainNavbar />
    <div class="content">
      <router-view></router-view>
    </div>
    <AppFooter />
  </div>
</template>

<script>
import MainNavbar from './components/MainNavbar.vue';
import AppFooter from './components/AppFooter.vue';

export default {
  created() {
        document.title = 'Палітра мистецтва';
    },
  name: 'App',
  components: {
    MainNavbar,
    AppFooter
  }
}
</script>

<style>
body {
  font-family: Avenir, Helvetica, Arial, sans-serif;
  margin: 0;
}
#app {
  text-align: center;
}

</style>
