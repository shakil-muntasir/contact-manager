<template>
    <div>
        <div class="relative">
            <div class="z-20 mt-2 bg-indigo-800 absolute w-72 right-0 px-6 py-6 rounded-lg">
                <p class="text-white">Are you sure you want to delete this contact? Action will be irreversible</p>

                <div class="flex justify-end items-center mt-3">
                    <button class="px-3 py-1 rounded border border-gray-400 hover:border-gray-200 text-white" @click.prevent="$emit('cancel')">Cancel</button>
                    <button @click.prevent="$emit('delete')" class="ml-3 px-3 py-1 rounded text-white bg-red-500 border border-red-500 hover:bg-red-700">Delete</button>
                </div>
            </div>
        </div>

        <div class="z-10 bg-gray-800 opacity-25 absolute inset-0" @click="$emit('cancel')" />
    </div>
</template>

<script>
export default {
    name: 'Modal',
    emits: ['cancel', 'delete']
}
</script>
