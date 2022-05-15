<template>
  <Head :title="book.title"/>

  <BreezeAuthenticatedLayout>
    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        {{ book.title }}
      </h2>
    </template>

    <div
        class="mx-auto grid max-w-7xl grid-cols-[repeat(auto-fit,minmax(22rem,1fr))] gap-2 md:p-4"
    >
      <div v-for="page in book.pages" :key="page.id" class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-6 bg-white">
          <div class="text-gray-500 text-sm flex justify-between mb-5">
            <p>Page</p>
            <p>{{ page.page_number }}</p>
          </div>

          <img class="mb-7" :src="page.image_path" alt="image">
          <p class="prose">{{ page.content }}</p>
        </div>
      </div>
    </div>
  </BreezeAuthenticatedLayout>
</template>

<script setup>
import BreezeAuthenticatedLayout from '@/Layouts/Authenticated.vue';
import {Head, Link} from '@inertiajs/inertia-vue3';

defineProps({
  book: Object,
});
</script>
