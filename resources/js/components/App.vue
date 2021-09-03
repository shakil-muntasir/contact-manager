<template>
    <router-view />
</template>

<script setup>
import { watch } from 'vue'
import { useRoute } from 'vue-router'

const route = useRoute()

watch(route, (to, from) => {
    let title = 'Contact Manager'

    if (to.meta.title !== undefined) {
        title = `${to.meta.title} | Contact Manager`
    }

    document.title = title
})
</script>
