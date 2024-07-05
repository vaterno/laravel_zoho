<template>
    <div v-if="accounts.length">
        <button type="button" class="btn btn-primary" v-on:click="isShowModal = true">Add new</button>

        <Modal
            :is-show-modal="isShowModal"
            @closeModal="closeModal"
        >
            <template v-slot:title>New account</template>
            <p class="text-danger">{{ messages.error }}</p>
            <p class="text-success">{{ messages.success }}</p>

            <Form @submit="submitData" ref="form">
                <div class="mb-3">
                    <div class="input-group input-group-sm">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="inputGroup-sizing-sm">Account name</span>
                        </div>
                        <Field name="account_name" rules="required"/>
                    </div>
                    <i class="text-danger"><ErrorMessage name="account_name"/></i>
                </div>

                <div class="mb-3">
                    <div class="input-group input-group-sm">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="inputGroup-sizing-sm">Website</span>
                        </div>
                        <Field name="website" rules="required|url"/>
                    </div>
                    <i class="text-danger"><ErrorMessage name="website"/></i>
                </div>

                <div class="mb-3">
                    <div class="input-group input-group-sm">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="inputGroup-sizing-sm">Phone</span>
                        </div>

                        <Field name="phone" rules="required"/>
                    </div>
                    <i class="text-danger"><ErrorMessage name="phone"/></i>
                </div>

                <div class="modal-footer">
                    <button @click="closeModal()" type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button :disabled="isBlockSubmitBtn" type="submit" class="btn btn-primary">Save</button>
                </div>
            </Form>
        </Modal>

        <table class="table table-striped mt-3">
            <thead>
                <tr>
                    <th scope="col">Account name</th>
                    <th scope="col">Website</th>
                    <th scope="col">Phone</th>
                </tr>
            </thead>

            <tbody>
                <tr v-for="account in accounts" :key="account.id">
                    <td>
                        {{ account.account_name }}
                    </td>
                    <td>
                        {{ account.website }}
                    </td>
                    <td>
                        {{ account.phone }}
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
    <p v-else>No content</p>
</template>

<script>
import Modal from "../Modal.vue";
import { Field, Form, ErrorMessage } from 'vee-validate';

export default {
    props: {
        accounts: {
            type: Array,
            default: [],
        },
    },
    components: {
        Modal,
        Field,
        Form,
        ErrorMessage,
    },
    data() {
        return {
            isShowModal: false,
            isBlockSubmitBtn: false,
            messages: {
                success: '',
                error: '',
            },
        }
    },
    methods: {
        closeModal() {
            this.isShowModal = false;
            this.messages.success = '';
            this.messages.error = '';

            this.$refs.form.resetForm();
            this.$emit('successAdded')
        },
        submitData(values, form) {
            this.messages.success = '';
            this.messages.error = '';
            this.isBlockSubmitBtn = true;

            axios.post('/api/v1/accounts', values)
                .then(data => {
                    if (data.data.data.success) {
                        this.messages.success = 'Record added';
                    } else {
                        this.messages.error = 'Something went wrong';
                    }
                }).catch(error => {
                    if (
                        error.response &&
                        error.response.data
                    ) {
                        if (error.response.data.errors) {
                            let errors = error.response.data.errors;

                            for (const key in errors) {
                                if (errors.hasOwnProperty(key)) {
                                    form.setFieldError(key, errors[key]);
                                }
                            }
                        } else if (error.response.data.message) {
                            this.messages.error = error.response.data.message;
                        }
                    }
                }).finally(() => {
                    this.isBlockSubmitBtn = false;
                });
        }
    }
}
</script>
