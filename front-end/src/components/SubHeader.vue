<template>
  <div
    class="flex flex-col sm:flex-row sm:items-center sm:justify-between mb-6"
  >
    <div>
      <h2 class="text-2xl font-bold text-gray-800 dark:text-gray-100">
        {{ pageName }}
      </h2>
      <p class="text-sm text-gray-500 dark:text-gray-400">
        {{ pageDescription }}
      </p>
    </div>
  </div>
</template>

<script>
export default {
  name: "SubHeader",
  props: {
    pageName: {
      type: String,
      default: "", // empty string by default
    },
    pageDescription: {
      type: String,
      default: "", // empty string by default
    },
  },
};
</script>
