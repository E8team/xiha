import Vue from 'vue';
import tHttp from './utils/tHttp';
import router from './router';
import App from './App.vue';
import 'normalize.css';
import { getBaseUrl } from './utils/utils';

// 获取baseUrl
let baseUrl = getBaseUrl();

Vue.use(tHttp, {
  baseURL: baseUrl + 'api/',
  router
});

new Vue({
  el: '#app',
  ...App,
  router
});
