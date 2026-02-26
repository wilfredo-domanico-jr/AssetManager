<script setup>
import { computed } from "vue";

const props = defineProps({
  asset: {
    type: Object,
    required: true,
  },
});

function calculateDepreciation(asset) {
  const purchaseCost = Number(asset.purchase_cost) || 0;
  const usefulLife = Number(asset.useful_life) || 1;

  const purchaseDate = asset.purchase_date
    ? new Date(asset.purchase_date)
    : null;

  const now = new Date();

  const monthsUsed = purchaseDate
    ? (now.getFullYear() - purchaseDate.getFullYear()) * 12 +
      (now.getMonth() - purchaseDate.getMonth())
    : 0;

  const yearsUsed = monthsUsed / 12;

  const depreciationPerYear = purchaseCost / usefulLife;
  const accumulatedDep = Math.min(
    depreciationPerYear * yearsUsed,
    purchaseCost,
  );

  const bookValue = Math.max(purchaseCost - accumulatedDep, 0);

  const depreciationRate =
    purchaseCost > 0 ? (accumulatedDep / purchaseCost) * 100 : 0;

  const isActive = yearsUsed < usefulLife;

  return {
    accumulatedDep,
    bookValue,
    depreciationRate,
    status: isActive ? "Active" : "Fully Depreciated",
    bgClass: isActive
      ? "bg-green-100 text-green-700"
      : "bg-gray-200 text-gray-700",
  };
}

const depreciation = computed(() => calculateDepreciation(props.asset));
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
          {{ asset.category?.name ?? "Not Available" }}
        </p>
      </div>

      <div class="flex space-x-2">
        <span
          :class="[
            'px-3 py-1 rounded-full text-xs font-medium',
            depreciation.bgClass,
          ]"
        >
          {{ depreciation.status }}
        </span>
      </div>
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-6">
      <div>
        <span class="text-md text-gray-600 dark:text-gray-400 block">
          Purchase Cost
        </span>
        <p class="text-sm font-medium text-gray-800 dark:text-gray-200">
          ₱{{ Number(asset.purchase_cost).toFixed(2) }}
        </p>
      </div>

      <div>
        <span class="text-md text-gray-600 dark:text-gray-400 block">
          Accumulated Dep.
        </span>
        <p class="text-sm font-medium text-gray-800 dark:text-gray-200">
          ₱{{ depreciation.accumulatedDep.toFixed(2) }}
        </p>
      </div>

      <div>
        <span class="text-md text-gray-600 dark:text-gray-400 block">
          Book Value
        </span>
        <p class="text-sm font-medium text-gray-800 dark:text-gray-200">
          ₱{{ depreciation.bookValue.toFixed(2) }}
        </p>
      </div>

      <div>
        <span class="text-md text-gray-600 dark:text-gray-400 block">
          Dep. Rate
        </span>
        <p class="text-sm font-medium text-gray-800 dark:text-gray-200">
          {{ depreciation.depreciationRate.toFixed(2) }}%
        </p>
      </div>
    </div>
  </div>
</template>
