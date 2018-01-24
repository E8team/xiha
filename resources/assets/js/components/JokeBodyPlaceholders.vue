<template>
<div>
  <div v-for="n in length" :key="n" class="content_placeholders_wrapper">
    <content-placeholders>
      <content-placeholders-heading :img="true" />
      <content-placeholders-text :lines="3" />
    </content-placeholders>
  </div>
</div>
</template>
<script>
export default {
  name: 'JokeBodyPlaceholders',
  props: {
    length: {
      type: Number,
      default: 1
    }
  }
};
</script>
<style lang="less" scoped>
.content_placeholders_wrapper{
  background-color: #fff;
  padding: 10px;
  box-shadow: 0 1px 3px rgba(26,26,26,.1);
  margin-bottom: 10px;
}
</style>
