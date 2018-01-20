import Vue from 'vue';
import tHttp from './utils/tHttp';
import router from './router';
import App from './App.vue';
import 'normalize.css';
import { getBaseUrl } from './utils/utils';
import confirm from './components/confirm';
import message from './components/message';
import FastClick from 'fastclick';

Vue.prototype.$message = message;
Vue.prototype.$confirm = confirm;

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
FastClick.attach(document.body);
