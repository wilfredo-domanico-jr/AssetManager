<script setup>
import { formatCurrency } from "../../../../utils/currency-formatter";
const props = defineProps({
  asset: {
    type: Object,
    required: true,
  },
});
</script>
<template>
  <div
    class="bg-gray-50 dark:bg-gray-900 border border-gray-200 dark:border-gray-700 rounded-lg p-4 shadow-inner mb-3"
  >
    <div class="flex justify-between items-start mb-6">
      <div>
        <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-100">
          {{ asset.asset_name }}
        </h3>
        <p class="text-sm text-gray-600 dark:text-gray-400">
          {{ asset.supplier }}
        </p>
      </div>

      <div class="flex space-x-2">
        <span
          class="px-3 py-1 rounded-full bg-gray-100 text-gray-700 text-xs font-medium"
        >
          {{ asset.category?.name ?? "Not Available" }}
        </span>

        <span
          :class="[
            'px-3 py-1 rounded-full text-xs font-medium',
            asset.condition === 'Excellent'
              ? 'bg-green-100 text-green-700'
              : asset.condition === 'Good'
                ? 'bg-blue-100 text-blue-700'
                : 'bg-yellow-100 text-yellow-700',
          ]"
        >
          {{ asset.condition ?? "Unknown" }}
        </span>
      </div>
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-6">
      <div>
        <span class="text-md text-gray-600 dark:text-gray-400 block">
          Department
        </span>
        <p class="text-sm font-medium text-gray-800 dark:text-gray-200">
          {{ asset.department.name ?? "N/A" }}
        </p>
      </div>

      <div>
        <span class="text-md text-gray-600 dark:text-gray-400 block">
          Purchase Date
        </span>
        <p class="text-sm font-medium text-gray-800 dark:text-gray-200">
          {{ new Date(asset.purchase_date).toLocaleDateString("en-GB") }}
        </p>
      </div>

      <div>
        <span class="text-md text-gray-600 dark:text-gray-400 block">
          Original Cost
        </span>
        <p class="text-sm font-medium text-gray-800 dark:text-gray-200">
          {{ formatCurrency(asset.purchase_cost) }}
        </p>
      </div>

      <div>
        <span class="text-md text-gray-600 dark:text-gray-400 block">
          Current Value
        </span>
        <p class="text-sm font-medium text-gray-800 dark:text-gray-200">
          {{ formatCurrency(asset.book_value) }}
        </p>
      </div>
    </div>
  </div>
</template>
