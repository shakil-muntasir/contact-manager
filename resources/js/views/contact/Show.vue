<template>
    <template v-if="!loaded"></template>
    <template v-else>
        <div class="flex w-full justify-between items-center">
            <div>
                <button
                    @click="$router.back"
                    class="
                        px-3
                        py-1
                        rounded
                        border border-blue-600
                        text-blue-600
                        hover:bg-blue-600 hover:text-white
                    "
                >
                    Back
                </button>
            </div>

            <div>
                <router-link :to="`/contacts/${$route.params.id}/edit`">
                    <button
                        class="
                            px-3
                            py-1
                            rounded
                            border border-green-600
                            text-green-600
                            hover:bg-green-600 hover:text-white
                        "
                    >
                        Edit
                    </button>
                </router-link>

                <button
                    class="
                        ml-3
                        px-3
                        py-1
                        rounded
                        border border-red-500
                        text-red-500
                        hover:bg-red-500 hover:text-white
                    "
                    @click="toggleModal = !toggleModal"
                >
                    Delete
                </button>
            </div>
        </div>

        <Modal
            v-if="toggleModal"
            @cancel="toggleModal = !toggleModal"
            @delete="deleteContact"
        />

        <div class="mt-8">
            <h3 class="mt-8 uppercase text-xs font-bold text-gray-500">
                Contact Name
            </h3>
            <div class="flex items-center mt-2">
                <div>
                    <UserCircle :name="contact.data.attributes.name" />
                </div>
                <p class="ml-3 text-xl text-blue-600">
                    {{ contact.data.attributes.name }}
                </p>
            </div>

            <h3 class="mt-8 uppercase text-xs font-bold text-gray-500">
                Contact Email
            </h3>
            <p class="mt-2 text-xl text-blue-600">
                {{ contact.data.attributes.email }}
            </p>

            <h3 class="mt-8 uppercase text-xs font-bold text-gray-500">
                Contact Cellphone
            </h3>
            <p class="mt-2 text-xl text-blue-600">
                {{ contact.data.attributes.cellphone }}
            </p>

            <h3 class="mt-8 uppercase text-xs font-bold text-gray-500">
                Contact Birthdate
            </h3>
            <p class="mt-2 text-xl text-blue-600">
                {{ contact.data.attributes.birthdate }}
            </p>

            <h3 class="mt-8 uppercase text-xs font-bold text-gray-500">Note</h3>
            <p class="mt-2 text-xl text-blue-600">
                {{ contact.data.attributes.note }}
            </p>
        </div>

        <div class="mt-12 flex justify-end text-xs font-thin text-gray-600">
            <p>Updated at {{ contact.data.attributes.updated_at }}</p>
        </div>
    </template>
</template>

<script>
import axios from "axios";
import UserCircle from "../../components/UserCircle.vue";
import Modal from "../../components/Modal.vue";
export default {
    name: "ContactShow",

    components: {
        UserCircle,
        Modal,
    },

    data() {
        return {
            contact: null,
            loaded: false,
            toggleModal: false,
        };
    },

    mounted() {
        axios
            .get(`/api/contacts/${this.$route.params.id}`)
            .then((response) => {
                this.contact = response.data;
                this.loaded = true;
            })
            .catch((error) => {
                if (error.response.status === 404) {
                    this.$router.replace("/error");
                }
            });
    },

    methods: {
        deleteContact() {
            axios
                .delete(`/api/contacts/${this.contact.data.id}`)
                .then((response) => {
                    this.$router.replace("/contacts");
                })
                .catch((error) => console.log(error.response.data));
        },
    },
};
</script>
