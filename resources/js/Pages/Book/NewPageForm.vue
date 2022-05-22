<script setup>
import BreezeInput from '@/Components/Input.vue';
import BreezeLabel from '@/Components/Label.vue';
import BreezeValidationErrors from '@/Components/ValidationErrors.vue';
import {useForm} from '@inertiajs/inertia-vue3';
import Button from "@/Components/Button";
import {ref} from "vue";

const emit = defineEmits(['close-form'])

const props = defineProps({
  book: Object
})
const form = useForm({
  book_id: props.book.id,
  page_number: '',
  content: '',
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
  form.post(route('pages.store'), {
    onSuccess: () => {
      clearImageFileInput();
      form.reset();
      emit('close-form')
    },
  });
};
</script>

<template>
  <div class="flex">
    <BreezeValidationErrors class="mb-4"/>
  </div>

  <form @submit.prevent="submit">
    <div>
      <BreezeLabel for="imageInput" value="Image"/>
      <input
          ref="imageInput"
          type="file"
          class="hidden"
          @change="updateImagePreview"
      />
      <div v-show="imagePreview" class="mt-2">
        <span
            class="block h-40 w-40 rounded-full bg-cover bg-center bg-no-repeat"
            :style="
                'background-image: url(\'' + imagePreview + '\');'
            "
        >
        </span>
      </div>

      <Button
          class="mt-2 mr-2"
          type="button"
          @click.prevent="selectNewImage"
      >
        Select An Image
      </Button>

    </div>

    <div class="mt-4">
      <BreezeLabel for="page_number" value="Page Number"/>
      <BreezeInput id="page_number" type="number" class="mt-1 block w-full" v-model="form.page_number" required
                   autocomplete="page_number"/>
    </div>

    <div class="mt-4">
      <BreezeLabel for="content" value="Contents"/>
      <BreezeInput id="content" type="text" class="mt-1 block w-full" v-model="form.content" required
                   autocomplete="content"/>
    </div>

    <div class="flex items-center justify-end mt-4">
      <Button class="ml-4" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
        Create!
      </Button>
    </div>
  </form>
</template>
