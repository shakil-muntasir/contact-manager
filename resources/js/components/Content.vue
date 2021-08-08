<template>
    <div class="flex-1 flex flex-col overflow-y-hidden">
        <div class="p-6 overflow-x-hidden">
            <slot />
        </div>
    </div>
</template>

<script>
export default {
    name: 'Content'
}
</script>
