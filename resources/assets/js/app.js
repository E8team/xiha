import Vue from 'vue';
import tHttp from './utils/tHttp';
import router from './router';
import App from './App.vue';
import 'normalize.css';
import { getBaseUrl } from './utils/utils';
import message from './components/message';
import FastClick from 'fastclick';
import Vuex from 'vuex';
import store from './vuex/store';
import VueScroller from 'vue-scroller';
import VueContentPlaceholders from 'vue-content-placeholders';
import DomPortal from 'vue-dom-portal';

Vue.prototype.$message = message;

// 获取baseUrl
let baseUrl = getBaseUrl();

Vue.use(VueContentPlaceholders);
Vue.use(DomPortal);
Vue.use(VueScroller);
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
