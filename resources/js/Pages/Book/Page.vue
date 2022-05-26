<template>
  <div class="p-1 bg-white">
    <img v-if="page.image_path" class="rounded" :src="page.image_path" alt="image">
    <p class="prose px-3 py-3">{{ page.content }}</p>
    <div v-if="canEditPages">
      <Button v-if="!showPageSettings"
              @click="showPageSettings = true"
              class="w-full">
        Edit Page
      </Button>
      <EditPageForm v-if="showPageSettings" :
                    :page="page"
                    @close-page-form="showPageSettings = false"/>
    </div>
  </div>
</template>

<script setup>
import Button from "@/Components/Button";
import {ref} from "vue";
import EditPageForm from "@/Pages/Book/EditPageForm";
import {usePermissions} from "@/permissions";

const {canEditPages} = usePermissions();

const props = defineProps({
  page: Object
})

let showPageSettings = ref(false);
</script>