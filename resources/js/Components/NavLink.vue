<script setup>
import { computed } from 'vue';
import { Link } from '@inertiajs/inertia-vue3';

const props = defineProps(['href', 'active']);

const classes = computed(() => props.active
    ? 'inline-flex items-center px-1 pt-1 border-b-4 border-yellow-200 text-3xl font-semibold leading-5 text-yellow-200 focus:outline-none focus:border-green-700 transition duration-150 ease-in-out'
    : 'inline-flex items-center px-1 pt-1 border-b-4 border-transparent text-3xl font-medium leading-5 text-white hover:text-yellow-200 hover:border-yellow-200 focus:outline-none focus:text-white focus:border-gray-300 transition duration-150 ease-in-out'
);
</script>

<template>
    <Link :href="href" :class="classes">
        <slot />
    </Link>
</template>
