<template>
    <div>
        <div class="table_caption">
            <span>Client stocks</span>
        </div>

        <div class="scroll">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col">Company</th>
                        <th scope="col">Volume</th>
                        <th scope="col">Purchase price</th>
                        <th scope="col">Current price</th>
                        <th scope="col">Gain / Loss</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="(item, index) in this.items"
                    v-bind:key="index">
                        <td scope="row">{{item.company}}</td>
                        <td scope="row">{{item.volume}}</td>
                        <td scope="row">€ {{item.purchase_price}}</td>
                        <td scope="row">€ {{item.current_price}}</td>
                        <td scope="row">
                            <span v-bind:class="{'text-success':(item.profit >= 0), 'text-danger':(item.profit < 0)}">
                                {{item.profit}}
                            </span>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

        <client-summary v-bind:stocks="this.items"></client-summary>

        <br/>
        <router-link to="/client" class="btn btn-success">Clients list</router-link>
    </div>
</template>

<script>
import request from "../services/Request";
import ClientSummary from './ClientSummary.vue';

export default {
    components: {
        ClientSummary
    },
    mounted () {
        this.loadItems();
    },
    data() {
        return {
            error: "",
            items: []
        };
    },
    methods:{
        loadItems() {
            let self = this;
            let url = '/client/' + this.$route.params.id + '/stocks';
            request({
                url: url,
                method: "get",
            }).then(function(response) {
                self.items = response.data.data
            });
        }
    }
}
</script>