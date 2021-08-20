<template>
    <UserCircle :name="user.data.attributes.name" />
</template>

<script setup>
import { computed } from 'vue'
import { useStore } from 'vuex'
import UserCircle from './UserCircle.vue'

const store = useStore()

await store.dispatch('fetchAuthUser')
const user = computed(() => store.getters.getUser)
</script>
