<template>
  <Head title="Photos"/>

  <BreezeAuthenticatedLayout>
    <template #header>
      <div class="flex justify-between">
        <Link class="w-3/4" :href="route('pictures.index')">
          <h2 class="font-semibold text-3xl text-gray-900 leading-tight">
            Recent Photos
          </h2>
        </Link>
      </div>
    </template>

    <PhotosGrid :photos="photos.data"/>
  </BreezeAuthenticatedLayout>
</template>

<script setup>
import BreezeAuthenticatedLayout from '@/Layouts/Authenticated.vue';
import PhotosGrid from '@/Pages/Photos/PhotosGrid.vue';
import {Head, Link} from '@inertiajs/inertia-vue3';

defineProps({
  photos: Object,
});

</script>
