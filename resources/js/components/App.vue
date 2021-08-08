<template>
    <div>
        <router-view v-if="loaded" />
    </div>
</template>

<script>
export default {
    name: 'App',

    data() {
        return {
            loaded: false
        }
    },

    async created() {
        await this.$store.dispatch('fetchAuthUser')

        this.loaded = true
    },

    watch: {
        $route: {
            immediate: true,
            handler(to, from) {
                let title = 'Contact Manager'

                if (to.meta.title !== undefined) {
                    title = `${to.meta.title} | Contact Manager`
                }

                document.title = title
            }
        }
    }
}
</script>
