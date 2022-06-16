<template>
  <div class="mt-10 flex flex-col">
    <div class="overflow-x-auto sm:-mx-6 lg:-mx-8">
      <div
          class="inline-block min-w-full py-2 sm:px-6 lg:px-8"
      >
        <div class="overflow-hidden">
          <table class="min-w-full">
            <thead class="border-b">
            <tr>
              <th
                  scope="col"
                  class="px-6 py-4 text-left text-sm font-semibold text-gray-900"
              >
                Name
              </th>
              <th
                  scope="col"
                  class="px-6 py-4 text-left text-sm font-semibold text-gray-900"
              >
                Email
              </th>
              <th
                  scope="col"
                  class="px-6 py-4 text-left text-sm font-semibold text-gray-900"
              >
                Role
              </th>
            </tr>
            </thead>
            <tbody>
            <tr v-for="(user, index) in users.data"
                :key="index"
                class="border-b bg-white">
              <td class="whitespace-nowrap px-6 py-4 text-sm font-medium text-gray-900">
                {{ user.name }}
              </td>
              <td
                  class="whitespace-nowrap px-6 py-4 text-sm font-light text-gray-900"
              >
                {{ user.email }}
              </td>
              <td
                  class="whitespace-nowrap px-6 py-4 text-sm"
              >
                <div v-if="userIsAdmin(user)" class="text-blue-600 font-bold">
                  <button @click="setPermissions(user, [])"
                          :disabled="isCurrentUser(user)"
                          :class="{ 'opacity-25': isCurrentUser(user) }"
                          class="inline-flex items-center px-3 py-1 bg-blue-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 active:bg-blue-900 focus:outline-none focus:border-blue-900 focus:shadow-outline-blue transition ease-in-out duration-150">
                    Revoke Admin
                  </button>
                </div>
                <div v-else>
                  <DangerButton @click="setPermissions(user, ['edit pages'])">Make Admin</DangerButton>
                </div>
              </td>
            </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
import DangerButton from "@/Components/DangerButton";
import {useForm, usePage} from "@inertiajs/inertia-vue3";
import Button from "@/Components/Button";

const isCurrentUser = (user) => usePage().props.value.auth.user.name === user.name;

const form = useForm({
  user: null,
  permissions: null
});

const setPermissions = (user, permissions) => {
  form.user = user;
  form.permissions = permissions;
  form.put(route('admin.permissions'), {});
};

const userIsAdmin = (user) => {
  return user.permissions_list.includes('edit pages')
};

defineProps({
  users: Object
})
</script>
