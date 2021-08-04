<template>
    <div class="text-3xl bg-blue-500">My Cool HomePage!!!</div>
    <p>{{ $store.getters.getTest }}</p>
</template>

<script>
export default {
    name: "Home",
};
</script>
