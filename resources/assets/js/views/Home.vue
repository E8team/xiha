<template>
  <div>
    <TNav></TNav>
    <JokeBody :key="item.id" :joke="item" v-for="item in jokes"></JokeBody>
  </div>
</template>

<script>
import TNav from '../components/TNav.vue';
import JokeBody from '../components/JokeBody.vue';
export default {
  components: { TNav, JokeBody },
  data () {
    return {
      jokes: []
    };
  },
  async mounted () {
    let res = await this.$http.get('jokes');
    this.jokes = res.data.data;
  }
};
</script>
