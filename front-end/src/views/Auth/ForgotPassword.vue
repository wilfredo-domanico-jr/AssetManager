<template>
  <div class="mb-8">
    <h2 class="text-2xl font-bold text-gray-900 dark:text-white tracking-tight">
      Forgot Password
    </h2>
    <p class="text-sm text-gray-600 dark:text-gray-300 mt-2 leading-relaxed">
      No problem. Just let us know your email address and we will email you a
      password reset link.
    </p>
  </div>

  <AlertMessage
    :message="alert.message"
    :type="alert.type"
    class="mb-6 shadow-sm"
  />

  <form @submit.prevent="submitForgotPassword" class="space-y-6">
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
        placeholder="Enter your registered email"
        required
        autofocus
        autocomplete="username"
      />
    </div>

    <div class="flex flex-col gap-4">
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
          Sending Link...
        </template>
        <template v-else> Email Reset Link </template>
      </PrimaryButton>

      <router-link
        to="/auth/login"
        class="text-center text-sm font-medium text-gray-600 dark:text-gray-400 hover:text-indigo-600 dark:hover:text-indigo-400 transition-colors underline-offset-4 hover:underline"
      >
        Back to Login
      </router-link>
    </div>
  </form>
</template>

<script setup>
import { ref, onMounted } from "vue";
import { useRouter } from "vue-router";
import { useAuthStore } from "../../store/auth";
import InputLabel from "../../components/InputLabel.vue";
import TextInput from "../../components/TextInput.vue";
import AlertMessage from "../../components/AlertMessage.vue";
import PrimaryButton from "../../components/PrimaryButton.vue";
import api from "../../plugins/api"; //

const auth = useAuthStore();
const router = useRouter();

const email = ref("");
const loading = ref(false);

const alert = ref({
  message: "",
  type: "error",
});

onMounted(() => {
  if (auth.isLoggedIn) {
    router.replace("/"); // redirect if already logged in
  }
});

async function submitForgotPassword() {
  alert.value = { message: "", type: "error" };
  loading.value = true;

  try {
    await api.post("/forgot-password", { email: email.value });

    alert.value = {
      message: "Password reset link has been sent to your email.",
      type: "success",
    };

    email.value = ""; // optional: clear input
  } catch (error) {
    alert.value = {
      message: "Something went wrong. Please try again.",
      type: "error",
    };
  } finally {
    loading.value = false;
  }
}
</script>
