<template>
    <div>
        <h2>Sale Report</h2>
        <form id="saleReportForm">
            <fieldset>
                <legend>Sale Dates</legend>
                <label>First Date: <input type="date" v-model="saleReportForm.firstDate"></label>
                <label>Second Date: <input type="date" v-model="saleReportForm.secondDate"></label>
            </fieldset>
            <button type="submit" v-on:click.prevent="saleReport()">Generate Report</button>
        </form>

        <div v-if="sales.length > 0">
        <h2>Sales Report</h2>
        <p>{{ oldSaleReportForm.firstDate }} - {{ oldSaleReportForm.secondDate }}</p>
            <table>
                <tr>
                    <th>Product 1</th>
                    <th>Product 2</th>
                    <th>Product 3</th>
                    <th>Product 4</th>
                    <th>Product 5</th>
                    <th>Product 6</th>
                </tr>
                <tr>
                    <td>{{ sales[0] }}</td>
                    <td>{{ sales[1] }}</td>
                    <td>{{ sales[2] }}</td>
                    <td>{{ sales[3] }}</td>
                    <td>{{ sales[4] }}</td>
                    <td>{{ sales[5] }}</td>
                </tr>
            </table>
        </div>


    </div>
</template>

<script>
import store from '@/store';

export default {
    data: function() {
        return {
            saleReportForm: {
                firstDate: "",
                secondDate: ""
            },
            oldSaleReportForm: {
                firstDate: "",
                secondDate: ""
            },
            sales: []
        }
    },
    computed: {
        session: function() {
            return store.state.session;
        }
    },
    methods: {
        saleReport: function() {
            const formdata = new FormData();
            var vm = this;

            formdata.append("firstDay", vm.saleReportForm.firstDate);
            formdata.append("secondDay", vm.saleReportForm.secondDate);

            fetch("http://localhost/Systems%20Final/ricksCarpentry/src/php/salesReport.php",{
                method: "post",
                body: formdata
            })
            .then(response => response.json())
            .then(function(data){
                if(data.status == "success"){
                    vm.sales = data.sales;
                    vm.oldSaleReportForm.firstDate = vm.saleReportForm.firstDate;
                    vm.oldSaleReportForm.secondDate = vm.saleReportForm.secondDate;
                    vm.saleReportForm.firstDate = "";
                    vm.saleReportForm.secondDate = "";
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