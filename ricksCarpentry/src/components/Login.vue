<template>
    <div>
        <slot></slot>
        <form v-if="!this.auth">
            <fieldset>
                <legend>{{ legend }}</legend>
                <label>
                    Username: 
                    <input type="text" v-model="username">
                </label>
                <label>
                    Password: 
                    <input type="password" v-model="password">
                </label>
                <button v-on:click.prevent="login()">
                    Login
                </button>
            </fieldset>
        </form>

        <form v-else>
            <button v-on:click.prevent="logout()">
                Logout
            </button>
        </form>
    </div>
</template>
  
<script>
import store from '@/store';

export default {
    name: 'LoginForm',
    props: {
        legend: {
            type: String,
            default: "Login"
        }
    },
    data: function() {
        return{
            username: "",
            password: ""
        }
    },
    computed: { 
        auth: function() {
            return store.state.auth;
        }
    },
    methods: {
        login: function() {
            store.state.auth = true;
            store.state.username = this.username;

            this.username = "";
            this.password = "";
        },
        logout: function() {
            store.state.auth = false;
            store.state.username = "";
        }
    },
}
</script>

<style scoped>
    fieldset {
        background-color: tan;
        border: 1px solid green;
    }

    legend {
        color: tan;
        background-color: green;
        padding: 3px;
    }

    label {
        display: block;
        margin-bottom: 10px;
        color: green;
    }

    button {
        color: white;
        background-color: black;
    }
</style>