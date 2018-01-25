<template>
  <div class="comment_editor" :class="{'focus': focus}">
    <input @keydown.enter="$emit('send_comment', text), text = ''" v-model="text" @focus="focus = true" @blur="focus = false" placeholder="说点什么" type="text">
    <button @click="$emit('send_comment', text), text = ''" class="send_btn"><i class="iconfont icon-fasong"></i></button>
    <div v-if="focus" class="mask"></div>
  </div>
</template>

<script>
export default {
  name: 'CommentEditor',
  data () {
    return {
      focus: false,
      text: ''
    };
  }
};
</script>

<style scoped lang="less">
.comment_editor{
  position: fixed;
  bottom: 0;
  left: 0;
  display: flex;
  width: 100%;
  height: 35px;
  >.mask{
    position: fixed;
    top: 0;
    bottom: 0;
    left: 0;
    right: 0;
    background-color: rgba(0, 0, 0, .6);
    z-index: 12;
  }
  &.focus{
    border-top-left-radius: 5px;
    border-top-right-radius: 5px;
    box-shadow: 0 -1px 1px 0 rgba(0, 34, 77, 0.05);
    .send_btn{
      color: #333;
    }
  }
  >input{
    flex-grow: 1;
    outline: 0;
    border: 0;
    padding: 0 10px;
    font-size: 12px;
    z-index: 13;
    position: relative;
  }
  .send_btn{
    outline: none;
    width: 35px;
    border: 0;
    background-color: #fff;
    color: #999;
    z-index: 13;
    position: relative;
  }
}
</style>
