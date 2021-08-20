<template>
    <div class="h-16 px-5 flex justify-between items-center border-b-2 border-gray-300">
        <div>Contacts</div>
        <Suspense>
            <template #default>
                <CircleContainer />
            </template>

            <template #fallback>
                <UserCircle />
            </template>
        </Suspense>
    </div>
</template>

<script setup>
import CircleContainer from './CircleContainer.vue'
import UserCircle from './UserCircle.vue'
</script>
