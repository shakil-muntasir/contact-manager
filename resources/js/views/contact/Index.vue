<template>
    <div>
        <div class="text-2xl" v-if="contacts.data.length === 0">
            No contacts found.
            <router-link class="text-blue-600" to="/contacts/create">Get Started?</router-link>
        </div>
        <router-link v-else v-for="contact in contacts.data" :key="contact.data.id" :to="contact.links.self" class="flex items-center w-full py-2 mb-2 border-b border-gray-300">
            <UserCircle :name="contact.data.attributes.name" />

            <div class="ml-3 font-semibold text-gray-700">
                <p>
                    <span class="text-base text-blue-600">{{ contact.data.attributes.name }}</span>
                    ({{ contact.data.attributes.email }})
                </p>
                <p>{{ contact.data.attributes.cellphone }}</p>
            </div>
        </router-link>
    </div>
</template>

<script setup>
import { computed } from 'vue'
import { useStore } from 'vuex'

import UserCircle from '../../components/UserCircle.vue'

const store = useStore()

await store.dispatch('fetchContacts')

const contacts = computed(() => store.getters.getContacts)
</script>
