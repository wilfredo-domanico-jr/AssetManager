// === IMPORTS ===
import { createRouter, createWebHistory } from "vue-router";
import { useAuthStore } from "../store/auth";
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

// === REPORTS ===

import DepreciationReportIndex from "../views/Reports/Depreciation/Index.vue";

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
        path: "depreciation",
        name: "DepreciationReport",
        component: DepreciationReportIndex,
      },
      {
        path: "categories",
        name: "Categories",
        component: CategoriesIndex,
        meta: { requiresAdmin: true },
      },
      {
        path: "categories/create",
        name: "CategoriesCreate",
        component: CategoriesCreate,
        meta: { requiresAdmin: true },
      },
      {
        path: "categories/:id/edit",
        name: "CategoriesEdit",
        component: CategoriesEdit,
        props: true,
        meta: { requiresAdmin: true },
      },
      {
        path: "departments",
        name: "Departments",
        component: DepartmentsIndex,
        meta: { requiresAdmin: true },
      },
      {
        path: "departments/create",
        name: "DepartmentsCreate",
        component: DepartmentsCreate,
        meta: { requiresAdmin: true },
      },
      {
        path: "departments/:id/edit",
        name: "DepartmentsEdit",
        component: DepartmentsEdit,
        props: true,
        meta: { requiresAdmin: true },
      },
      {
        path: "report-email-setting",
        name: "ReportEmailSetting",
        component: ReportEmailSettingIndex,
        meta: { requiresAdmin: true },
      },
      {
        path: "users",
        name: "Users",
        component: UsersIndex,
        meta: { requiresAdmin: true },
      },
      {
        path: "users/create",
        name: "UsersCreate",
        component: UsersCreate,
        meta: { requiresAdmin: true },
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

router.beforeEach(async (to, from, next) => {
  const auth = useAuthStore();

  // Check admin-only routes
  if (to.meta.requiresAdmin && auth.user?.role !== "Admin") {
    // Optionally redirect to dashboard or show a 403 page
    return next({ name: "Dashboard" });
  }

  next();
});

export default router;
