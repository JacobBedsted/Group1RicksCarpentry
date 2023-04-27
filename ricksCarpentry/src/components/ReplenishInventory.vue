<template>
    <div>
        <h2>Replenish Inventory Form</h2>
        <form id="replenishInventoryForm">
            <fieldset>
                <legend>Product Replenish</legend>
                <label>Product Id: <input type="number" v-model="replenishInventoryForm.productID"></label>
                <label>Quantity Added: <input type="number" v-model="replenishInventoryForm.productQty"></label>
            </fieldset>
            <button type="submit" v-on:click.prevent="replenishInventory()">Add Product</button>
        </form>
    </div>
</template>
  
<script>
import store from '@/store';

export default {
    name: 'ReplenishInventory',
    data: function() {
        return {
            replenishInventoryForm: {
                productID: null,
                productQty: null
            }
        }
    },
    computed: {
        session: function() {
            return store.state.session;
        }
    },
    methods: {
        replenishInventory: function() {
            const formdata = new FormData();
            var vm = this;

            formdata.append("productID", this.replenishInventoryForm.productID);
            formdata.append("productQty", this.replenishInventoryForm.productQty);

            fetch("http://localhost/Systems%20Final/ricksCarpentry/src/php/replenishInventory.php",{
                method: "post",
                body: formdata
            })
            .then(response => response.json())
            .then(function(data){
                if(data.status == "success"){
                    vm.replenishInventoryForm.productID = null;
                    vm.replenishInventoryForm.productQty = null;
                } else {
                    console.log("Error");
                }
            })
        }
    }
}
</script>

<style scoped>

    body{
        background-color: lightskyblue;
    }
    fieldset {
        border-radius: 25px;
        background-color: rgb(122, 121, 120);
        border: 1px solid darkgreen;
    }

    legend {
        background-color: darkgreen;
        color: white;
        padding: 5px;
        border: solid 1px silver;
    }
    label{
        display: block;
        margin-bottom: 10px;
        color: white;
    }
    button{
        color: white;
        background-color: darkgreen;
    }

</style>