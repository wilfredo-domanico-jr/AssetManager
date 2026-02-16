<template>
  <div class="py-8">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
      <!-- Dashboard Header and Add Button -->
      <SubHeader
        pageName="Dashboard"
        pageDescription="Overview of your asset inventory and depreciation"
      />

      <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-5">
        <!-- Card 1 -->
        <div
          class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-100 dark:border-gray-700 p-6 flex justify-between items-center hover:shadow-md transition"
        >
          <div>
            <h3 class="text-sm text-gray-500 dark:text-gray-400">
              Total Assets
            </h3>
            <p class="text-3xl font-bold text-gray-900 dark:text-gray-100 mt-1">
              1
            </p>
            <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">
              Registered Items
            </p>
          </div>
          <div class="text-indigo-500">
            <i class="fa-solid fa-box text-3xl"></i>
          </div>
        </div>

        <!-- Card 2 -->
        <div
          class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-100 dark:border-gray-700 p-6 flex justify-between items-center hover:shadow-md transition"
        >
          <div>
            <h3 class="text-sm text-gray-500 dark:text-gray-400">
              Deployed Asset
            </h3>
            <p class="text-3xl font-bold text-gray-900 dark:text-gray-100 mt-1">
              2
            </p>
            <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">
              Active Deployment
            </p>
          </div>
          <div class="text-green-500">
            <i class="fa-solid fa-truck text-3xl"></i>
          </div>
        </div>

        <!-- Card 3 -->
        <div
          class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-100 dark:border-gray-700 p-6 flex justify-between items-center hover:shadow-md transition"
        >
          <div>
            <h3 class="text-sm text-gray-500 dark:text-gray-400">In stock</h3>
            <p class="text-3xl font-bold text-gray-900 dark:text-gray-100 mt-1">
              3
            </p>
            <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">
              Available items in storage
            </p>
          </div>
          <div class="text-yellow-500">
            <i class="fa-solid fa-boxes-stacked text-3xl"></i>
          </div>
        </div>

        <!-- Card 4 -->
        <div
          class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-100 dark:border-gray-700 p-6 flex justify-between items-center hover:shadow-md transition"
        >
          <div>
            <h3 class="text-sm text-gray-500 dark:text-gray-400">
              Critial Assets
            </h3>
            <p class="text-3xl font-bold text-gray-900 dark:text-gray-100 mt-1">
              4
            </p>
            <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">
              Need Attention
            </p>
          </div>
          <div class="text-red-500">
            <i class="fa-solid fa-triangle-exclamation text-3xl"></i>
          </div>
        </div>
      </div>

      <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-5">
        <div
          class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-100 dark:border-gray-700 p-6 w-full"
        >
          <h3
            class="text-lg font-semibold text-gray-800 mb-4 dark:text-gray-100"
          >
            Asset by Category
          </h3>

          <div
            id="categoryPieChart"
            style="max-width: 450px; margin: auto"
          ></div>
        </div>

        <div
          class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-100 dark:border-gray-700 p-6 w-full"
        >
          <!-- Header -->
          <div class="flex justify-between items-center mb-4">
            <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-100">
              Recent Assets
            </h3>

            <a
              href=""
              class="text-sm text-indigo-600 dark:text-indigo-400 hover:underline"
            >
              View All
            </a>
          </div>

          <!-- Asset List -->
          <div class="divide-y divide-gray-200 dark:divide-gray-700">
            <div
              class="flex justify-between items-center py-4 border-b border-gray-200 dark:border-gray-700"
            >
              <div>
                <p class="font-semibold text-gray-800 dark:text-gray-100">
                  Asset Name
                </p>
                <p class="text-sm text-gray-500 dark:text-gray-400">Category</p>
              </div>

              <div class="flex items-center space-x-3">
                <div class="text-right">
                  <p class="font-semibold text-gray-800 dark:text-gray-100">
                    ₱2
                  </p>
                  <p class="text-xs text-gray-500 dark:text-gray-400">
                    Book Value
                  </p>
                </div>

                <span class="px-3 py-1 rounded-full text-xs font-medium">
                  Condition
                </span>
              </div>
            </div>

            <div class="text-center py-8 text-gray-500 dark:text-gray-400">
              No recent asset
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
import SubHeader from "../components/SubHeader.vue";



</script>
