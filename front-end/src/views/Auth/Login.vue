<template>
    <form @submit.prevent="submitLogin">
        <!-- Email -->
        <div>
            <InputLabel value="Email" for="email" />
            <TextInput
                :value="email"
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
                :value="password"
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

            <PrimaryButton type="submit" class="ms-3"> Login </PrimaryButton>
        </div>
    </form>
</template>

<script setup>
import { ref } from "vue";
import axios from "axios";
import InputLabel from "../../components/InputLabel.vue";
import TextInput from "../../components/TextInput.vue";
import PrimaryButton from "../../components/PrimaryButton.vue";

const email = ref("");
const password = ref("");

async function submitLogin() {
    try {
        const apiUrl = import.meta.env.VITE_API_URL;

        const response = await axios.post(`${apiUrl}/login`, {
            email: email.value,
            password: password.value,
        });

        console.log("Login successful:", response.data);
        // e.g., save token: localStorage.setItem('token', response.data.token)
        // redirect user, etc.
    } catch (error) {
        console.error("Login failed:", error.response?.data || error.message);
    }
}
</script>
