<template>
  <div class="m_input">
    <div @click="$refs['input'].focus()" :class="{'focus': focus, 'open': open}" class="placeholder">{{placeholder}}</div>
    <input ref="input" v-model="text" :class="{'focus': focus}" @focus="focus = true" @blur="focus = false" type="text">
  </div>
</template>

<script>
export default {
  name: 'MInput',
  props: {
    placeholder: String,
    value: String
  },
  watch: {
    value (val) {
      this.text = val;
    },
    text (txt) {
      this.$emit('input', txt);
    }
  },
  computed: {
    open () {
      if (this.focus) {
        return true;
      }
      return this.text.length > 0;
    }
  },
  data () {
    return {
      focus: false,
      text: this.value
    };
  }
};
</script>

<style scoped lang="less">
  .m_input{
    position: relative;
    .placeholder{
      position: absolute;
      color: #999;
      font-size: 14px;
      top: 8px;
      left: 0;
      transition: all .3s;
      &.open{
        top: -11px;
        font-size: 12px;
      }
      &.focus{
        color: #0f88eb;
      }
    }
    input{
      transition: all .1s;
      font-size: 14px;
      width: 100%;
      border: 0;
      border-bottom: 1px solid #999;
      &.focus{
        border-bottom: 2px solid #0f88eb;
      }
      line-height: 35px;
      outline: none;
    }
  }
</style>
