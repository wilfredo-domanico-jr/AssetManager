<template>
  <div class="py-8">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
      <SubHeader
        pageName="Edit Asset"
        pageDescription="Modify the details of this existing asset record"
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
        <form v-if="isAdmin" @submit.prevent="submitAsset" class="space-y-6">
          <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
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

            <div>
              <InputLabel value="Model" for="model" />
              <TextInput
                v-model="model"
                type="text"
                class="block mt-1 w-full"
                required
                placeholder="e.g., Dell Inspiron 15"
              />
            </div>

            <div>
              <InputLabel value="Category" for="category_id" />
              <DropdownInput
                v-model="category"
                :options="categoryOptions"
                class="mt-1 w-full"
                required
              />
            </div>

            <div>
              <InputLabel value="Department" for="department_id" />
              <DropdownInput
                v-model="department"
                :options="departmentOptions"
                class="mt-1 w-full"
                required
              />
            </div>

            <div>
              <InputLabel value="Purchase Date" for="purchase_date" />
              <TextInput
                v-model="purchaseDate"
                type="date"
                class="mt-1 w-full"
                required
              />
            </div>

            <div>
              <InputLabel value="Purchase Cost (₱)" for="purchase_cost" />
              <TextInput
                v-model.number="purchaseCost"
                type="number"
                placeholder="0.00"
                step="0.01"
                min="0"
                class="mt-1 w-full"
                required
              />
            </div>

            <div>
              <InputLabel value="Useful Life (Years)" for="useful_life" />
              <TextInput
                v-model.number="usefulLife"
                type="number"
                placeholder="e.g., 2"
                min="1"
                class="mt-1 w-full"
                required
              />
            </div>

            <div>
              <InputLabel value="Supplier" for="supplier" />
              <TextInput
                v-model="supplier"
                type="text"
                placeholder="e.g., EasyPC"
                class="mt-1 w-full"
                required
              />
            </div>

            <div>
              <InputLabel value="Condition" for="condition" />
              <DropdownInput
                v-model="condition"
                :options="conditionOptions"
                class="mt-1 w-full"
                required
              />
            </div>

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

          <div>
            <InputLabel value="Description (Optional)" for="description" />
            <TextAreaInput
              v-model="description"
              rows="3"
              placeholder="Additional notes about this asset..."
              class="mt-1 w-full"
            />
          </div>

          <!-- Start Toggle Deployment -->
          <div class="md:col-span-2 flex items-center space-x-3 mt-4">
            <InputLabel value="Deployed ?" for="isDeployed" />

            <label class="relative inline-flex items-center cursor-pointer">
              <input
                v-model="isDeployed"
                type="checkbox"
                class="sr-only peer"
              />

              <div
                class="w-11 h-6 bg-gray-200 peer-focus:outline-none rounded-full peer dark:bg-gray-700 peer-checked:bg-indigo-600 after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:after:translate-x-full"
              ></div>
            </label>
          </div>
          <!-- End Toggle Deployment -->

          <!-- Start Deployment Field -->

          <div
            v-show="isDeployed"
            class="md:col-span-2 grid grid-cols-1 md:grid-cols-2 gap-4 mt-4"
          >
            <div class="md:col-span-2">
              <hr class="border-t border-gray-200 dark:border-gray-700 mb-3" />
              <label
                class="block text-center font-medium text-gray-700 dark:text-gray-300"
              >
                Deployment Details
              </label>
            </div>

            <div>
              <InputLabel value="Name" for="name" />

              <TextInput
                v-model="deployedName"
                type="text"
                class="block mt-1 w-full"
                :required="isDeployed"
              />
            </div>

            <div>
              <InputLabel value="Designation" for="designation" />

              <DropdownInput
                v-model="deployedDepartment"
                :options="departmentOptions"
                class="mt-1 w-full"
                :required="isDeployed"
              />
            </div>
          </div>

          <!-- End Deployment Field -->
          <div
            class="flex justify-end space-x-2 pt-4 border-t border-gray-200 dark:border-gray-700"
          >
            <SecondaryLink to="/assets" class="ms-3 uppercase"
              >Cancel</SecondaryLink
            >
            <PrimaryButton
              type="submit"
              :disabled="loading"
              class="ms-3 uppercase"
            >
              {{ loading ? "Updating Asset..." : "Update Asset" }}
            </PrimaryButton>
          </div>
        </form>

        <form v-else class="space-y-6">
          <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
              <InputLabel value="Asset Name" for="asset_name" />
              <TextInput
                v-model="assetName"
                type="text"
                class="block mt-1 w-full"
                required
                autofocus
                placeholder="e.g., ITV0002"
                :disabled="!isAdmin"
              />
            </div>

            <div>
              <InputLabel value="Model" for="model" />
              <TextInput
                v-model="model"
                type="text"
                class="block mt-1 w-full"
                required
                placeholder="e.g., Dell Inspiron 15"
                :disabled="!isAdmin"
              />
            </div>

            <div>
              <InputLabel value="Category" for="category_id" />
              <DropdownInput
                v-model="category"
                :options="categoryOptions"
                class="mt-1 w-full"
                required
                :disabled="!isAdmin"
              />
            </div>

            <div>
              <InputLabel value="Department" for="department_id" />
              <DropdownInput
                v-model="department"
                :options="departmentOptions"
                class="mt-1 w-full"
                required
                :disabled="!isAdmin"
              />
            </div>

            <div>
              <InputLabel value="Purchase Date" for="purchase_date" />
              <TextInput
                v-model="purchaseDate"
                type="date"
                class="mt-1 w-full"
                required
                :disabled="!isAdmin"
              />
            </div>

            <div>
              <InputLabel value="Purchase Cost (₱)" for="purchase_cost" />
              <TextInput
                v-model.number="purchaseCost"
                type="number"
                placeholder="0.00"
                step="0.01"
                min="0"
                class="mt-1 w-full"
                required
                :disabled="!isAdmin"
              />
            </div>

            <div>
              <InputLabel value="Useful Life (Years)" for="useful_life" />
              <TextInput
                v-model.number="usefulLife"
                type="number"
                placeholder="e.g., 2"
                min="1"
                class="mt-1 w-full"
                required
                :disabled="!isAdmin"
              />
            </div>

            <div>
              <InputLabel value="Supplier" for="supplier" />
              <TextInput
                v-model="supplier"
                type="text"
                placeholder="e.g., EasyPC"
                class="mt-1 w-full"
                required
                :disabled="!isAdmin"
              />
            </div>

            <div>
              <InputLabel value="Condition" for="condition" />
              <DropdownInput
                v-model="condition"
                :options="conditionOptions"
                class="mt-1 w-full"
                required
                :disabled="!isAdmin"
              />
            </div>

            <div class="md:col-span-2">
              <div v-if="assetPreviewUrl" class="mt-3 flex justify-center">
                <img
                  :src="assetPreviewUrl"
                  class="w-48 h-48 object-cover rounded-lg shadow-md border border-gray-300 dark:border-gray-700"
                  alt="Preview"
                />
              </div>
            </div>
          </div>

          <div>
            <InputLabel value="Description (Optional)" for="description" />
            <TextAreaInput
              v-model="description"
              rows="3"
              placeholder="Additional notes about this asset..."
              class="mt-1 w-full"
              :disabled="!isAdmin"
            />
          </div>

          <!-- Start Toggle Deployment -->
          <div class="md:col-span-2 flex items-center space-x-3 mt-4">
            <InputLabel value="Deployed ?" for="isDeployed" />

            <label class="relative inline-flex items-center cursor-pointer">
              <input
                v-model="isDeployed"
                type="checkbox"
                class="sr-only peer"
                :disabled="!isAdmin"
              />

              <div
                class="w-11 h-6 bg-gray-200 peer-focus:outline-none rounded-full peer dark:bg-gray-700 peer-checked:bg-indigo-600 after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:after:translate-x-full"
              ></div>
            </label>
          </div>
          <!-- End Toggle Deployment -->

          <!-- Start Deployment Field -->

          <div
            v-show="isDeployed"
            class="md:col-span-2 grid grid-cols-1 md:grid-cols-2 gap-4 mt-4"
          >
            <div class="md:col-span-2">
              <hr class="border-t border-gray-200 dark:border-gray-700 mb-3" />
              <label
                class="block text-center font-medium text-gray-700 dark:text-gray-300"
              >
                Deployment Details
              </label>
            </div>

            <div>
              <InputLabel value="Name" for="name" />

              <TextInput
                v-model="deployedName"
                type="text"
                class="block mt-1 w-full"
                :required="isDeployed"
                :disabled="!isAdmin"
              />
            </div>

            <div>
              <InputLabel value="Designation" for="designation" />

              <DropdownInput
                v-model="deployedDepartment"
                :options="departmentOptions"
                class="mt-1 w-full"
                :required="isDeployed"
                :disabled="!isAdmin"
              />
            </div>
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
import { useAuthStore } from "../../store/auth";
const auth = useAuthStore();

