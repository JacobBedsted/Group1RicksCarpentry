<template>
    <div>
        <h2>Inventory List</h2>
        <table>
            <tr>
                <th>Product ID</th>
                <th>Product Name</th>
                <th>Product Cost</th>
                <th>Product Quantity</th>
            </tr>
            <tr v-for="product in products" :key="product.id">
                <td>{{ product.productID }}</td>
                <td>{{ product.productName }}</td>
                <td>${{ product.productCost }}</td>
                <td>{{ product.productQty }}</td>
            </tr>
            
        </table>
    </div>
</template>
  
<script>
export default {
    name: 'ShowInventory',
    data: function() {
        return {
            products: []
        }
    },
    created: function() {
        this.getProducts();
    },
    methods: {
        getProducts: function() {
            var vm = this;

            fetch("http://localhost/Systems%20Final/ricksCarpentry/src/php/getProducts.php")
            .then(response => response.json())
            .then(function(data){
                vm.products = data.products;
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

    table{
        width: 50%;
        margin: auto;
        background-color: white;
        border: solid;
    }

    th, td {
        border-bottom: 1px solid #ddd;
    }

</style>