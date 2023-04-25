<template>
    <div>
        <h2>Replenish Inventory Form</h2>
        <form id="replenishInventoryForm">
            <fieldset>
                <legend>Product Replenish</legend>
                <label>Product Id: <input type="number" v-model="replenishInventoryForm.productId"></label>
                <label>Quantity Added: <input type="number" v-model="replenishInventoryForm.amountAdded"></label>
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
                productId: null,
                amountAdded: null
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

            formdata.append("productID", vm.productId);
            formdata.append("productQuantity", vm.amountAdded);

            fetch("http://localhost/Systems%20Final/ricksCarpentry/src/php/replenishInventory.php",{
                method: "post",
                body: formdata
            })
            .then(response => response.json())
            .then(function(data){
                if(data.status == "success"){
                    vm.replenishInventoryForm.productId = null;
                    vm.replenishInventoryForm.amountAdded = null;
                } else {
                    console.log("Error");
                }
            })
        }
    }
}
</script>

<style scoped>

</style>