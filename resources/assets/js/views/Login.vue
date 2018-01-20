<template>
  <div class="login">
    <TNav></TNav>
    <section class="intro">
      <div class="logo">
        <img :src="require('../assets/logo.png')" alt="">
        <h1>嘻 哈</h1>
      </div>
      <p class="text">嘻哈是一个原创的笑话分享社区, 分享的搞笑段子、搞笑图片大全。一切爆笑尽在嘻哈。</p>
      <div class="btn_wrapper">
        <button class="button github"><i class="iconfont icon-github"></i>GitHub账号登陆</button>
      </div>
    </section>
  </div>
</template>
<script>
import TNav from '../components/TNav.vue';
export default {
  components: { TNav }
};
</script>

<style lang="less" scoped>
.intro{
  background: #fff;
  .logo{
    text-align: center;
    padding: 20px 0;
    img{
      width: 100px;
      height: 100px;
      padding: 10px;
      margin: 0 auto;
      display: block;
    }
    h1{
      margin: 10px 0;
      font-size: 25px;
      font-weight: 100;

    }
  }
  .text {
    margin: 0 25px;
    margin-bottom: 40px;
    font-size: 15px;
    color: #2D2D2F;
    line-height: 24px;
    max-width: 380px;
  }
  .btn_wrapper{
    padding: 0 20px;
  }
  .button{
    border: 0;
    border-radius: 4px;
    height: 50px;
    line-height: 32px;
    font-size: 14px;
    position: relative;
    padding: 0 16px;
    color: rgba(0, 0, 0, 0.44);
    text-align: center;
    text-decoration: none;
    cursor: pointer;
    vertical-align: bottom;
    white-space: nowrap;
    -moz-user-select: none;
    -ms-user-select: none;
    user-select: none;
    box-sizing: border-box;
    font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Oxygen, Ubuntu, Cantarell, "Open Sans", "Helvetica Neue", sans-serif;
    letter-spacing: 0;
    font-weight: 400;
    font-style: normal;
    text-rendering: optimizeLegibility;
    width: 100%;
    outline: none;
    &.github{
      background: #4A4A4A;
      margin-bottom: 20px;
      color: #fff;
      .iconfont{
        font-size: 20px;
        padding-right: 10px;
      }
    }
  }
}
</style>
