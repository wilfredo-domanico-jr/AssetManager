<template>
  <div class="font-sans antialiased bg-gray-100 dark:bg-gray-900">
    <div class="flex h-screen overflow-hidden">
      <!-- Mobile overlay -->
      <div
        v-if="sidebarOpen"
        class="fixed inset-0 z-30 bg-black/50 lg:hidden"
        @click="closeSidebar"
      />

      <!-- Sidebar -->
      <aside
        class="fixed lg:static inset-y-0 left-0 z-40 w-64 bg-white dark:bg-gray-800 shadow-md flex flex-col transform transition-transform duration-200 ease-in-out lg:translate-x-0"
        :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full'"
      >
        <!-- Logo / Header -->
        <div
          class="h-16 flex items-center justify-between px-4 border-b border-gray-200 dark:border-gray-700"
        >
          <span class="text-xl font-semibold text-gray-700 dark:text-gray-100">
            Asset Manager
          </span>

          <!-- Close button (mobile only) -->
          <button
            type="button"
            class="lg:hidden text-gray-500 dark:text-gray-300"
            @click="closeSidebar"
            aria-label="Close sidebar"
          >
            <i class="fa-solid fa-xmark text-xl"></i>
          </button>
        </div>

        <!-- Navigation -->
        <nav class="flex-1 px-4 py-4 space-y-2 overflow-y-auto">
          <!-- If SidebarLink is a component that wraps router-link,
               it might NOT emit click automatically.
               We'll handle closing on route change (see watch below),
               so these @click are optional. -->
          <SidebarLink
            icon="fa-chart-line"
            label="Dashboard"
            route-name="Dashboard"
          />
          <SidebarLink
            icon="fa-boxes-stacked"
            label="Assets"
            route-name="Assets"
            group="asset"
          />
          <SidebarLink
            icon="fa-file-lines"
            label="Reports"
            route-name="DepreciationReport"
            group="report"
          />

          <template v-if="auth.user?.role === 'Admin'">
            <hr class="border-t border-gray-300 dark:border-gray-700 my-2" />
            <div
              class="text-xs font-semibold text-gray-400 uppercase tracking-wider mt-4 mb-2 px-3"
            >
              Admin Section
            </div>

            <SidebarLink
              icon="fa-folder"
              label="Categories"
              route-name="Categories"
              group="category"
            />
            <SidebarLink
              icon="fa-building"
              label="Departments"
              route-name="Departments"
              group="department"
            />
            <SidebarLink
              icon="fa-users"
              label="Users"
              route-name="Users"
              group="user"
            />
            <SidebarLink
              icon="fa-paper-plane"
              label="Report Email Setting"
              route-name="ReportEmailSetting"
            />
          </template>
        </nav>

        <!-- Logout -->
        <div class="border-t border-gray-200 dark:border-gray-700 p-4">
          <button
            @click="handleLogout"
            class="w-full flex items-center gap-3 px-3 py-2 rounded-md text-gray-700 dark:text-gray-200 hover:bg-gray-200 dark:hover:bg-gray-700"
          >
            <i
              class="fa-solid fa-power-off text-gray-500 dark:text-gray-300"
            ></i>
            <span>Logout</span>
          </button>
        </div>
      </aside>

      <!-- Main Content -->
      <div class="flex-1 flex flex-col overflow-hidden">
        <!-- Header -->
        <Header @open-sidebar="openSidebar" />

        <!-- Page Content -->
        <main class="flex-1 overflow-y-auto p-4 sm:p-6 lg:p-8">
          <router-view />
        </main>
      </div>
    </div>
  </div>
</template>

<script setup>
import { ref, watch } from "vue";
import { useAuthStore } from "./store/auth";
import { useRouter, useRoute } from "vue-router";

import SidebarLink from "./components/SidebarLink.vue";
import Header from "./components/Header.vue";

const auth = useAuthStore();
const router = useRouter();
const route = useRoute();

const sidebarOpen = ref(false);

function openSidebar() {
  sidebarOpen.value = true;
}
function closeSidebar() {
  sidebarOpen.value = false;
}

function handleLogout() {
  auth.logout();
  router.push("/auth/login");
}

/**
 * Close sidebar automatically after navigation.
 * This also solves cases where SidebarLink doesn't emit click events.
 */
watch(
  () => route.fullPath,
  () => {
    sidebarOpen.value = false;
  },
);
</script>
