import { createRouter, createWebHistory } from "vue-router";
import Accounts from "./Pages/Accounts.vue";
import Deals from "./Pages/Deals.vue";
import Main from "./Layouts/Main.vue";

const router = createRouter({
    history: createWebHistory(),
    routes: [
        {
            path: '/',
            alias: ['/accounts'],
            name: 'home',
            component: Main,
            children: [
                {
                    path: '',
                    component: Accounts,
                }
            ],
        },
        {
            path: '/deals',
            name: 'deals',
            component: Main,
            children: [
                {
                    path: '',
                    component: Deals,
                }
            ],
        },
    ],
});

export default router;
