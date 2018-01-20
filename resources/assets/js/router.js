import Vue from 'vue';
import Router from 'vue-router';
// import { getBaseUrl } from './utils/utils';
Vue.use(Router);

const router = new Router({
  // mode: 'history',
  // base: getBaseUrl(),
  routes: [{
    path: '/joke/:id',
    name: 'joke',
    component: require('./views/JokeDetail.vue'),
  },
  {
    path: '/user/:id?',
    name: 'user',
    component: require('./views/User.vue'),
  },
  {
    path: '/login',
    name: 'login',
    component: require('./views/Login.vue'),
  },
  {
    path: '/publish',
    name: 'publish',
    component: require('./views/Publish.vue'),
  },
  {
    path: '/',
    component: require('./views/Home.vue'),
  }]
});

export default router;
