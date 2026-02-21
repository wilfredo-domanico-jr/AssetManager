<template>
  <div class="py-8">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
      <SubHeader
        pageName="Categories"
        pageDescription="Manage asset categories"
      >
        <template #actionLink>
          <PrimaryLink to="/categories/create">
            <i class="fa-solid fa-plus mr-2"></i>
            Add Category
          </PrimaryLink>
        </template>
      </SubHeader>

      <AlertMessage
        v-if="errorMessage"
        type="error"
        :message="errorMessage"
        :dismissible="false"
      />

      <AlertMessage
        v-if="successMessage"
        type="success"
        :message="successMessage"
        :dismissible="false"
      />

      <SearchFilter @filter-changed="applyFilter" />

      <div
        class="bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-xl shadow-sm p-4 space-y-4"
      >
        <CategoryCard
          v-for="category in categories"
          :key="category.id"
          :category="category"
          @delete="handleDelete"
        />

        <EmptyState
          v-if="categories.length === 0"
          message="No category found."
          icon-class="fa-solid fa-folder-open"
        />

        <Pagination :pagination="pagination" @page-changed="fetchPage" />
      </div>
    </div>
  </div>
</template>

<script setup>
import { ref, onMounted } from "vue";
import api from "../../plugins/api";
import SubHeader from "../../components/SubHeader.vue";
import SearchFilter from "./components/SearchFilter.vue";
import EmptyState from "../../components/EmptyState.vue";
import Pagination from "../../components/Pagination.vue";
import AlertMessage from "../../components/AlertMessage.vue";
import PrimaryLink from "../../components/PrimaryLink.vue";
import CategoryCard from "./components/CategoryCard.vue";

const categories = ref({});

const errorMessage = ref("");
const successMessage = ref("");

const pagination = ref({
  current_page: 1,
  per_page: 0,
  total: 0,
  from: 0,
  to: 0,
  last_page: 0,
  links: [],
});

const fetchCategories = async (page = 1) => {
  try {
    errorMessage.value = "";
    const response = await api.get("/categories", { params: { page } });
    const data = response.data;

    categories.value = data.categories.data;

    pagination.value = {
      current_page: data.categories.current_page,
      per_page: data.categories.per_page,
      total: data.categories.total,
      from: data.categories.from,
      to: data.categories.to,
      last_page: data.categories.last_page,
      links: data.categories.links,
    };
  } catch (err) {
    errorMessage.value = "Unable to fetch categories data.";
    console.error("Error fetching categories:", err);
  }
};

onMounted(() => fetchCategories());
const applyFilter = async (filters) => {
  try {
    errorMessage.value = "";
    const params = { ...filters };
    const response = await api.get("/categories", { params });
    const data = response.data;

    categories.value = data.categories.data;

    pagination.value = {
      current_page: data.categories.current_page,
      per_page: data.categories.per_page,
      total: data.categories.total,
      from: data.categories.from,
      to: data.categories.to,
      last_page: data.categories.last_page,
      links: data.categories.links,
    };
  } catch (err) {
    errorMessage.value = "Unable to fetch categories data.";
    console.error("Failed to fetch filtered categories:", err);
  }
};

const handleDelete = async (id) => {
  if (!confirm("Are you sure you want to delete this category?")) return;
  try {
    successMessage.value = "";
    errorMessage.value = "";
    const response = await api.delete(`/categories/${id}`);

    await fetchCategories(pagination.value.current_page);

    successMessage.value = response.data.message;

    // Refetch the current page so pagination stays correct
    await fetchCategories(pagination.value.current_page);

    // Auto-hide success message after 3 seconds
    setTimeout(() => {
      successMessage.value = "";
    }, 3000);
  } catch (err) {
    errorMessage.value = "Failed to delete category";
    console.error("Failed to delete category:", err);
  }
};

const fetchPage = (page) => fetchCategories(page);
</script>
