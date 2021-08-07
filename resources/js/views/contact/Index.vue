<template>
    <div v-for="i in 100" :key="i">
        <p>
            Lorem ipsum dolor sit amet consectetur adipisicing elit. Aperiam eum
            accusamus deserunt eaque cumque accusantium, ut animi voluptate
            saepe ducimus hic fuga expedita dolore quis aliquid excepturi, odio
            obcaecati nihil, perferendis tempora?
        </p>
    </div>
</template>

<script>
export default {
    name: "ContactIndex",

    $route: {
        immediate: true,
        handler(to, from) {
            document.title = to.meta.title || "Contact Manager";
        },
    },
};
</script>
