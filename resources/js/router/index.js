import { createRouter, createWebHistory } from "vue-router";

import DashboardLayout from "../components/Layout.vue";
import ContactIndex from "../views/contact/Index.vue";
import ContactCreate from "../views/contact/Create.vue";
import ContactShow from "../views/contact/Show.vue";
import ContactEdit from "../views/contact/Edit.vue";
import NotFound from "../views/NotFound.vue";

const routes = [
    {
        path: "/",
        name: "home",
        component: DashboardLayout,
        children: [
            {
                path: "/",
                component: ContactIndex,
            },
            {
                path: "/contacts",
                name: "contact.index",
                component: ContactIndex,
                meta: { title: "All" },
            },
            {
                path: "/contacts/create",
                name: "contact.create",
                component: ContactCreate,
                meta: { title: "Create" },
            },
            {
                path: "/contacts/:id",
                name: "contact.show",
                component: ContactShow,
                meta: { title: "Detail" },
            },
            {
                path: "/contacts/:id/edit",
                name: "contact.edit",
                component: ContactEdit,
                meta: { title: "Edit" },
            },
        ],
    },

    { path: "/error", name: "error", component: NotFound },
    { path: "/:pathMatch(.*)*", name: "notfound", component: NotFound },
];

const router = createRouter({
    routes,
    history: createWebHistory(),
});

export default router;
