<template>
    <div class="relative mb-4">
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
                text-gray-900
                placeholder-gray-400
                border-0 border-b
                focus:border-blue-600 focus:ring-0 focus:border-0
            "
            v-model="value"
            @input="$emit('update:input', value)"
            :type="type ? type : 'text'"
            :id="name"
            :placeholder="placeholder"
        />
    </div>
</template>

<script>
export default {
    name: "Input",
    props: ["name", "label", "placeholder", "type"],
    data() {
        return {
            value: "",
        };
    },
};
</script>
