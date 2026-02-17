<template>
  <div class="py-8">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
      <SubHeader
        pageName="Assets"
        pageDescription="Manage your inventory and equipment"
      >
        <template #actionLink>
          <router-link
            to="/assets/create"
            class="inline-flex items-center px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white text-sm font-medium rounded-lg shadow-sm transition"
          >
            <i class="fa-solid fa-plus mr-2"></i>
            Add Asset
          </router-link>
        </template>
      </SubHeader>


      
    </div>
  </div>
</template>

<script setup>
import SubHeader from "../../components/SubHeader.vue";
</script>
