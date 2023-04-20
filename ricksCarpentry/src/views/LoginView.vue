<template>
    <div>
        <Login legend="Authentication">
            <AuthHeader>

            </AuthHeader>
        </Login>
    </div>
  </template>
  
  <script>
  // @ is an alias to /src
  import Login from '@/components/Login.vue';
  import AuthHeader from '@/components/AuthHeader.vue';
  
  export default {
    name: 'LoginView',
    components: {
      Login,
      AuthHeader
    }
  }
  </script>