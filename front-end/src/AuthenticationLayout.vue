<template>
  <div class="font-sans text-gray-900 antialiased min-h-screen flex">
    <div class="hidden lg:flex w-1/2 relative bg-gray-900 overflow-hidden">
      <img
        src="https://images.unsplash.com/photo-1586528116311-ad8dd3c8310d?q=80&w=2000&auto=format&fit=crop"
        class="absolute inset-0 h-full w-full object-cover opacity-60"
        alt="Asset Background"
      />
      <div
        class="absolute inset-0 bg-gradient-to-t from-gray-900 via-transparent to-transparent"
      ></div>

      <div class="relative z-10 m-auto text-center px-12">
        <h1
          class="text-5xl font-extrabold text-white tracking-tight drop-shadow-2xl"
        >
          Asset Manager
        </h1>
        <div class="h-1.5 w-24 bg-indigo-500 mx-auto mt-6 rounded-full"></div>
        <p class="mt-6 text-lg text-gray-200 font-medium">
          Streamlining enterprise infrastructure and asset tracking with
          precision.
        </p>
      </div>
    </div>

    <div
      class="w-full lg:w-1/2 flex flex-col justify-center items-center bg-gray-50 dark:bg-gray-950 px-6 relative overflow-hidden"
    >
      <div class="absolute inset-0 lg:hidden">
        <img
          src="https://images.unsplash.com/photo-1586528116311-ad8dd3c8310d?q=80&w=2000&auto=format&fit=crop"
          class="h-full w-full object-cover opacity-20"
        />
      </div>

      <div
        class="z-10 w-full max-w-md p-8 sm:p-10 bg-white/70 dark:bg-gray-900/60 backdrop-blur-xl shadow-2xl rounded-3xl border border-white/20 dark:border-gray-800/50"
      >
        <div class="lg:hidden mb-8 text-center">
          <span
            class="text-2xl font-bold text-gray-900 dark:text-white uppercase tracking-tighter"
            >Asset Manager</span
          >
        </div>

        <router-view />
      </div>
    </div>
  </div>
</template>
<script setup lang="ts"></script>
