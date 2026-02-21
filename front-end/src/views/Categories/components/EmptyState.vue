<template>
  <div class="text-center text-gray-500 dark:text-gray-400 py-10">
    <i :class="iconClass" class="text-4xl mb-3"></i>
    <p>{{ message }}</p>
  </div>
</template>

<script setup>
const props = defineProps({
  message: {
    type: String,
    default: "Nothing found.",
  },
  iconClass: {
    type: String,
    default: "fa-solid fa-box-open",
  },
});
</script>
