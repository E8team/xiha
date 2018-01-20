import Confirm from './Confirm.vue';
import Vue from 'vue';

let ConfirmConstructor = Vue.extend(Confirm);
export default function confirm (content, title = '确认？', confirmTilte = '确认', cancelTilte = '取消', confirm = () => {}, cancel = () => {}) {
  let instance = new ConfirmConstructor({
    data: {
      content,
      title,
      confirmTilte,
      cancelTilte
    },
    methods: {
      cancelCallBack: cancel,
      confirmCallBack: confirm
    }
  });
  instance.$mount();
  document.body.appendChild(instance.$el);
  return instance;
}
