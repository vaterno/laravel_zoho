<template>
    <div>
        <List
            :deals="deals"
            @successAdded="successAdded"
        />
    </div>
</template>

<script>
import List from "../Components/Deal/List.vue";

export default {
    data() {
        return {
            deals: [],
        };
    },
    created() {
        this.getDeals();
    },
    components: {
        List,
    },
    methods: {
        getDeals() {
            axios.get('/api/v1/deals')
                .then(data => {
                    if (data.data.data) {
                        this.deals = data.data.data;
                    }
                });
        },
        successAdded() {
            this.getDeals();
        }
    }
}
</script>
