<template>
  <div class="mb-4 text-sm text-gray-600 dark:text-gray-400">
    Forgot your password? No problem. Just let us know your email address and we
    will email you a password reset link that will allow you to choose a new
    one.
  </div>

  <!-- Alert message for success or error -->
  <AlertMessage :message="alert.message" :type="alert.type" />

  <form @submit.prevent="submitForgotPassword">
    <div>
      <InputLabel value="Email" for="email" />
      <TextInput
        v-model="email"
        type="email"
        class="block mt-1 w-full"
        required
        autofocus
      />
    </div>

    <div class="flex items-center justify-end mt-4">
      <PrimaryButton type="submit" class="ms-3" :disabled="loading">
        {{ loading ? "Sending..." : "Email Password Reset Link" }}
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
