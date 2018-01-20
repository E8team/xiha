<template>
  <router-view></router-view>
</template>
<script>

export default {
  mounted () {
    if (location.search.includes('logined')) {
      this.$store.dispatch('updateMe');
    }
  }
};
</script>
<style lang="less">
  @import url(//at.alicdn.com/t/font_548487_nr3fhlnnu1y8pvi.css);
  body, html {
    font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Ubuntu, "Helvetica Neue", Helvetica, Arial, "PingFang SC", "Hiragino Sans GB", "Microsoft YaHei UI", "Microsoft YaHei", "Source Han Sans CN", sans-serif;
    background: #f3f3f3;
    text-rendering: optimizelegibility;
  }
  *{
    box-sizing: border-box;
  }
</style>
