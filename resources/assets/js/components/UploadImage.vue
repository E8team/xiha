<template>
  <div class="upload_image">
    <div class="preview">
      <div class="close_btn"></div>
      <img src="https://i0.hdslb.com/bfs/album/85adc060bbcaf74086022b65092ef3cdbcb8c2bc.jpg@1036w_1e_1c.webp">
    </div>
    <div class="upload_btn">
      <input @change="upload" type="file">
    </div>
  </div>
</template>

<script>
export default {
  name: 'UploadImage',
  methods: {
    upload (files) {
      console.log(files);
    }
  }
};
</script>

<style lang="less" scoped>
.upload_image {
  .preview{
    width: 90px;
    height: 90px;
    overflow: hidden;
    position: relative;
    .close_btn{
      position: absolute;
      right: 0;
      top: 0;
      width: 15px;
      height: 15px;
      background-color: #4da2fd;
      border-bottom-left-radius: 5px;
      &::before, &::after{
        position: absolute;
        content: '';
        background-color: #fff;
        display: block;
        top: 50%;
        left: 50%;
        transform: rotate(45deg);
      }
      &::before{
        margin-left: -3px;
        height: 1px;
        width: 7px;
      }
      &::after{
        margin-top: -3px;
        height: 7px;
        width: 1px;
      }
    }
    img{
      width: 100%;
    }
  }
  .upload_btn{
    width: 90px;
    height: 90px;
    border: 1px solid #c0ccda;
    border-radius: 4px;
    position: relative;
    &::before, &::after{
      position: absolute;
      content: '';
      background-color: #c0ccda;
      display: block;
      top: 50%;
      left: 50%;
    }
    &::before{
      margin-top: -1px;
      margin-left: -15px;
      height: 2px;
      width: 30px;
    }
    &::after{
      margin-left: -1px;
      margin-top: -15px;
      height: 30px;
      width: 2px;
    }
    input[type=file]{
      width: 100%;
      height: 100%;
      opacity: 0;
    }
  }
}
</style>
