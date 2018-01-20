<template>
  <div class="joke">
    <header>
      <img class="user_img" src="http://image.uc.cn/s/uae/g/0q/avatar/43.png">
      <div class="user_name">金牌港C</div>
    </header>
    <section class="content">
      你若军训 便是晴天，你若放假 便是雨天，你若发奋做作业 便是开学前一天，多么痛的领悟 。
    </section>
    <footer>
      <button class="btn vote" type="button">
        <svg viewBox="0 0 20 18" class="icon" width="9" height="16">
          <g><path d="M0 15.243c0-.326.088-.533.236-.896l7.98-13.204C8.57.57 9.086 0 10 0s1.43.57 1.784 1.143l7.98 13.204c.15.363.236.57.236.896 0 1.386-.875 1.9-1.955 1.9H1.955c-1.08 0-1.955-.517-1.955-1.9z"></path></g>
        </svg>
        79
      </button>
      <button class="btn vote tread" type="button">
        <svg viewBox="0 0 20 18" class="icon" width="9" height="16">
          <g><path d="M0 15.243c0-.326.088-.533.236-.896l7.98-13.204C8.57.57 9.086 0 10 0s1.43.57 1.784 1.143l7.98 13.204c.15.363.236.57.236.896 0 1.386-.875 1.9-1.955 1.9H1.955c-1.08 0-1.955-.517-1.955-1.9z"></path></g>
        </svg>
      </button>
      <button class="btn comment" type="button">
        <svg fill="currentColor" viewBox="0 0 24 24" width="1.2em" height="1.2em">
          <path d="M10.241 19.313a.97.97 0 0 0-.77.2 7.908 7.908 0 0 1-3.772 1.482.409.409 0 0 1-.38-.637 5.825 5.825 0 0 0 1.11-2.237.605.605 0 0 0-.227-.59A7.935 7.935 0 0 1 3 11.25C3 6.7 7.03 3 12 3s9 3.7 9 8.25-4.373 9.108-10.759 8.063z" fill-rule="evenodd">
          </path>
        </svg>
        <div>评论 10</div>
      </button>
    </footer>
  </div>
</template>

<style lang="less" scoped>
.joke{
  margin-bottom: 10px;
  background: #fff;
  border-radius: 2px;
  box-shadow: 0 1px 3px rgba(26,26,26,.1);
  padding: 15px;
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
