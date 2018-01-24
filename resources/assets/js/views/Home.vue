<template>
  <div>
    <TNav></TNav>
    <scroller
      class="scroller"
      :on-refresh="refresh"
      :on-infinite="infinite">
      <JokeBody :key="item.id" :joke="item" v-for="item in jokes"></JokeBody>
    </scroller>
    <JokeBodyPlaceholders class="joke_body_placeholders" v-if="jokes.length=='0'" :length="3"/>
  </div>
</template>

<script>
import TNav from '../components/TNav.vue';
import JokeBody from '../components/JokeBody.vue';
import JokeBodyPlaceholders from '../components/JokeBodyPlaceholders.vue';
export default {
  components: { TNav, JokeBody, JokeBodyPlaceholders },
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
</style>
