<script setup>
import { Link } from '@inertiajs/inertia-vue3';
</script>

<template>
    <Link class="block w-full px-4 py-2 text-left text-sm leading-5 text-gray-700 bg-yellow-200 hover:bg-yellow-400 focus:outline-none focus:bg-yellow-200 transition duration-150 ease-in-out">
        <slot />
    </Link>
</template>
