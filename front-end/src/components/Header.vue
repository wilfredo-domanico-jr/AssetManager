<template>
  <header
    class="sticky top-0 z-20 bg-white/80 dark:bg-gray-950/80 backdrop-blur-md border-b border-gray-200/50 dark:border-gray-800/50 px-4 lg:px-10 py-4"
  >
    <div class="flex items-center justify-between">
      <div class="flex items-center gap-4">
        <button
          type="button"
          class="lg:hidden h-10 w-10 flex items-center justify-center rounded-xl bg-gray-100 dark:bg-gray-800 text-gray-600 dark:text-gray-300 hover:bg-indigo-50 dark:hover:bg-indigo-900/30 transition-colors"
          @click="$emit('open-sidebar')"
          aria-label="Open sidebar"
        >
          <i class="fa-solid fa-bars-staggered"></i>
        </button>
      </div>

      <div class="flex items-center gap-3 lg:gap-6">
        <div
          class="flex items-center gap-3 pl-3 lg:pl-6 border-l border-gray-200 dark:border-gray-800"
        >
          <div class="hidden lg:block text-right">
            <p
              class="text-sm font-bold text-gray-900 dark:text-white leading-tight"
            >
              {{ auth.user?.name || "User" }}
            </p>
            <p
              class="text-[10px] font-bold text-indigo-600 dark:text-indigo-400 uppercase tracking-wider"
            >
              {{ auth.user?.role || "Member" }}
            </p>
          </div>
          <div
            class="h-10 w-10 rounded-xl bg-gradient-to-br from-indigo-500 to-purple-600 border-2 border-white dark:border-gray-800 shadow-md flex items-center justify-center text-white"
          >
            <i class="fa-solid fa-user-tie"></i>
          </div>
        </div>
      </div>
    </div>
  </header>
</template>

<script setup>
import { useAuthStore } from "../store/auth";
const auth = useAuthStore();

defineEmits(["open-sidebar"]);
</script>
