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

</style>