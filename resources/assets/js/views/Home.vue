<template>
  <div>
    <TNav></TNav>
    <scroller
      v-if="jokes.length > 0"
      class="scroller"
      :on-refresh="refresh"
      :on-infinite="infinite">
      <JokeBody :key="item.id" :joke="item" v-for="item in jokes"></JokeBody>
    </scroller>
    <template  v-else>
      <div v-for="n in 3" :key="n" class="content_placeholders_wrapper">
        <content-placeholders>
          <content-placeholders-heading :img="true" />
          <content-placeholders-text :lines="3" />
        </content-placeholders>
      </div>
    </template>
  </div>
</template>

<script>
import TNav from '../components/TNav.vue';
import JokeBody from '../components/JokeBody.vue';
export default {
  components: { TNav, JokeBody },
  data () {
    return {
      jokes: [],
      links: {}
    };
  },
  methods: {
    refresh (done) {
      console.log('refresh');
      done();
    },
    async infinite (done) {
      if (this.links.next) {
        await this.getJokes(this.links.next);
      }
      done();
    },
    async getJokes (link) {
      let res = await this.$http.get(link || 'jokes');
      this.links = res.data.links;
      if (link) {
        this.jokes.push(...res.data.data);
      } else {
        this.jokes = res.data.data;
      }
    },
  },
  mounted () {
    this.getJokes();
  }
};
</script>
<style scoped lang="less">
.scroller{
  margin-top: 50px;
}
.content_placeholders_wrapper{
  background-color: #fff;
  padding: 10px;
  box-shadow: 0 1px 3px rgba(26,26,26,.1);
  margin-bottom: 10px;
}
</style>
