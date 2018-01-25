<template>
  <div class="publish">
    <header>
      <div class="cancel" @click="$router.back()">取消</div>
      <button :disabled="canPublish" @click="publish" class="publish_btn">发布</button>
    </header>
    <div class="input_wrapper">
      <textarea v-model="joke.content" placeholder="请开始你的表演" rows="6"></textarea>
      <UploadImage @is_upload="isUp => {isUpload = isUp}" @change="image_hash => {joke.image_hash = image_hash}"></UploadImage>
    </div>
  </div>
</template>

<script>
import UploadImage from '../components/UploadImage.vue';
export default {
  components: { UploadImage },
  computed: {
    canPublish () {
      if (!this.isUpload) {
        return !this.joke.content;
      }
      return !this.joke.image_hash;
    }
  },
  data () {
    return {
      joke: {
        content: null,
        image_hash: null
      },
      isUpload: false
    };
  },
  activated () {
    this.joke = {
      content: null,
      image_hash: null
    };
  },
  methods: {
    async publish () {
      try {
        let res = await this.$http.post('jokes', this.joke);
        this.$message({type: 'success', msg: '发布成功！'});
        this.$router.push({name: 'joke', params: {id: res.data.data.id}});
        this.$store.commit('UPDATE_LAST_PUBLISH_JOKE', res.data.data);
      } catch (e) {}
    }
  }
};
</script>


<style lang="less" scoped>
.publish{
  header{
    background-color: #fff;
    line-height: 50px;
    overflow: hidden;
    padding: 0 10px;
    border-bottom: 1px solid rgba(30,35,42,.06);
    .cancel{
      float: left;
      font-size: 14px;
    }
    .publish_btn{
      transition: all .3s;
      margin-top: 13px;
      float: right;
      border: 0;
      outline: 0;
      border-radius: 3px;
      padding: 4px 6px;
      font-size: 14px;
      background-color: #0f88eb;
      color: #fff;
      &[disabled]{
        background-color: #f5f5f5;
        color: #333;
      }
    }
  }
  .input_wrapper{
    background-color: #fff;
    padding: 10px;
    >textarea{
      width: 100%;
      border: 0;
      outline: none;
    }
  }
}
</style>
