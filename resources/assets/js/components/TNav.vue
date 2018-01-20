<template>
  <header>
    <div class="logo">嘻哈</div>
    <router-link class="login_btn" :to="{name: 'login'}">登录 · 注册</router-link>
    <!-- https://gitee.com/uploads/4/634804_3twd.png?1465007207 -->
  </header>
</template>

<style lang="less" scoped>
  header{
    line-height: 50px;
    height: 50px;
    background-color: #fff;
    padding: 0 10px;
    border-bottom: 1px solid rgba(30,35,42,.06);
    box-shadow: 0 1px 1px 0 rgba(0, 34, 77, 0.05);
    >.login_btn{
      float: right;
      color: #007fff;
      text-decoration: none;
    }
    >.logo{
      float: left;
      font-size: 24px;
      color: rgb(15, 136, 235);
      font-family: '宋体';
      font-weight: bold;
    }
  }
</style>

