<template>
  <transition name="fade">
    <div v-show="visable" class="js_dialog">
      <div class="weui-mask"></div>
      <div class="weui-dialog weui-skin_android">
        <div class="weui-dialog__hd"><strong class="weui-dialog__title">{{title}}</strong></div>
        <div class="weui-dialog__bd">
            {{content}}
        </div>
        <div class="weui-dialog__ft">
            <a href="javascript:;" @click="cancel" class="weui-dialog__btn weui-dialog__btn_default">{{cancelTilte}}</a>
            <a href="javascript:;" @click="confirm" class="weui-dialog__btn weui-dialog__btn_primary">{{confirmTilte}}</a>
        </div>
      </div>
    </div>
  </transition>
</template>

<script>
export default {
  data () {
    return {
      content: '',
      title: '',
      confirmTilte: '',
      cancelTilte: '',
      visable: false
    };
  },
  methods: {
    cancel () {
      this.cancelCallBack();
      this.visable = false;
      this.hide();
    },
    confirm () {
      this.confirmCallBack();
      this.hide();
    },
    hide () {
      this.visable = false;
      this.$el.addEventListener('transitionend', this.destroyElement);
    },
    destroyElement () {
      this.$el.removeEventListener('transitionend', this.destroyElement);
      this.$el.parentNode.removeChild(this.$el);
      this.$destroy(true);
    }
  },
  mounted () {
    this.visable = true;
  }
};
</script>

<style scoped>
.fade-enter-active, .fade-leave-active {
  transition: opacity .3s cubic-bezier(.55,0,.1,1);
}
.fade-enter, .fade-leave-active {
  opacity: 0;
}
</style>