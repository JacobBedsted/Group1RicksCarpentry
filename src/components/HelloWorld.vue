<template>
  <div class="hello">
    <p> {{ message }} </p>
  </div>
</template>

<script>
import store from '@/store';

export default {
  name: 'HelloWorld',
  props: {
    msg: String
  },
  computed: {
    message: function() {
      return store.state.msg;
    }
  }
}
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style scoped>
h3 {
  margin: 40px 0 0;
}
ul {
  list-style-type: none;
  padding: 0;
}
li {
  display: inline-block;
  margin: 0 10px;
}
a {
  color: #42b983;
}
</style>
