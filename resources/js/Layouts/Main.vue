<template>
    <Header/>

    <div class="container mt-3">
        <router-view />
    </div>
</template>

<script>
import Header from "../Components/Header.vue";

export default {
    components: {
        Header,
    }
}
</script>
