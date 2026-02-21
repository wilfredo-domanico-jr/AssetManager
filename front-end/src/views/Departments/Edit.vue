<template>
  <div class="py-8">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
      <SubHeader
        pageName="Edit Department"
        pageDescription="Update existing department details"
      />

      <AlertMessage v-if="errorMessage" type="error" :message="errorMessage" />
      <AlertMessage
        v-if="successMessage"
        type="success"
        :message="successMessage"
      />

      <div
        class="bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-xl shadow-sm p-4 space-y-4"
      >
        <form @submit.prevent="submitDepartment" class="space-y-6">
          <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
              <InputLabel value="Depart Name" for="name" />
              <TextInput
                v-model="name"
                type="text"
                class="block mt-1 w-full"
                required
                autofocus
                placeholder="Enter Department Name"
              />
            </div>

            <div>
              <InputLabel value="Description" for="description" />
              <TextInput
                v-model="description"
                type="text"
                class="block mt-1 w-full"
                placeholder="Enter Department Short Description"
              />
            </div>
          </div>

          <div
            class="flex justify-end space-x-2 pt-4 border-t border-gray-200 dark:border-gray-700"
          >
            <SecondaryLink to="/departments" class="ms-3 uppercase"
              >Cancel</SecondaryLink
            >
            <PrimaryButton
              type="submit"
              :disabled="loading"
              class="ms-3 uppercase"
            >
              {{ loading ? "Updating Department..." : "Update Department" }}
            </PrimaryButton>
          </div>
        </form>
      </div>
    </div>
  </div>
</template>

<script setup>
import { ref, onMounted, computed, watch } from "vue";
import { useRoute } from "vue-router";
import api from "../../plugins/api";

import SubHeader from "../../components/SubHeader.vue";
import AlertMessage from "../../components/AlertMessage.vue";
import InputLabel from "../../components/InputLabel.vue";
import TextInput from "../../components/TextInput.vue";
import PrimaryButton from "../../components/PrimaryButton.vue";
import SecondaryLink from "../../components/SecondaryLink.vue";

const route = useRoute();
const departmentId = route.params.id;

// Form fields
const name = ref("");
const description = ref("");

// Messages & loading
const errorMessage = ref("");
const successMessage = ref("");
const loading = ref(false);

// Fetch department data
onMounted(async () => {
  try {
    const res = await api.get(`/departments/${departmentId}/edit`);
    const data = res.data;
    const department = data.department;

    name.value = department.name;
    description.value = department.description || "";
  } catch {
    errorMessage.value = "Unable to fetch department details.";
  }
});

// Submit updated department
const submitDepartment = async () => {
  try {
    loading.value = true;
    errorMessage.value = "";
    successMessage.value = "";

    // Make PUT request
    await api.post(
      `/departments/${departmentId}`,
      {
        name: name.value,
        description: description.value,
      },
      {
        params: { _method: "PUT" },
      },
    );

    successMessage.value = "Department updated successfully!";
  } catch (err) {
    errorMessage.value = err.response?.data?.errors
      ? Object.values(err.response.data.errors).flat().join(" ")
      : err.response?.data?.message || "Failed to update department.";
  } finally {
    loading.value = false;
  }
};
</script>
