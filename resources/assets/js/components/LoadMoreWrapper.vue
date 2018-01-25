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
    refresh (url) {
      this.nextLink = null;
      this.loading = this.isEnd = false;
      this.getList(url || this.url);
    },
    addItem (item) {
      this.list.unshift(item);
    },
    async getList (nextLink) {
      this.list = [];
      let res = await this.$http.get(nextLink || this.url);
      this.links = res.data.links;
      if (this.links.next) {
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
    this.nextLink = null;
    this.loading = this.isEnd = false;
    this.getList(this.url);
  },
  mounted () {
    this.nextLink = null;
    this.loading = this.isEnd = false;
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
