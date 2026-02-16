import { createRouter, createWebHistory } from "vue-router";

import DefaultLayout from "../DefaultLayout.vue";
import AuthenticationLayout from "../AuthenticationLayout.vue";
import Dashboard from "../views/Dashboard.vue";
import Login from "../views/Auth/Login.vue";
import ForgotPassword from "../views/Auth/ForgotPassword.vue";
import ResetPassword from "../views/Auth/ResetPassword.vue";

const routes = [
  {
    path: "/",
    component: DefaultLayout,
    children: [
      {
        path: "",
        name: "Dashboard",
        component: Dashboard,
      },
    ],
  },

  // Authentication routes
  {
    path: "/",
    component: AuthenticationLayout,
    children: [
      {
        path: "login",
        name: "Login",
        component: Login,
      },
      {
        path: "forgot-password",
        name: "ForgotPassword",
        component: ForgotPassword,
      },
      {
        path: "reset-password",
        name: "ResetPassword",
        component: ResetPassword,
      },
    ],
  },
];

const router = createRouter({
  history: createWebHistory(), // uses HTML5 history mode
  routes,
});

export default router;
