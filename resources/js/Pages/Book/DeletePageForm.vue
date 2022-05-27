<template>
  <form @submit.prevent="submit" class="text-center mt-10">
    <DangerButton>Delete {{ buttonText }}</DangerButton>
  </form>
</template>

<script setup>
import DangerButton from '@/Components/DangerButton.vue';
import {useForm} from '@inertiajs/inertia-vue3';

const props = defineProps({
  page: Object,
});

const truncateString = (str, num) =>
    str.length > num ? `${str.slice(0, num > 3 ? num - 3 : num)}...` : str;
const buttonText = truncateString(props.page.content, 20)

const form = useForm({});

const submit = () => {
  if (window.confirm("Are you sure you want to delete this page? The picture will also be deleted.")) {
    form.delete(route('pages.destroy', props.page));
  }
};
</script>