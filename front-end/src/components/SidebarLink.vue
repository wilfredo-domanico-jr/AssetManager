<template>
  <router-link
    :to="{ name: routeName }"
    class="flex items-center gap-3 px-3 py-2 rounded-md text-gray-700 dark:text-gray-200 hover:bg-gray-200 dark:hover:bg-gray-700"
    :class="{ 'bg-gray-200 dark:bg-gray-700 font-semibold': isActive }"
  >
    <i :class="`fa-solid ${icon} text-gray-500 dark:text-gray-300`"></i>
    <span>{{ label }}</span>
  </router-link>
</template>

<script setup>
import { computed } from "vue";
import { useRoute } from "vue-router";

const props = defineProps({
  icon: String,
  label: String,
  routeName: String,
});

const route = useRoute();

const isActive = computed(() => route.name === props.routeName);
</script>
