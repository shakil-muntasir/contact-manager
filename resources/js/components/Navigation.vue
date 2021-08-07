<template>
    <nav class="pt-4 pl-6 bg-gray-200 h-screen w-48 border-r-2 border-gray-300">
        <router-link to="/">
            <svg
                xmlns="http://www.w3.org/2000/svg"
                class="h-12 w-12 text-blue-600"
                fill="none"
                viewBox="0 0 24 24"
                stroke="currentColor"
            >
                <path
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    stroke-width="2"
                    d="M7 21a4 4 0 01-4-4V5a2 2 0 012-2h4a2 2 0 012 2v12a4 4 0 01-4 4zm0 0h12a2 2 0 002-2v-4a2 2 0 00-2-2h-2.343M11 7.343l1.657-1.657a2 2 0 012.828 0l2.829 2.829a2 2 0 010 2.828l-8.486 8.485M7 17h.01"
                />
            </svg>
        </router-link>

        <h3 class="mt-12 uppercase text-xs font-bold text-gray-500">Create</h3>

        <router-link
            to="/contacts/create"
            class="mt-2 flex items-center text-gray-900 hover:text-blue-600"
        >
            <svg
                xmlns="http://www.w3.org/2000/svg"
                class="h-5 w-5 text-blue-600"
                fill="none"
                viewBox="0 0 24 24"
                stroke="currentColor"
            >
                <path
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    stroke-width="2"
                    d="M12 4v16m8-8H4"
                />
            </svg>

            <span class="pl-3 tracking-wide text-sm">Add New</span>
        </router-link>

        <h3 class="mt-12 uppercase text-xs font-bold text-gray-500">General</h3>

        <router-link
            to="/contacts"
            class="mt-2 flex items-center text-gray-900 hover:text-blue-600"
        >
            <svg
                xmlns="http://www.w3.org/2000/svg"
                class="h-5 w-5 text-blue-600"
                fill="none"
                viewBox="0 0 24 24"
                stroke="currentColor"
            >
                <path
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    stroke-width="2"
                    d="M7 21a4 4 0 01-4-4V5a2 2 0 012-2h4a2 2 0 012 2v12a4 4 0 01-4 4zm0 0h12a2 2 0 002-2v-4a2 2 0 00-2-2h-2.343M11 7.343l1.657-1.657a2 2 0 012.828 0l2.829 2.829a2 2 0 010 2.828l-8.486 8.485M7 17h.01"
                />
            </svg>

            <span class="pl-3 tracking-wide text-sm">Contacts</span>
        </router-link>

        <h3 class="pt-12 uppercase text-xs font-bold text-gray-500">
            Settings
        </h3>

        <div
            @click="logout"
            class="
                py-2
                flex
                items-center
                text-gray-900
                hover:text-blue-600
                cursor-pointer
            "
        >
            <svg
                xmlns="http://www.w3.org/2000/svg"
                class="h-5 w-5 text-blue-600"
                fill="none"
                viewBox="0 0 24 24"
                stroke="currentColor"
            >
                <path
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    stroke-width="2"
                    d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"
                />
            </svg>

            <span class="pl-3 tracking-wide text-sm">Logout</span>
        </div>
    </nav>
</template>

<script>
import axios from "axios";
export default {
    name: "Navigaton",

    methods: {
        logout() {
            axios
                .post("/logout")
                .finally(() => window.location.replace("/login"));
        },
    },
};
</script>
