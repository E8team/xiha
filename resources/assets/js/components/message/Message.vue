<template>
  <transition name="el-message-fade">
    <div v-show="visable" class="message" :class="type">
      {{msg}}
    </div>
  </transition>
</template>

<script>
export default {
  data () {
    return {
      visable: false,
      type: 'error',
      msg: '',
      delay: 3000
    };
  },
  methods: {
    destroyElement () {
      this.$el.removeEventListener('transitionend', this.destroyElement);
      this.$el.parentNode.removeChild(this.$el);
      this.$destroy(true);
    }
  },
  mounted () {
    this.visable = true;
    setTimeout(() => {
      this.$el.addEventListener('transitionend', this.destroyElement);
      this.visable = false;
    }, this.delay);
  }
};
</script>

<style scoped>
  .message{
    line-height: 28px;
    font-size: 12px;
    color: #fff;
    position: fixed;
    z-index: 1000;
    top: 50px;
    left: 0;
    width: 100%;
    background-color: #333;
    text-align: center;
    transition: opacity .3s,transform .4s;
  }
  .message.error{
    color: #a94442;
    background-color: #f2dede;
  }
  .message.info{
    color: #31708f;
    background-color: #d9edf7;
  }
  .message.success{
    color: #3c763d;
    background-color: #dff0d8;
  }
  .el-message-fade-enter,.el-message-fade-leave-active{
    opacity:0;
    -webkit-transform:translate(0, -100%);
    transform:translate(0, -100%)
  }
</style>
