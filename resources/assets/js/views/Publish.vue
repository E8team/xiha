<template>
  <div class="publish">
    <header>
      <div class="cancel" href="#">取消</div>
      <button class="publish_btn">发布</button>
    </header>
    <div class="input_wrapper">
      <textarea placeholder="请开始你的表演" rows="6"></textarea>
      <UploadImage></UploadImage>
    </div>
  </div>
</template>

<script>
import UploadImage from '../components/UploadImage.vue';
export default {
  components: { UploadImage }
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
      margin-top: 13px;
      float: right;
      border: 0;
      outline: 0;
      background-color: #f5f5f5;
      border-radius: 3px;
      padding: 4px 6px;
      font-size: 14px;
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
