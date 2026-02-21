<template>
  <AlertMessage v-if="errorMessage" type="error" :message="errorMessage" />

  <form @submit.prevent="submitLogin">
    <!-- Email -->
    <div>
      <InputLabel value="Email" for="email" />
      <TextInput
        v-model="email"
        type="email"
        class="block mt-1 w-full"
        required
        autofocus
        autocomplete="username"
      />
    </div>

    <!-- Password -->
    <div class="mt-4">
      <InputLabel value="Password" for="password" />

      <TextInput
        type="password"
        v-model="password"
        class="block mt-1 w-full"
        required
        autocomplete="current-password"
      />
    </div>

    <div class="block mt-4">
      <label for="remember_me" class="inline-flex items-center">
        <input
          type="checkbox"
          class="rounded dark:bg-gray-900 border-gray-300 dark:border-gray-700 text-indigo-600 shadow-sm focus:ring-indigo-500 dark:focus:ring-indigo-600 dark:focus:ring-offset-gray-800"
          name="remember"
        />
        <span class="ms-2 text-sm text-gray-600 dark:text-gray-400"
          >Remember me</span
        >
      </label>
    </div>

    <div class="flex items-center justify-end mt-4">
      <router-link
        to="/auth/forgot-password"
        class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800"
        href=""
        >Forgot your password?
      </router-link>

      <PrimaryButton type="submit" :disabled="loading" class="ms-3 uppercase">
        {{ loading ? "Logging in..." : "Log in" }}
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
