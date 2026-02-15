<template>
  <div
    v-if="errorMessage"
    class="mb-4 text-center text-sm font-medium text-red-700 bg-red-100 dark:bg-red-900 dark:text-red-300 px-4 py-2 rounded"
  >
    {{ errorMessage }}
  </div>

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
        to="/forgot-password"
        class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800"
        href=""
        >Forgot your password?
      </router-link>

      <PrimaryButton type="submit" :disabled="loading" class="ms-3">
        {{ loading ? "Logging in..." : "Login" }}
      </PrimaryButton>
    </div>
  </form>
</template>

<script setup>
import { ref, onMounted } from "vue";
import api from "../../plugins/api";
import { useRouter } from "vue-router";
import { useAuthStore } from "../../store/auth";
import InputLabel from "../../components/InputLabel.vue";
import TextInput from "../../components/TextInput.vue";
import PrimaryButton from "../../components/PrimaryButton.vue";

const auth = useAuthStore();
const router = useRouter();
const email = ref("");
const password = ref("");
const errorMessage = ref("");
const loading = ref(false);

// redirect if already logged in
onMounted(() => {
  if (auth.isLoggedIn) {
    router.replace("/"); // redirect to home/dashboard
  }
});

async function submitLogin() {
  errorMessage.value = "";
  loading.value = true;

  try {
    console.log("Eto Email:", email.value);
    const response = await api.post("/login", {
      email: email.value,
      password: password.value,
    });

    console.log("Eto Response:", response.data);
    router.push("/");

    const token = response.data.token;

    localStorage.setItem("token", token);

    console.log("Login success", response.data.user);
  } catch (error) {
    errorMessage.value = error.response?.data?.message || "Login failed";
  } finally {
    loading.value = false;
  }
}
</script>
