<template>
  <div
    class="flex flex-col md:flex-row md:items-center md:space-x-4 space-y-2 md:space-y-0 w-full mb-6"
  >
    <form @submit.prevent="submitFilter" class="flex flex-wrap gap-2 w-full">
      <!-- Search -->
      <div class="relative w-full">
        <input
          type="text"
          v-model="filters.search"
          placeholder="Search categories..."
          class="w-full pl-10 pr-4 py-2 border border-gray-300 dark:border-gray-700 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-800 dark:text-gray-100"
        />
        <div
          class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none"
        >
          <i
            class="fa-solid fa-magnifying-glass text-gray-400 dark:text-gray-300"
          ></i>
        </div>
      </div>
    </form>
  </div>
</template>

<script setup>
import { reactive, watch } from "vue";
import { useRouter, useRoute } from "vue-router";

const emits = defineEmits(["filter-changed"]);

const route = useRoute();
const router = useRouter();

// Initialize filters from query params
const filters = reactive({
  search: route.query.search || "",
});

// Watch filters and emit changes (for auto-submit)
watch(
  filters,
  (newFilters) => {
    emits("filter-changed", { ...newFilters });

    router.replace({ query: { ...newFilters } });
  },
  { deep: true },
);

const submitFilter = () => {
  emits("filter-changed", { ...filters });
};
</script>
