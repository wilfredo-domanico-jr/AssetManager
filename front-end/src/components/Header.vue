<template>
  <!-- Header -->
  <header
    class="bg-white dark:bg-gray-800 shadow flex items-center justify-between px-4 lg:px-8 py-4"
  >
    <button class="lg:hidden text-gray-600 dark:text-gray-300">
      <i class="fa-solid fa-bars text-xl"></i>
    </button>

    <div>
      <h2 class="text-2xl font-bold text-gray-800 dark:text-gray-100">
        Asset Manager
      </h2>
      <p class="text-sm text-gray-500 dark:text-gray-400">
        Track and manage your equipment assets
      </p>
    </div>
  </header>
</template>

<script>
export default {
  name: "Header",
};
</script>
