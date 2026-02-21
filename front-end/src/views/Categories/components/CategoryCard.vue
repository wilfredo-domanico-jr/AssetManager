<template>
  <div
    class="bg-gray-50 dark:bg-gray-900 border border-gray-200 dark:border-gray-700 rounded-lg p-4 shadow-inner"
  >
    <div class="flex justify-between items-start mb-4">
      <div>
        <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-100">
          {{ category.name }}
        </h3>
        <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">
          {{ category.description || "No Description" }}
        </p>
      </div>
      <div class="flex space-x-3 text-gray-500 dark:text-gray-300">
        <router-link :to="`/categories/${category.id}/edit`">
          <i class="fa-solid fa-pen hover:text-blue-500 cursor-pointer"></i>
        </router-link>

        <button @click="$emit('delete', category.id)">
          <i class="fa-solid fa-trash hover:text-red-500 cursor-pointer"></i>
        </button>
      </div>
    </div>

    <div class="text-sm text-gray-600 dark:text-gray-400">
      Created: {{ formattedDate }}
    </div>
  </div>
</template>
<script setup>
import { computed } from "vue";

const props = defineProps({
  category: {
    type: Object,
    required: true,
  },
});

const formattedDate = computed(() => {
  if (!props.category.created_at) return "";
  const date = new Date(props.category.created_at);
  return date.toLocaleDateString(undefined, {
    year: "numeric",
    month: "short",
    day: "numeric",
  });
});
</script>
