<template>
  <header>
    <div @click="$router.push({name: 'home'})" class="logo">嘻哈</div>
    <router-link v-if="!me" class="login_btn" :to="{name: 'login'}">登录 · 注册</router-link>
    <template v-else>
      <div @click="$router.push({name: 'user', params: {id: me.username}})" class="cover_wrapper">
        <img :src="me.avatar.avatar_sm" :alt="me.name">
      </div>
      <div @click="$router.push({name: 'notification'})" class="icon_btn" :class="{'has_notify': hasNotify}">
        <i class="iconfont icon-tongzhi"></i>
      </div>
      <div @click="$router.push({name: 'publish'})" class="icon_btn">
        <i class="iconfont icon-tianjia"></i>
      </div>
    </template>
  </header>
</template>

<script>

export default {
  name: 'TNav',
  computed: {
    me () {
      return this.$store.state.me;
    },
    hasNotify () {
      return this.$store.state.unread > 0;
    }
  }
};
</script>

<style lang="less" scoped>
  header{
    line-height: 50px;
    height: 50px;
    background-color: #fff;
    padding: 0 10px;
    border-bottom: 1px solid rgba(30,35,42,.06);
    position: relative;
    z-index: 11;
    >.icon_btn{
      float: right;
      position: relative;
      >i{ 
        font-size: 24px;
        color: #666;
        margin-right: 15px;
      }
      &.has_notify::after{
        content: '';
        position: absolute;
        top: 13px;
        right: 16px;
        width: 8px;
        height: 8px;
        border-radius: 50%;
        background-color: red;
        border: 1.5px solid #fff;
        box-shadow: 0 1px 3px rgba(26, 26, 26, 0.1);
      }
    }
    >.cover_wrapper{
      margin-top: 9px;
      margin-right: 2px;
      float: right;
      width: 30px;
      height: 30px;
      border-radius: 3px;
      overflow: hidden;
      >img{
        width: 100%;
      }
    }
    >.login_btn{
      float: right;
      color: #007fff;
      text-decoration: none;
    }
    >.logo{
      float: left;
      font-size: 24px;
      color: rgb(15, 136, 235);
      font-weight: 100;
    }
  }
</style>

