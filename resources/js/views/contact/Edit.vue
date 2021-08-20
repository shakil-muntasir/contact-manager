<template>
    <form @submit.prevent="updateContact">
        <Input name="name" label="Name" :data="form.name" @update:input="form.name = $event" :errors="errors" placeholder="Contact Name" />

        <Input name="email" label="Email" :data="form.email" @update:input="form.email = $event" :errors="errors" placeholder="contact@email.com" />

        <Input name="cellphone" label="Cellphone" :data="form.cellphone" @update:input="form.cellphone = $event" :errors="errors" placeholder="+1 23-123-1234" />

        <Input name="birthdate" label="Birthdate" :data="form.birthdate" @update:input="form.birthdate = $event" :errors="errors" placeholder="DD-MM-YYYY" />

        <Input name="note" label="Note" :data="form.note" @update:input="form.note = $event" :errors="errors" placeholder="Your Note" />

        <div class="flex justify-end">
            <button @click.prevent="router.replace('/contacts')" class="px-3 py-2 text-sm text-red-600 border border-red-600 rounded hover:bg-red-600 hover:text-white">Cancel</button>
            <button type="submit" class="px-3 py-2 ml-2 text-sm text-white bg-blue-600 rounded hover:bg-blue-500">Update Contact</button>
        </div>
    </form>
</template>

<script setup>
import { computed } from 'vue'
import { useStore } from 'vuex'
import { useRoute, useRouter } from 'vue-router'

import Input from '../../components/Input.vue'

const store = useStore()
const route = useRoute()
const router = useRouter()

const form = computed(() => store.getters.getContactForm)
const contact = computed(() => store.getters.getContact)
const errors = computed(() => store.getters.getContactErrors)

try {
    await store.dispatch('fetchContactForm', route.params.id)
} catch (error) {
    if (error.response.status === 404) {
        router.replace('/error')
    }
}

const updateContact = async () => {
    const payload = {
        contact_id: route.params.id,
        payload: { ...form.value }
    }
    
    try {
        await store.dispatch('updateContact', payload)

        router.push(contact.value.links.self)
    } catch (error) {
        console.log(error)
    }
}
</script>
