<template>
  <div class="py-8">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
      <SubHeader
        pageName="Add New Category"
        pageDescription="Create a new asset category"
      />

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
              {{ loading ? "Saving Category..." : "Save Category" }}
            </PrimaryButton>
          </div>
        </form>
      </div>
    </div>
  </div>
</template>

<script setup>
import { ref, onMounted, watch, computed } from "vue";
import api from "../../plugins/api";
import SubHeader from "../../components/SubHeader.vue";
import AlertMessage from "../../components/AlertMessage.vue";
import InputLabel from "../../components/InputLabel.vue";
import TextInput from "../../components/TextInput.vue";
import PrimaryButton from "../../components/PrimaryButton.vue";
import SecondaryLink from "../../components/SecondaryLink.vue";

const name = ref("");
const description = ref("");

const errorMessage = ref("");
const successMessage = ref("");
const loading = ref(false);

const submitCategory = async () => {
  try {
    loading.value = true;
    errorMessage.value = "";
    successMessage.value = "";

    const formData = new FormData();
    const fields = ["name", "description"];

    fields.forEach((field) => {
      const valueMap = {
        name: name.value,
        description: description.value || "",
      };
      formData.append(field, valueMap[field]);
    });

    const response = await api.post("/categories", formData);

    successMessage.value = response.data.message;

    // Clear form fields
    name.value = "";
    description.value = "";
  } catch (err) {
    if (err.response?.data?.errors) {
      errorMessage.value = Object.values(err.response.data.errors)
        .flat()
        .join(" ");
    } else {
      errorMessage.value =
        err.response?.data?.message || "Failed to save category.";
    }
  } finally {
    loading.value = false;
  }
};
</script>
