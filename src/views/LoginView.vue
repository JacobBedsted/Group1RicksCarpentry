<template>
    <div>
        <Login legend="Authentication">
            <AuthHeader>

            </AuthHeader>
        </Login>
        <div v-if="!this.auth">
          <h2>- OR -</h2>
          <SignUp>
          </SignUp>
        </div>
    </div>
  </template>
  
  <script>
  // @ is an alias to /src
  import Login from '@/components/Login.vue';
  import AuthHeader from '@/components/AuthHeader.vue';
  import SignUp from '@/components/SignUp.vue';
  import store from '@/store';
  
  export default {
    name: 'LoginView',
    components: {
      Login,
      AuthHeader,
      SignUp
    },
    computed: {
      auth: function() {
        return store.state.auth;
      }
    }
  }
  </script>