<template>
    <div>
        <div class="table_caption">
            <span>List all clients</span>
            <button @click="showModal = true" type="button" class="btn btn-sm btn-primary">Create a new client</button>
        </div>

        <div class="scroll">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col">Client</th>
                        <th scope="col">Cash Balance</th>
                        <th scope="col">Gain/Loss</th>
                        <th scope="col">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="(item, index) in this.clients"
                    v-bind:key="index">
                        <td scope="row">{{item.username}}</td>
                        <td scope="row">{{item.balance}}</td>
                        <td scope="row">
                            <span v-bind:class="{'text-success':(item.profit >= 0), 'text-danger':(item.profit < 0)}">
                                {{item.profit}}
                            </span>
                        </td>
                        <td>
                            <div class="dropdown">
                                <button class="btn btn-default dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <span class="glyphicon glyphicon-option-horizontal" aria-hidden="true"></span>
                                    <span class="caret"></span>
                                </button>
                                <ul class="dropdown-menu">
                                    <li>
                                        <router-link :to="{ name: 'clientStocks', params: { id: item.id }}" class="dropdown-item">View stocks</router-link>
                                    </li>
                                </ul>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

        <div v-if="showModal" class="modal-mask">
            <div class="modal-wrapper">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-body">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true" @click="showModal = false">&times;</span>
                            </button>
                            <p><strong>Create a new client</strong></p>
                            <form v-on:submit.prevent="addClient">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">@</div>
                                    </div>
                                    <input type="text" class="form-control" v-model="form.username" placeholder="Username">
                                </div>
                                <div class="alert alert-danger" v-if="hasError">{{getError}}</div>
                                <div class="modal-action">
                                    <button type="submit" class="btn btn-primary">Add</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <br/>
        <router-link to="/" class="btn btn-success">Stocks list</router-link>
        <button type="button" class="btn btn-primary" @click="showPurchaseModal = true">Purchase a stock</button>

        <purchase 
            v-if="showPurchaseModal" 
            v-on:closePurchaseModal="closePurchaseModal($event)"
            v-on:loadClientsList="loadClientsList($event)">
            </purchase>
    </div>
</template>


<script>
import Purchase from './Purchase.vue';
import store from "../stores/user";
import request from "../services/Request";

export default {
    components: {
        Purchase
    },
    mounted () {
        this.resetForm();
        this.loadClientsList();
    },
    data () {
        return {
            showModal: false,
            showPurchaseModal: false,
            message: "",
            clients: [],
            form: {
                'username': null
            }
        };
    },
    computed: {
        getError() {
            return store.getters.errorMessage;
        },
        hasError() {
            return store.getters.hasError;
        }
    },
    methods: {
        closePurchaseModal() {
            this.showPurchaseModal = false
        },
        addClient() {
            let self = this;
            request({
                url: '/client',
                method: "post",
                data: this.form
            }).then(function(response) {
                self.clients.push(response.data.data);
                self.resetForm();
                self.showModal = false;
            });
        },
        loadClientsList() {
            let self = this;
            request({
                url: '/client',
                method: "get"
            }).then(function(response) {
                self.clients = response.data.data
            });
        },
        resetForm() {
            this.form = {
                username: null
            }
        }
    }
}
</script>