<template>
    <div class="flex">
        <Navigation />
        <div class="flex flex-col flex-1 h-screen overflow-y-hidden">
            <Topbar />
            <Content>
                <Suspense>
                    <router-view />
                </Suspense>
            </Content>
        </div>
    </div>
</template>

<script>
import Navigation from './Navigation.vue'
import Topbar from './Topbar.vue'
import Content from './Content.vue'
export default {
    name: 'Layout',

    components: {
        Navigation,
        Topbar,
        Content
    }
}
</script>
