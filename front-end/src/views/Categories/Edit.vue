<template>
  <div class="py-8">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
      <SubHeader
        pageName="Edit Category"
        pageDescription="Update existing category details"
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
        <form @submit.prevent="submitCategory" class="space-y-6">
          <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
              <InputLabel value="Category Name" for="name" />
              <TextInput
                v-model="name"
                type="text"
                class="block mt-1 w-full"
                required
                autofocus
                placeholder="Enter Category Name"
              />
            </div>

            <div>
              <InputLabel value="Description" for="description" />
              <TextInput
                v-model="description"
                type="text"
                class="block mt-1 w-full"
                placeholder="Enter Category Short Description"
              />
            </div>
          </div>

          <div
            class="flex justify-end space-x-2 pt-4 border-t border-gray-200 dark:border-gray-700"
          >
            <SecondaryLink to="/categories" class="ms-3 uppercase"
              >Cancel</SecondaryLink
            >
            <PrimaryButton
              type="submit"
              :disabled="loading"
              class="ms-3 uppercase"
            >
              {{ loading ? "Updating Category..." : "Update Category" }}
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
const categoryId = route.params.id;

// Form fields
const name = ref("");
const description = ref("");

// Messages & loading
const errorMessage = ref("");
const successMessage = ref("");
const loading = ref(false);

// Fetch category data
onMounted(async () => {
  try {
    const res = await api.get(`/categories/${categoryId}/edit`);
    const data = res.data;
    const category = data.category;

    name.value = category.name;
    description.value = category.description || "";
  } catch {
    errorMessage.value = "Unable to fetch category details.";
  }
});

// Submit updated category
const submitCategory = async () => {
  try {
    loading.value = true;
    errorMessage.value = "";
    successMessage.value = "";

    const formData = new FormData();
    formData.append("name", name.value);
    formData.append("description", description.value);

    // Make PUT request
    await api.post(`/categories/${categoryId}`, formData, {
      params: { _method: "PUT" },
    });

    successMessage.value = "Category updated successfully!";
  } catch (err) {
    errorMessage.value = err.response?.data?.errors
      ? Object.values(err.response.data.errors).flat().join(" ")
      : err.response?.data?.message || "Failed to update category.";
  } finally {
    loading.value = false;
  }
};
</script>
