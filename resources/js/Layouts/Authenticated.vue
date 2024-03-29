<script setup>
import {ref} from 'vue';
import BreezeApplicationLogo from '@/Components/ApplicationLogo.vue';
import BreezeDropdown from '@/Components/Dropdown.vue';
import BreezeDropdownLink from '@/Components/DropdownLink.vue';
import BreezeNavLink from '@/Components/NavLink.vue';
import BreezeResponsiveNavLink from '@/Components/ResponsiveNavLink.vue';
import {Link} from '@inertiajs/inertia-vue3';
import { usePermissions } from '@/permissions'
import { usePage } from '@inertiajs/inertia-vue3'

const { canEditPages } = usePermissions();

const showingNavigationDropdown = ref(false);
const username = ref(usePage().props.value.auth.user.name)

</script>

<template>
  <div>
    <div class="min-h-screen bg-gradient-to-r from-blue-500 to-green-300">
      <nav class="bg-blue-500 ">
        <!-- Primary Navigation Menu -->
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
          <div class="flex justify-between h-16">
            <div class="flex">
              <!-- Logo -->
              <div class="shrink-0 flex items-center">
                <Link :href="route('books.index')">
                  <BreezeApplicationLogo class="block h-9 w-auto"/>
                </Link>
              </div>

              <!-- Navigation Links -->
              <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                <BreezeNavLink v-if="canEditPages" :href="route('dashboard')" :active="route().current('dashboard')">
                  Dashboard
                </BreezeNavLink>
                <BreezeNavLink :href="route('books.index')" :active="route().current('books.*')">
                  Books
                </BreezeNavLink>
                <BreezeNavLink :href="route('pictures.index')" :active="route().current('pictures.*')">
                  Photos
                </BreezeNavLink>
              </div>
            </div>

            <div class="hidden sm:flex sm:items-center sm:ml-6">
              <!-- Settings Dropdown -->
              <div class="ml-3 relative">
                <BreezeDropdown align="right" width="48">
                  <template #trigger>
                    <span class="inline-flex rounded-md">
                        <button type="button"
                                class="inline-flex border-gray-900 items-center px-3 py-2 border text-sm leading-4 font-medium rounded-md text-gray-500 bg-yellow-200 hover:text-gray-900 focus:outline-none transition ease-in-out duration-150">
                            {{ username }}

                            <svg class="ml-2 -mr-0.5 h-4 w-4" xmlns="http://www.w3.org/2000/svg"
                                 viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd"
                                      d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                      clip-rule="evenodd"/>
                            </svg>
                        </button>
                    </span>
                  </template>

                  <template #content>
                    <BreezeDropdownLink
                        v-if="canEditPages"
                        :href="route('logout')"
                        method="post"
                        as="button">
                      Log Out
                    </BreezeDropdownLink>
                    <div class="p-5" v-else>
                      <h3>Hi {{username}} Mommy and Daddy love you!!</h3>
                    </div>
                  </template>
                </BreezeDropdown>
              </div>
            </div>

            <!-- Hamburger -->
            <div class="-mr-2 flex items-center sm:hidden">
              <button @click="showingNavigationDropdown = ! showingNavigationDropdown"
                      class="inline-flex items-center justify-center p-2 rounded-md text-yellow-200 hover:text-yellow-400 hover:bg-blue-500 focus:outline-none focus:bg-blue-500 focus:text-yellow-200 transition duration-150 ease-in-out">
                <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                  <path :class="{'hidden': showingNavigationDropdown, 'inline-flex': ! showingNavigationDropdown }"
                        stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                  <path :class="{'hidden': ! showingNavigationDropdown, 'inline-flex': showingNavigationDropdown }"
                        stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                </svg>
              </button>
            </div>
          </div>
        </div>

        <!-- Responsive Navigation Menu -->
        <div :class="{'block': showingNavigationDropdown, 'hidden': ! showingNavigationDropdown}" class="sm:hidden">
          <div class="pt-2 pb-3 space-y-1">
            <BreezeResponsiveNavLink v-if="canEditPages" :href="route('dashboard')" :active="route().current('dashboard')">
              Dashboard
            </BreezeResponsiveNavLink>
            <BreezeResponsiveNavLink :href="route('books.index')" :active="route().current('books.*')">
              Books
            </BreezeResponsiveNavLink>
            <BreezeResponsiveNavLink :href="route('pictures.index')" :active="route().current('pictures.*')">
              Photos
            </BreezeResponsiveNavLink>
          </div>

          <!-- Responsive Settings Options -->
          <div class="pt-4 pb-1 border-t border-yellow-200">
            <div class="px-4">
              <div class="font-medium text-base text-white">{{ $page.props.auth.user.name }}</div>
              <div class="font-medium text-sm text-white">{{ $page.props.auth.user.email }}</div>
            </div>

            <div class="mt-3 space-y-1">
              <BreezeResponsiveNavLink v-if="canEditPages" :href="route('logout')" method="post" as="button">
                Log Out
              </BreezeResponsiveNavLink>
              <div class="p-5" v-else>
                <h3>Hi {{username}} Mommy and Daddy love you!!</h3>
              </div>
            </div>
          </div>
        </div>
      </nav>

      <!-- Page Heading -->
      <header class="border-2 border-gray-900 bg-yellow-300" v-if="$slots.header">
        <div class="max-w-7xl mx-auto py-4 px-4 sm:px-6 lg:px-8">
          <slot name="header"/>
        </div>
      </header>

      <!-- Page Content -->
      <main>
        <slot/>
      </main>
    </div>
  </div>
</template>
