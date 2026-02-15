import { defineStore } from "pinia";
import { ref, computed } from "vue";
import api from "../plugins/api";

export const useAuthStore = defineStore("auth", () => {
  const user = ref(null);
  const token = ref(localStorage.getItem("token"));

  const isLoggedIn = computed(() => !!token.value);

  async function login(credentials) {
    const res = await api.post("/login", {
      email: credentials.email,
      password: credentials.password,
    });

    user.value = res.data.user;
    token.value = res.data.token;

    localStorage.setItem("token", res.data.token);
  }

  function logout() {
    user.value = null;
    token.value = null;
    localStorage.removeItem("token");
  }

  async function fetchUser() {
    if (!token.value) return;

    try {
      const res = await api.get("/me");
      user.value = res.data;
    } catch {
      logout();
    }
  }

  return {
    user,
    token,
    isLoggedIn,
    login,
    logout,
    fetchUser,
  };
});
