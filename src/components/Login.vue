<template>
    <div>
        <slot></slot>
        <form v-if="!this.auth">
            <fieldset>
                <legend>{{ legend }}</legend>
                <label>
                    Email: 
                    <input type="text" v-model="email">
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
            email: "",
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
            const formdata = new FormData();
            var vm = this;

            formdata.append("email",this.email);
            formdata.append("password",this.password);

            fetch("http://localhost/Systems%20Final/ricksCarpentry/src/php/login.php",{
                method: "post",
                body: formdata
            })
            .then(response => response.json())
            .then(function(data){
                if(data.status == "success") {
                    vm.email = "";
                    vm.password = "";

                    store.commit("setAuth", {
                        auth: data.auth,
                        session: data.session
                    });

                    store.commit("setUser", {
                        fname: data.fname,
                        lname: data.lname,
                        email: data.email,
                        id: data.id
                    });
                } else {
                    console.log(data);
                }
            });
        },
        logout: function() {
            store.state.auth = false;
            store.state.username = "";
        }
    },
}
</script>

<style scoped>

    form {
        padding-left: 40%;
        padding-right: 40%;
    }
    
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