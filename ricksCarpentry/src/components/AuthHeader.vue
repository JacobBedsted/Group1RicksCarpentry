<template>
    <div>
        <h3>{{ text }}</h3>
        <slot></slot>
        <p v-if="this.auth">{{ username }} is authenticated</p>
        <p v-else>You are not authenticated</p>
    </div>
</template>
  
<script>
import store from '@/store';

export default {
    name: 'AuthHeader',
    props: {
        text: {
            type: String,
            default: "Authorization",
            required: false
        }
    },
    computed: {
        auth: function() {
                return store.state.auth;
        },
        username: function() {
            return store.state.username;
        }
    }
}
</script>

<style scoped>

</style>