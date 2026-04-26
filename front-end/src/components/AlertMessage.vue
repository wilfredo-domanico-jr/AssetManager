<script setup>
import { ref, computed } from "vue";

const props = defineProps({
  message: {
    type: String,
    default: "",
  },
  type: {
    type: String,
    default: "error",
  },
  dismissible: {
    type: Boolean,
    default: true,
  },
});

const visible = ref(true);

const alertClasses = computed(() => {
  switch (props.type) {
    case "success":
      return "text-green-700 bg-green-100 dark:bg-green-900 dark:text-green-300";
    case "warning":
      return "text-yellow-800 bg-yellow-50 border-l-4 border-yellow-500 dark:bg-gray-800 dark:text-yellow-300";
    case "error":
    default:
      return "text-white bg-red-500 dark:bg-red-900 dark:text-red-300 border-l-4 border-red-500";
  }
});

const iconMap = {
  success: "fas fa-check-circle",
  warning: "fas fa-exclamation-triangle",
  error: "fas fa-times-circle",
};

const alertIcon = computed(() => iconMap[props.type] || "");
</script>

<template>
  <div
    v-if="message && visible"
    :class="[
      'mb-4 px-4 py-2 rounded flex items-center justify-between',
      alertClasses,
    ]"
    role="alert"
  >
    <div class="flex items-center space-x-2">
      <i :class="[alertIcon, 'text-lg']"></i>
      <span class="text-sm" v-html="message"></span>
    </div>

    <button
      v-if="dismissible"
      @click="visible = false"
      class="ml-4 text-current hover:opacity-70 font-bold"
      aria-label="Close"
    >
      &times;
    </button>
  </div>
</template>
