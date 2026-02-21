<template>
  <div class="py-8">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
      <SubHeader
        pageName="Add New User"
        pageDescription="Fill out the details to register a new user"
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
        <form @submit.prevent="submitUser" class="space-y-6">
          <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
              <InputLabel value="Name" for="name" />
              <TextInput
                v-model="name"
                type="text"
                placeholder="Enter your full name"
                class="block mt-1 w-full"
                required
                autofocus
              />
            </div>

            <div>
              <InputLabel value="Email" for="email" />
              <TextInput
                v-model="email"
                type="email"
                required
                placeholder="Enter your email address"
                class="block mt-1 w-full"
                autocomplete="name"
              />
            </div>

            <div>
              <InputLabel value="Password" for="password" />
              <TextInput
                v-model="password"
                type="password"
                required
                placeholder="Enter your password"
                class="block mt-1 w-full"
                autocomplete="new-password"
              />
            </div>

            <div>
              <InputLabel value="Confirm Password" for="confirm_password" />
              <TextInput
                v-model="password_confirmation"
                type="password"
                required
                placeholder="Confirm your password"
                class="block mt-1 w-full"
                autocomplete="new-password"
              />
            </div>

            <div>
              <InputLabel value="Role" for="role" />
              <DropdownInput
                v-model="role"
                :options="roleOptions"
                class="mt-1 w-full"
                required
              />
            </div>
          </div>

          <div
            class="flex justify-end space-x-2 pt-4 border-t border-gray-200 dark:border-gray-700"
          >
            <SecondaryLink to="/users" class="ms-3 uppercase"
              >Cancel</SecondaryLink
            >
            <PrimaryButton
              type="submit"
              :disabled="loading"
              class="ms-3 uppercase"
            >
              {{ loading ? "Saving User..." : "Save User" }}
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
import DropdownInput from "../../components/DropdownInput.vue";

const name = ref("");
const email = ref("");
const password = ref("");
const password_confirmation = ref("");
const role = ref("");

const errorMessage = ref("");
const successMessage = ref("");
const loading = ref(false);

const roleOptions = [
  { value: "", label: "Select Role" },
  { value: "Admin", label: "Admin" },
  { value: "User", label: "User" },
];

const submitUser = async () => {
  try {
    loading.value = true;
    errorMessage.value = "";
    successMessage.value = "";

    console.log("Test", {
      name: name.value,
      email: email.value,
      password: password.value,
      password_confirmation: password_confirmation.value,
      role: role.value,
    });

    const response = await api.post("/users", {
      name: name.value,
      email: email.value,
      password: password.value,
      password_confirmation: password_confirmation.value,
      role: role.value,
    });

    successMessage.value = response.data.message;

    // Clear form fields
    name.value = "";
    email.value = "";
    password.value = "";
    password_confirmation.value = "";
    role.value = "";
  } catch (err) {
    if (err.response?.data?.errors) {
      errorMessage.value = Object.values(err.response.data.errors)
        .flat()
        .join(" ");
    } else {
      errorMessage.value =
        err.response?.data?.message || "Failed to save user.";
    }
  } finally {
    loading.value = false;
  }
};
</script>
