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
        updateStock() {
            let baseUrl = process.env.MIX_API_URL;
            axios.put(baseUrl + '/stock/' + this.item.id, this.form)
                 .then((res) => {
                    this.$emit("loadStocksList");
                    this.closeModal();
                 })
                 .catch((error) => {
                     this.error = error;
                     console.log(error);
                 });
        }
    }
}
</script>