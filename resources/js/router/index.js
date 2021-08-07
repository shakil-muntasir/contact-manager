import { createRouter, createWebHistory } from "vue-router";

import DashboardLayout from "../components/Layout.vue";
import ContactIndex from "../views/contact/Index.vue";
import ContactCreate from "../views/contact/Create.vue";
import NotFound from "../views/NotFound.vue";

const routes = [
    {
        path: "/",
        name: "home",
        component: DashboardLayout,
        children: [
            { path: "/", name: "contact.index", component: ContactIndex },
            {
                path: "/contacts/create",
                name: "contact.create",
                component: ContactCreate,
            },
        ],
    },

    { path: "/:pathMatch(.*)*", name: "notfound", component: NotFound },
];

const router = createRouter({
    routes,
    history: createWebHistory(),
});

export default router;
