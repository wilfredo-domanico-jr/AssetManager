<template>
  <div class="font-sans antialiased bg-gray-100 dark:bg-gray-900">
    <div class="flex h-screen">
      <!-- Mobile Sidebar Backdrop -->
      <div
        x-show="sidebarOpen"
        class="fixed inset-0 bg-black bg-opacity-50 z-30 lg:hidden"
        x-cloak
      ></div>

      <!-- Sidebar -->
      <aside
        class="fixed lg:static inset-y-0 left-0 z-40 w-64 bg-white dark:bg-gray-800 shadow-md transform transition-transform duration-300 lg:translate-x-0 flex flex-col"
      >
        <div
          class="h-16 flex items-center justify-between px-4 border-b border-gray-200 dark:border-gray-700"
        >
          <span class="text-xl font-semibold text-gray-700 dark:text-gray-100"
            >Asset Manager</span
          >
          <button class="lg:hidden text-gray-500 dark:text-gray-300">
            <i class="fa-solid fa-xmark text-xl"></i>
          </button>
        </div>

        <nav class="flex-1 px-4 py-4 space-y-2 overflow-y-auto">
          <a
            href=""
            class="flex items-center gap-3 px-3 py-2 rounded-md text-gray-700 dark:text-gray-200 hover:bg-gray-200 dark:hover:bg-gray-700 {{ request()->routeIs('dashboard') ? 'bg-gray-200 dark:bg-gray-700 font-semibold' : '' }}"
          >
            <i
              class="fa-solid fa-chart-line text-gray-500 dark:text-gray-300"
            ></i>
            <span>Dashboard</span>
          </a>
          <a
            href=""
            class="flex items-center gap-3 px-3 py-2 rounded-md text-gray-700 dark:text-gray-200 hover:bg-gray-200 dark:hover:bg-gray-700 {{ request()->routeIs('assets.*') ? 'bg-gray-200 dark:bg-gray-700 font-semibold' : '' }}"
          >
            <i
              class="fa-solid fa-boxes-stacked text-gray-500 dark:text-gray-300"
            ></i>
            <span>Assets</span>
          </a>
          <a
            href=""
            class="flex items-center gap-3 px-3 py-2 rounded-md text-gray-700 dark:text-gray-200 hover:bg-gray-200 dark:hover:bg-gray-700 {{ request()->routeIs('reporting.*') ? 'bg-gray-200 dark:bg-gray-700 font-semibold' : '' }}"
          >
            <i
              class="fa-solid fa-file-lines text-gray-500 dark:text-gray-300"
            ></i>
            <span>Reports</span>
          </a>

          <!-- 🔹 Show only to Admin -->

          <hr class="border-t border-gray-300 dark:border-gray-700 my-2" />
          <div
            class="text-xs font-semibold text-gray-400 uppercase tracking-wider mt-4 mb-2 px-3"
          >
            Admin Section
          </div>

          <a
            href=""
            class="flex items-center gap-3 px-3 py-2 rounded-md text-gray-700 dark:text-gray-200 hover:bg-gray-200 dark:hover:bg-gray-700"
          >
            <i class="fa-solid fa-folder text-gray-500 dark:text-gray-300"></i>
            <span>Categories</span>
          </a>

          <a
            href=""
            class="flex items-center gap-3 px-3 py-2 rounded-md text-gray-700 dark:text-gray-200 hover:bg-gray-200 dark:hover:bg-gray-700"
          >
            <i
              class="fa-solid fa-building text-gray-500 dark:text-gray-300"
            ></i>
            <span>Departments</span>
          </a>

          <a
            href=""
            class="flex items-center gap-3 px-3 py-2 rounded-md text-gray-700 dark:text-gray-200 hover:bg-gray-200 dark:hover:bg-gray-700"
          >
            <i class="fa-solid fa-users text-gray-500 dark:text-gray-300"></i>
            <span>Users</span>
          </a>

          <a
            href=""
            class="flex items-center gap-3 px-3 py-2 rounded-md text-gray-700 dark:text-gray-200 hover:bg-gray-200 dark:hover:bg-gray-700"
          >
            <i
              class="fa-solid fa-paper-plane text-gray-500 dark:text-gray-300"
            ></i>
            <span>Report Email Setting</span>
          </a>

          @endif @endauth
        </nav>

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
        <header
          class="bg-white dark:bg-gray-800 shadow flex items-center justify-between px-4 lg:px-8 py-4"
        >
          <div class="flex items-center gap-3">
            <button class="lg:hidden text-gray-600 dark:text-gray-300">
              <i class="fa-solid fa-bars text-xl"></i>
            </button>
            <!-- @isset($header)
                        {{ $header }}
                        @endisset -->
          </div>
        </header>

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

const auth = useAuthStore();
const router = useRouter();

onMounted(() => {
  if (!auth.isLoggedIn) {
    router.replace("/login"); // redirect to login if unauthenticated
  }
});

function handleLogout() {
  auth.logout();
  router.push("/login");
}
</script>
