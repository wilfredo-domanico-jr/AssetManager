<template>
    <div class="mb-4 text-sm text-gray-600 dark:text-gray-400">
        Forgot your password? No problem. Just let us know your email address
        and we will email you a password reset link that will allow you to
        choose a new one.
    </div>

    <form @submit.prevent="submitForgotPassword">
        <!-- Email -->
        <div>
            <InputLabel value="Email" for="email" />
            <TextInput
                type="email"
                class="block mt-1 w-full"
                required
                autofocus
            />
        </div>

        <div class="flex items-center justify-end mt-4">
            <PrimaryButton type="submit" class="ms-3">
                Email Password Reset Link
            </PrimaryButton>
        </div>
    </form>
</template>

<script setup>
import { ref } from "vue";

import InputLabel from "../../components/InputLabel.vue";
import TextInput from "../../components/TextInput.vue";
import PrimaryButton from "../../components/PrimaryButton.vue";

const email = ref("");

function submitForgotPassword() {
    console.log("Email:", email.value);
    // You can call an API here to log in
}
</script>
