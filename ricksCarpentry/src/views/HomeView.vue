<template>
  <div class="home">
    <HelloWorld/>
    <img alt="Vue logo" src="../assets/tool.png">
  </div>
</template>

<script>
// @ is an alias to /src
import HelloWorld from '@/components/HelloWorld.vue'

export default {
  name: 'HomeView',
  components: {
    HelloWorld
  }
}
</script>
