<template>
  <div
    class="font-sans antialiased bg-gray-50 dark:bg-gray-950 text-gray-900 dark:text-gray-100"
  >
    <div class="flex h-screen overflow-hidden">
      <Transition
        enter-active-class="transition-opacity duration-300"
        leave-active-class="transition-opacity duration-300"
        enter-from-class="opacity-0"
        leave-to-class="opacity-0"
      >
        <div
          v-if="sidebarOpen"
          class="fixed inset-0 z-30 bg-gray-900/40 backdrop-blur-sm lg:hidden"
          @click="closeSidebar"
        />
      </Transition>

      <aside
        class="fixed lg:static inset-y-0 left-0 z-40 w-64 bg-white dark:bg-gray-900 shadow-2xl lg:shadow-none flex flex-col transform transition-all duration-300 ease-in-out lg:translate-x-0 border-r border-gray-200/50 dark:border-gray-800/50"
        :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full'"
      >
        <div class="h-20 flex items-center justify-between px-6">
          <div class="flex items-center gap-3">
            <div
              class="h-8 w-8 bg-indigo-600 rounded-lg flex items-center justify-center shadow-lg shadow-indigo-500/20"
            >
              <i class="fa-solid fa-cube text-white text-sm"></i>
            </div>
            <span
              class="text-lg font-bold tracking-tight text-gray-800 dark:text-white"
            >
              Asset Manager
            </span>
          </div>

          <button
            type="button"
            class="lg:hidden p-2 rounded-full hover:bg-gray-100 dark:hover:bg-gray-800 text-gray-500 transition-colors"
            @click="closeSidebar"
          >
            <i class="fa-solid fa-chevron-left"></i>
          </button>
        </div>

        <nav
          class="flex-1 px-4 py-4 space-y-1 overflow-y-auto custom-scrollbar"
        >
          <div class="pt-6 mb-2 px-3 flex items-center gap-2">
            <div class="h-px flex-1 bg-gray-200 dark:bg-gray-800"></div>
            <span
              class="text-[10px] font-bold text-gray-400 uppercase tracking-[0.2em]"
              >General</span
            >
            <div class="h-px flex-1 bg-gray-200 dark:bg-gray-800"></div>
          </div>

          <SidebarLink
            icon="fa-chart-pie"
            label="Dashboard"
            route-name="Dashboard"
          />
          <SidebarLink
            icon="fa-layer-group"
            label="Assets"
            route-name="Assets"
            group="asset"
          />
          <SidebarLink
            icon="fa-file-invoice"
            label="Reports"
            route-name="DepreciationReport"
            group="report"
          />

          <template v-if="auth.user?.role === 'Admin'">
            <div class="pt-6 mb-2 px-3 flex items-center gap-2">
              <div class="h-px flex-1 bg-gray-200 dark:bg-gray-800"></div>
              <span
                class="text-[10px] font-bold text-gray-400 uppercase tracking-[0.2em]"
                >Administration</span
              >
              <div class="h-px flex-1 bg-gray-200 dark:bg-gray-800"></div>
            </div>

            <SidebarLink
              icon="fa-tags"
              label="Categories"
              route-name="Categories"
              group="category"
            />
            <SidebarLink
              icon="fa-sitemap"
              label="Departments"
              route-name="Departments"
              group="department"
            />
            <SidebarLink
              icon="fa-user-shield"
              label="Users"
              route-name="Users"
              group="user"
            />
            <SidebarLink
              icon="fa-envelope-open-text"
              label="Email Settings"
              route-name="ReportEmailSetting"
            />
          </template>
        </nav>

        <div class="p-4 bg-gray-50/50 dark:bg-gray-800/30">
          <button
            @click="handleLogout"
            class="w-full flex items-center gap-3 px-4 py-3 rounded-xl text-sm font-medium text-red-600 dark:text-red-400 hover:bg-red-50 dark:hover:bg-red-900/20 transition-all active:scale-95"
          >
            <i class="fa-solid fa-arrow-right-from-bracket rotate-180"></i>
            <span>Sign Out</span>
          </button>
        </div>
      </aside>

      <div class="flex-1 flex flex-col overflow-hidden relative">
        <Header
          @open-sidebar="openSidebar"
          class="z-20 bg-white/80 dark:bg-gray-950/80 backdrop-blur-md"
        />

        <main class="flex-1 overflow-y-auto p-4 sm:p-6 lg:p-8 custom-scrollbar">
          <div class="max-w-7xl mx-auto">
            <router-view v-slot="{ Component }">
              <transition
                enter-active-class="transition duration-200 ease-out"
                enter-from-class="opacity-0 translate-y-2"
                enter-to-class="opacity-100 translate-y-0"
              >
                <component :is="Component" />
              </transition>
            </router-view>
          </div>
        </main>
      </div>
    </div>
  </div>
</template>

<style scoped>
.custom-scrollbar::-webkit-scrollbar {
  width: 4px;
}
.custom-scrollbar::-webkit-scrollbar-track {
  background: transparent;
}
.custom-scrollbar::-webkit-scrollbar-thumb {
  background: #e2e8f0;
  border-radius: 10px;
}
.dark .custom-scrollbar::-webkit-scrollbar-thumb {
  background: #1e293b;
}
</style>
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
