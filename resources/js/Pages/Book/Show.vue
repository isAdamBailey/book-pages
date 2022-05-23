<template>
  <Head :title="book.title"/>

  <BreezeAuthenticatedLayout>
    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        {{ book.title }} <span class="text-base text-gray-500">by: {{ book.author }}</span>
      </h2>
    </template>

    <template #authenticated-actions>
      <div class="flex mb-10 mt-5 mx-5">
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
      <div v-for="page in book.pages" :key="page.id" class="bg-white overflow-hidden shadow-sm rounded">
        <div class="p-1 bg-white">
          <img v-if="page.image_path" class="rounded" :src="page.image_path" alt="image">
          <p class="prose px-3 py-3">{{ page.content }}</p>
        </div>
      </div>
    </div>
  </BreezeAuthenticatedLayout>
</template>

<script setup>
import BreezeAuthenticatedLayout from '@/Layouts/Authenticated.vue';
import {Head} from '@inertiajs/inertia-vue3';
import Button from "@/Components/Button";
import {onMounted, ref} from "vue";
import NewPageForm from "@/Pages/Book/NewPageForm";

const props = defineProps({
  book: Object,
});

let newPageFormOpen = ref(false)

onMounted(() => {
  if (props.book.pages.length < 1) {
    newPageFormOpen.value = true
  }
})
</script>