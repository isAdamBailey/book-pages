<script setup>
import BreezeButton from '@/Components/Button.vue';
import BreezeInput from '@/Components/Input.vue';
import BreezeLabel from '@/Components/Label.vue';
import DeleteForm from "@/Pages/Book/DeleteBookForm";
import {useForm} from '@inertiajs/inertia-vue3';
import TextArea from "@/Components/TextArea";

const props = defineProps({
  book: Object,
});

const form = useForm({
  title: props.book.title,
  excerpt: props.book.excerpt,
  author: props.book.author,
});

const submit = () => {
  form.put(route('books.update', props.book.slug));
};
</script>

<template>
  <div class=" bg-white rounded p-5 md:w-1/4">
    <h3 class="text-2xl w-full border-b mb-7">Edit Book</h3>
    <form @submit.prevent="submit">
      <div class="flex">
        <div class="mr-3">
          <BreezeLabel for="title" value="Title"/>
          <BreezeInput id="title" type="text" class="mt-1 block w-full" v-model="form.title" required
                       autocomplete="title"/>
        </div>
        <div>
          <BreezeLabel for="author" value="Author"/>
          <BreezeInput id="author" type="text" class="mt-1 block w-full" v-model="form.author" autocomplete="author"/>
        </div>
      </div>

      <div>
        <BreezeLabel for="excerpt" value="Excerpt"/>
        <TextArea id="excerpt" type="text" class="mt-1 block w-full" size="sm" v-model="form.excerpt" autocomplete="excerpt"/>
      </div>

      <div class="flex justify-center  mt-4">
        <BreezeButton class="w-3/4 py-3 flex justify-center" :class="{ 'opacity-25': form.processing }"
                      :disabled="form.processing">
          Save
        </BreezeButton>
      </div>
    </form>
    <DeleteForm :book="book" />
  </div>
</template>
