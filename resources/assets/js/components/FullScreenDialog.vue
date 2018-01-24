<template>
  <transition name="side">
    <div v-show="isShow" class="full_screen_dialog">
      <header>
        <div @click="close" class="close"></div>
        <button @click="$emit('save');" class="save">保存</button>
      </header>
      <slot></slot>
    </div>
  </transition>
</template>

<script>
export default {
  name: 'FullScreenDialog',
  props: {
    show: Boolean
  },
  watch: {
    show (show) {
      this.isShow = show;
    }
  },
  data () {
    return {
      isShow: this.show
    };
  },
  methods: {
    close () {
      this.$emit('update:show', false);
    }
  }
};
</script>

<style scoped lang="less">
.side-enter-active, .side-leave-active {
  transition: all .3s;
}
.side-enter, .side-leave-to{
  transform: translateY(100%);
  opacity: 0;
}
.full_screen_dialog{
  background-color: #fff;
  position: fixed;
  top: 0;
  bottom: 0;
  left: 0;
  right: 0;
  >header{
    position: relative;
    height: 64px;
    .save{
      position: absolute;
      right: 15px;
      top: 15px;
      background-color: transparent;
      border: 0;
      font-size: 14px;
      color: #666;
    }
  }
  .close{
    position: absolute;
    top: 15px;
    left: 15px;
    height: 25px;
    width: 25px;
    &::after, &::before{
      position: absolute;
      content: '';
      background-color: #0f88eb;
      display: block;
      top: 50%;
      left: 50%;
      transform: rotate(45deg);
      border-radius: 40%;
    }
    &::after {
      margin-left: -1.5px;
      margin-top: -11.5px;
      width: 3px;
      height: 23px;
    }
    &::before {
      margin-top: -1.5px;
      margin-left: -11.5px;
      width: 23px;
      height: 3px;
    }
  }
}
</style>
