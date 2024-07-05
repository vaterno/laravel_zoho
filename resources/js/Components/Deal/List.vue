<template>
    <div v-if="deals.length">
        <button type="button" class="btn btn-primary" v-on:click="isShowModal = true">Add new</button>

        <Modal
            :is-show-modal="isShowModal"
            @closeModal="closeModal"
        >
            <template v-slot:title>New deal</template>
            <p class="text-danger">{{ messages.error }}</p>
            <p class="text-success">{{ messages.success }}</p>

            <Form @submit="submitData" ref="form">
                <div class="mb-3">
                    <div class="input-group input-group-sm">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="inputGroup-sizing-sm">Name</span>
                        </div>
                        <Field name="name" rules="required"/>
                    </div>
                    <i class="text-danger"><ErrorMessage name="name"/></i>
                </div>

                <div class="mb-3">
                    <div class="input-group input-group-sm">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="inputGroup-sizing-sm">Stage</span>
                        </div>

                        <Field name="stage" as="select" rules="required">
                            <option v-for="(stage, key) in stages"
                                    :value="stage"
                                    :key="key"
                            >{{ stage }}</option>
                        </Field>
                    </div>
                    <i class="text-danger"><ErrorMessage name="stage"/></i>
                </div>

                <div class="mb-3">
                    <div class="input-group input-group-sm">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="inputGroup-sizing-sm">Account name</span>
                        </div>

                        <Field name="account_id" as="select" rules="required|integer">
                            <option v-for="account in accounts"
                                    :value="account.id"
                                    :key="account.id"
                            >{{ account.account_name }}</option>
                        </Field>
                    </div>
                    <i class="text-danger"><ErrorMessage name="account_id"/></i>
                </div>

                <div class="modal-footer">
                    <button @click="closeModal()" type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
            </Form>
        </Modal>

        <table class="table table-striped">
            <thead>
                <tr>
                    <th scope="col">Name</th>
                    <th scope="col">Stage</th>
                    <th scope="col">Account name</th>
                </tr>
            </thead>

            <tbody>
                <tr v-for="deal in deals" :key="deal.id">
                    <td>
                        {{ deal.name }}
                    </td>
                    <td>
                        {{ deal.stage }}
                    </td>
                    <td>
                        {{ deal.account_name.name }}
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
        deals: {
            type: Array,
            default: [],
        }
    },
    components: {
        Modal,
        Field,
        Form,
        ErrorMessage,
    },
    data() {
        return {
            accounts: [],
            stages: [],
            isShowModal: false,
            isBlockSubmitBtn: false,
            messages: {
                success: '',
                error: '',
            },
        };
    },
    methods: {
        getAccounts() {
            axios.get('/api/v1/accounts')
                .then(data => {
                    if (data.data.data) {
                        this.accounts = data.data.data;
                    }
                });
        },
        getStages() {
            axios.get('/api/v1/deals/stages')
                .then(data => {
                    if (data.data.data) {
                        this.stages = data.data.data;
                    }
                });
        },
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

            axios.post('/api/v1/deals', values)
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
        },
    },
    watch: {
        isShowModal(newValue) {
            console.log(newValue);

            if (newValue === true) {
                if (!this.accounts.length) {
                    this.getAccounts();
                }

                if (!this.stages.length) {
                    this.getStages();
                }
            }
        },
    },
}
</script>
