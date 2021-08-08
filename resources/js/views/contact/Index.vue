<template>
    <div v-if="loaded">
        <div class="text-2xl" v-if="contacts.data.length === 0">
            No contacts found.
            <router-link class="text-blue-600" to="/contacts/create">Get Started?</router-link>
        </div>
        <router-link v-else v-for="contact in contacts.data" :key="contact.data.id" :to="contact.links.self" class="flex items-center w-full border-b border-gray-300 py-2 mb-2">
            <UserCircle :name="contact.data.attributes.name" />

            <div class="ml-3 font-semibold text-gray-700">
                <p>
                    <span class="text-blue-600 text-base">{{ contact.data.attributes.name }}</span>
                    ({{ contact.data.attributes.email }})
                </p>
                <p>{{ contact.data.attributes.cellphone }}</p>
            </div>
        </router-link>
    </div>
</template>

<script>
import axios from 'axios'
import UserCircle from '../../components/UserCircle.vue'
export default {
    name: 'ContactIndex',

    data() {
        return {
            contacts: [],
            loaded: false
        }
    },

    components: {
        UserCircle
    },

    mounted() {
        axios
            .get('/api/contacts')
            .then(response => {
                this.contacts = response.data

                this.loaded = true
            })
            .catch(error => {})
    }
}
</script>
