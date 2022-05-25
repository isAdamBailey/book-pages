<script setup>
defineProps({
  type: {
    type: String,
    default: 'submit',
  },
});
</script>

<template>
  <button :type="type"
          class="inline-flex items-center px-3 py-1 bg-red-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-700 active:bg-red-900 focus:outline-none focus:border-red-900 focus:shadow-outline-red transition ease-in-out duration-150">
    <slot/>
  </button>
</template>
