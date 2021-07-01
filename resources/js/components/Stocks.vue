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
                    <tr v-for="(item, index) in this.clients"
                    v-bind:key="index"
                    v-bind:value="item.key">
                        <th scope="row">{{item.company}}</th>
                        <th scope="row">€ {{item.unit}}</th>
                        <th scope="row">{{item.updated_at}}</th>
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
                            <div style="margin-bottom:10px">
                                <input type="text" class="form-control" placeholder="Company">
                            </div>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">€</div>
                                </div>
                                <input type="text" class="form-control" placeholder="Unit price">
                            </div>
                            <div class="modal-action">
                                <button type="button" class="btn btn-primary">Add</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>


<script>
export default {
    created: function() {},
    data() {
        return {
            showModal: false,
            message: "",
            clients: [
                {company: "Microsoft", unit: "35.0", updated_at: "11/02/2021"},
                {company: "IBM", unit: "23.0", updated_at: "05/01/2021"},
                {company: "Apple", unit: "25.6", updated_at: "08/02/2021"},
            ]
        };
    }
}
</script>