<template>
    <div>
        <List
            :accounts="accounts"
            @successAdded="successAdded"
        />
    </div>
</template>

<script>
import List from "../Components/Account/List.vue";

export default {
    data() {
        return {
            accounts: [],
        };
    },
    created() {
        this.getAccounts();
    },
    components: {
        List,
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
        successAdded() {
            this.getAccounts();
        }
    }
}
</script>
