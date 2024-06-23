// src/main.js

import { createApp } from 'vue';
import App from './App.vue';
import router from './index.js'; // Ваш файл маршрутизатора
import store from './store'; // Імпорт Vuex store

const app = createApp(App);

app.use(router);
app.use(store);

store.dispatch('checkAuth'); // Перевірка стану аутентифікації при завантаженні додатку

app.mount('#app');
