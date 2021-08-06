<template>
    <Layout>
        <form @submit.prevent="submitContact">
            <Input
                name="name"
                label="Name"
                @update:input="form.name = $event"
                placeholder="Contact Name"
            />
            <Input
                name="email"
                type="email"
                label="Email"
                @update:input="form.email = $event"
                placeholder="contact@email.com"
            />
            <Input
                name="cellphone"
                label="Cellphone"
                @update:input="form.cellphone = $event"
                placeholder="+1 23-123-1234"
            />
            <Input
                name="birthdate"
                label="Birthdate"
                @update:input="form.birthdate = $event"
                placeholder="DD-MM-YYYY"
            />
            <Input
                name="note"
                label="Note"
                @update:input="form.note = $event"
                placeholder="Your Note"
            />

            <div class="flex justify-end">
                <button
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
    </Layout>
</template>

<script>
import axios from "axios";
import Layout from "../../components/Layout.vue";
import Input from "../../components/Input.vue";
export default {
    name: "Create",

    components: {
        Layout,
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
        };
    },

    methods: {
        submitContact() {
            axios
                .post("/api/contacts", this.form)
                .then((response) => console.log(response.data))
                .catch((error) => console.log(error.response.data));
        },
    },
};
</script>
