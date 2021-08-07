<template>
    <div
        class="
            h-16
            px-5
            flex
            justify-between
            items-center
            border-b-2 border-gray-300
        "
    >
        <div>Contacts</div>

        <UserCircle :name="user.data.attributes.name" />
    </div>
</template>

<script>
import { mapGetters } from "vuex";
import UserCircle from "./UserCircle.vue";

export default {
    name: "Topbar",

    components: {
        UserCircle,
    },

    computed: {
        ...mapGetters({
            user: "getUser",
        }),
    },
};
</script>
