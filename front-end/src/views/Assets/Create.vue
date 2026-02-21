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

      <AlertMessage
        v-if="successMessage"
        type="success"
        :message="successMessage"
        :dismissible="false"
      />

      <div
        class="bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-xl shadow-sm p-4 space-y-4"
      >
        <form @submit.prevent="submitAsset" class="space-y-6">
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
              <ImageInput
                v-model="assetImage"
                :key="imageInputKey"
                class="mt-1 block w-full"
              />
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
              {{ loading ? "Saving Asset..." : "Save Asset" }}
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
import DropdownInput from "../../components/DropdownInput.vue";
import TextAreaInput from "../../components/TextAreaInput.vue";
import ImageInput from "../../components/ImageInput.vue";
import PrimaryButton from "../../components/PrimaryButton.vue";
import SecondaryLink from "../../components/SecondaryLink.vue";

const assetName = ref("");
const category = ref("");
const department = ref("");
const purchaseDate = ref("");
const purchaseCost = ref(null);
const usefulLife = ref(null);
const supplier = ref("");
const condition = ref("");
const assetImage = ref(null);
const assetPreviewUrl = ref(null);
const imageInputKey = ref(Date.now());
const description = ref("");
const errorMessage = ref("");
const successMessage = ref("");
const loading = ref(false);

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

onMounted(async () => {
  try {
    const res = await api.get("/assets/create");
    categories.value = res.data.categories;
    departments.value = res.data.departments;
  } catch {
    errorMessage.value = "Unable to fetch categories and departments data.";
  }
});

watch(assetImage, (file) => {
  assetPreviewUrl.value = file ? URL.createObjectURL(file) : null;
});

const submitAsset = async () => {
  try {
    loading.value = true;
    errorMessage.value = "";
    successMessage.value = "";

    const formData = new FormData();
    const fields = [
      "asset_name",
      "category_id",
      "department_id",
      "purchase_date",
      "purchase_cost",
      "useful_life",
      "supplier",
      "condition",
      "description",
    ];

    fields.forEach((field) => {
      const valueMap = {
        asset_name: assetName.value,
        category_id: category.value,
        department_id: department.value,
        purchase_date: purchaseDate.value,
        purchase_cost: purchaseCost.value,
        useful_life: usefulLife.value,
        supplier: supplier.value,
        condition: condition.value,
        description: description.value || "",
      };
      formData.append(field, valueMap[field]);
    });

    if (assetImage.value) formData.append("image", assetImage.value);

    const response = await api.post("/assets", formData, {
      headers: { "Content-Type": "multipart/form-data" },
    });

    successMessage.value = response.data.message;

    // Clear form fields
    assetName.value = "";
    category.value = "";
    department.value = "";
    purchaseDate.value = "";
    purchaseCost.value = null;
    usefulLife.value = null;
    supplier.value = "";
    condition.value = "";
    assetImage.value = null;
    assetPreviewUrl.value = null;
    description.value = "";

    imageInputKey.value = Date.now();
    
  } catch (err) {
    if (err.response?.data?.errors) {
      errorMessage.value = Object.values(err.response.data.errors)
        .flat()
        .join(" ");
    } else {
      errorMessage.value =
        err.response?.data?.message || "Failed to save asset.";
    }
  } finally {
    loading.value = false;
  }
};
</script>
