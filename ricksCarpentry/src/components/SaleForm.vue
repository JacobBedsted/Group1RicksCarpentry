<template>
    <div>
        <h2>Sale Form</h2>
        <form id="saleForm">
            <fieldset>
                <legend>Make Sale</legend>
                <label>Product Id: <input type="number" v-model="saleForm.productId"></label>
                <label>Customer Name: <input type="text" v-model="saleForm.customerName"></label>
                <label>Sale Date: <input type="date" v-model="saleForm.salesDate"></label>
                <label>Quantity Sold: <input type="number" v-model="saleForm.salesQty"></label>
            </fieldset>
            <button type="submit" v-on:click.prevent="makeSale()">Make Sale</button>
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
                customerName: "",
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

            formdata.append("productID", vm.saleForm.productId);
            formdata.append("customerName", vm.saleForm.customerName);
            formdata.append("salesDate", vm.saleForm.salesDate);
            formdata.append("salesQty", vm.saleForm.salesQty);

            fetch("http://localhost/Systems%20Final/ricksCarpentry/src/php/makeSale.php",{
                method: "post",
                body: formdata
            })
            .then(response => response.json())
            .then(function(data){
                if(data.status == "success"){
                    vm.saleForm.productId = null;
                    vm.saleForm.customerName = "";
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