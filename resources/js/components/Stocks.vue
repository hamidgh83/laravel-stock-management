<template>
    <div>
        <div class="table_caption">
            <span>List all stocks</span>
            <button @click="showModal = true" type="button" class="btn btn-sm btn-primary">Create a new stock</button>
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
                    v-bind:key="index"
                    v-bind:value="item.key">
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
                                    <li><a class="dropdown-item" href="#">Update unit price</a></li>
                                    <li><a class="dropdown-item" href="#">Delete stock</a></li>
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
                            <p><strong>Create a new stock</strong></p>
                            <form v-on:submit.prevent="addStock">
                                <div style="margin-bottom:10px">
                                    <input type="text" class="form-control" v-model="form.company_name" placeholder="Company">
                                </div>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">€</div>
                                    </div>
                                    <input type="text" class="form-control" v-model="form.unit_price" placeholder="Unit price">
                                </div>
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
        this.resetForm(); 
        this.loadStocksList();
    },
    data() {
        return {
            showModal: false,
            error: "",
            stocks: [],
            form: {}
        };
    },
    methods:{
        addStock() {
            let baseUrl = process.env.MIX_API_URL;
            axios.post(baseUrl + '/stock', this.form)
                 .then((res) => {
                    this.stocks.push(res.data.data);
                    this.resetForm();
                    this.showModal = false;
                 })
                 .catch((error) => {
                     this.error = error;
                     console.log(error);
                 });
        },
        loadStocksList() {
            let baseUrl = process.env.MIX_API_URL;
            axios
                .get(baseUrl + '/stock')
                .then(response => {
                    this.stocks = response.data.data
                })
                .catch(error => {
                    
                });
        },
        resetForm() {
            this.form = {
                company_name: '',
                unit_price: 0
            }
        }
    }
}
</script>