<script setup>
import BreezeLabel from '@/Components/Label.vue';
import {useForm} from '@inertiajs/inertia-vue3';
import Button from "@/Components/Button";
import {ref} from "vue";
import TextArea from "@/Components/TextArea";
import DeletePageForm from "@/Pages/Book/DeletePageForm";

const emit = defineEmits(['close-page-form'])

const props = defineProps({
  page: Object
})

const form = useForm({
  content: props.page.content,
  image: null,
});

const imagePreview = ref(null)

const imageInput = ref(null)

function selectNewImage() {
  imageInput.value.click();
}

function updateImagePreview() {
  const photo = imageInput.value.files[0];
  if (!photo) return;

  const reader = new FileReader();
  reader.onload = (e) => {
    imagePreview.value = e.target.result;
  };

  reader.readAsDataURL(photo);
}

function clearImageFileInput() {
  if (imageInput.value) {
    imageInput.value = null;
  }
}

const submit = () => {
  if (imageInput.value) {
    form.image = imageInput.value.files[0];
  }
  form.post(route('pages.update', props.page), {
    onSuccess: () => {
      clearImageFileInput();
      form.reset();
      emit('close-page-form')
    },
  });
};
</script>

<template>
  <div class="border-t-2 bg-white rounded p-5 mt-10">
    <form @submit.prevent="submit">
      <div class="flex flex-wrap">
        <div class="w-full md:w-1/4">
          <BreezeLabel for="imageInput" value="Image"/>
          <input
              ref="imageInput"
              type="file"
              class="hidden"
              @change="updateImagePreview"
          />
          <div v-show="imagePreview" class="mt-2">
          <span class="block h-40 w-40 rounded bg-cover bg-center bg-no-repeat"
                :style="'background-image: url(\'' + imagePreview + '\');'">
          </span>
          </div>

          <Button
              class="mt-2 mr-2"
              type="button"
              @click.prevent="selectNewImage"
          >
            New Image
          </Button>
        </div>

        <div class="w-full md:w-3/4">
          <BreezeLabel for="content" value="Words"/>
          <TextArea v-model="form.content" id="content" class="mt-1 block w-full" required
                    autocomplete="content"/>
        </div>
      </div>

      <div class="flex justify-center mt-5 md:mt-20">
        <Button class="w-3/4 flex justify-center py-3" :class="{ 'opacity-25': form.processing }"
                :disabled="form.processing">
          Update!
        </Button>
      </div>
    </form>
    <DeletePageForm :page="page" />
  </div>
</template>