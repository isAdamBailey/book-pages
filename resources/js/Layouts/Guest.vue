<script setup>
import BreezeApplicationLogo from '@/Components/ApplicationLogo.vue';
import {Link} from '@inertiajs/inertia-vue3';
</script>

<template>
  <div
      class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gradient-to-r from-blue-500 to-green-300">
    <div>
      <Link href="/">
        <BreezeApplicationLogo class="w-20 h-20 fill-current text-gray-500"/>
      </Link>
    </div>

    <div class="w-full sm:max-w-md mt-6 px-6 py-4 border-4 border-gray-900 bg-yellow-300 shadow-md overflow-hidden sm:rounded-lg">
      <slot/>
    </div>
  </div>
</template>
