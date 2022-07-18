<template>
  <Head title="Books"/>

  <BreezeAuthenticatedLayout>
    <template #header>
      <h2 class="font-semibold text-3xl text-gray-900 leading-tight">
        Books
      </h2>
    </template>

    <BooksGrid :books="books" />
  </BreezeAuthenticatedLayout>
</template>

<script setup>
import BreezeAuthenticatedLayout from '@/Layouts/Authenticated.vue';
import BooksGrid from '@/Pages/Books/BooksGrid.vue';
import { Head } from '@inertiajs/inertia-vue3';

defineProps({
  books: Object,
});
</script>
