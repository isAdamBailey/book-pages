<script setup>
import BreezeButton from '@/Components/Button.vue';
import BreezeInput from '@/Components/Input.vue';
import BreezeLabel from '@/Components/Label.vue';
import {useForm} from '@inertiajs/inertia-vue3';

const form = useForm({
  title: '',
  excerpt: '',
  author: ''
});

const submit = () => {
  form.post(route('books.store'), {});
};
</script>

<template>
  <form @submit.prevent="submit">
    <div>
      <BreezeLabel for="title" value="Title"/>
      <BreezeInput id="title" type="text" class="mt-1 block w-full" v-model="form.title" required autofocus
                   autocomplete="title"/>
    </div>

    <div class="mt-4">
      <BreezeLabel for="excerpt" value="Excerpt"/>
      <BreezeInput id="excerpt" type="text" class="mt-1 block w-full" v-model="form.excerpt"
                   autocomplete="excerpt"/>
    </div>

    <div class="mt-4">
      <BreezeLabel for="author" value="Author Name"/>
      <BreezeInput id="author" type="text" class="mt-1 block w-full" v-model="form.author"
                   autocomplete="author"/>
    </div>

    <div class="flex items-center justify-end mt-4">
      <BreezeButton class="ml-4" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
        Create!
      </BreezeButton>
    </div>
  </form>
</template>