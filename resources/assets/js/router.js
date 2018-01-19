import Vue from 'vue';
import Router from 'vue-router';
import { getBaseUrl } from './utils/utils';
Vue.use(Router);

const router = new Router({
  // mode: 'history',
  // base: getBaseUrl(),
  routes: [{
    path: '/joke/:id',
    component: require('./views/JokeDetail.vue'),
  },
  {
    path: '/user/:id?',
    component: require('./views/User.vue'),
  },
  {
    path: '/',
    component: require('./views/Home.vue'),
  }]
});

export default router;
