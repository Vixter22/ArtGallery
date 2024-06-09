import { createRouter, createWebHistory } from 'vue-router';
import Home from '@/components/Home.vue'; // Шлях до вашого компонента Home.vue
import About from '@/components/About.vue'; // Шлях до вашого компонента About.vue
import HomeGallery from '@/components/HomeGallery.vue'; // Шлях до вашого компонента HomeGallery.vue
import LandscapeGallery from '@/components/category/LandscapeGallery.vue'; // Шлях до вашого компонента LandscapeGallery.vue
import PortraitGallety from '@/components/category/PortraitGallety.vue'; // Шлях до вашого компонента PortraitGallety.vue
import AbstractGallery from '@/components/category/AbstractGallery.vue'; // Шлях до вашого компонента AbstractGallery.vue
import StilllifeGallery from '@/components/category/StilllifeGallery.vue'; // Шлях до вашого компонента StilllifeGallery.vue
import SurrealismGallery from '@/components/category/SurrealismGallery.vue'; // Шлях до вашого компонента SurrealismGallery.vue

const routes = [
  {
    path: '/',
    name: 'Home',
    component: Home
  },
    {
      path: '/HomeGallery',
      name: 'HomeGallery',
      component: HomeGallery
    },
  {
    path: '/about',
    name: 'About',
    component: About
  },
  {
    path: '/LandscapeGallery',
    name: 'LandscapeGallery',
    component: LandscapeGallery
  },
  {
    path: '/PortraitGallety',
    name: 'PortraitGallety',
    component: PortraitGallety 
  },
  {
    path: '/AbstractGallery',
    name: 'AbstractGallery',
    component: AbstractGallery
  },
  {
    path: '/StilllifeGallery',
    name: 'StilllifeGallery',
    component: StilllifeGallery
  },
  {
    path: '/SurrealismGallery',
    name: 'SurrealismGallery',
    component: SurrealismGallery
  }
];

const router = createRouter({
  history: createWebHistory(),
  routes
});

export default router;