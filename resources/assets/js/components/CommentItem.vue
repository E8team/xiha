<template>
  <div class="comment_item">
    <div @click="$router.push({name: 'user', params: {id: joke.user.username}})" class="cover_wrapper">
      <img :src="comment.user && comment.user.avatar.cover_url">
    </div>
    <div @click="$router.push({name: 'user', params: {id: joke.user.username}})" class="user_name">{{comment.user.name}}</div>
    <div class="zan" @click="zan" :class="{'active': comment.me_vote}">
      <i class="iconfont icon-xin"></i>
      <div class="zan_num">{{comment.up_votes_count}}</div>
    </div>
    <p class="comment_text">
      {{comment.content}}
    </p>
    <footer>
      <span class="comment_time">{{comment.create_at | timeAgo}}</span>
    </footer>
  </div>
</template>
<script>
export default {
  name: 'CommentItem',
  props: {
    comment: Object
  },
  methods: {
    async zan () {
      let res;
      if (!this.comment.me_vote) {
        res = await this.$http.patch(`comments/${this.comment.id}/up_vote`);
        this.comment.me_vote = { type: 'up_vote' };
      } else {
        res = await this.$http.patch(`comments/${this.comment.id}/cancel_vote`);
        this.comment.me_vote = null;
      }
      this.comment.up_votes_count = res.data.up_votes_count;
    }
  }
};
</script>

<style lang="less" scoped>
.comment_item{
  border-bottom: .02133rem solid #eee;
  position: relative;
  padding: 10px 0 10px 50px;
  .cover_wrapper{
    position: absolute;
    left: 0px;
    top: 10px;
    width: 40px;
    height: 40px;
    border-radius: 3px;
    overflow: hidden;
    img{
      width: 100%;
    }
  }
  .user_name{
    display: block;
    max-width: 60%;
    color: #757575;
    font-size: 14px;
    overflow: hidden;
    text-overflow: ellipsis;
    white-space: nowrap;
  }
  .zan{
    position: absolute;
    right: 10px;
    top: 7px;
    color: #999;
    &.active{
      color: #ed4630;
    }
    >i{
      font-size: 24px;
    }
    >.zan_num{
      font-size: 12px;
      text-align: center;
    }
  }
  .comment_time{
    font-size: 12px;
    color: #999;
  }
  .comment_text{
    color: #212121;
    line-height: 18px;
    font-size: 15px;
    margin: 0;
    margin-top: 10px;
  }
  footer{
    padding-top: 5px;
    overflow: hidden;
  }
}
</style>
