<template>
  <header>
    <div @click="$router.push({name: 'home'})" class="logo">嘻哈</div>
    <router-link v-if="!me" class="login_btn" :to="{name: 'login'}">登录 · 注册</router-link>
    <template v-else>
      <div @click="$router.push({name: 'user', params: {id: me.username}})" class="cover_wrapper">
        <img :src="me.avatar.cover_url" :alt="me.name">
      </div>
      <div @click="$router.push({name: 'publish'})" class="publish_btn">
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
  },
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
    >.publish_btn{
      float: right;
      >i{ 
        font-size: 24px;
        color: #666;
        margin-right: 15px;
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

