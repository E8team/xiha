<template>
  <div>
    <slot :data="list"></slot>
    <slot name="bottom">
      <div v-if="loading && !isEnd" class="text">加载中...</div>
      <div v-if="isEnd" class="text">(･∀･) 到底了</div>
    </slot>
  </div>
</template>

<script>
export default {
  name: 'LoadMoreWrapper',
  props: {
    url: String,
    addComment: Object
  },
  watch: {
    addComment () {
      this.list.unshift(this.addComment);
    }
  },
  data () {
    return {
      list: [],
      links: {},
      loading: false,
      isEnd: false
    };
  },
  methods: {
    async getList (nextLink) {
      let res = await this.$http.get(nextLink || this.url);
      this.links = res.data.links;
      if (nextLink) {
        this.list.push(...res.data.data);
      } else {
        this.list = res.data.data;
      }
      if (this.list.length === 0 || this.list.length < res.data.meta.per_page) {
        this.isEnd = true;
      }
      return this.list.length;
    }
  },
  activated () {
    this.getList(this.url);
    window.onscroll = (e) => {
      let scrollTop = document.documentElement.scrollTop || window.pageYOffset || document.body.scrollTop;
      if (document.documentElement.scrollHeight === document.documentElement.clientHeight + scrollTop) {
        if (!this.isEnd) {
          this.loading = true;
          this.getList(this.links.next);
        }
      }
    };
  }
};
</script>

<style scoped lang="less">
.text{
  margin-top: 10px;
  color: #777;
  text-align: center;
  line-height: 40px;
  font-size: 14px;
}
</style>
