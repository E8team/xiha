<template>
  <div class="user_info">
    <TNav></TNav>
    <div class="user_info_block">
      <div class="cover">
        <img :src="user.avatar_url" :alt="user.name">
      </div>
      <h1>{{user.name}} <a class="github_link" :href="user.github_url"><i class="iconfont icon-github"></i></a></h1>
      <p class="intro">口中疾呼烫烫烫</p>
      <footer>
        <ul>
          <li class="active">投稿 <span class="tip">({{user.jokes_count}})</span></li>
          <li>回复</li>
          <li>赞</li>
        </ul>
      </footer>
    </div>
  </div>
</template>

<script>
import TNav from '../components/TNav.vue';
export default {
  components: {
    TNav
  },
  computed: {
    user () {
      return this.$store.state.me || {};
    },
  },
};
</script>

<style lang="less" scoped>
.user_info_block{
  background-color: #fff;
  padding: 20px 10px 0 10px;
  .cover{
    text-align: center;
    img{
      width: 90px;
      height: 90px;
      border-radius: 3px;
    }
  }
  h1{
    text-align: center;
    font-size: 20px;
    margin-bottom: 17px;
    .github_link{
      text-decoration: none;
      color: #333;
    }
  }
  .intro{
    font-size: 14px;
    color: #72777b;
    text-align: center;
  }
  footer{
    margin-top: 10px;
    border-bottom: 1px solid #eeeaea;
    ul{
      padding: 0;
      list-style: none;
      overflow: hidden;
      margin: 0;
      li{
        float: left;
        font-size: 16px;
        color: #818181;
        padding: 15px;
        position: relative;
        >.tip{
          color: #777;
          font-size: 14px;
        }
        &.active{
          font-weight: bold;
          color: #2D2D2F;
          &::before{
            content: '';
            position: absolute;
            display: block;
            width: 60%;
            left: 20%;
            bottom: 0;
            height: 3px;
            background-color: #000;
          }
        }
      }
    }
  }
}
</style>

