<script setup>
import { computed } from 'vue';
import { Link } from '@inertiajs/vue3';

const props = defineProps({
    href: {
        type: String,
        required: true,
    },
    active: {
        type: Boolean,
    },
});

const classes = computed(() =>
    props.active
        ? 'block w-full px-4 py-2 border-l-4 border-orange-500 text-white bg-gray-800/50 text-start text-base font-medium hover:bg-gray-800 focus:outline-none focus:bg-gray-800 transition-colors duration-150'
        : 'block w-full px-4 py-2 border-l-4 border-transparent text-start text-base font-medium text-gray-400 hover:text-gray-300 hover:bg-gray-800/30 hover:border-orange-500/50 focus:outline-none focus:text-gray-300 focus:bg-gray-800/30 transition-colors duration-150',
);
</script>

<template>
    <Link :href="href" :class="classes">
        <slot />
    </Link>
</template>
