<template>
  <div>
    <!-- Alert message -->
    <AlertMessage :message="alert.message" :type="alert.type" />

    <form @submit.prevent="submitResetPassword">
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

      <div class="mt-4">
        <InputLabel value="Password" for="password" />
        <TextInput
          v-model="password"
          type="password"
          class="block mt-1 w-full"
          required
          autocomplete="new-password"
        />
      </div>

      <div class="mt-4">
        <InputLabel value="Confirm Password" for="password_confirmation" />
        <TextInput
          v-model="password_confirmation"
          type="password"
          class="block mt-1 w-full"
          required
          autocomplete="new-password"
        />
      </div>

      <div class="flex items-center justify-end mt-4">
        <PrimaryButton type="submit" class="ms-3" :disabled="loading">
          {{ loading ? "Resetting Password..." : "Reset Password" }}
        </PrimaryButton>
      </div>
    </form>
  </div>
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
    console.log(token);
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
      router.push("/login");
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
