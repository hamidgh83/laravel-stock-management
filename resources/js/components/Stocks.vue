<template>
    <div>
        <div class="table_caption">
            <span>List all stocks</span>
            <button @click="addStockModal = true" type="button" class="btn btn-sm btn-primary">Create a new stock</button>
        </div>

        <div class="scroll">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col">Company</th>
                        <th scope="col">Unit price</th>
                        <th scope="col">Updated at</th>
                        <th scope="col">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="(item, index) in this.stocks"
                    v-bind:key="index">
                        <td scope="row">{{item.company}}</td>
                        <td scope="row">€ {{item.unit_price}}</td>
                        <td scope="row">{{item.updated_at}}</td>
                        <td>
                            <div class="dropdown">
                                <button class="btn btn-default dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <span class="glyphicon glyphicon-option-horizontal" aria-hidden="true"></span>
                                    <span class="caret"></span>
                                </button>
                                <ul class="dropdown-menu">
                                    <li><a class="dropdown-item" href="#" @click="updateStockModal = true, stock = item">Update unit price</a></li>
                                    <li><a class="dropdown-item" href="#" @click="deleteStock(item)">Delete stock</a></li>
                                </ul>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

        <br/>
        <router-link to="/client" class="btn btn-success">Clients list</router-link>

        <add-stock 
            v-if="addStockModal" 
            v-on:pushStockItem="(...args)=>this.pushStockItem(...args)"
            v-on:closeModal="closeModal($event)">
            </add-stock>

        <update-stock 
            v-if="updateStockModal" 
            v-bind:item="stock"
            v-on:closeUpdateModal="closeUpdateModal($event)"
            v-on:loadStocksList="loadStocksList($event)">
            </update-stock>
    </div>
</template>


<script>
import AddStock from './AddStock.vue';
import UpdateStock from './UpdateStock.vue';
import request from "../services/Request";

export default {
    components: {
        AddStock,
        UpdateStock
    },
    mounted () {
        this.loadStocksList();
    },
    data() {
        return {
            stock: {},
            addStockModal: false,
            updateStockModal: false,
            error: "",
            stocks: []
        };
    },
    methods:{
        closeModal() {
            this.addStockModal = false
        },
        closeUpdateModal() {
            this.updateStockModal = false
        },
        addStock() {
            let self = this;
            request({
                url: '/stock',
                method: "post",
                data: self.form
            }).then(function(response) {
                self.stocks.push(res.data.data);
                self.resetForm();
                self.addStockModal = false;
            });
        },
        deleteStock(item) {
            let self = this;
            request({
                url: "/stock/" + item.id,
                method: "delete",
                data: this.form
            }).then(function(response) {
                self.loadStocksList();
            });
        },
        pushStockItem(item) {
            this.stocks.push(item);
        },
        loadStocksList() {
            let self = this;
            request({
                url: "/stock",
                method: "get",
                data: self.form
            }).then(function(response) {
                self.stocks = response.data.data
            });
        }
    }
}
</script>