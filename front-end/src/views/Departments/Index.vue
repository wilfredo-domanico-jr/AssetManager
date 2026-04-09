<template>
  <div class="py-8">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
      <SubHeader
        pageName="Departments"
        pageDescription="Manage asset departments"
      >
        <template #actionLink>
          <PrimaryLink to="/departments/create">
            <i class="fa-solid fa-plus mr-2"></i>
            Add Department
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
        <DepartmentCard
          v-for="department in departments"
          :key="department.id"
          :department="department"
          @delete="handleDelete"
        />

        <EmptyState
          v-if="departments.length === 0"
          message="No department found."
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
import DepartmentCard from "./components/DepartmentCard.vue";

const departments = ref({});

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

const fetchDepartments = async (page = 1) => {
  try {
    errorMessage.value = "";
    const response = await api.get("/departments", { params: { page } });
    const data = response.data;

    departments.value = data.departments.data;

    pagination.value = {
      current_page: data.departments.current_page,
      per_page: data.departments.per_page,
      total: data.departments.total,
      from: data.departments.from,
      to: data.departments.to,
      last_page: data.departments.last_page,
      links: data.departments.links,
    };
  } catch (err) {
    errorMessage.value = "Unable to fetch departments data.";
    console.error("Error fetching departments:", err);
  }
};

onMounted(() => fetchDepartments());
const applyFilter = async (filters) => {
  try {
    errorMessage.value = "";
    const params = { ...filters };
    const response = await api.get("/departments", { params });
    const data = response.data;

    departments.value = data.departments.data;

    pagination.value = {
      current_page: data.departments.current_page,
      per_page: data.departments.per_page,
      total: data.departments.total,
      from: data.departments.from,
      to: data.departments.to,
      last_page: data.departments.last_page,
      links: data.departments.links,
    };
  } catch (err) {
    errorMessage.value = "Unable to fetch departments data.";
    console.error("Failed to fetch filtered departments:", err);
  }
};

const handleDelete = async (id) => {
  if (!confirm("Are you sure you want to delete this department?")) return;
  try {
    successMessage.value = "";
    errorMessage.value = "";
    const response = await api.delete(`/departments/${id}`);

    await fetchDepartments(pagination.value.current_page);

    successMessage.value = response.data.message;

    // Refetch the current page so pagination stays correct
    await fetchDepartments(pagination.value.current_page);

    // Auto-hide success message after 3 seconds
    setTimeout(() => {
      successMessage.value = "";
    }, 3000);
  } catch (err) {
    errorMessage.value = "Failed to delete department";
    console.error("Failed to delete department:", err);
  }
};

const fetchPage = (page) => fetchDepartments(page);
</script>
