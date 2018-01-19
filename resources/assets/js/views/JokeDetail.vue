<template>
  <div class="joke_detail">
    <TNav></TNav>
    <JokeBody></JokeBody>
    <div class="comment">
      <header>
        <h3>评论<span class="comment_num">(1514)</span></h3>
      </header>
      <CommentItem />
      <CommentItem />
      <CommentItem />
    </div>
  </div>
</template>

<script>
import TNav from '../components/TNav.vue';
import JokeBody from '../components/JokeBody.vue';
import CommentItem from '../components/CommentItem.vue';
export default {
  components: { TNav, JokeBody, CommentItem }
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
