import { createRouter, createWebHistory } from 'vue-router';
import Home from '@/components/Home.vue';
import AboutGallery from '@/components/AboutGallery.vue';
import HomeGallery from '@/components/HomeGallery.vue';
import LandscapeGallery from '@/components/category/LandscapeGallery.vue';
import PortraitGallety from '@/components/category/PortraitGallety.vue';
import AbstractGallery from '@/components/category/AbstractGallery.vue';
import StilllifeGallery from '@/components/category/StilllifeGallery.vue';
import SurrealismGallery from '@/components/category/SurrealismGallery.vue';
import PaintingDetail from '@/components/PaintingDetail.vue'; 
import ArtistDetail from '@/components/ArtistDetail';
import AdminPanel from '@/components/AdminPanel.vue'; 
import store from '@/store';
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
    path: '/AboutGallery',
    name: 'AboutGallery',
    component: AboutGallery
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
    component: PaintingDetail
  },
  {
    path: '/artist/:id',
    name: 'ArtistDetail',
    component: ArtistDetail
  },
  {
    path: '/admin',
    name: 'AdminPanel',
    component: AdminPanel,
    meta: { requiresAuth: true }
  }
];

const router = createRouter({
  history: createWebHistory(),
  routes
});

router.beforeEach((to, from, next) => {
  const isLoggedIn = store.state.isLoggedIn;
  if (to.matched.some(record => record.meta.requiresAuth) && !isLoggedIn) {
    next('/');
  } else {
    next();
  }
});

export default router;
