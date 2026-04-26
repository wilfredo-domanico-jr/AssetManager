<template>
  <div class="mb-8">
    <h2 class="text-2xl font-bold text-gray-900 dark:text-white tracking-tight">
      Set New Password
    </h2>
    <p class="text-sm text-gray-600 dark:text-gray-300 mt-2">
      Please provide your email and choose a secure new password.
    </p>
  </div>

  <AlertMessage
    :message="alert.message"
    :type="alert.type"
    class="mb-6 shadow-sm"
  />

  <form @submit.prevent="submitResetPassword" class="space-y-5">
    <div>
      <InputLabel
        value="Email Address"
        for="email"
        class="text-xs uppercase tracking-widest font-bold text-gray-500 dark:text-gray-400"
      />
      <TextInput
        v-model="email"
        type="email"
        id="email"
        class="block mt-1.5 w-full bg-white/20 dark:bg-gray-900/20 backdrop-blur-sm border-gray-300/50 dark:border-gray-700/50 focus:ring-indigo-500/50 transition-all"
        placeholder="you@example.com"
        required
        autofocus
        autocomplete="username"
      />
    </div>

    <div>
      <InputLabel
        value="New Password"
        for="password"
        class="text-xs uppercase tracking-widest font-bold text-gray-500 dark:text-gray-400"
      />
      <TextInput
        v-model="password"
        type="password"
        id="password"
        class="block mt-1.5 w-full bg-white/20 dark:bg-gray-900/20 backdrop-blur-sm border-gray-300/50 dark:border-gray-700/50 focus:ring-indigo-500/50 transition-all"
        placeholder="••••••••"
        required
        autocomplete="new-password"
      />
    </div>

    <div>
      <InputLabel
        value="Confirm Password"
        for="password_confirmation"
        class="text-xs uppercase tracking-widest font-bold text-gray-500 dark:text-gray-400"
      />
      <TextInput
        v-model="password_confirmation"
        type="password"
        id="password_confirmation"
        class="block mt-1.5 w-full bg-white/20 dark:bg-gray-900/20 backdrop-blur-sm border-gray-300/50 dark:border-gray-700/50 focus:ring-indigo-500/50 transition-all"
        placeholder="••••••••"
        required
        autocomplete="new-password"
      />
    </div>

    <div class="pt-4 flex flex-col gap-4">
      <PrimaryButton
        type="submit"
        :disabled="loading"
        class="w-full justify-center py-3 bg-indigo-600 hover:bg-indigo-500 shadow-lg shadow-indigo-500/30 transition-all active:scale-[0.98] uppercase tracking-widest font-bold"
      >
        <template v-if="loading">
          <svg
            class="animate-spin -ml-1 mr-3 h-4 w-4 text-white"
            fill="none"
            viewBox="0 0 24 24"
          >
            <circle
              class="opacity-25"
              cx="12"
              cy="12"
              r="10"
              stroke="currentColor"
              stroke-width="4"
            ></circle>
            <path
              class="opacity-75"
              fill="currentColor"
              d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"
            ></path>
          </svg>
          Updating...
        </template>
        <template v-else> Reset Password </template>
      </PrimaryButton>

      <router-link
        to="/auth/login"
        class="text-center text-sm font-medium text-gray-600 dark:text-gray-400 hover:text-indigo-600 dark:hover:text-indigo-400 transition-colors"
      >
        Return to login
      </router-link>
    </div>
  </form>
</template>

<script setup>
import { ref, onMounted } from "vue";
import { useRouter, useRoute } from "vue-router";
import InputLabel from "../../components/InputLabel.vue";
import TextInput from "../../components/TextInput.vue";
import PrimaryButton from "../../components/PrimaryButton.vue";
import AlertMessage from "../../components/AlertMessage.vue";
import api from "../../plugins/api";

const router = useRouter();
const route = useRoute();

const email = ref(route.query.email || "");
const token = ref(route.query.token || "");
const password = ref("");
const password_confirmation = ref("");
const loading = ref(false);

const alert = ref({
  message: "",
  type: "error",
});

async function submitResetPassword() {
  alert.value = { message: "", type: "error" };
  loading.value = true;

  try {
    const response = await api.post("/reset-password", {
      token: token.value,
      email: email.value,
      password: password.value,
      password_confirmation: password_confirmation.value,
    });

    alert.value = {
      message: response.data.message || "Password has been reset successfully.",
      type: "success",
    };
    // Redirect to login after successful reset
    setTimeout(() => {
      router.push("/auth/login");
    }, 1000);
  } catch (error) {
    alert.value = {
      message:
        error.response?.data?.message ||
        "Unable to reset password. Please try again.",
      type: "error",
    };
  } finally {
    loading.value = false;
  }
}
</script>
