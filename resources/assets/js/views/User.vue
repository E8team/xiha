<template>
  <div class="user_info">
    <TNav></TNav>
    <div class="user_info_block">
      <div class="cover">
        <img :src="user.avatar && user.avatar.avatar_sm" :alt="user.name">
      </div>
      <h1>{{user.name}} <a class="github_link" :href="user.github_url"><i class="iconfont icon-github"></i></a></h1>
      <p class="intro">{{user.introduce}}</p>
      <button v-if="isMine" @click="$router.push({name: 'userSettings'})" class="edit_btn"><i class="iconfont icon-bianji"></i> 编辑资料</button>
      <footer>
        <ul>
          <li class="active">投稿 <span class="tip">({{user.jokes_count}})</span></li>
        </ul>
      </footer>
    </div>
    <div class="jokes">
      <LoadMoreWrapper :url="`users/${this.$route.params.id}/jokes`" ref="jokesLoadMore">
        <template slot-scope="props">
          <JokeBody :key="item.id" :user="user" :joke="item" v-for="item in props.data"></JokeBody>
        </template>
      </LoadMoreWrapper>
    </div>
  </div>
</template>

<script>
import JokeBody from '../components/JokeBody.vue';
import TNav from '../components/TNav.vue';
import LoadMoreWrapper from '../components/LoadMoreWrapper.vue';
export default {
  components: {
    TNav, JokeBody, LoadMoreWrapper
  },
  data () {
    return {
      user: {}
    };
  },
  computed: {
    isMine () {
      if (this.$store.state.me) {
        return this.$store.state.me.username === this.$route.params.id;
      }
    }
  },
  methods: {
    init () {
      if (this.isMine) {
        this.user = this.$store.state.me;
      } else {
        (async () => {
          let user = await this.$http.get(`users/${this.$route.params.id}`);
          this.user = user.data.data;
        })();
      }
    }
  },
  activated () {
    this.init();
  },
  watch: {
    $route ($route) {
      if ($route.name !== 'user') {
        return;
      }
      this.init();
      this.$refs.jokesLoadMore.refresh(`users/${this.$route.params.id}/jokes`);
    }
  }
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
  .edit_btn{
    width: 130px;
    height: 35px;
    margin: 20px auto 0;
    display: block;
    background-color: #fff;
    color: #3780f7;
    border-radius: 3px;
    border: 0;
    outline: none;
    border: 1px solid currentColor;
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
.jokes{
  padding: 10px;
}
</style>

