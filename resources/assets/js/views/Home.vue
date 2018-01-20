<template>
  <div>
    <TNav></TNav>
    <JokeBody></JokeBody>
    <JokeBody></JokeBody>
    <JokeBody></JokeBody>
  </div>
</template>

<script>
import TNav from '../components/TNav.vue';
import JokeBody from '../components/JokeBody.vue';
export default {
  components: { TNav, JokeBody }
};
</script>
