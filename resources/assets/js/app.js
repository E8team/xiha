import Vue from 'vue';
import tHttp from './utils/tHttp';
import router from './router';
import App from './App.vue';
import 'normalize.css';
import { getBaseUrl } from './utils/utils';
import confirm from './components/confirm';
import message from './components/message';
import FastClick from 'fastclick';
import Vuex from 'vuex';
import store from './vuex/store';
Vue.prototype.$message = message;
Vue.prototype.$confirm = confirm;

// 获取baseUrl
let baseUrl = getBaseUrl();

Vue.use(tHttp, {
  baseURL: baseUrl + 'api/',
  router
});
Vue.use(Vuex);
new Vue({
  el: '#app',
  ...App,
  router,
  store
});
FastClick.attach(document.body);
