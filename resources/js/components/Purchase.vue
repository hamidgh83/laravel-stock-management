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
    methods:{
        closeModal() {
            this.$emit("closePurchaseModal");
        },
        reloadClients() {
            this.$emit("loadClientsList");
        },
        purchase() {
            let baseUrl = process.env.MIX_API_URL;
            axios.post(baseUrl + '/client/' + this.client + '/stock/' + this.stock, {volume: this.volume})
                 .then((res) => {
                    this.closeModal();
                    this.reloadClients();
                 })
                 .catch((error) => {
                     this.error = error;
                     console.log(error);
                     return Promise.reject(error)
                 });
        },
        loadClientsList() {
            let baseUrl = process.env.MIX_API_URL;
            axios
                .get(baseUrl + '/client')
                .then(response => {
                    this.clients = response.data.data
                })
                .catch(error => {
                    
                });
        },
        loadStocksList() {
            let baseUrl = process.env.MIX_API_URL;
            axios
                .get(baseUrl + '/stock')
                .then(response => {
                    this.stocks = response.data.data;
                    console.log(this.stocks);
                })
                .catch(error => {
                    
                });
        }
    }
}
</script>