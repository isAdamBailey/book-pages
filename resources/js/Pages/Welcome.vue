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

  <div class="flex justify-center min-h-screen bg-gradient-to-r from-green-300 to-yellow-100 items-center">
    <div class="container bg-white rounded-lg flex-col md:flex-row flex px-6 py-4 md:py-20">
      <div class="flex flex-col items-center w-full md:flex-row md:w-3/4">
        <div>
          <h1 class="text-3xl tracking-wide text-gray-800 md:text-5xl font-bold">Colin's {{ appName }}</h1>
          <p class="mt-4 text-gray-300 text-xl text-gray-600">An application to save books and pictures for Colin!</p>
          <div class="mt-6">
            <div v-if="$page.props.auth.user">
              <Link :href="route('books.index')">
                <Button>
                  View Books
                </Button>
              </Link>
            </div>
            <div class="flex justify-around" v-else>
              <Link :href="route('login')">
                <Button>
                  Log In
                </Button>
              </Link>
              <Link :href="route('register')">
                <Button>
                  Register
                </Button>
              </Link>
            </div>
          </div>
        </div>
      </div>

      <div class="w-full mt-10 md:mt-0 max-w-sm">
        <ApplicationLogo/>
      </div>
    </div>
  </div>
</template>
