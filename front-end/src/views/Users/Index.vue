<template>
  <div class="py-8">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
      <SubHeader pageName="Users" pageDescription="Manage your system users">
        <template #actionLink>
          <PrimaryLink to="/users/create">
            <i class="fa-solid fa-plus mr-2"></i>
            Add User
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
        <UserCard
          v-for="user in users"
          :key="user.id"
          :user="user"
          @delete="handleDelete"
        />

        <EmptyState
          v-if="users.length === 0"
          message="No users found."
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
import UserCard from "./components/UserCard.vue";

const users = ref({});

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

const fetchUsers = async (page = 1) => {
  try {
    errorMessage.value = "";
    const response = await api.get("/users", { params: { page } });
    const data = response.data;

    users.value = data.users.data;

    pagination.value = {
      current_page: data.users.current_page,
      per_page: data.users.per_page,
      total: data.users.total,
      from: data.users.from,
      to: data.users.to,
      last_page: data.users.last_page,
      links: data.users.links,
    };
  } catch (err) {
    errorMessage.value = "Unable to fetch users data.";
    console.error("Error fetching users:", err);
  }
};

onMounted(() => fetchUsers());
const applyFilter = async (filters) => {
  try {
    errorMessage.value = "";
    const params = { ...filters };
    const response = await api.get("/users", { params });
    const data = response.data;

    users.value = data.users.data;

    pagination.value = {
      current_page: data.users.current_page,
      per_page: data.users.per_page,
      total: data.users.total,
      from: data.users.from,
      to: data.users.to,
      last_page: data.users.last_page,
      links: data.users.links,
    };
  } catch (err) {
    errorMessage.value = "Unable to fetch users data.";
    console.error("Failed to fetch filtered users:", err);
  }
};

const handleDelete = async (id) => {
  if (!confirm("Are you sure you want to delete this user?")) return;
  try {
    successMessage.value = "";
    errorMessage.value = "";
    const response = await api.delete(`/users/${id}`);

    await fetchUsers(pagination.value.current_page);

    successMessage.value = response.data.message;

    // Refetch the current page so pagination stays correct
    await fetchUsers(pagination.value.current_page);

    // Auto-hide success message after 3 seconds
    setTimeout(() => {
      successMessage.value = "";
    }, 3000);
  } catch (err) {
    errorMessage.value = "Failed to delete user";
    console.error("Failed to delete user:", err);
  }
};

const fetchPage = (page) => fetchUsers(page);
</script>
