<template>
  <div class="mb-8">
    <h2 class="text-2xl font-bold text-gray-900 dark:text-white tracking-tight">
      Login
    </h2>
    <p class="text-sm text-gray-600 dark:text-gray-300 mt-1">
      Enter your credentials to manage assets.
    </p>
  </div>

  <AlertMessage
    v-if="errorMessage"
    type="error"
    :message="errorMessage"
    class="mb-6 shadow-sm"
  />

  <form @submit.prevent="submitLogin" class="space-y-5">
    <div>
      <InputLabel
        value="Email"
        for="email"
        class="text-xs uppercase tracking-widest font-bold text-gray-500 dark:text-gray-400"
      />
      <TextInput
        v-model="email"
        type="email"
        id="email"
        class="block mt-1 w-full bg-white/20 dark:bg-gray-900/20 backdrop-blur-sm border-gray-300/50 dark:border-gray-700/50 focus:ring-indigo-500/50 transition-all"
        placeholder="you@example.com"
        required
        autofocus
        autocomplete="username"
      />
    </div>

    <div>
      <div class="flex justify-between items-center">
        <InputLabel
          value="Password"
          for="password"
          class="text-xs uppercase tracking-widest font-bold text-gray-500 dark:text-gray-400"
        />
        <router-link
          to="/auth/forgot-password"
          class="text-xs text-indigo-600 dark:text-indigo-400 hover:underline underline-offset-4"
        >
          Forgot password?
        </router-link>
      </div>

      <TextInput
        id="password"
        type="password"
        v-model="password"
        class="block mt-1 w-full bg-white/20 dark:bg-gray-900/20 backdrop-blur-sm border-gray-300/50 dark:border-gray-700/50 focus:ring-indigo-500/50 transition-all"
        placeholder="••••••••"
        required
        autocomplete="current-password"
      />
    </div>

    <div class="flex items-center">
      <label
        for="remember_me"
        class="inline-flex items-center cursor-pointer group"
      >
        <input
          id="remember_me"
          type="checkbox"
          class="rounded bg-white/30 dark:bg-gray-900/30 border-gray-300/50 dark:border-gray-700/50 text-indigo-600 shadow-sm focus:ring-indigo-500/50"
          name="remember"
        />
        <span
          class="ms-2 text-sm text-gray-600 dark:text-gray-300 group-hover:text-gray-900 dark:group-hover:text-white transition-colors"
        >
          Remember me
        </span>
      </label>
    </div>

    <div class="pt-2">
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
          Processing
        </template>
        <template v-else> Sign In </template>
      </PrimaryButton>
    </div>
  </form>
</template>

<script setup>
import { ref, onMounted } from "vue";
import { useRouter } from "vue-router";
import { useAuthStore } from "../../store/auth";
import InputLabel from "../../components/InputLabel.vue";
import TextInput from "../../components/TextInput.vue";
import PrimaryButton from "../../components/PrimaryButton.vue";
import AlertMessage from "../../components/AlertMessage.vue";

const auth = useAuthStore();
const router = useRouter();
const email = ref("");
const password = ref("");
const errorMessage = ref("");
const loading = ref(false);

// redirect if already logged in
onMounted(() => {
  if (auth.isLoggedIn) {
    router.replace("/");
  }
});

async function submitLogin() {
  errorMessage.value = "";
  loading.value = true;

  try {
    await auth.login({
      email: email.value,
      password: password.value,
    });

    router.push("/");
  } catch (error) {
    errorMessage.value = error.response?.data?.message || "Login failed";
  } finally {
    loading.value = false;
  }
}
</script>
