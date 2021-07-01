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
                    v-bind:key="index"
                    v-bind:value="item.key">
                        <th scope="row">{{item.client}}</th>
                        <th scope="row">{{item.balance}}</th>
                        <th scope="row">
                            <span v-bind:class="{'text-success':(item.profit >= 0), 'text-danger':(item.profit < 0)}">
                                {{item.profit}}
                            </span>
                        </th>
                        <th>
                            <div class="dropdown">
                                <button class="btn btn-default dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <span class="glyphicon glyphicon-option-horizontal" aria-hidden="true"></span>
                                    <span class="caret"></span>
                                </button>
                                <ul class="dropdown-menu">
                                    <li><a class="dropdown-item" href="#">View stocks</a></li>
                                </ul>
                            </div>
                        </th>
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
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">@</div>
                                </div>
                                <input type="text" class="form-control" id="username" placeholder="Username">
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
                {client: "johndoe", balance: "670", profit: "16"},
                {client: "michael", balance: "25", profit: "-20"},
                {client: "Joe", balance: "1000", profit: "80"},
                {client: "george", balance: "410", profit: "10"},
            ]
        };
    }
}
</script>