<template>
  <div
    class="flex flex-col sm:flex-row border-b border-gray-200 dark:border-gray-700 mb-4 rounded-lg overflow-hidden"
  >
    <!-- Depreciation Tab -->
    <router-link
      to="/depreciation"
      :class="[
        'flex-1 flex items-center justify-center space-x-2 py-2 font-medium focus:outline-none transition',
        isDepreciationPageActive
          ? 'bg-white text-gray-800'
          : 'bg-gray-100 dark:bg-gray-800 text-gray-700 dark:text-gray-200 hover:bg-white hover:text-gray-800',
      ]"
    >
      <i class="fa-solid fa-coins text-yellow-500"></i>
      <span>Depreciation</span>
    </router-link>

    <!-- Inventory Tab -->
    <router-link
      to="/inventory"
      :class="[
        'flex-1 flex items-center justify-center space-x-2 py-2 font-medium focus:outline-none transition',
        isInventoryPageActive
          ? 'bg-white text-gray-800'
          : 'bg-gray-100 dark:bg-gray-800 text-gray-700 dark:text-gray-200 hover:bg-white hover:text-gray-800',
      ]"
    >
      <i class="fa-solid fa-boxes-stacked text-blue-500"></i>
      <span>Inventory</span>
    </router-link>

    <!-- Lifecycle Tab -->
    <router-link
      to="/lifecycle"
      :class="[
        'flex-1 flex items-center justify-center space-x-2 py-2 font-medium focus:outline-none transition',
        isLifecyclePageActive
          ? 'bg-white text-gray-800'
          : 'bg-gray-100 dark:bg-gray-800 text-gray-700 dark:text-gray-200 hover:bg-white hover:text-gray-800',
      ]"
    >
      <i class="fa-solid fa-recycle text-green-500"></i>
      <span>Lifecycle</span>
    </router-link>
  </div>
</template>

<script setup>
import { computed } from "vue";
import { useRoute } from "vue-router";

const route = useRoute();

const isDepreciationPageActive = computed(() => route.path === "/depreciation");

const isInventoryPageActive = computed(() => route.path === "/inventory");

const isLifecyclePageActive = computed(() => route.path === "/lifecycle");
</script>
