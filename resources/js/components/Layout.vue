<template>
    <div class="flex">
        <Navigation />
        <div class="flex-1 flex flex-col h-screen overflow-y-hidden">
            <Topbar />
            <Content>
                <router-view />
            </Content>
        </div>
    </div>
</template>

<script>
import Navigation from "./Navigation.vue";
import Topbar from "./Topbar.vue";
import Content from "./Content.vue";
export default {
    name: "Layout",

    components: {
        Navigation,
        Topbar,
        Content,
    },
};
</script>
