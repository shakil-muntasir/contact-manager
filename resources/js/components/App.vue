<template>
    <template v-if="!loaded"></template>
    <router-view v-else />
</template>

<script>
export default {
    name: "App",

    data() {
        return {
            loaded: false,
        };
    },

    created() {
        this.getAuthUser();
    },

    methods: {
        async getAuthUser() {
            await this.$store.dispatch("fetchAuthUser");

            return (this.loaded = true);
        },
    },

    watch: {
        $route: {
            immediate: true,
            handler(to, from) {
                let title = "Contact Manager";

                if (to.meta.title !== undefined) {
                    title = `${to.meta.title} | Contact Manager`;
                }

                document.title = title;
            },
        },
    },
};
</script>
