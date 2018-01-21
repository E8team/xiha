<template>
  <div class="joke_detail">
    <TNav></TNav>
    <JokeBody v-if="joke" :joke="joke"></JokeBody>
    <JokeBodyPlaceholders v-else/>
    <div class="comment">
      <header>
        <h3>评论<span class="comment_num">({{joke && joke.comments_count}})</span></h3>
      </header>
      <CommentItem />
    </div>
  </div>
</template>

<script>
import TNav from '../components/TNav.vue';
import JokeBody from '../components/JokeBody.vue';
import CommentItem from '../components/CommentItem.vue';
import JokeBodyPlaceholders from '../components/JokeBodyPlaceholders.vue';
export default {
  components: { TNav, JokeBody, CommentItem, JokeBodyPlaceholders },
  data () {
    return {
      joke: null
    };
  },
  mounted () {
    let lastPublishJoke = this.$store.state.lastPublishJoke;
    if (lastPublishJoke && this.$route.params.id === lastPublishJoke.id) {
      // 刚刚创建的笑话
      this.joke = lastPublishJoke;
      this.joke.user = this.$store.state.me;
    } else {
      (async () => {
        let res = await this.$http.get(`jokes/${this.$route.params.id}`);
        this.joke = res.data.data;
      })();
    }
  }
};
</script>

<style lang="less" scoped>
.comment{
  margin-top: 10px;
  background: #fff;
  padding: 10px;
  padding-bottom: 0;
  header{
    line-height: 30px;
    h3{
      margin: 0;
      font-weight: 100;
      font-size: 16px;
      .comment_num{
        margin-left: 10px;
        color: #777;
      }
    }
  }
}
</style>
