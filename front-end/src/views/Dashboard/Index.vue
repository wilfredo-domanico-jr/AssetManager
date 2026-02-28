<template>
  <div class="py-8">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
      <!-- Dashboard Header -->
      <SubHeader
        pageName="Dashboard"
        pageDescription="Overview of your asset inventory and depreciation"
      />

      <AlertMessage
        v-if="errorMessage"
        type="error"
        :message="errorMessage"
        :dismissible="false"
      />

      <!-- Stats Cards -->
      <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-5">
        <DashboardCard
          v-for="(stat, index) in dashboardStats"
          :key="index"
          :title="stat.title"
          :value="stat.value"
          :subtitle="stat.subtitle"
          :icon="stat.icon"
          :iconColor="stat.iconColor"
        />
      </div>

      <!-- Charts & Recent Assets -->
      <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-5">
        <!-- Assets by Category Chart -->
        <div
          class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-100 dark:border-gray-700 p-6 w-full"
        >
          <h3
            class="text-lg font-semibold text-gray-800 mb-4 dark:text-gray-100"
          >
            Assets by Category
          </h3>
          <div
            v-if="assetByCategory.length"
            id="categoryPieChart"
            style="max-width: 450px; margin: auto"
          ></div>
          <p v-else class="text-center text-gray-500 dark:text-gray-400 py-6">
            No asset category data
          </p>
        </div>

        <!-- Recent Assets -->
        <div
          class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-100 dark:border-gray-700 p-6 w-full"
        >
          <div class="flex justify-between items-center mb-4">
            <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-100">
              Recent Assets
            </h3>
            <router-link
              v-show="recentAssets.length != 0"
              to="/assets"
              class="text-sm text-indigo-600 dark:text-indigo-400 hover:underline"
            >
              View All
            </router-link>
          </div>

          <div
            v-if="recentAssets.length"
            class="divide-y divide-gray-200 dark:divide-gray-700"
          >
            <div
              v-for="asset in recentAssets"
              :key="asset.id"
              class="flex justify-between items-center py-4 border-b border-gray-200 dark:border-gray-700"
            >
              <div>
                <p class="font-semibold text-gray-800 dark:text-gray-100">
                  {{ asset.asset_name }}
                </p>
                <p class="text-sm text-gray-500 dark:text-gray-400">
                  {{ asset.category?.name || "No Category" }}
                </p>
              </div>

              <div class="flex items-center space-x-3">
                <div class="text-right">
                  <p class="font-semibold text-gray-800 dark:text-gray-100">
                    {{ formatCurrency(asset.book_value) }}
                  </p>
                  <p class="text-xs text-gray-500 dark:text-gray-400">
                    Book Value
                  </p>
                </div>

                <span
                  class="px-3 py-1 rounded-full text-xs font-medium"
                  :class="{
                    'bg-green-100 text-green-700':
                      asset.condition === 'Excellent',
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
          </div>

          <p v-else class="text-center text-gray-500 dark:text-gray-400 py-8">
            No recent asset
          </p>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
import SubHeader from "../../components/SubHeader.vue";
import DashboardCard from "./components/DashboardCard.vue";
import AlertMessage from "../../components/AlertMessage.vue";
import { formatCurrency } from "../../utils/currency-formatter";
import { ref, onMounted, nextTick, computed } from "vue";
import api from "../../plugins/api";

const totalAssets = ref(0);
const deployedAssets = ref(0);
const inStockAssets = ref(0);
const criticalAsset = ref(0);
const recentAssets = ref([]);
const assetByCategory = ref([]);
const errorMessage = ref("");

let categoryChart = null;

onMounted(async () => {
  try {
    const response = await api.get("/dashboard");
    const data = response.data;

    totalAssets.value = data.totalAssets || 0;
    deployedAssets.value = data.deployedAssets || 0;
    inStockAssets.value = data.inStockAssets || 0;
    criticalAsset.value = data.criticalAsset || 0;
    recentAssets.value = data.recentAssets || [];
    assetByCategory.value = data.assetByCategory || [];

    // Wait for DOM to update before rendering chart
    await nextTick();
    renderCategoryPieChart(assetByCategory.value);
  } catch (error) {
    errorMessage.value = "Unable to fetch dashboard data.";
    console.error(error);
  }
});

const dashboardStats = computed(() => [
  {
    title: "Total Assets",
    value: totalAssets.value,
    subtitle: "Registered Items",
    icon: "fa-box",
    iconColor: "text-indigo-500",
  },
  {
    title: "Deployed Asset",
    value: deployedAssets.value,
    subtitle: "Active Deployment",
    icon: "fa-truck",
    iconColor: "text-green-500",
  },
  {
    title: "In Stock",
    value: inStockAssets.value,
    subtitle: "Available items in storage",
    icon: "fa-boxes-stacked",
    iconColor: "text-yellow-500",
  },
  {
    title: "Critical Assets",
    value: criticalAsset.value,
    subtitle: "Need Attention",
    icon: "fa-triangle-exclamation",
    iconColor: "text-red-500",
  },
]);

function renderCategoryPieChart(categories) {
  const element = document.querySelector("#categoryPieChart");
  if (!element || !categories.length) return;

  const labels = categories.map((c) => c.category_name);
  const series = categories.map((c) => c.total);

  const options = {
    chart: { type: "pie" },
    series,
    labels,
  };

  if (categoryChart) categoryChart.destroy();
  categoryChart = new ApexCharts(element, options);
  categoryChart.render();
}
</script>
