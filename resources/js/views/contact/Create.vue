<template>
    <form @submit.prevent="submitContact">
        <Input
            name="name"
            label="Name"
            @update:input="form.name = $event"
            :errors="errors"
            placeholder="Contact Name"
        />

        <Input
            name="email"
            label="Email"
            @update:input="form.email = $event"
            :errors="errors"
            placeholder="contact@email.com"
        />

        <Input
            name="cellphone"
            label="Cellphone"
            @update:input="form.cellphone = $event"
            :errors="errors"
            placeholder="+1 23-123-1234"
        />

        <Input
            name="birthdate"
            label="Birthdate"
            @update:input="form.birthdate = $event"
            :errors="errors"
            placeholder="DD-MM-YYYY"
        />

        <Input
            name="note"
            label="Note"
            @update:input="form.note = $event"
            :errors="errors"
            placeholder="Your Note"
        />

        <div class="flex justify-end">
            <button
                @click.prevent="$router.replace('/contacts')"
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
                Add New Contact
            </button>
        </div>
    </form>
</template>

<script>
import axios from "axios";
import Input from "../../components/Input.vue";
export default {
    name: "Create",

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
            contact: null,
        };
    },

    methods: {
        submitContact() {
            axios
                .post("/api/contacts", this.form)
                .then((response) => {
                    this.contact = response.data;
                    this.$router.push(this.contact.links.self);
                })
                .catch((error) => (this.errors = error.response.data.errors));
        },
    },
};
</script>
