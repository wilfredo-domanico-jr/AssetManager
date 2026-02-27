<script setup>
import { computed } from "vue";

const props = defineProps({
  asset: {
    type: Object,
    required: true,
  },
});

const lifecycle = computed(() => {
  const purchaseCost = Number(props.asset.purchase_cost) || 0;
  const usefulLife = Number(props.asset.useful_life) || 1; // default 1 yr

  if (!props.asset.purchase_date) {
    return {
      yearsUsed: 0,
      usefulLife,
      remainingLife: usefulLife,
      status: "Good",
      bookValue: purchaseCost,
    };
  }

  const purchaseDate = new Date(props.asset.purchase_date);
  const now = new Date();

  // Calculate months difference
  const monthsUsed =
    (now.getFullYear() - purchaseDate.getFullYear()) * 12 +
    (now.getMonth() - purchaseDate.getMonth());

  const yearsUsed = monthsUsed / 12;

  // Straight-line depreciation
  const depreciationPerYear = purchaseCost / usefulLife;
  const bookValue = Math.max(purchaseCost - depreciationPerYear * yearsUsed, 0);

  const remainingLife = Math.max(usefulLife - yearsUsed, 0);

  // Determine status
  let status = "Good";
  if (remainingLife <= 0) status = "Fully Depreciated";
  else if (remainingLife / usefulLife <= 0.2) status = "Near End";

  return {
    yearsUsed,
    usefulLife,
    remainingLife,
    status,
    bookValue,
  };
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
          {{ asset.category?.name ?? "Not Available" }}
        </p>
      </div>

      <div class="flex space-x-2">
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
      <!-- Age -->
      <div>
        <span class="text-md text-gray-600 dark:text-gray-400 block">Age</span>
        <p class="text-sm font-medium text-gray-800 dark:text-gray-200">
          {{ lifecycle.yearsUsed.toFixed(1) }} yrs
        </p>
      </div>

      <!-- Useful Life -->
      <div>
        <span class="text-md text-gray-600 dark:text-gray-400 block"
          >Useful Life</span
        >
        <p class="text-sm font-medium text-gray-800 dark:text-gray-200">
          {{ lifecycle.usefulLife }} yrs
        </p>
      </div>

      <!-- Remaining Life -->
      <div>
        <span class="text-md text-gray-600 dark:text-gray-400 block"
          >Remaining Life</span
        >
        <p class="text-sm font-medium text-gray-800 dark:text-gray-200">
          {{ lifecycle.remainingLife.toFixed(1) }} yrs
        </p>
      </div>

      <!-- Status -->
      <div>
        <span class="text-md text-gray-600 dark:text-gray-400 block"
          >Status</span
        >
        <p class="text-sm font-medium text-gray-800 dark:text-gray-200">
          {{ lifecycle.status }}
        </p>
      </div>
    </div>
  </div>
</template>
