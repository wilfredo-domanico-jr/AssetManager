<template>
  <button
    v-bind="$attrs"
    :class="[
      'inline-flex items-center px-4 py-2 border rounded-md font-semibold text-xs uppercase tracking-widest focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150',

      // Light mode
      'bg-white text-gray-700 border-gray-300 hover:bg-gray-100 focus:bg-gray-100 active:bg-gray-200',

      // Dark mode
      'dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600 dark:hover:bg-gray-700 dark:focus:bg-gray-700 dark:active:bg-gray-600 dark:focus:ring-offset-gray-800',

      $attrs.class,
    ]"
  >
    <slot></slot>
  </button>
</template>

<script>
export default {
  name: "SecondaryButton",
};
</script>
