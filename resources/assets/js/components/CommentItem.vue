<template>
  <div class="comment_item">
    <div class="cover_wrapper">
      <img src="https://apic.douyucdn.cn/upload/avatar/face/201609/08/f6c0c08a3f3cb1fd074fe38907ae2508_middle.jpg?rltime">
    </div>
    <div class="user_name">初音ミク骑士团の奈</div>
    <div class="zan">
      <i class="iconfont icon-xin"></i>
      <div class="zan_num">10</div>
    </div>
    <p class="comment_text">
      周四大事件，周五分开播
    </p>
    <footer>
      <span class="comment_time">12小时前</span>
    </footer>
  </div>
</template>

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
