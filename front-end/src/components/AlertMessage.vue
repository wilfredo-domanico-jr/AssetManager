<script setup>
import { computed } from "vue";

const props = defineProps({
  message: {
    type: String,
    default: "",
  },
  type: {
    type: String,
    default: "error", // success | error
  },
});

const alertClasses = computed(() => {
  if (props.type === "success") {
    return "text-green-700 bg-green-100 dark:bg-green-900 dark:text-green-300";
  }

  return "text-white bg-red-100 dark:bg-red-900 dark:text-red-300";
});
</script>

<template>
  <div
    v-if="message"
    :class="[
      'mb-4 text-center text-sm font-medium px-4 py-2 rounded',
      alertClasses,
    ]"
  >
    {{ message }}
  </div>
</template>
