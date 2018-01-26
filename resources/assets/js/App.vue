<template>
  <keep-alive>
    <router-view></router-view>
  </keep-alive>
</template>
<script>
import { isLogin } from './utils/utils';
export default {
  data () {
    return {
      unreadTimer: null
    };
  },
  mounted () {
    if (isLogin()) {
      this.$store.dispatch('updateMe');
      this.getUnreadCount();
      this.unreadTimer = setInterval(() => {
        this.getUnreadCount();
      }, 10000);
    }
  },
  methods: {
    async getUnreadCount () {
      let res = await this.$http.get('me/notifications/unread_count');
      this.$store.commit('UPDATE_UNREAD', res.data.unread);
    }
  },
};
</script>
<style lang="less">
  @import url(//at.alicdn.com/t/font_548487_mgfw2desy4mibe29.css);
  body, html {
    font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Ubuntu, "Helvetica Neue", Helvetica, Arial, "PingFang SC", "Hiragino Sans GB", "Microsoft YaHei UI", "Microsoft YaHei", "Source Han Sans CN", sans-serif;
    background: #f3f3f3;
    text-rendering: optimizelegibility;
  }
  @media screen and (min-width: 600px) {
    body, .scroller{
      width: 500px!important;
      margin: 0 auto!important;
    }  
    .scroller {
      left: 50%!important;
      margin-left: -250px!important;
    }
  }
  *{
    box-sizing: border-box;
  }
</style>
