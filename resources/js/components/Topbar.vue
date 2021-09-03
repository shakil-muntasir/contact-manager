<template>
    <div class="h-16 px-5 flex justify-between items-center border-b-2 border-gray-300">
        <div>{{ title }}</div>
        <Suspense>
            <template #default>
                <CircleContainer />
            </template>

            <template #fallback>
                <UserCircle />
            </template>
        </Suspense>
    </div>
</template>

<script setup>
import { ref, watch } from 'vue'
import { useRoute } from 'vue-router'

import CircleContainer from './CircleContainer.vue'
import UserCircle from './UserCircle.vue'

const route = useRoute()
const title = ref('Contact Manager')

watch(route, (to, from) => {
    let meta = 'Contact Manager'

    if (to.meta.title !== undefined) {
        meta = `${to.meta.title} | Contact Manager`
    }

    title.value = meta
})
</script>
