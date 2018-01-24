<template>
  <div class="joke">
    <header>
      <div @click="$router.push({name: 'user', params: {id: joke.user.username}})">
        <img class="user_img" :src="joke.user && joke.user.avatar.cover_url">
        <div class="user_name">{{joke.user && joke.user.name}}</div>
      </div>
    </header>
    <section @click="$router.push({name: 'joke', params: {id: joke.id}})"  class="content">
      <div>{{joke.content}}</div>
      <div @click.stop="$refs['photoSwipe'].show()" v-if="joke.image" :class="{'gif': joke.image.is_gif, 'high': joke.image.is_high}" class="img">
        <img :src="joke.image.cover_url" alt="">
      </div>
    </section>
    <footer>
      <button :class="{'active': joke.me_vote && joke.me_vote.type === 'up_vote'}" @click.stop="upVote" class="btn vote" type="button">
        <svg viewBox="0 0 20 18" class="icon" width="9" height="16">
          <g><path d="M0 15.243c0-.326.088-.533.236-.896l7.98-13.204C8.57.57 9.086 0 10 0s1.43.57 1.784 1.143l7.98 13.204c.15.363.236.57.236.896 0 1.386-.875 1.9-1.955 1.9H1.955c-1.08 0-1.955-.517-1.955-1.9z"></path></g>
        </svg>
        {{joke.up_votes_count}}
      </button>
      <button :class="{'active': joke.me_vote && joke.me_vote.type === 'down_vote'}" @click.stop="downVote" class="btn vote tread" type="button">
        <svg viewBox="0 0 20 18" class="icon" width="9" height="16">
          <g><path d="M0 15.243c0-.326.088-.533.236-.896l7.98-13.204C8.57.57 9.086 0 10 0s1.43.57 1.784 1.143l7.98 13.204c.15.363.236.57.236.896 0 1.386-.875 1.9-1.955 1.9H1.955c-1.08 0-1.955-.517-1.955-1.9z"></path></g>
        </svg>
      </button>
      <button class="btn comment" type="button">
        <svg fill="currentColor" viewBox="0 0 24 24" width="1.2em" height="1.2em">
          <path d="M10.241 19.313a.97.97 0 0 0-.77.2 7.908 7.908 0 0 1-3.772 1.482.409.409 0 0 1-.38-.637 5.825 5.825 0 0 0 1.11-2.237.605.605 0 0 0-.227-.59A7.935 7.935 0 0 1 3 11.25C3 6.7 7.03 3 12 3s9 3.7 9 8.25-4.373 9.108-10.759 8.063z" fill-rule="evenodd">
          </path>
        </svg>
        <div @click="$router.push({name: 'joke', params: {id: joke.id}})">评论 {{joke.comments_count}}</div>
      </button>
    </footer>
    <PhotoSwipe v-dom-portal ref="photoSwipe" :items="items"></PhotoSwipe>
  </div>
</template>
<script>
import PhotoSwipe from './PhotoSwipe.vue';
export default {
  name: 'JokeBody',
  components: { PhotoSwipe },
  props: {
    joke: Object
  },
  computed: {
    items () {
      if (this.joke.image) {
        return [{
          src: this.joke.image.url,
          w: this.joke.image.width,
          h: this.joke.image.height
        }];
      }
    }
  },
  methods: {
    async upVote () {
      let res;
      if (!this.joke.me_vote || this.joke.me_vote.type !== 'up_vote') {
        res = await this.$http.patch(`jokes/${this.joke.id}/up_vote`);
        this.joke.me_vote = { type: 'up_vote' };
      } else {
        res = await this.$http.patch(`jokes/${this.joke.id}/cancel_vote`);
        this.joke.me_vote = null;
      }
      this.joke.up_votes_count = res.data.up_votes_count;
    },
    async downVote () {
      let res;
      if (!this.joke.me_vote || this.joke.me_vote.type !== 'down_vote') {
        res = await this.$http.patch(`jokes/${this.joke.id}/down_vote`);
        this.joke.me_vote = { type: 'down_vote' };
      } else {
        res = await this.$http.patch(`jokes/${this.joke.id}/cancel_vote`);
        this.joke.me_vote = null;
      }
      this.joke.up_votes_count = res.data.up_votes_count;
    }
  }
};
</script>

<style lang="less" scoped>
.joke{
  margin-bottom: 10px;
  background: #fff;
  border-radius: 2px;
  box-shadow: 0 1px 3px rgba(26,26,26,.1);
  padding: 15px;
  
  &:active{
    background-color: #fafafa;
  }
  header {
    display: flex;
    flex-direction: row;
    .user_img{
      border-radius: 2px;
      width: 38px;
      height: 38px;
    }
    .user_name{
      line-height: 38px;
      padding-left: 10px;
      font-size: 14px;
      color: #888;
      white-space: nowrap;
      overflow: hidden;
      text-overflow: ellipsis;
      display: inline-block;
    }
  }
  .content{
    overflow: hidden;
    margin: 0;
    padding: 15px 0;
    font-size: 15px;
    color: #4e4e4e;
    line-height: 1.8;
    word-break: break-all;
    .img{
      margin-top: 10px;
      position: relative;
      display: inline-block;
      >img{
        max-width: 100%;
        vertical-align: middle;
      }
      &.gif::after, &.high::after{
        position: absolute;
        bottom: 0;
        right: 0;
        padding: 0px 3px;
        font-size: 11px;
        color: #fff;
        background-color: rgba(80,125,175,.75);
      }
      &.gif::after{
        content: '动图';
      }
      &.high::after{
        content: '长图';
      }
    }
  }
  .btn {
    outline: none;
    display: inline-block;
    font-size: 14px;
    line-height: 32px;
    text-align: center;
    cursor: pointer;
    border: 1px solid;
    color: #8590a6;
  }
  footer{
    .btn.active{
      color: #fff!important;
      background: #0084ff!important;
    }
    .btn.vote{
      border-radius: 3px;
      padding: 0 10px;
      color: #0084ff;
      background: rgba(0, 132, 255, 0.1);
      border-color: transparent;
      .icon{
        margin-right: 5px;
        fill: currentColor;
        height: 12px;
        width: 9px;
      }
      &.tread{
        .icon {
          margin-right: 0;
          transform: rotate(180deg);
        }
      }
    }
    .comment{
      padding: 0;
      margin-left: 13px;
      line-height: inherit;
      background-color: transparent;
      border: none;
      border-radius: 0;
      position: relative;
      div{
        padding-left: 20px;
      }
      svg{
        position: absolute;
        left: 0;
        top: 0;
      } 
    }
  }
}
</style>

