<template>
  <div class="notification">
    <TNav></TNav>
    <scroller
      class="scroller"
      ref="scroller"
      noDataText="(･∀･) 到底了！"
      :on-infinite="infinite">
      <div class="notification_list">
        <header>
          <button @click="read()">全部标记为已读</button>
        </header>
        <ul>
          <li @click="read(notification.id, index)" :class="{'readed': notification.read_at}" class="item" v-for="(notification, index) in list" :key="notification.id">
            <div @click="$router.push({name: 'user', params: {id: notification.data.user.id}})" class="user" v-if="notification.data.user">
              <img :src="notification.data.user.avatar.avatar_xs" alt="">
              <div class="user_name">{{notification.data.user.name}}</div>
            </div>
            <div class="content">
              <template v-if="notification.type === 'up_vote_joke'">
                点赞了您的 <router-link :to="{name: 'joke', params: {id: notification.data.joke.id}}">笑话</router-link>
              </template>
              <template v-if="notification.type === 'up_vote_comment'">
                点赞了您的评论 {{notification.data.comment.content | limit(5) }}
              </template>
              <template v-if="notification.type === 'comment_joke'">
                评论了您的 <router-link :to="{name: 'joke', params: {id: notification.data.joke.id}}">笑话</router-link>
              </template>
            </div>
            <div class="time">{{notification.created_at | timeAgo}}</div>
          </li>
        </ul>
      </div>
    </scroller>    
  </div>
</template>

<script>
import TNav from '../components/TNav.vue';
export default {
  components: { TNav },
  data () {
    return {
      list: [],
      links: {},
      isNull: true
    };
  },
  methods: {
    async read (id = '', index) {
      await this.$http.patch(`me/notifications/read/${id}`);
      if (index) {
        this.list[index].read_at = true;
      } else {
        this.list.forEach(notification => {
          notification.read_at = true;
        });
      }
    },
    async infinite (done) {
      let len = 0;
      if (this.links.next) {
        len = await this.getList(this.links.next);
      }
      done(len === 0);
    },
    async getList (link) {
      let res = await this.$http.get(link || '/me/notifications');
      this.links = res.data.links;
      if (link) {
        this.list.push(...res.data.data);
      } else {
        this.list = res.data.data;
      }
      return this.list.length;
    },
  },
  async activated () {
    let len = await this.getList();
    if (len === 0) {
      this.isNull = true;
    }
  },
};
</script>

<style scoped lang="less">
.notification_list{
  background-color: #fff;
  padding: 10px;
  padding-bottom: 0px;
  header {
    height: 45px;
    border-bottom: 1px solid #f1f1f1;
    overflow: hidden;
    button {
      margin-top: 3px;
      float: right;
      background-color: transparent;
      border-radius: 5px;
      font-size: 14px;
      height: 30px;
      border: 1px solid currentColor;
      color: #28a745;
    }
  }
  ul {
    padding: 0;
    list-style: none;
    margin: 0;
    .item {
      padding: 10px 0;
      display: flex;
      flex-direction: row;
      line-height: 30px;
      border-bottom: 1px solid #f1f1f1;
      &.readed .content{
        color: #777;
      }
      .user {
        width: 120px;
        display: flex;
        flex-direction: row;
        img{
          width: 30px;
          height: 30px;
          margin-right: 10px;
        }
        .user_name{
          float: left;
          color: #0f88eb;
        }
      }
      .content{
        flex-grow: 1;
        a{
          color: #0f88eb;
          text-decoration: none;
        }
      }
      .time{
        width: 70px;
        font-size: 12px;
        color: #999;
        text-align: right;
      }
    }
  }
}
.scroller{
  padding-top: 50px;
}
</style>
