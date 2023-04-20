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
            <tr>
                <td>0</td>
                <td>2x4 Lumber</td>
                <td>7.82</td>
                <td>10</td>
            </tr>
            <tr>
                <td>1</td>
                <td>2x6 Lumber</td>
                <td>5.85</td>
                <td>25</td>
            </tr>
            <tr>
                <td>2</td>
                <td>1x2 Lumber</td>
                <td>1.48</td>
                <td>28</td>
            </tr>
        </table>
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