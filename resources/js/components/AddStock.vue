<template>
    <div class="modal-mask">
        <div class="modal-wrapper">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-body">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true" @click="closeModal">&times;</span>
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
</template>

<script>
import store from "../stores/user";
import request from "../services/Request";

export default {
    data() {
        return {
            form: {
                company_name: '',
                unit_price: 0
            }
        }
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
            store.commit("clearErrors");
            this.$emit("closeModal");
        },
        pushStockItem(item) {
            this.$emit("pushStockItem", item);
        },
        addStock() {
            let self = this;
            let url = "/stock";
            request({
                url: url,
                method: "post",
                data: this.form
            }).then(function(response) {
                self.pushStockItem(response.data.data);
                self.closeModal();
            });
        }
    }
}
</script>