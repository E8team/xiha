<template>
  <header>
    <div @click="$router.push({name: 'home'})" class="logo">嘻哈</div>
    <!-- <router-link class="login_btn" :to="{name: 'login'}">登录 · 注册</router-link> -->

    <div @click="$router.push({name: 'user'})" class="cover_wrapper">
      <img src="https://gitee.com/uploads/4/634804_3twd.png?1465007207" alt="">
    </div>
    <div @click="$router.push({name: 'publish'})" class="publish_btn">
      <i class="iconfont icon-tianjia"></i>
    </div>
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
    position: relative;
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
      font-family: '宋体';
      font-weight: bold;
    }
  }
</style>

