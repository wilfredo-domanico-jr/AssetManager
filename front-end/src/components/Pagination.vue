<template>
  <div
    v-if="pagination.total > 0"
    class="flex items-center justify-between border-t border-white/10 px-4 py-3 sm:px-6"
  >
    <div class="flex flex-1 justify-between sm:hidden">
      <button
        @click="changePage(pagination.current_page - 1)"
        :disabled="pagination.current_page === 1"
        class="relative inline-flex items-center rounded-md border border-white/10 bg-white/5 px-4 py-2 text-sm font-medium text-gray-200 hover:bg-white/10 disabled:opacity-50"
      >
        Previous
      </button>
      <button
        @click="changePage(pagination.current_page + 1)"
        :disabled="pagination.current_page === pagination.last_page"
        class="relative ml-3 inline-flex items-center rounded-md border border-white/10 bg-white/5 px-4 py-2 text-sm font-medium text-gray-200 hover:bg-white/10 disabled:opacity-50"
      >
        Next
      </button>
    </div>

    <div class="hidden sm:flex sm:flex-1 sm:items-center sm:justify-between">
      <p class="text-sm text-gray-300">
        Showing <span class="font-medium">{{ pagination.from }}</span> to
        <span class="font-medium">{{ pagination.to }}</span> of
        <span class="font-medium">{{ pagination.total }}</span> results
      </p>

      <nav
        class="isolate inline-flex -space-x-px rounded-md"
        aria-label="Pagination"
      >
        <button
          @click="changePage(pagination.current_page - 1)"
          :disabled="pagination.current_page === 1"
          class="relative inline-flex items-center rounded-l-md px-2 py-2 text-gray-400 ring-1 ring-inset ring-gray-700 hover:bg-white/5 disabled:opacity-50"
        >
          <span class="sr-only">Previous</span>
          <ChevronLeftIcon class="w-5 h-5" aria-hidden="true" />
        </button>

        <button
          v-for="page in pages"
          :key="page"
          @click="changePage(page)"
          :class="pageClass(page)"
        >
          {{ page }}
        </button>

        <button
          @click="changePage(pagination.current_page + 1)"
          :disabled="pagination.current_page === pagination.last_page"
          class="relative inline-flex items-center rounded-r-md px-2 py-2 text-gray-400 ring-1 ring-inset ring-gray-700 hover:bg-white/5 disabled:opacity-50"
        >
          <span class="sr-only">Next</span>
          <ChevronRightIcon class="w-5 h-5" aria-hidden="true" />
        </button>
      </nav>
    </div>
  </div>
</template>

<script setup>
import { ChevronLeftIcon, ChevronRightIcon } from "@heroicons/vue/20/solid";
import { computed } from "vue";

const props = defineProps({
  pagination: {
    type: Object,
    default: () => ({
      current_page: 1,
      per_page: 10,
      total: 0,
      from: 0,
      to: 0,
      last_page: 1,
    }),
  },
});

const emit = defineEmits(["page-changed"]);

// Generate page numbers
const pages = computed(() => {
  const pagesArr = [];
  for (let i = 1; i <= props.pagination.last_page; i++) {
    pagesArr.push(i);
  }
  return pagesArr;
});

// Dynamic classes for current page
const pageClass = (page) => {
  return page === props.pagination.current_page
    ? "relative z-10 inline-flex items-center bg-indigo-500 px-4 py-2 text-sm font-semibold text-white"
    : "relative inline-flex items-center px-4 py-2 text-sm font-semibold text-gray-200 ring-1 ring-inset ring-gray-700 hover:bg-white/5";
};

const changePage = (page) => {
  if (page < 1 || page > props.pagination.last_page) return;
  emit("page-changed", page);
};
</script>
