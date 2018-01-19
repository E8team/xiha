<template>
  <div class="comment_item">
    <div class="cover_wrapper">
      <img src="https://apic.douyucdn.cn/upload/avatar/face/201609/08/f6c0c08a3f3cb1fd074fe38907ae2508_middle.jpg?rltime">
    </div>
    <div class="user_name">初音ミク骑士团の奈</div>
    <span class="comment_time">12小时前</span>
    <p class="comment_text">
      周四大事件，周五分开播
    </p>
    <footer>
      <div class="item active">
        <i class="iconfont icon-pinglun"></i> <span class="num">12</span>
      </div>
      <div class="item">
        <i class="iconfont icon-zan"></i> <span class="num">12</span>
      </div>
      <div class="item">
        <i class="iconfont icon-zan reversal"></i> <span class="num">12</span>
      </div>
    </footer>
  </div>
</template>

<style lang="less" scoped>
@import url(//at.alicdn.com/t/font_548487_u5u3ppcw0so9wwmi.css);
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
  .comment_time{
    position: absolute;
    right: 0;
    font-size: 12px;
    color: #999;
    top: 10px;
  }
  .comment_text{
    color: #212121;
    line-height: 18px;
    font-size: 15px;
    margin: 0;
    margin-top: 10px;
  }
  footer{
    padding-top: 10px;
    overflow: hidden;
    .item{
      font-size: 12px;
      color: #aaa;
      float: left;
      margin-right: 10px;
      &.active{
        color: #0f88eb;
      }
      i.reversal{
        position: relative;
        top: 2px;
        display: inline-block;
        transform: rotate(180deg)
      }
    }
  }
}
</style>
