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
        ? 'inline-flex items-center px-3 pt-1 pb-1 border-b-2 border-orange-500 text-sm font-medium text-white hover:border-orange-400 focus:outline-none transition-colors duration-150'
        : 'inline-flex items-center px-3 pt-1 pb-1 border-b-2 border-transparent text-sm font-medium text-gray-400 hover:text-gray-300 hover:border-orange-500/50 focus:outline-none focus:text-gray-300 transition-colors duration-150',
);
</script>

<template>
    <Link :href="href" :class="classes">
        <slot />
    </Link>
</template>
