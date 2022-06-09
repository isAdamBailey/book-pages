<script setup>
import { computed } from 'vue';
import { Link } from '@inertiajs/inertia-vue3';

const props = defineProps(['href', 'active']);

const classes = computed(() => props.active
    ? 'block pl-3 pr-4 py-2 border-l-4 border-yellow-200 text-lg font-semibold text-yellow-200 focus:outline-none focus:text-yellow-200 focus:border-yellow-200 transition duration-150 ease-in-out'
    : 'block pl-3 pr-4 py-2 border-l-4 border-transparent text-lg font-medium text-white hover:text-yellow-400 hover:border-yellow-200 focus:outline-none focus:text-white focus:border-yellow-200 transition duration-150 ease-in-out'
);
</script>

<template>
    <Link :href="href" :class="classes">
        <slot />
    </Link>
</template>
