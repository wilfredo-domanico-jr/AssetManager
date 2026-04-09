<template>
  <router-link
    v-bind="$attrs"
    :class="[
      // Base styles
      'inline-flex items-center mt-4 sm:mt-0 px-4 py-2 text-sm border border-transparent rounded-md font-mediumfocus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150',

      // Light mode
      'bg-gray-800 text-white hover:bg-gray-900 focus:bg-gray-900 active:bg-gray-900',

      // Dark mode
      'dark:bg-indigo-600 dark:text-white dark:hover:bg-indigo-700 dark:focus:bg-indigo-700 dark:active:bg-indigo-700 dark:focus:ring-offset-gray-800',

      $attrs.class,
    ]"
  >
    <slot></slot>
  </router-link>
</template>

<script>
export default {
  name: "PrimaryLink",
};
</script>
