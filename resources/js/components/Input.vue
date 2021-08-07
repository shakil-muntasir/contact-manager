<template>
    <div class="relative mb-2">
        <label
            class="absolute pt-1 text-xs uppercase font-bold text-blue-600"
            :for="name"
            >{{ label }}</label
        >

        <input
            class="
                w-full
                text-sm
                pl-0
                pt-6
                border-0
                text-gray-900
                placeholder-gray-400
                focus:ring-0 focus:border-0
            "
            :class="classes"
            v-model="value"
            @input="updateInput"
            type="text"
            :id="name"
            :placeholder="placeholder"
        />

        <span class="text-red-600 text-xs">{{ errorMessage }}</span>
    </div>
</template>

<script>
export default {
    name: "Input",
    props: ["name", "label", "placeholder", "errors", "data"],
    data() {
        return {
            value: "",
        };
    },

    computed: {
        errorMessage() {
            if (this.hasError) {
                return this.errors[this.name][0];
            }
        },

        classes() {
            return {
                "border-b border-gray-300 focus:border-blue-600":
                    !this.hasError,
                "border-b-2 focus:border-red-500 border-red-500": this.hasError,
            };
        },

        hasError() {
            return (
                this.errors != null &&
                this.errors[this.name] &&
                this.errors[this.name].length > 0
            );
        },
    },

    methods: {
        updateInput() {
            this.$emit("update:input", this.value);

            if (this.hasError) {
                this.errors[this.name] = null;
            }
        },
    },

    watch: {
        data: {
            immediate: true,
            handler(val) {
                this.value = val;
            },
        },
    },
};
</script>
