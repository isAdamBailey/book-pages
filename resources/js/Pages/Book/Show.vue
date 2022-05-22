<template>
  <Head :title="book.title"/>

  <BreezeAuthenticatedLayout>
    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        {{ book.title }} <span class="text-base text-gray-500">by: {{ book.author }}</span>
      </h2>
    </template>

    <template #authenticated-actions>
      <div class="flex mt-5 mx-5">
        <div v-if="!newPageFormOpen" class="w-full">
          <Button v-if="!newPageFormOpen" @click="newPageFormOpen = true" class="w-full flex justify-center py-5">Add
            New
            Page
          </Button>
        </div>
        <NewPageForm v-else @close-form="newPageFormOpen = false" :book="book"/>
      </div>
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

          <img v-if="page.image_path" class="mb-7" :src="page.image_path" alt="image">
          <p class="prose">{{ page.content }}</p>
        </div>
      </div>
    </div>
  </BreezeAuthenticatedLayout>
</template>

<script setup>
import BreezeAuthenticatedLayout from '@/Layouts/Authenticated.vue';
import {Head} from '@inertiajs/inertia-vue3';
import Button from "@/Components/Button";
import {ref} from "vue";
import NewPageForm from "@/Pages/Book/NewPageForm";

defineProps({
  book: Object,
});

const newPageFormOpen = ref(false)
</script>
