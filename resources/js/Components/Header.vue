<template>
    <div class="container">
        <header class="d-flex justify-content-center py-3">
            <ul class="nav nav-pills">
                <li class="nav-item">
                    <router-link
                        active-class="active"
                        class="nav-link"
                        to="/">Accounts</router-link>
                </li>

                <li class="nav-item">
                    <router-link
                        active-class="active"
                        class="nav-link"
                        to="/deals">Deals</router-link>
                </li>
            </ul>
        </header>
    </div>
</template>

<script>
export default {
    components: 'Header',
}
</script>
