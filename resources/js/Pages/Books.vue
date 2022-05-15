<template>
  <Head title="Books"/>

  <BreezeAuthenticatedLayout>
    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        Books
      </h2>
    </template>

    <div
        class="mt-3 md:mt-0 mx-auto grid max-w-7xl grid-cols-[repeat(auto-fit,minmax(22rem,1fr))] gap-2 md:p-4"
    >
      <Link :href="route('books.show', book.slug)" v-for="book in books.data" :key="book.id"
            class="bg-white overflow-hidden shadow-sm">
        <div class="p-6 bg-white">
          <div class="flex flex-wrap justify-between mb-5">
            <h3 class="font-bold text-lg">{{ book.title }}</h3>
            <p class="text-sm text-grey-500">by: {{ book.author }}</p>
          </div>
          <p class="prose mb-5">{{ book.excerpt }}</p>
          <p class="text-sm text-gray-500">{{ book.pages_count }} pages</p>
        </div>
      </Link>
    </div>
  </BreezeAuthenticatedLayout>
</template>

<script setup>
import BreezeAuthenticatedLayout from '@/Layouts/Authenticated.vue';
import {Head, Link} from '@inertiajs/inertia-vue3';

defineProps({
  books: Object,
});
</script>
