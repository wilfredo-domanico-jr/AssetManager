<template>
  <div class="py-8">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
      <SubHeader
        pageName="Add New Asset"
        pageDescription="Fill out the details to register a new equipment asset"
      />

      <AlertMessage
        v-if="errorMessage"
        type="error"
        :message="errorMessage"
        :dismissible="false"
      />

      <div
        class="bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-xl shadow-sm p-4 space-y-4"
      >
        <form @submit.prevent="submitLogin" class="space-y-6">
          <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <!-- Asset Name -->
            <div>
              <InputLabel value="Asset Name" for="asset_name" />
              <TextInput
                v-model="assetName"
                type="text"
                class="block mt-1 w-full"
                required
                autofocus
                placeholder="e.g., ITV0002"
              />
            </div>

            <!-- Category -->
            <div>
              <InputLabel value="Category" for="category_id" />
              <DropdownInput
                v-model="category"
                :options="[
                  { value: '', label: 'Select Category' },
                  { value: '1', label: 'Category 1' },
                  { value: '2', label: 'Category 2' },
                  { value: '3', label: 'Category 3' },
                ]"
                class="mt-1 w-full"
                required
              />
            </div>

            <!-- Department -->
            <div>
              <InputLabel value="Department" for="department_id" />
              <DropdownInput
                v-model="department"
                :options="[
                  { value: '', label: 'Select Department' },
                  { value: '1', label: 'Department 1' },
                  { value: '2', label: 'Department 2' },
                  { value: '3', label: 'Department 3' },
                ]"
                class="mt-1 w-full"
                required
              />
            </div>

            <!-- Purchase Date -->
            <div>
              <InputLabel value="Purchase Date" for="purchase_date" />
              <TextInput
                v-model="purchaseDate"
                type="date"
                name="purchase_date"
                class="mt-1 w-full"
                required
              />
            </div>

            <!-- Purchase Cost -->
            <div>
              <InputLabel value="Purchase Cost (₱)" for="purchase_cost" />
              <TextInput
                v-model="purchaseCost"
                type="number"
                name="purchase_cost"
                placeholder="0.00"
                step="0.01"
                min="0"
                class="mt-1 w-full"
                required
              />
            </div>

            <!-- Useful Life -->
            <div>
              <InputLabel value="Useful Life (Years)" for="useful_life" />
              <TextInput
                v-model="usefulLife"
                type="number"
                name="useful_life"
                placeholder="e.g., 2"
                min="1"
                class="mt-1 w-full"
                required
              />
            </div>

            <!-- Supplier -->
            <div>
              <InputLabel value="Supplier" for="supplier" />
              <TextInput
                v-model="supplier"
                type="text"
                name="supplier"
                placeholder="e.g., EasyPC"
                class="mt-1 w-full"
                required
              />
            </div>

            <!-- Condition -->
            <div>
              <InputLabel value="Condition" for="condition" />
              <DropdownInput
                v-model="condition"
                :options="[
                  { value: '', label: 'Select Condition' },
                  { value: 'Excellent', label: 'Excellent' },
                  { value: 'Good', label: 'Good' },
                  { value: 'Needs Repair', label: 'Needs Repair' },
                ]"
                class="mt-1 w-full"
                required
              />
            </div>

            <!-- Image Upload -->
            <div class="md:col-span-2">
              <InputLabel value="Upload Image" for="assetImage" />
              <ImageInput v-model="assetImage" class="mt-1 block w-full" />
              <div v-if="assetPreviewUrl" class="mt-3 flex justify-center">
                <img
                  :src="assetPreviewUrl"
                  class="w-48 h-48 object-cover rounded-lg shadow-md border border-gray-300 dark:border-gray-700"
                  alt="Preview"
                />
              </div>
            </div>
          </div>

          <!-- Description -->
          <div>
            <InputLabel value="Description (Optional)" for="description" />
            <TextAreaInput
              v-model="description"
              rows="3"
              placeholder="Additional notes about this asset..."
              class="mt-1 w-full"
            />
          </div>

          <!-- Buttons -->
          <div
            class="flex justify-end space-x-2 pt-4 border-t border-gray-200 dark:border-gray-700"
          >
            <a
              href="/assets"
              class="px-4 py-2 bg-gray-200 dark:bg-gray-700 text-gray-800 dark:text-gray-100 rounded-lg hover:bg-gray-300 dark:hover:bg-gray-600"
            >
              Cancel
            </a>

            <PrimaryButton type="submit" :disabled="loading" class="ms-3">
              {{ loading ? "Saving Asset..." : "Save Asset" }}
            </PrimaryButton>
          </div>
        </form>
      </div>
    </div>
  </div>
</template>

<script setup>
import { ref, watch } from "vue";
import SubHeader from "../../components/SubHeader.vue";
import AlertMessage from "../../components/AlertMessage.vue";
import InputLabel from "../../components/InputLabel.vue";
import TextInput from "../../components/TextInput.vue";
import DropdownInput from "../../components/DropdownInput.vue";
import TextAreaInput from "../../components/TextAreaInput.vue";
import ImageInput from "../../components/ImageInput.vue";
import PrimaryButton from "../../components/PrimaryButton.vue";

// Form fields
const assetName = ref("");
const category = ref("");
const department = ref("");
const purchaseDate = ref("");
const purchaseCost = ref("");
const usefulLife = ref("");
const supplier = ref("");
const condition = ref("");
const assetImage = ref(null);
const assetPreviewUrl = ref(null);
const description = ref("");
const errorMessage = ref("");

watch(assetImage, (file) => {
  if (file) {
    assetPreviewUrl.value = URL.createObjectURL(file);
  } else {
    assetPreviewUrl.value = null;
  }
});
</script>
