<template>
  <div class="user_settings">
    <TNav></TNav>
    <div class="items">
      <Cell title="头像"><img class="cover" :src="me.avatar && me.avatar.cover_url" :alt="me.name"></Cell>
      <Cell title="昵称">{{me.name}}</Cell>
      <Cell title="用户名">{{me.username}}</Cell>
    </div>
    <button class="logout_btn">退出登录</button>
  </div>
</template>
<script>
import Cell from '../components/Cell'
import TNav from '../components/TNav';
export default {
  components: { TNav, Cell },
  computed: {
    me () {
      return this.$store.state.me || {};
    }
  }
};
</script>

<style lang="less" scoped>
.items{
  padding-top: 10px;
  .cover{
    width: 70px;
    height: 70px;
  }
}
.logout_btn{
  margin-top: 30px;
  background-color: #fff;
  font-size: 16px;
  border: 0;
  width: 100%;
  padding: 15px 0;
  color: #666;
}
</style>

