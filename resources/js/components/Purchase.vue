<template>
    <div>
        <div class="modal-mask">
            <div class="modal-wrapper">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-body">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true" @click="closeModal">&times;</span>
                            </button>
                            <p><strong>Purchase a stock</strong></p>
                            <form v-on:submit.prevent="purchase">
                                <div class="form-group">
                                    <select v-model="stock" class="form-control">
                                        <option disabled selected>Choose stock</option>
                                        <option v-for="option in stocks" v-bind:key="option.id" v-bind:value="option.id">
                                            {{ option.company }}
                                        </option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <select v-model="client" class="form-control">
                                        <option disabled selected>Choose client</option>
                                        <option v-for="option in clients" v-bind:key="option.id" v-bind:value="option.id">
                                            {{ option.username }}
                                        </option>
                                    </select>
                                </div>
                                <input type="text" class="form-control" v-model="volume" placeholder="Volume">
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
    </div>
</template>

<script>
import store from "../stores/user";
import request from "../services/Request";

export default {
    mounted () {
        this.loadClientsList();
        this.loadStocksList();
    },
    data() {
        return {
            showModal: false,
            client: null,
            stock: null,
            stocks: [],
            clients: [],
            volume: 0
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
    methods:{
        closeModal() {
            this.$emit("closePurchaseModal");
        },
        reloadClients() {
            this.$emit("loadClientsList");
        },
        purchase() {
            let self = this;
            let url = '/client/' + this.client + '/stock/' + this.stock;
            request({
                url: url,
                method: "post",
                data: {volume: this.volume}
            }).then(function(response) {
                self.closeModal();
                self.reloadClients();
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
        loadStocksList() {
            let self = this;
            request({
                url: '/stock',
                method: "get"
            }).then(function(response) {
                self.stocks = response.data.data
            });
        }
    }
}
</script>