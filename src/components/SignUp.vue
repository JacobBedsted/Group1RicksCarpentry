<template>
    <div>
        <form>
            <fieldset>
                <legend>Sign Up</legend>
                <label>
                    First Name: 
                    <input type="text" v-model="signUpForm.fname">
                </label>
                <label>
                    Last Name: 
                    <input type="text" v-model="signUpForm.lname">
                </label>
                <label>
                    Email: 
                    <input type="text" v-model="signUpForm.email">
                </label>
                <label>
                    Password: 
                    <input type="password" v-model="signUpForm.password">
                </label>
                <button v-on:click.prevent="signUp()">
                    Sign Up
                </button>
            </fieldset>
        </form>
    </div>
</template>
  
<script>
import store from '@/store';

export default {
    data: function() {
        return{
            signUpForm: {
                fname: "",
                lname: "",
                email: "",
                password: ""
            }
        }
    },
    methods: {
        signUp: function() {
            const formdata = new FormData();
            var vm = this;

            formdata.append("fname", vm.signUpForm.fname);
            formdata.append("lname", vm.signUpForm.lname);
            formdata.append("email", vm.signUpForm.email);
            formdata.append("password", vm.signUpForm.password);

            fetch("http://localhost/Systems%20Final/ricksCarpentry/src/php/addUser.php",{
                method: "post",
                body: formdata
            })
            .then(response => response.json())
            .then(function(data){
                if(data.status == "success") {
                    store.commit("setAuth", {
                        auth: data.auth,
                        session: data.session
                    });
                    store.commit("setUser", {
                        fName: data.fName,
                        lName: data.lName,
                        email: data.email,
                        id: data.id
                    });
                    vm.signUpForm.fname = "";
                    vm.signUpForm.lname = "";
                    vm.signUpForm.email = "";
                    vm.signUpForm.password = ""; 
                } else {
                    console.log(data);
                }
            });
        },
    },
}
</script>

<style scoped>
    fieldset {
        background-color: tan;
        border: 1px solid green;
    }

    form {
        padding-left: 40%;
        padding-right: 40%;
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