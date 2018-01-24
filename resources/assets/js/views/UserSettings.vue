<template>
  <div class="user_settings">
    <TNav></TNav>
    <div class="items">
      <Cell title="头像">
        <div class="cover_wrapper">
          <input @change="upload" type="file">
          <img class="cover" @change="upload" :src="uploadSrc || me.avatar && me.avatar.cover_url" :alt="me.name">
        </div>
      </Cell>
      <Cell @click.native="showNameDialog = true" title="昵称">{{me.name}}</Cell>
      <Cell title="用户名">{{me.username}}</Cell>
      <Cell title="一句话介绍">{{me.introduce}}</Cell>
    </div>
    <button class="logout_btn" @click="logout">退出登录</button>
    <FullScreenDialog :show.sync="showNameDialog" class="name_input_dialog">
      <div class="input_wrapper">
        <MInput placeholder="请输入昵称" v-model="name"/>
      </div>
    </FullScreenDialog>
  </div>
</template>
<script>
import Cell from '../components/Cell';
import TNav from '../components/TNav';
import MInput from '../components/MInput.vue';
import FullScreenDialog from '../components/FullScreenDialog.vue';
export default {
  components: { TNav, Cell, FullScreenDialog, MInput },
  computed: {
    me () {
      return this.$store.state.me || {};
    }
  },
  data () {
    return {
      name: '123',
      uploadSrc: null,
      showNameDialog: false
    };
  },
  methods: {
    logout () {
    },
    async patchMe (filed, newValue) {
      let params = {};
      params[filed] = newValue;
      try {
        await this.$http.patch('me', params);
        this.$message({type: 'success', msg: '修改成功'});
      } catch (e) {
        throw e;
      }
    },
    async upload ({ srcElement: { files: {0: file} } }) {
      let formData = new FormData();
      formData.append('image', file);
      this.uploadSrc = window.URL.createObjectURL(file);
      try {
        let res = await this.$http.post('ajax_upload_image', formData);
        await this.patchMe('avatar_hash', res.data.image_hash);
      } catch (e) {
        this.uploadSrc = null;
      }
    }
  }
};
</script>

<style lang="less" scoped>
.items{
  padding-top: 10px;
  .cover_wrapper{
    width: 70px;
    height: 70px;
    position: relative;
    >input {
      position: absolute;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      opacity: 0;
    }
    .cover{
      width: 100%;
      height: 100%;
    }
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
.name_input_dialog{
  .input_wrapper{
    padding: 10px 20px;
  }
}
</style>

