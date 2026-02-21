<template>
  <div
    class="bg-gray-50 dark:bg-gray-900 border border-gray-200 dark:border-gray-700 rounded-lg p-4 shadow-inner"
  >
    <div class="flex justify-between items-start mb-4">
      <div>
        <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-100">
          {{ user.name }}
        </h3>
        <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">
          {{ user.email }}
        </p>
      </div>
      <div class="flex space-x-3 text-gray-500 dark:text-gray-300">
        <router-link :to="`/users/${user.id}/edit`">
          <i class="fa-solid fa-pen hover:text-blue-500 cursor-pointer"></i>
        </router-link>

        <button @click="$emit('delete', user.id)">
          <i class="fa-solid fa-trash hover:text-red-500 cursor-pointer"></i>
        </button>
      </div>
    </div>

    <div class="text-sm text-gray-600 dark:text-gray-400 flex space-x-2">
      <span>Created: {{ createdDate }}</span>
      <span>•</span>
      <span>Updated: {{ updatedDate }}</span>
      <span>•</span>
      <span>Role: {{ user.role || "N/A" }}</span>
    </div>
  </div>
</template>
<script setup>
import { computed } from "vue";

const props = defineProps({
  user: {
    type: Object,
    required: true,
  },
});

function formatDate(date) {
  if (!date) return "N/A";
  const d = new Date(date);
  return d.toLocaleDateString(undefined, {
    year: "numeric",
    month: "short",
    day: "numeric",
  });
}

const createdDate = computed(() => formatDate(props.user.created_at));
const updatedDate = computed(() => formatDate(props.user.updated_at));
</script>
