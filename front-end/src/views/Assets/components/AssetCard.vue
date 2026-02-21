<template>
  <div
    class="bg-gray-50 dark:bg-gray-900 border border-gray-200 dark:border-gray-700 rounded-lg p-4 shadow-inner"
  >
    <div class="flex justify-between items-start mb-6">
      <div>
        <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-100">
          {{ asset.asset_name }}
        </h3>
        <div class="flex flex-wrap gap-2 mt-1">
          <span
            class="px-3 py-1 rounded-full bg-gray-100 text-gray-700 text-xs font-medium"
          >
            {{ asset.category?.name || "Not Available" }}
          </span>
          <span
            class="px-3 py-1 rounded-full text-xs font-medium"
            :class="{
              'bg-green-100 text-green-700': asset.condition === 'Excellent',
              'bg-blue-100 text-blue-700': asset.condition === 'Good',
              'bg-yellow-100 text-yellow-700':
                asset.condition === 'Needs Repair',
              'bg-gray-100 text-gray-700':
                !asset.condition ||
                ['Excellent', 'Good', 'Needs Repair'].indexOf(
                  asset.condition,
                ) === -1,
            }"
          >
            {{ asset.condition || "Unknown" }}
          </span>
        </div>
      </div>

      <div class="flex space-x-3 text-gray-500 dark:text-gray-300">
        <router-link :to="`/assets/${asset.id}/edit`">
          <i class="fa-solid fa-pen hover:text-blue-500 cursor-pointer"></i>
        </router-link>

        <button @click="$emit('delete', asset.id)">
          <i class="fa-solid fa-trash hover:text-red-500 cursor-pointer"></i>
        </button>
      </div>
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-6">
      <div>
        <span class="text-md text-gray-600 dark:text-gray-400 block"
          >Purchase Cost</span
        >
        <p class="text-sm font-medium text-gray-800 dark:text-gray-200">
          ₱{{ formatNumber(asset.purchase_cost) }}
        </p>
      </div>

      <div>
        <span class="text-md text-gray-600 dark:text-gray-400 block"
          >Book Value</span
        >
        <p class="text-sm font-medium text-gray-800 dark:text-gray-200">
          ₱{{ formatNumber(bookValue) }}
        </p>
      </div>

      <div>
        <span class="text-md text-gray-600 dark:text-gray-400 block">Age</span>
        <p class="text-sm font-medium text-gray-800 dark:text-gray-200">
          {{ yearsUsed.toFixed(2) }} {{ yearsUsed <= 1 ? "year" : "years" }}
        </p>
      </div>

      <div>
        <span class="text-md text-gray-600 dark:text-gray-400 block"
          >Department</span
        >
        <p class="text-sm font-medium text-gray-800 dark:text-gray-200">
          {{ asset.department?.name || "N/A" }}
        </p>
      </div>
    </div>
  </div>
</template>

<script setup>
import { computed } from "vue";
import dayjs from "dayjs";

const props = defineProps({
  asset: {
    type: Object,
    required: true,
  },
});

const formatNumber = (num) =>
  (num ?? 0).toLocaleString(undefined, {
    minimumFractionDigits: 2,
    maximumFractionDigits: 2,
  });

const yearsUsed = computed(() => {
  const purchaseDate = props.asset.purchase_date
    ? dayjs(props.asset.purchase_date)
    : null;
  if (!purchaseDate) return 0;
  const months = purchaseDate.diff(dayjs(), "month") * -1; // ensure positive
  return months / 12;
});

const bookValue = computed(() => {
  const purchaseCost = props.asset.purchase_cost ?? 0;
  const usefulLife = props.asset.useful_life ?? 1;
  return Math.max(
    purchaseCost - (purchaseCost / usefulLife) * yearsUsed.value,
    0,
  );
});
</script>
