import { createRouter, createWebHistory } from 'vue-router';
import Home from '@/components/Home.vue';
import About from '@/components/About.vue';
import HomeGallery from '@/components/HomeGallery.vue';
import LandscapeGallery from '@/components/category/LandscapeGallery.vue';
import PortraitGallety from '@/components/category/PortraitGallety.vue';
import AbstractGallery from '@/components/category/AbstractGallery.vue';
import StilllifeGallery from '@/components/category/StilllifeGallery.vue';
import SurrealismGallery from '@/components/category/SurrealismGallery.vue';
import PaintingDetail from '@/components/PaintingDetail.vue'; // Додаємо цей імпорт

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
  },
  {
    path: '/painting/:id',
    name: 'PaintingDetail',
    component: PaintingDetail // Додаємо цей маршрут
  }
];

const router = createRouter({
  history: createWebHistory(),
  routes
});

export default router;
