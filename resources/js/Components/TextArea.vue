<script setup>
import {onMounted, ref} from 'vue';

defineProps({
  modelValue: String,
  size: {
    type: String,
    default: 'lg'
  }
});

defineEmits(['update:modelValue']);

const input = ref(null);

onMounted(() => {
  if (input.value.hasAttribute('autofocus')) {
    input.value.focus();
  }
});
</script>

<template>
    <textarea
        class="border-gray-300 focus:border-green-300 focus:ring focus:ring-green-200 focus:ring-opacity-50 rounded-md shadow-sm prose"
        :value="modelValue"
        @input="$emit('update:modelValue', $event.target.value)"
        :rows="size === 'sm' ? 4 : 7"
        ref="input"/>
</template>
