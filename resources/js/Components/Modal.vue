<template>
    <div class="modal fade" :class="{show: isShowModal}" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">
                        <slot name="title"></slot>
                    </h5>
                    <button @click="closeModal()" type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <slot />
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    props: {
        isShowModal: {
            default: false,
        },
    },
    methods: {
        closeModal() {
            this.$emit('closeModal');
        },
        submitModal() {
            this.$emit('submitModal');
        }
    }
}
</script>

<style>
.modal.fade.show {
    display: block;
    background: rgba(0, 0, 0, .5);
}
</style>
