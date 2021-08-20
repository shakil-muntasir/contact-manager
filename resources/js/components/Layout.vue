<template>
    <div class="flex">
        <Navigation />
        <div class="flex flex-col flex-1 h-screen overflow-y-hidden">
            <Topbar />

            <Content>
                <Suspense>
                    <template #default>
                        <router-view />
                    </template>

                    <template #fallback>
                        <div class="flex justify-center min-h-full items-center">
                            <Spinner class="animate-spin h-8 w-8 text-blue-600" />
                        </div>
                    </template>
                </Suspense>
            </Content>
        </div>
    </div>
</template>

<script setup>
import Navigation from './Navigation.vue'
import Topbar from './Topbar.vue'
import Content from './Content.vue'
import Spinner from './Spinner.vue'
</script>
