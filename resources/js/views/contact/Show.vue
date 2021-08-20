<template>
    <div>
        <div class="flex items-center justify-between w-full">
            <div>
                <button @click="router.back()" class="px-3 py-1 text-blue-600 border border-blue-600 rounded hover:bg-blue-600 hover:text-white">Back</button>
            </div>

            <div>
                <router-link :to="`/contacts/${route.params.id}/edit`">
                    <button class="px-3 py-1 text-green-600 border border-green-600 rounded hover:bg-green-600 hover:text-white">Edit</button>
                </router-link>

                <button class="px-3 py-1 ml-3 text-red-500 border border-red-500 rounded hover:bg-red-500 hover:text-white" @click="toggleModal = !toggleModal">Delete</button>
            </div>
        </div>

        <Modal v-if="toggleModal" @cancel="toggleModal = !toggleModal" @delete="deleteContact" />

        <div class="mt-8">
            <h3 class="mt-8 text-xs font-bold text-gray-500 uppercase">Contact Name</h3>
            <div class="flex items-center mt-2">
                <div>
                    <UserCircle :name="contact.data.attributes.name" />
                </div>
                <p class="ml-3 text-xl text-blue-600">
                    {{ contact.data.attributes.name }}
                </p>
            </div>

            <h3 class="mt-8 text-xs font-bold text-gray-500 uppercase">Contact Email</h3>
            <p class="mt-2 text-xl text-blue-600">
                {{ contact.data.attributes.email }}
            </p>

            <h3 class="mt-8 text-xs font-bold text-gray-500 uppercase">Contact Cellphone</h3>
            <p class="mt-2 text-xl text-blue-600">
                {{ contact.data.attributes.cellphone }}
            </p>

            <h3 class="mt-8 text-xs font-bold text-gray-500 uppercase">Contact Birthdate</h3>
            <p class="mt-2 text-xl text-blue-600">
                {{ contact.data.attributes.birthdate }}
            </p>

            <h3 class="mt-8 text-xs font-bold text-gray-500 uppercase">Note</h3>
            <p class="mt-2 text-xl text-blue-600">
                {{ contact.data.attributes.note }}
            </p>
        </div>

        <div class="flex justify-end mt-12 text-xs font-thin text-gray-600">
            <p>Updated at {{ contact.data.attributes.updated_at }}</p>
        </div>
    </div>
</template>

<script setup>
import { computed, ref } from 'vue'
import { useStore } from 'vuex'
import { useRoute, useRouter } from 'vue-router'

import UserCircle from '../../components/UserCircle.vue'
import Modal from '../../components/Modal.vue'

const store = useStore()
const route = useRoute()
const router = useRouter()

const toggleModal = ref(false)

await store.dispatch('fetchContact', route.params.id)

const contact = computed(() => store.getters.getContact)

const deleteContact = async () => {
    await store.dispatch('deleteContact', contact.value.data.id)
    router.replace('/contacts')
}
</script>
