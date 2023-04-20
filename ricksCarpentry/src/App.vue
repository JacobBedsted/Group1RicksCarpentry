<template>
  <div id="app">
    <header>
      <h1>Rick's Carpentry</h1>
      <h2>Inventory Manager</h2>
    </header>
    <nav>
      | <router-link to="/">Home</router-link> |
      <router-link to="/Login">Login</router-link> |
      <router-link to="/ShowInventory">Show Inventory</router-link> |
      <span v-if="auth"><router-link to="/SaleForm">Sale Form</router-link> | </span>
      <span v-if="auth"><router-link to="/ReplenishInventory">Replenish Inventory</router-link> | </span>
    </nav>
    <router-view/>
  </div>
</template>

<script>
import store from './store';

export default {
  computed:{
    auth: function() {
      return store.state.auth;
    }
  }
}
</script>

<style>
#app {
  font-family: Avenir, Helvetica, Arial, sans-serif;
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;
  text-align: center;
  color: #2c3e50;
}

nav {
  padding: 30px;
}

nav a {
  font-weight: bold;
  color: #2c3e50;
}

nav a.router-link-exact-active {
  color: #42b983;
}
</style>
