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
                    <th>2x4 Lumber</th>
                    <th>2x6 Lumber</th>
                    <th>1x2 Lumber</th>
                    <th>Pre-Finished Top</th>
                    <th>Shims</th>
                    <th>Wood Glue</th>
                </tr>
                <tr>
                    <td v-if="sales[0]>0">{{ sales[0] }}</td>
                    <td v-else>0</td>
                    <td v-if="sales[1]>0">{{ sales[1] }}</td>
                    <td v-else>0</td>
                    <td v-if="sales[2]>0">{{ sales[2] }}</td>
                    <td v-else>0</td>
                    <td v-if="sales[3]>0">{{ sales[3] }}</td>
                    <td v-else>0</td>
                    <td v-if="sales[4]>0">{{ sales[4] }}</td>
                    <td v-else>0</td>
                    <td v-if="sales[5]>0">{{ sales[5] }}</td>
                    <td v-else>0</td>
                </tr>
                <tr>
                    <td v-if="revenue[0]>0">$ {{ revenue[0] }}</td>
                    <td v-else>$ 0</td>
                    <td v-if="revenue[1]>0">$ {{ revenue[1] }}</td>
                    <td v-else>$ 0</td>
                    <td v-if="revenue[2]>0">$ {{ revenue[2] }}</td>
                    <td v-else>$ 0</td>
                    <td v-if="revenue[3]>0">$ {{ revenue[3] }}</td>
                    <td v-else>$ 0</td>
                    <td v-if="revenue[4]>0">$ {{ revenue[4] }}</td>
                    <td v-else>$ 0</td>
                    <td v-if="revenue[5]>0">$ {{ revenue[5] }}</td>
                    <td v-else>$ 0</td>
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
            sales: [],
            revenue: []
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
                    vm.revenue = data.revenue;
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