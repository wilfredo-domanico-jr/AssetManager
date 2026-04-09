<template>
  <div class="py-8">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
      <SubHeader
        pageName="Report Email Settings"
        pageDescription="Configure email addresses to receive summary CSV reports"
      >
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

      <div
        class="bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-xl shadow-sm p-4 space-y-4"
      >
        <form @submit.prevent="submitEmails" class="space-y-6">
          <div>
            <InputLabel value="Email Addresses" for="emails" />

            <p class="text-sm text-gray-500 dark:text-gray-400 mb-2">
              Enter one or more emails separated by commas (e.g.,
              admin@example.com, manager@example.com)
            </p>

            <TextInput
              v-model="emails"
              type="text"
              class="block mt-1 w-full"
              required
              autofocus
              placeholder="Enter Emails"
            />
          </div>

          <div
            class="flex justify-end space-x-2 pt-4 border-t border-gray-200 dark:border-gray-700"
          >
            <PrimaryButton
              type="submit"
              :disabled="loading"
              class="ms-3 uppercase"
            >
              {{ loading ? "Saving Emails..." : "     Save Emails" }}
            </PrimaryButton>
          </div>
        </form>
      </div>
    </div>
  </div>
</template>

<script setup>
import { ref, onMounted } from "vue";
import api from "../../plugins/api";
import SubHeader from "../../components/SubHeader.vue";
import AlertMessage from "../../components/AlertMessage.vue";
import PrimaryButton from "../../components/PrimaryButton.vue";
import InputLabel from "../../components/InputLabel.vue";
import TextInput from "../../components/TextInput.vue";

const emails = ref("");

const errorMessage = ref("");
const successMessage = ref("");
const loading = ref(false);

const fetchEmails = async () => {
  try {
    errorMessage.value = "";
    const response = await api.get("/report-email-setting");
    const data = response.data;

    if (Array.isArray(data.emails)) {
      emails.value = data.emails.join(",");
    } else {
      emails.value = "";
    }
  } catch (err) {
    errorMessage.value = "Unable to fetch emails.";
    console.error("Error fetching emails:", err);
  }
};

onMounted(() => fetchEmails());

const submitEmails = async () => {
  try {
    loading.value = true;
    errorMessage.value = "";
    successMessage.value = "";

    // Make PUT request
    await api.post("report-email-setting", { emails: emails.value });

    successMessage.value = "Email updated successfully!";
  } catch (err) {
    errorMessage.value = err.response?.data?.errors
      ? Object.values(err.response.data.errors).flat().join(" ")
      : err.response?.data?.message || "Failed to update email.";
  } finally {
    loading.value = false;
  }
};
</script>
