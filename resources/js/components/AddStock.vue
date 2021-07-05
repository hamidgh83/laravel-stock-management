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
export default {
    mounted () {
        
    },
    data() {
        return {
            form: {
                company_name: '',
                unit_price: 0
            }
        }
    },
    methods:{
        closeModal() {
            this.$emit("closeModal");
        },
        pushStockItem(item) {
            this.$emit("pushStockItem", item);
        },
        addStock() {
            let baseUrl = process.env.MIX_API_URL;
            axios.post(baseUrl + '/stock', this.form)
                 .then((res) => {
                    this.pushStockItem(res.data.data);
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