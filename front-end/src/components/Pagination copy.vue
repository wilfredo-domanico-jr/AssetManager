<template>
  <nav
    v-if="total > 0"
    class="flex flex-col sm:flex-row sm:items-center sm:justify-between mt-6"
    role="navigation"
    aria-label="Pagination Navigation"
  >
    <!-- Info text -->
    <div class="text-sm text-gray-700 dark:text-gray-400 mb-3 sm:mb-0">
      Showing
      <span class="font-medium">{{ from }}</span>
      to
      <span class="font-medium">{{ to }}</span>
      of
      <span class="font-medium">{{ total }}</span>
      results
    </div>

    <!-- Page links -->
    <div>
      <span class="relative z-0 inline-flex shadow-sm rounded-md">
        <!-- Previous -->
        <button
          :disabled="!prevLink"
          @click="handleClick(prevLink)"
          class="relative inline-flex items-center px-2 py-2 text-sm font-medium text-gray-500 bg-white border border-gray-300 rounded-l-md hover:text-gray-400 disabled:cursor-not-allowed disabled:opacity-50 dark:bg-gray-800 dark:border-gray-600 dark:text-gray-300 dark:disabled:text-gray-500"
          aria-label="Previous"
        >
          <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
            <path
              fill-rule="evenodd"
              d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z"
              clip-rule="evenodd"
            ></path>
          </svg>
        </button>

        <!-- Numbered pages -->
        <button
          v-for="link in pageLinks"
          :key="link.label"
          :disabled="link.active"
          @click="handleClick(link)"
          v-html="link.label"
          class="relative inline-flex items-center px-4 py-2 -ml-px text-sm font-medium border border-gray-300 bg-white hover:bg-gray-100 disabled:bg-indigo-600 disabled:text-white disabled:border-indigo-600 dark:bg-gray-800 dark:border-gray-600 dark:text-gray-300 dark:hover:bg-gray-700 dark:disabled:bg-indigo-600 dark:disabled:text-white"
        ></button>

        <!-- Next -->
        <button
          :disabled="!nextLink"
          @click="handleClick(nextLink)"
          class="relative inline-flex items-center px-2 py-2 -ml-px text-sm font-medium text-gray-500 bg-white border border-gray-300 rounded-r-md hover:text-gray-400 disabled:cursor-not-allowed disabled:opacity-50 dark:bg-gray-800 dark:border-gray-600 dark:text-gray-300 dark:disabled:text-gray-500"
          aria-label="Next"
        >
          <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
            <path
              fill-rule="evenodd"
              d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
              clip-rule="evenodd"
            ></path>
          </svg>
        </button>
      </span>
    </div>
  </nav>
</template>

<script setup>
import { computed } from "vue";

const props = defineProps({
  links: { type: Array, default: () => [] },
  from: { type: Number, default: 0 },
  to: { type: Number, default: 0 },
  total: { type: Number, default: 0 },
});

const emit = defineEmits(["page-changed"]);

// Filter only numbered pages
const pageLinks = computed(() =>
  props.links.filter(
    (l) => !["&laquo; Previous", "Next &raquo;"].includes(l.label),
  ),
);

// Previous & Next buttons
const prevLink = computed(() =>
  props.links.find((l) => l.label.includes("Previous")),
);
const nextLink = computed(() =>
  props.links.find((l) => l.label.includes("Next")),
);

// Handle click
const handleClick = (link) => {
  if (!link || !link.url || link.active) return;
  emit("page-changed", link.page);
};
</script>
