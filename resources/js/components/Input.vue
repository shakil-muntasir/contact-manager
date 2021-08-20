<template>
    <div class="relative mb-2">
        <label class="absolute pt-1 text-xs uppercase font-bold text-blue-600" :for="name">{{ label }}</label>

        <input class="w-full text-sm pl-0 pt-6 border-0 text-gray-900 placeholder-gray-400 focus:ring-0 focus:border-0" :class="classes" v-model="value" @input="updateInput" type="text" :id="name" :placeholder="placeholder" />

        <span class="text-red-600 text-xs">{{ errorMessage }}</span>
    </div>
</template>

<script setup>
import { ref, computed, watch } from 'vue'

const props = defineProps(['name', 'label', 'placeholder', 'errors', 'data'])

const emit = defineEmits(['update:input'])

const value = ref('')

const errorMessage = computed(() => {
    if (hasError.value) {
        return props.errors[props.name][0]
    }
})

const hasError = computed(() => {
    return props.errors != null && props.errors[props.name] && props.errors[props.name].length > 0
})

const classes = computed(() => {
    return {
        'border-b border-gray-300 focus:border-blue-600': !hasError.value,
        'border-b-2 focus:border-red-500 border-red-500': hasError.value
    }
})

const updateInput = () => {
    emit('update:input', value.value)

    if (hasError.value) {
        props.errors[props.name] = null
    }
}

watch(
    () => props.data,
    (data, prevData) => {
        value.value = data
    },
    {
        immediate: true
    }
)
</script>