const isAdmin = computed(() => auth.user?.role === "Admin");

import SubHeader from "../../components/SubHeader.vue";
import AlertMessage from "../../components/AlertMessage.vue";
import InputLabel from "../../components/InputLabel.vue";
import TextInput from "../../components/TextInput.vue";
import DropdownInput from "../../components/DropdownInput.vue";
import TextAreaInput from "../../components/TextAreaInput.vue";
import ImageInput from "../../components/ImageInput.vue";
import PrimaryButton from "../../components/PrimaryButton.vue";
import SecondaryLink from "../../components/SecondaryLink.vue";

// Asset ID from route
const route = useRoute();
const assetId = route.params.id;

// Form fields
const assetName = ref("");
const model = ref("");
const category = ref("");
const department = ref("");
const purchaseDate = ref("");
const purchaseCost = ref(null);
const usefulLife = ref(null);
const supplier = ref("");
const condition = ref("");
const assetImage = ref(null);
const assetPreviewUrl = ref(null);
const description = ref("");
const isDeployed = ref(false);
const deployedName = ref("");
const deployedDepartment = ref("");

// Messages & loading
const errorMessage = ref("");
const successMessage = ref("");
const loading = ref(false);

// Options
const categories = ref([]);
const departments = ref([]);
const conditionOptions = [
  { value: "", label: "Select Condition" },
  { value: "Excellent", label: "Excellent" },
  { value: "Good", label: "Good" },
  { value: "Needs Repair", label: "Needs Repair" },
];

