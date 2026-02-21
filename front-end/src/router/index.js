// === IMPORTS ===
import { createRouter, createWebHistory } from "vue-router";

// === LAYOUTS ===
import DefaultLayout from "../DefaultLayout.vue";
import AuthenticationLayout from "../AuthenticationLayout.vue";

// === AUTHENTICATION ===
import Login from "../views/Auth/Login.vue";
import ForgotPassword from "../views/Auth/ForgotPassword.vue";
import ResetPassword from "../views/Auth/ResetPassword.vue";

// === DASHBOARD ===
import DashboardIndex from "../views/Dashboard/Index.vue";

// === ASSETS ===
import AssetsIndex from "../views/Assets/Index.vue";
import AssetsCreate from "../views/Assets/Create.vue";
import AssetsEdit from "../views/Assets/Edit.vue";

// === CATEGORIES ===
import CategoriesIndex from "../views/Categories/Index.vue";
import CategoriesCreate from "../views/Categories/Create.vue";
import CategoriesEdit from "../views/Categories/Edit.vue";

// === DEPARTMENTS ===
import DepartmentsIndex from "../views/Departments/Index.vue";
import DepartmentsCreate from "../views/Departments/Create.vue";
import DepartmentsEdit from "../views/Departments/Edit.vue";

// === REPORT EMAIL SETTING ===
import ReportEmailSettingIndex from "../views/ReportEmailSetting/Index.vue";

// === USERS ===
import UsersIndex from "../views/Users/Index.vue";
import UsersCreate from "../views/Users/Create.vue";

const routes = [
  {
    path: "/",
    component: DefaultLayout,
    children: [
      {
        path: "",
        name: "Dashboard",
        component: DashboardIndex,
      },
      {
        path: "assets",
        name: "Assets",
        component: AssetsIndex,
      },
      {
        path: "assets/create",
        name: "AssetsCreate",
        component: AssetsCreate,
      },
      {
        path: "assets/:id/edit",
        name: "AssetsEdit",
        component: AssetsEdit,
        props: true,
      },
      {
        path: "categories",
        name: "Categories",
        component: CategoriesIndex,
      },
      {
        path: "categories/create",
        name: "CategoriesCreate",
        component: CategoriesCreate,
      },
      {
        path: "categories/:id/edit",
        name: "CategoriesEdit",
        component: CategoriesEdit,
        props: true,
      },
      {
        path: "departments",
        name: "Departments",
        component: DepartmentsIndex,
      },
      {
        path: "departments/create",
        name: "DepartmentsCreate",
        component: DepartmentsCreate,
      },
      {
        path: "departments/:id/edit",
        name: "DepartmentsEdit",
        component: DepartmentsEdit,
        props: true,
      },
      {
        path: "report-email-setting",
        name: "ReportEmailSetting",
        component: ReportEmailSettingIndex,
      },
      {
        path: "users",
        name: "Users",
        component: UsersIndex,
      },
      {
        path: "users/create",
        name: "UsersCreate",
        component: UsersCreate,
      },
    ],
  },

  // Authentication routes
  {
    path: "/auth",
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
