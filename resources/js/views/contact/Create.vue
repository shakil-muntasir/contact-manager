<template>
    <form @submit.prevent="submitContact">
        <Input name="name" label="Name" @update:input="form.name = $event" :errors="errors" placeholder="Contact Name" />

        <Input name="email" label="Email" @update:input="form.email = $event" :errors="errors" placeholder="contact@email.com" />

        <Input name="cellphone" label="Cellphone" @update:input="form.cellphone = $event" :errors="errors" placeholder="+1 23-123-1234" />

        <Input name="birthdate" label="Birthdate" @update:input="form.birthdate = $event" :errors="errors" placeholder="DD-MM-YYYY" />

        <Input name="note" label="Note" @update:input="form.note = $event" :errors="errors" placeholder="Your Note" />

        <div class="flex justify-end">
            <button @click.prevent="$router.replace('/contacts')" class="px-3 py-2 text-sm text-red-600 border border-red-600 rounded hover:bg-red-600 hover:text-white">Cancel</button>
            <button type="submit" class="px-3 py-2 ml-2 text-sm text-white bg-blue-600 rounded hover:bg-blue-500">Add New Contact</button>
        </div>
    </form>
</template>

<script setup>
import { useStore } from 'vuex'
import { ref, computed } from 'vue'
import { useRouter } from 'vue-router'
import Input from '../../components/Input.vue'

const store = useStore()
const router = useRouter()
const form = ref({
    name: '',
    email: '',
    cellphone: '',
    birthdate: '',
    note: ''
})
const contact = computed(() => store.getters.getContact)
const errors = computed(() => store.getters.getContactErrors)

const submitContact = async () => {
    try {
        await store.dispatch('createContact', form.value)
        router.push(contact.value.links.self)
    } catch (error) {}
}

// export default {
//     name: 'Create',

//     components: {
//         Input
//     },

//     data() {
//         return {
//             form: {
//                 name: '',
//                 email: '',
//                 cellphone: '',
//                 birthdate: '',
//                 note: ''
//             }
//         }
//     },

//     computed: {
//         ...mapGetters({
//             contact: 'getContact',
//             errors: 'getContactErrors'
//         })
//     },

//     methods: {
//
//     }
// }
</script>
