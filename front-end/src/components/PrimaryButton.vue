<template>
  <button
    v-bind="$attrs"
    :class="[
      // Base styles
      'inline-flex items-center px-4 py-2 border border-transparent rounded-md font-semibold text-xs  tracking-widest focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150',

      // Light mode
      'bg-gray-800 text-white hover:bg-gray-900 focus:bg-gray-900 active:bg-gray-900',

      // Dark mode
      'dark:bg-indigo-600 dark:text-white dark:hover:bg-indigo-700 dark:focus:bg-indigo-700 dark:active:bg-indigo-700 dark:focus:ring-offset-gray-800',

      $attrs.class,
    ]"
  >
    <slot></slot>
  </button>
</template>

<script>
export default {
  name: "PrimaryButton",
};
</script>
