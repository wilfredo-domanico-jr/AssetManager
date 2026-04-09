<template>
  <div class="font-sans text-gray-900 antialiased">
    <div
      class="min-h-screen flex flex-col justify-center items-center pt-6 px-4 sm:px-0 sm:pt-0 bg-gray-100 dark:bg-gray-900"
    >
      <div>
        <a href="/">
          <span class="text-xl font-semibold text-gray-700 dark:text-gray-100"
            >Asset Manager</span
          >
        </a>
      </div>

      <div
        class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white dark:bg-gray-800 shadow-md overflow-hidden sm:rounded-lg"
      >
        <router-view />
      </div>
    </div>
  </div>
</template>

<script setup lang="ts"></script>
