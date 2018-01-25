import axios from 'axios';
import { getCsrfToken } from '../utils/utils';

let token = getCsrfToken();

let tHttp = {};

tHttp.config = {};

tHttp.install = (Vue, {baseURL, router}) => {
  tHttp.config = {
    baseURL
  };
  tHttp.config['X-CSRF-TOKEN'] = token.content;
  let auth = {};
  let jwtToken = localStorage.getItem('jwt_token');
  if (jwtToken) {
    auth = {
      Authorization: 'Bearer ' + jwtToken
    };
  }
  Vue.prototype.$http = axios.create({
    baseURL,
    timeout: 6000,
    responseType: 'json',
    headers: {
      'X-Requested-With': 'XMLHttpRequest',
      ...auth
    }
  });
  /* Vue.prototype.$http.interceptors.request.use((config) => {
    if (config.url.replace(config.baseURL, '') === 'auth/refresh') {
      return config;
    }
    let expiryTime = localStorage.getItem('expiry_time');
    if (!expiryTime) {
      return config;
    }
    (async () => {
      if (new Date().getTime() > Number(expiryTime)) {
        // jwt_token已经过期
        let res = await Vue.prototype.$http.post('auth/refresh');
        Vue.prototype.$http.defaults.headers.Authorization = 'Bearer ' + res.data.access_token;
        localStorage.setItem('expiry_time', new Date().getTime() + res.data.expiresIn * 1000);
        localStorage.setItem('jwt_token', res.data.access_token);
      }
    })();
    return config;
  }, (error) => {
    return Promise.reject(error);
  });*/
  Vue.prototype.$http.interceptors.response.use((response) => {
    return response;
  }, (error) => {
    if (error.code === 'ECONNABORTED') {
      Vue.prototype.$message('请求超时');
    } else if (error.response.status === 401) {
      Vue.prototype.$message('请先登录');
      router.push({name: 'login'});
    } else if (error.response.status === 422) {
      let errorsTemp = error.response.data.errors;
      for (let index in errorsTemp) {
        errorsTemp[index] = errorsTemp[index].join(',');
      }
    } else {
      if (error.config.noErrorTip) {
        return Promise.reject(error);
      }
      if (error.response.data.message) {
        Vue.prototype.$message(error.response.data.message);
      }
    }
    return Promise.reject(error);
  });
};

export default tHttp;