const categoryOptions = computed(() => [
  { value: "", label: "Select Category" },
  ...categories.value.map((c) => ({ value: c.id, label: c.name })),
]);

const departmentOptions = computed(() => [
  { value: "", label: "Select Department" },
  ...departments.value.map((d) => ({ value: d.id, label: d.name })),
]);

// Watch image for preview
watch(assetImage, (file) => {
  assetPreviewUrl.value = file ? URL.createObjectURL(file) : null;
});

// Fetch asset data
onMounted(async () => {
  try {
    const res = await api.get(`/assets/${assetId}/edit`);
    const data = res.data;
    const asset = data.asset;

    assetName.value = asset.asset_name;
    model.value = asset.model;
    category.value = asset.category_id;
    department.value = asset.department_id;
    purchaseDate.value = asset.purchase_date
      ? asset.purchase_date.slice(0, 10)
      : "";
    purchaseCost.value = asset.purchase_cost;
    usefulLife.value = asset.useful_life;
    supplier.value = asset.supplier;
    condition.value = asset.condition;
    description.value = asset.description || "";
    if (asset.image) assetPreviewUrl.value = asset.image;
    isDeployed.value = asset.is_deployed === 1;
    deployedName.value = asset.deployed_name;
    deployedDepartment.value = asset.deployed_designation;
    categories.value = data.categories;
    departments.value = data.departments;
  } catch {
    errorMessage.value = "Unable to fetch asset details.";
  }
});

// Submit updated asset
const submitAsset = async () => {
  try {
    loading.value = true;
    errorMessage.value = "";
    successMessage.value = "";

    const formData = new FormData();
    formData.append("asset_name", assetName.value);
    formData.append("model", model.value);
    formData.append("category_id", category.value);
    formData.append("department_id", department.value);
    formData.append("purchase_date", purchaseDate.value);
    formData.append("purchase_cost", purchaseCost.value);
    formData.append("useful_life", usefulLife.value);
    formData.append("supplier", supplier.value);
    formData.append("condition", condition.value);
    formData.append("description", description.value);
    formData.append("is_deployed", isDeployed.value ? 1 : 0);
    formData.append("deployed_name", deployedName.value);
    formData.append("deployed_designation", deployedDepartment.value);

    if (assetImage.value) {
      formData.append("image", assetImage.value);
    }

    // Make PUT request
    await api.post(`/assets/${assetId}`, formData, {
      headers: { "Content-Type": "multipart/form-data" },
      params: { _method: "PUT" }, // Laravel will treat it as PUT
    });

    successMessage.value = "Asset updated successfully!";
  } catch (err) {
    errorMessage.value = err.response?.data?.errors
      ? Object.values(err.response.data.errors).flat().join(" ")
      : err.response?.data?.message || "Failed to update asset.";
  } finally {
    loading.value = false;
  }
};
</script>
