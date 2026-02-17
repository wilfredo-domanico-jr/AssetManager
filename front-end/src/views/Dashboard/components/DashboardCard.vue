<template>
  <div
    class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-100 dark:border-gray-700 p-6 flex justify-between items-center hover:shadow-md transition"
  >
    <div>
      <h3 class="text-sm text-gray-500 dark:text-gray-400">{{ title }}</h3>
      <p class="text-3xl font-bold text-gray-900 dark:text-gray-100 mt-1">
        {{ value }}
      </p>
      <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">
        {{ subtitle }}
      </p>
    </div>
    <div :class="iconColor">
      <i :class="`fa-solid ${icon} text-3xl`"></i>
    </div>
  </div>
</template>

<script>
export default {
  name: "DashboardCard",
  props: {
    title: { type: String, required: true },
    value: { type: Number, default: 0 },
    subtitle: { type: String, default: "" },
    icon: { type: String, default: "fa-box" },
    iconColor: { type: String, default: "text-indigo-500" },
  },
};
</script>
