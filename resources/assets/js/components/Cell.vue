<template>
  <div class="cell">
    <div class="title">
      {{title}}
    </div>
    <div class="content">
      <slot></slot>
    </div>
  </div>
</template>

<script>
export default {
  name: 'cell',
  props: {
    title: String
  }
};
</script>
<style lang="less" scoped>
.cell{
  background-color: #fff;
  padding: 15px 10px;
  border-bottom: 1px solid #eee;
  overflow: hidden;
  position: relative;
  min-height: 49.4px;
  &:active{
    background-color: #fafafa;
  }
  .title, .content{
    font-size: 16px;
  }
  .title{
    text-align: left;
    color: #505050;
    position: absolute;
    top: 50%;
    transform: translateY(-50%);
  }
  .content{
    float: right;
    color: #999;
  }
}
</style>

