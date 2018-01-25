<template>
  <div>
    <TNav></TNav>
    <scroller
      class="scroller"
      ref="scroller"
      noDataText="(･∀･) 到底了！"
      :on-refresh="refresh"
      :on-infinite="infinite">
      <JokeBody :user="item.user" :key="item.id" :joke="item" v-for="item in jokes"></JokeBody>
    </scroller>
    <JokeBodyPlaceholders class="joke_body_placeholders" v-if="!isNull && jokes.length=='0'" :length="3"/>
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
      links: {},
      isNull: false
    };
  },
  beforeRouteLeave (to, from, next) {
    this.$store.commit('UPDATE_LAST_HOME_POS', this.$refs['scroller'].getPosition());
    next();
  },
  methods: {
    async refresh (done) {
      if (!this.jokes[0]) {
        done();
        return ;
      }
      let res = await this.$http.get('jokes', {
        params: {
          last_id: this.jokes[0].id
        }
      });
      let len = res.data.data.length;
      if (len > 0) {
        this.jokes.unshift(res.data.data);
      }
      this.$message({
        msg: `${len}条新笑话`,
        type: 'info'
      });
      done();
    },
    async infinite (done) {
      let len = 0;
      if (this.links.next) {
        len = await this.getJokes(this.links.next);
      }
      done(len === 0);
    },
    async getJokes (link) {
      let res = await this.$http.get(link || 'jokes');
      this.links = res.data.links;
      if (link) {
        this.jokes.push(...res.data.data);
      } else {
        this.jokes = res.data.data;
      }
      return this.jokes.length;
    },
  },
  async mounted () {
    let len = await this.getJokes();
    if (len === 0) {
      this.isNull = true;
    }
  },
  activated () {
    if (this.$store.state.lastHomePos) {
      this.$nextTick(() => {
        setTimeout(() => {
          this.$refs['scroller'].scrollTo(this.$store.state.lastHomePos.left, this.$store.state.lastHomePos.top, false);
        }, 0);
      });
    }
  },
  destroyed () {
    let pswps = document.querySelectorAll('.pswp');
    pswps.forEach(element => {
      document.body.removeChild(element);
    });
  }
};
</script>
<style scoped lang="less">
.scroller{
  padding-top: 50px;
}
</style>
