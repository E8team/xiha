<template>
  <div class="joke_detail">
    <TNav></TNav>
    <JokeBody v-if="joke" :user="joke.user" :joke="joke"></JokeBody>
    <JokeBodyPlaceholders v-else/>
    <LoadMoreWrapper :url="`jokes/${this.$route.params.id}/comments`" ref="commentLoadMore">
      <template slot-scope="props">
        <div class="comment">
          <header>
            <h3>评论<span class="comment_num">({{joke && joke.comments_count}})</span></h3>
          </header>
          <p v-if="props.data.length === 0" class="no_data">Σ(ﾟдﾟ;) 还没有评论</p>
          <CommentItem :comment="comment" v-for="comment in props.data" :key="comment.id"/>
        </div>
      </template>
    </LoadMoreWrapper>
    <CommentEditor @send_comment="sendComment"></CommentEditor>
  </div>
</template>  

<script>
import TNav from '../components/TNav.vue';
import JokeBody from '../components/JokeBody.vue';
import CommentItem from '../components/CommentItem.vue';
import JokeBodyPlaceholders from '../components/JokeBodyPlaceholders.vue';
import CommentEditor from '../components/CommentEditor.vue';
import LoadMoreWrapper from '../components/LoadMoreWrapper.vue';
export default {
  components: { TNav, JokeBody, CommentItem, JokeBodyPlaceholders, CommentEditor, LoadMoreWrapper },
  data () {
    return {
      joke: null
    };
  },
  methods: {
    async sendComment (text) {
      let res = await this.$http.post(`jokes/${this.$route.params.id}/comment`, {content: text});
      res.data.data.user = this.$store.state.me;
      this.$refs.commentLoadMore.addItem(res.data.data);
    }
  },
  activated () {
    let lastPublishJoke = this.$store.state.lastPublishJoke;
    if (lastPublishJoke && this.$route.params.id === lastPublishJoke.id) {
      // 刚刚创建的笑话
      this.joke = lastPublishJoke;
      this.joke.user = this.$store.state.me;
    } else {
      this.joke = null;
      this.$http.get(`jokes/${this.$route.params.id}`).then(res => {
        this.joke = res.data.data;
      });
    }
  }
};
</script>

<style lang="less" scoped>
.joke_detail{
  padding-bottom: 60px;
}
.comment{
  margin-top: 10px;
  background: #fff;
  padding: 10px;
  padding-bottom: 0;
  overflow: hidden;
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
  .no_data{
    line-height: 50px;
    font-size: 16px;
    color: #777;
    margin-top: 5px;
    text-align: center;
  }
}
</style>
