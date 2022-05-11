<template>
  <ul v-for="book in books.data" :key="book.id">
    <li>{{ book.title }}</li>
  </ul>
</template>

<script setup>
defineProps({
  books: Object,
});
</script>
