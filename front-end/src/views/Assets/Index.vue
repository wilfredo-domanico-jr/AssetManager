<template>
  <div class="py-8">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
      <SubHeader
        pageName="Assets"
        pageDescription="Manage your inventory and equipment"
      >
        <template #actionLink>
          <PrimaryLink to="/assets/create">
            <i class="fa-solid fa-plus mr-2"></i>
            Add Asset
          </PrimaryLink>
        </template>
      </SubHeader>

      <AlertMessage
        v-if="errorMessage"
        type="error"
        :message="errorMessage"
        :dismissible="false"
      />

      <SearchFilter
        :categories="categories"
        :departments="departments"
        @filter-changed="applyFilter"
      />

      <div
        class="bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-xl shadow-sm p-4 space-y-4"
      >
        <AssetCard
          v-for="asset in assets"
          :key="asset.id"
          :asset="asset"
          @delete="handleDelete"
        />

        <EmptyState
          v-if="assets.length === 0"
          message="No assets found."
          icon-class="fa-solid fa-box-open"
        />

        <Pagination :pagination="pagination" @page-changed="fetchPage" />
      </div>
    </div>
  </div>
</template>

<script setup>
import { ref, onMounted } from "vue";
import api from "../../plugins/api";
import AssetCard from "./components/AssetCard.vue";
import SubHeader from "../../components/SubHeader.vue";
import SearchFilter from "./components/SearchFilter.vue";
import EmptyState from "./components/EmptyState.vue";
import Pagination from "../../components/Pagination.vue";
import AlertMessage from "../../components/AlertMessage.vue";
import PrimaryLink from "../../components/PrimaryLink.vue";

const assets = ref({});
const categories = ref([]);
const departments = ref([]);
const errorMessage = ref("");

const pagination = ref({
  current_page: 1,
  per_page: 0,
  total: 0,
  from: 0,
  to: 0,
  last_page: 0,
  links: [],
});

const fetchAssets = async (page = 1) => {
  try {
    errorMessage.value = "";
    const response = await api.get("/assets", { params: { page } });
    const data = response.data;

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

onMounted(() => fetchAssets());
const applyFilter = async (filters) => {
  try {
    errorMessage.value = "";
    const params = { ...filters };
    const response = await api.get("/assets", { params });
    const data = response.data;

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

console.log("This is the assets:", assets.data);

const handleDelete = async (id) => {
  if (!confirm("Are you sure you want to delete this asset?")) return;
  try {
    await api.delete(`/assets/${id}`);
    assets.value = assets.value.filter((a) => a.id !== id);
  } catch (err) {
    console.error("Failed to delete asset:", err);
  }
};

const fetchPage = (page) => fetchAssets(page);
</script>
