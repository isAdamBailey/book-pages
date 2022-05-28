<script setup>
import {Head, Link} from '@inertiajs/inertia-vue3';
import ApplicationLogo from "@/Components/ApplicationLogo";
import {usePermissions} from "@/permissions";
import Button from "@/Components/Button";

const {canEditPages} = usePermissions();

defineProps({
  canLogin: Boolean,
  canRegister: Boolean,
  appName: String,
})
</script>

<template>
  <Head title="Welcome"/>

  <div class="flex items-top justify-center min-h-screen bg-gradient-to-r from-green-300 to-gray-100 items-center">
    <div class="container bg-white rounded-lg flex-col md:flex-row flex px-6 py-4 md:h-128 md:py-20">
      <div class="flex flex-col items-center w-full md:flex-row lg:w-1/2">
        <div class="max-w-lg">
          <h1 class="text-3xl tracking-wide text-gray-800 md:text-5xl font-bold">Colin's {{ appName }}</h1>
          <p class="mt-4 text-gray-300 text-xl text-gray-600">An application to save books and pictures for Colin!</p>
          <div class="mt-6">
            <div v-if="$page.props.auth.user">
              <Button>
                <a :href="route('books.index')">
                  View Books
                </a>
              </Button>
            </div>
            <div class="flex justify-around" v-else>
              <Button>
                <a :href="route('login')">
                  Log In
                </a>
              </Button>
              <Button>
                <a :href="route('register')">
                  Register
                </a>
              </Button>
            </div>
          </div>
        </div>
      </div>

      <div class="flex items-center justify-center w-full mt-10 md:mt-0 lg:w-1/2">
        <ApplicationLogo/>
      </div>
    </div>
  </div>
</template>
