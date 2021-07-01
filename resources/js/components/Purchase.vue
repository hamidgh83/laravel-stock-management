<template>
    <div>
        <button @click="showModal = true" class="btn btn-primary btn-lg" type="button">Purchase a stock</button>

        <div v-if="showModal" class="modal-mask">
            <div class="modal-wrapper">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-body">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true" @click="showModal = false">&times;</span>
                            </button>
                            <p><strong>Purchase a stock</strong></p>
                            <div class="form-group">
                                <select class="form-control">
                                    <option disabled selected>Choose client</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <select class="form-control">
                                    <option disabled selected>Choose stock</option>
                                </select>
                            </div>
                            <input type="text" class="form-control" placeholder="Volume">
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
            showModal: false
        };
    }
}
</script>