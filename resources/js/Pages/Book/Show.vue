<template>
  <Head :title="book.title"/>

  <BreezeAuthenticatedLayout>
    <template #header>
      <Link :href="pages.first_page_url" class="flex justify-between">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight w-3/4">
          {{ book.title }} <span v-if="book.author" class="text-base text-gray-500">by: {{ book.author }}</span>
        </h2>
        <Button v-if="pages.current_page !== 1" class="w-1/8">Beginning</Button>
      </Link>

    </template>

    <div v-if="canEditPages" class="flex mb-10 mt-5 mx-5">
      <div v-if="!settingsOpen" class="w-full">
        <Button @click="settingsOpen = true" class="w-full flex justify-center py-5">
          Open Settings
        </Button>
      </div>
      <div v-else class="w-full">
        <div>
          <BreezeValidationErrors class="mb-4"/>
        </div>
        <div class="flex flex-col md:flex-row justify-around">
          <NewPageForm @close-form="settingsOpen = false" :book="book"/>
          <EditForm :book="book"/>
        </div>
      </div>
    </div>

    <div
        class="mx-auto grid max-w-7xl grid-cols-[repeat(auto-fit,minmax(22rem,1fr))] gap-2 md:p-4"
    >
      <div v-for="page in pages.data" :key="page.id" class="bg-white overflow-hidden shadow-sm rounded">
        <Page :page="page"/>
      </div>
    </div>
    <div class="flex justify-around pb-20 mt-5">
      <Link :href="pages.prev_page_url">
        <Button aria-label="previous page"
                :disabled="!pages.prev_page_url"
                :class="{ 'opacity-50': !pages.prev_page_url }"
                class="py-5">
          <ArrowIcon class="rotate-180 mr-3"/>
          Previous Page
        </Button>
      </Link>
      <Link :href="pages.next_page_url">
        <Button aria-label="next page"
                :disabled="!pages.next_page_url"
                :class="{ 'opacity-50': !pages.next_page_url }"
                class="py-5">
          Next Page
          <ArrowIcon class="ml-3"/>
        </Button>
      </Link>
    </div>
  </BreezeAuthenticatedLayout>
</template>

<script setup>
import BreezeAuthenticatedLayout from '@/Layouts/Authenticated.vue';
import BreezeValidationErrors from '@/Components/ValidationErrors.vue';
import {Head, Link} from '@inertiajs/inertia-vue3';
import Button from "@/Components/Button";
import {onMounted, ref} from "vue";
import NewPageForm from "@/Pages/Book/NewPageForm";
import EditForm from "@/Pages/Book/EditBookForm";
import {usePermissions} from "@/permissions";
import Page from "@/Pages/Book/Page";
import ArrowIcon from '@/Components/ArrowIcon';

const {canEditPages} = usePermissions();

const props = defineProps({
  book: Object,
  pages: Object
});

let settingsOpen = ref(false)

onMounted(() => {
  if (props.pages.length < 1) {
    settingsOpen.value = true
  }
})
</script>
