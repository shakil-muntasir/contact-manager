<template>
    <div class="flex items-center justify-center rounded-full bg-blue-600 text-white font-bold h-10 w-10 border border-gray-300">
        {{ initials }}
    </div>
</template>

<script>
export default {
    name: 'UserCircle',

    props: ['name'],

    computed: {
        initials() {
            if (this.name) {
                return this.name
                    .split(' ')
                    .map(word => word[0])
                    .join('')
                    .slice(0, 2)
                    .toUpperCase()
            }

            return '??'
        }
    }
}
</script>
