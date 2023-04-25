<template>
    <div>
        <h2>Sale Form</h2>
        <form id="saleForm">
            <fieldset>
                <legend>Make Sale</legend>
                <label>Product Id: <input type="number" v-model="saleForm.productId"></label>
                <label>Customer Id: <input type="number" v-model="saleForm.customerId"></label>
                <label>Sale Date: <input type="number" v-model="saleForm.salesDate"></label>
                <label>Quantity Sold: <input type="number" v-model="saleForm.salesQty"></label>
            </fieldset>
            <button type="submit" v-on:click.prevent="makeSale()">Add Product</button>
        </form>
    </div>
</template>
  
<script>
import store from '@/store';

export default {
    data: function() {
        return {
            saleForm: {
                productId: null,
                customerId: null,
                salesDate: "",
                salesQty: null
            }
        }
    },
    computed: {
        session: function() {
            return store.state.session;
        }
    },
    methods: {
        makeSale: function() {
            const formdata = new FormData();
            var vm = this;

            formdata.append("productID", vm.productId);
            formdata.append("customerId", vm.customerId);
            formdata.append("salesDate", vm.salesDate);
            formdata.append("salesQty", vm.salesQty);

            fetch("http://localhost/Systems%20Final/ricksCarpentry/src/php/makeSale.php",{
                method: "post",
                body: formdata
            })
            .then(response => response.json())
            .then(function(data){
                if(data.status == "success"){
                    vm.saleForm.productId = null;
                    vm.saleForm.customerId = null;
                    vm.saleForm.salesDate = "";
                    vm.saleForm.salesQty = null;
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