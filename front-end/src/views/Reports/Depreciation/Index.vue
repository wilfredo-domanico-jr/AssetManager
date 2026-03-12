<template>
  <div class="py-8">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
      <SubHeader
        pageName="Reports"
        pageDescription="Generate and export asset reports"
      />

      <AlertMessage
        v-if="errorMessage"
        type="error"
        :message="errorMessage"
        :dismissible="false"
      />

      <ReportTabs />

      <SearchFilter
        :categories="categories"
        :departments="departments"
        @filter-changed="applyFilter"
      />

      <div
        class="bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-xl p-5 shadow-sm"
      >
        <!-- Header -->
        <div
          class="flex flex-col sm:flex-row justify-between sm:items-center mb-6 space-y-3 sm:space-y-0"
        >
          <div>
            <h2
              class="text-xl sm:text-2xl font-bold text-gray-800 dark:text-gray-100"
            >
              Depreciation Report
            </h2>
            <p class="text-sm text-gray-500 dark:text-gray-400">
              Asset depreciation analysis and book values
            </p>
          </div>

          <!-- Export button -->
          <button
            @click="exportDepreciationExcel"
            class="flex items-center justify-center gap-2 bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium px-4 py-2 rounded-lg shadow-sm transition-all dark:bg-blue-500 dark:hover:bg-blue-600 w-full sm:w-auto"
          >
            <i class="fa-solid fa-download"></i>
            Export to Excel
          </button>
        </div>

        <!-- Stat Cards -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4 mb-4">
          <!-- Total Purchase Cost -->
          <div
            class="bg-gray-50 dark:bg-gray-900 border border-gray-200 dark:border-gray-700 rounded-lg p-4 shadow-sm text-center"
          >
            <h3
              class="text-sm font-medium text-gray-600 dark:text-gray-400 mb-1"
            >
              Total Purchase Cost
            </h3>
            <p
              class="text-2xl sm:text-3xl font-bold text-gray-800 dark:text-gray-100"
            >
              {{ formatCurrency(totPurchaseCost) }}
            </p>
          </div>

          <!-- Total Purchase Value -->
          <div
            class="bg-gray-50 dark:bg-gray-900 border border-gray-200 dark:border-gray-700 rounded-lg p-4 shadow-sm text-center"
          >
            <h3
              class="text-sm font-medium text-gray-600 dark:text-gray-400 mb-1"
            >
              Total Purchase Value
            </h3>
            <p
              class="text-2xl sm:text-3xl font-bold text-gray-800 dark:text-gray-100"
            >
              {{ formatCurrency(totPurchaseValue) }}
            </p>
          </div>

          <!-- Total Depreciation -->
          <div
            class="bg-gray-50 dark:bg-gray-900 border border-gray-200 dark:border-gray-700 rounded-lg p-4 shadow-sm text-center"
          >
            <h3
              class="text-sm font-medium text-gray-600 dark:text-gray-400 mb-1"
            >
              Total Depreciation
            </h3>
            <p
              class="text-2xl sm:text-3xl font-bold text-gray-800 dark:text-gray-100"
            >
              {{ formatCurrency(totDepreciationValue) }}
            </p>
          </div>
        </div>

        <DepreciationAssetsCard
          v-for="asset in assets"
          :key="asset.id"
          :asset="asset"
        />

        <div
          v-if="assets.length === 0"
          class="bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-xl shadow-sm p-4 space-y-4"
        >
          <EmptyState
            message="No asset found."
            icon-class="fa-solid fa-box-open"
          />
        </div>

        <Pagination :pagination="pagination" @page-changed="fetchPage" />
      </div>
    </div>
  </div>
</template>

<script setup>
import DepreciationAssetsCard from "./components/DepreciationAssetsCard.vue";
import SubHeader from "../../../components/SubHeader.vue";
import EmptyState from "../../../components/EmptyState.vue";
import Pagination from "../../../components/Pagination.vue";
import AlertMessage from "../../../components/AlertMessage.vue";
import ReportTabs from "../components/ReportTabs.vue";
import SearchFilter from "../components/SearchFilter.vue";
import { ref, onMounted, watch } from "vue";
import api from "../../../plugins/api";
import { formatCurrency } from "../../../utils/currency-formatter";
import { useRoute } from "vue-router";

const route = useRoute();
const errorMessage = ref("");
const totPurchaseCost = ref(0);
const totPurchaseValue = ref(0);
const totDepreciationValue = ref(0);
const assets = ref([]);
const categories = ref([]);
const departments = ref([]);

const pagination = ref({
  current_page: 1,
  per_page: 0,
  total: 0,
  from: 0,
  to: 0,
  last_page: 0,
  links: [],
});

onMounted(() => fetchDepreciationData());

watch(
  () => route.query,
  () => {
    fetchDepreciationData();
  },
);

const fetchDepreciationData = async (page = 1) => {
  try {
    errorMessage.value = "";
    const response = await api.get("/depreciation", {
      params: { page, ...route.query },
    });
    const data = response.data;

    totPurchaseCost.value = data.totalPurchaseCost;
    totPurchaseValue.value = data.totalBookValue;
    totDepreciationValue.value = data.totalDepreciation;
    assets.value = data.assets.data;
    categories.value = data.categories;
    departments.value = data.departments;

    pagination.value = {
      current_page: data.assets.current_page,
      per_page: data.assets.per_page,
      total: data.assets.total,
      from: data.assets.from,
      to: data.assets.to,
      last_page: data.assets.last_page,
      links: data.assets.links,
    };
  } catch (err) {
    errorMessage.value = "Unable to fetch assets data.";
    console.error("Error fetching assets:", err);
  }
};

const applyFilter = async (filters) => {
  try {
    errorMessage.value = "";
    const params = { ...route.query, ...filters };

    const response = await api.get("/depreciation", { params });

    console.log("Response ng Apply filter", response.data);
    const data = response.data;

    totPurchaseCost.value = data.totalPurchaseCost;
    totPurchaseValue.value = data.totalBookValue;
    totDepreciationValue.value = data.totalDepreciation;
    assets.value = data.assets.data;
    categories.value = data.categories;
    departments.value = data.departments;

    pagination.value = {
      current_page: data.assets.current_page,
      per_page: data.assets.per_page,
      total: data.assets.total,
      from: data.assets.from,
      to: data.assets.to,
      last_page: data.assets.last_page,
      links: data.assets.links,
    };
  } catch (err) {
    errorMessage.value = "Unable to fetch assets data.";
    console.error("Failed to fetch filtered assets:", err);
  }
};

const exportDepreciationExcel = async () => {
  try {
    const response = await api.get("/export-depreciation-summary-xlsx", {
      responseType: "blob",
    });

    const blob = new Blob([response.data], {
      type: "text/xlsx",
    });

    const url = window.URL.createObjectURL(blob);

    const link = document.createElement("a");
    link.href = url;
    link.setAttribute("download", "depreciation-summary.xlsx");
    document.body.appendChild(link);
    link.click();

    link.remove();
    window.URL.revokeObjectURL(url);
  } catch (error) {
    errorMessage.value =
      "Exporting Depreciation Summary Report to Excel Failed.";
    console.error("Export failed:", error);
  }
};

const fetchPage = (page) => fetchDepreciationData(page);
</script>
