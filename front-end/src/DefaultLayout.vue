<template>
  <div class="font-sans antialiased bg-gray-100 dark:bg-gray-900">
    <div class="flex h-screen">
      <!-- Sidebar -->
      <aside
        class="fixed lg:static inset-y-0 left-0 z-40 w-64 bg-white dark:bg-gray-800 shadow-md flex flex-col"
      >
        <!-- Logo / Header -->
        <div
          class="h-16 flex items-center justify-between px-4 border-b border-gray-200 dark:border-gray-700"
        >
          <span class="text-xl font-semibold text-gray-700 dark:text-gray-100">
            Asset Manager
          </span>
          <button class="lg:hidden text-gray-500 dark:text-gray-300">
            <i class="fa-solid fa-xmark text-xl"></i>
          </button>
        </div>

        <!-- Navigation -->
        <nav class="flex-1 px-4 py-4 space-y-2 overflow-y-auto">
          <SidebarLink
            icon="fa-chart-line"
            label="Dashboard"
            route-name="Dashboard"
          />
          <SidebarLink
            icon="fa-boxes-stacked"
            label="Assets"
            route-name="Assets"
          />
          <SidebarLink
            icon="fa-file-lines"
            label="Reports"
            route-name="ForgotPassword"
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
            />
            <SidebarLink
              icon="fa-building"
              label="Departments"
              route-name="Departments"
            />
            <SidebarLink icon="fa-users" label="Users" route-name="Users" />
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
        <Header />

        <!-- Page Content -->
        <main class="flex-1 overflow-y-auto p-4 sm:p-6 lg:p-8">
          <router-view />
        </main>
      </div>
    </div>
  </div>
</template>

<script setup>
import { useAuthStore } from "./store/auth";
import { useRouter } from "vue-router";
import { onMounted } from "vue";

// Sidebar link component
import SidebarLink from "./components/SidebarLink.vue";
import Header from "./components/Header.vue";

const auth = useAuthStore();
const router = useRouter();

onMounted(() => {
  if (!auth.isLoggedIn) {
    router.replace("/auth/login");
  }
});

function handleLogout() {
  auth.logout();
  router.push("/auth/login");
}
</script>
