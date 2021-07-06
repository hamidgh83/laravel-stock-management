<template>
    <div class="modal-mask">
        <div class="modal-wrapper">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-body">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true" @click="closeModal">&times;</span>
                        </button>
                        <p><strong>{{item.company}}</strong></p>
                        <form v-on:submit.prevent="updateStock">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">€</div>
                                </div>
                                <input type="text" class="form-control" v-model="form.unit_price" placeholder="Unit price">
                            </div>
                            <div class="modal-action">
                                <button type="submit" class="btn btn-primary">Update</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import request from "../services/Request";

export default {
    data() {
        return {
            form: {
                unit_price: this.item.unit_price
            }
        }
    },
    props: {
        item: Object
    },
    methods:{
        closeModal() {
            this.$emit("closeUpdateModal");
        },
        reloadStockList() {
            this.$emit("loadStocksList");
        },
        updateStock() {
            let self = this;
            request({
                url: "/stock/" + this.item.id,
                method: "put",
                data: this.form
            }).then(function(response) {
                self.reloadStockList();
                self.closeModal();
            });
        }
    }
}
</script>