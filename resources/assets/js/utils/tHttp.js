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
  let headers = {
    'X-Requested-With': 'XMLHttpRequest',
  };
  let jwtToken = localStorage.getItem('jwt_token');
  if (jwtToken) {
    headers.Authorization = 'Bearer ' + jwtToken;
  }
  Vue.prototype.$http = axios.create({
    baseURL,
    timeout: 6000,
    responseType: 'json',
    headers
  });
  Vue.prototype.$http.interceptors.response.use((response) => {
    return response;
  }, (error) => {
    if (error.code === 'ECONNABORTED') {
      Vue.prototype.$Message('请求超时');
    } else if (error.response.status === 401) {
      Vue.prototype.$Message('请先登录');
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
        Vue.prototype.$Message('出错了');
      }
    }
    return Promise.reject(error);
  });
};

export default tHttp;
