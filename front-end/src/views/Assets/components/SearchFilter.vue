<template>
  <div
    class="flex flex-col md:flex-row md:items-center md:space-x-4 space-y-2 md:space-y-0 w-full mb-6"
  >
    <form @submit.prevent="submitFilter" class="flex flex-wrap gap-2 w-full">
      <!-- Search -->
      <div class="relative w-full md:w-[35%]">
        <input
          type="text"
          v-model="filters.search"
          placeholder="Search assets..."
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

      <!-- Category -->
      <div class="relative w-full md:w-[20%]">
        <select
          v-model="filters.category"
          class="w-full px-4 py-2 border border-gray-300 dark:border-gray-700 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-800 dark:text-gray-100 appearance-none"
        >
          <option value="">All Categories</option>
          <option
            v-for="category in categories"
            :key="category.id"
            :value="category.id"
          >
            {{ category.name }}
          </option>
        </select>
        <div
          class="pointer-events-none absolute inset-y-0 right-0 flex items-center pr-3"
        >
          <i
            class="fa-solid fa-chevron-down text-gray-400 dark:text-gray-300"
          ></i>
        </div>
      </div>

      <!-- Department -->
      <div class="w-full md:w-[22%]">
        <select
          v-model="filters.department"
          class="w-full px-4 py-2 border border-gray-300 dark:border-gray-700 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-800 dark:text-gray-100"
        >
          <option value="">All Departments</option>
          <option
            v-for="department in departments"
            :key="department.id"
            :value="department.id"
          >
            {{ department.name }}
          </option>
        </select>
      </div>

      <!-- Condition -->
      <div class="w-full md:w-[20%]">
        <select
          v-model="filters.condition"
          class="w-full px-4 py-2 border border-gray-300 dark:border-gray-700 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-800 dark:text-gray-100"
        >
          <option value="">All Conditions</option>
          <option value="Excellent">Excellent</option>
          <option value="Good">Good</option>
          <option value="Needs Repair">Needs Repair</option>
        </select>
      </div>
    </form>
  </div>
</template>

<script setup>
import { reactive, watch, toRefs } from "vue";
import { useRouter, useRoute } from "vue-router";

const props = defineProps({
  categories: { type: Array, default: () => [] },
  departments: { type: Array, default: () => [] },
});

const emits = defineEmits(["filter-changed"]);

const route = useRoute();
const router = useRouter();

// Initialize filters from query params
const filters = reactive({
  search: route.query.search || "",
  category: route.query.category || "",
  department: route.query.department || "",
  condition: route.query.condition || "",
});

// Watch filters and emit changes (for auto-submit)
watch(
  filters,
  (newFilters) => {
    emits("filter-changed", { ...newFilters });

    // Optionally, update URL query params for SPA behavior
    router.replace({ query: { ...route.query, ...newFilters } });
  },
  { deep: true },
);

const submitFilter = () => {
  emits("filter-changed", { ...filters });
};
</script>
