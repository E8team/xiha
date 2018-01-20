import Message from './Message.vue';
import Vue from 'vue';
let MessageConstructor = Vue.extend(Message);
export default function message (options) {
  if (typeof options === 'string') {
    options = {
      msg: options
    };
  }
  let instance = new MessageConstructor({
    data: options
  });
  instance.$mount();
  document.body.appendChild(instance.$el);
  return instance;
}
