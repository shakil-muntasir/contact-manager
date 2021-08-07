<template>
    <template v-if="!loaded"></template>
    <template v-else>
        <form @submit.prevent="submitContact">
            <Input
                name="name"
                label="Name"
                :data="form.name"
                @update:input="form.name = $event"
                :errors="errors"
                placeholder="Contact Name"
            />

            <Input
                name="email"
                label="Email"
                :data="form.email"
                @update:input="form.email = $event"
                :errors="errors"
                placeholder="contact@email.com"
            />

            <Input
                name="cellphone"
                label="Cellphone"
                :data="form.cellphone"
                @update:input="form.cellphone = $event"
                :errors="errors"
                placeholder="+1 23-123-1234"
            />

            <Input
                name="birthdate"
                label="Birthdate"
                :data="form.birthdate"
                @update:input="form.birthdate = $event"
                :errors="errors"
                placeholder="DD-MM-YYYY"
            />

            <Input
                name="note"
                label="Note"
                :data="form.note"
                @update:input="form.note = $event"
                :errors="errors"
                placeholder="Your Note"
            />

            <div class="flex justify-end">
                <button
                    @click="$router.replace('/contacts')"
                    class="
                        px-3
                        py-2
                        rounded
                        border border-red-600
                        text-red-600 text-sm
                        hover:bg-red-600 hover:text-white
                    "
                >
                    Cancel
                </button>
                <button
                    type="submit"
                    class="
                        ml-2
                        px-3
                        py-2
                        rounded
                        bg-blue-600
                        text-white text-sm
                        hover:bg-blue-500
                    "
                >
                    Update Contact
                </button>
            </div>
        </form>
    </template>
</template>

<script>
import axios from "axios";
import Input from "../../components/Input.vue";
export default {
    name: "Edit",

    components: {
        Input,
    },

    data() {
        return {
            form: {
                name: "",
                email: "",
                cellphone: "",
                birthdate: "",
                note: "",
            },
            errors: null,
            loaded: false,
        };
    },

    mounted() {
        axios
            .get(`/api/contacts/${this.$route.params.id}`)
            .then((response) => {
                this.form = response.data.data.attributes;
                this.loaded = true;
            })
            .catch((error) => {
                if (error.response.status === 404) {
                    this.$router.replace("/error");
                }
            });
    },

    methods: {
        submitContact() {
            axios
                .patch(`/api/contacts/${this.$route.params.id}`, this.form)
                .then((response) => {
                    this.$router.push(response.data.links.self);
                })
                .catch((error) => {
                    this.errors = error.response.data.errors;
                });
        },
    },
};
</script>
