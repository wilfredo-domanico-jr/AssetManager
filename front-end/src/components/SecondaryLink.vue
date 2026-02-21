<template>
  <router-link
    v-bind="$attrs"
    :class="[
      // Base styles
      'inline-flex items-center mt-4 sm:mt-0 px-4 py-2 text-sm border rounded-md font-medium focus:outline-none focus:ring-2 focus:ring-offset-2 transition ease-in-out duration-150',

      // Light mode
      'bg-white text-gray-700 border-gray-300 hover:bg-gray-50 focus:ring-indigo-500 active:bg-gray-100',

      // Dark mode
      'dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600 dark:hover:bg-gray-700 dark:focus:ring-indigo-500 dark:active:bg-gray-700 dark:focus:ring-offset-gray-900',

      $attrs.class,
    ]"
  >
    <slot></slot>
  </router-link>
</template>

<script>
export default {
  name: "SecondaryLink",
};
</script>
