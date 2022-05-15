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
      <Link :href="route('books.show', book.id)" v-for="book in books.data" :key="book.id"
            class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-6 bg-white border-b border-gray-200">
          <div class="flex flex-wrap justify-between">
            <h3 class="font-bold text-lg">{{ book.title }}</h3>
            <p class="text-sm text-grey-500">by: {{ book.author }}</p>
          </div>
          <p>{{ book.pages_count }} pages</p>
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
