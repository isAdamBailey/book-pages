<template>
  <Head title="Books"/>

  <BreezeAuthenticatedLayout>
    <template #header>
      <h2 class="font-semibold text-3xl text-gray-900 leading-tight">
        Books
      </h2>
    </template>

    <div
        class="mt-3 md:mt-0 mx-auto grid max-w-7xl grid-cols-[repeat(auto-fit,minmax(22rem,1fr))] gap-2 md:p-4"
    >
      <Link :href="route('books.show', book.slug)" v-for="book in books.data" :key="book.id"
            class="border-4 border-gray-900 overflow-hidden shadow-sm">
        <div class="p-6 bg-yellow-200 h-full flex flex-col justify-between">
          <div class="flex flex-wrap justify-between mb-5 border-b border-gray-900">
            <h3 class="font-bold text-2xl w-full">{{ book.title }}</h3>
            <p v-if="book.author" class="text-sm text-grey-900">by: {{ book.author }}</p>
          </div>
          <div class="flex justify-between">
            <p class="prose mb-5">{{ book.excerpt }}</p>
            <img v-if="book.pages[0]?.image_path"
                 class="max-h-16 rounded-lg ml-1"
                 :src="book.pages[0].image_path"
                 alt="cover image"/>
          </div>
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
