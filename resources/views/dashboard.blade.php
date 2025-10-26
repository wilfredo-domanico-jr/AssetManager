<x-app-layout>
    <x-slot name="header">
        <div>
            <h2 class="text-2xl font-bold text-gray-800 dark:text-gray-100">
                Asset Manager
            </h2>
            <p class="text-sm text-gray-500 dark:text-gray-400">
                Track and manage your equipment assets
            </p>



        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <!-- Dashboard Header and Add Button -->
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between mb-6">
                <div>
                    <h2 class="text-2xl font-bold text-gray-800 dark:text-gray-100">Dashboard</h2>
                    <p class="text-sm text-gray-500 dark:text-gray-400">Overview of your asset inventory and depreciation</p>
                </div>

            </div>

            <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-5">

                <!-- Card 1 -->
                <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-100 dark:border-gray-700 p-6 flex justify-between items-center hover:shadow-md transition">
                    <div>
                        <h3 class="text-sm text-gray-500 dark:text-gray-400">Total Assets</h3>
                        <p class="text-3xl font-bold text-gray-900 dark:text-gray-100 mt-1">3</p>
                        <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">Registered Items</p>
                    </div>
                    <div class="text-indigo-500">
                        <i class="fa-solid fa-box text-3xl"></i>
                    </div>
                </div>

                <!-- Card 2 -->
                <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-100 dark:border-gray-700 p-6 flex justify-between items-center hover:shadow-md transition">
                    <div>
                        <h3 class="text-sm text-gray-500 dark:text-gray-400">Deployed Asset</h3>
                        <p class="text-3xl font-bold text-gray-900 dark:text-gray-100 mt-1">3</p>
                        <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">Active Deployment</p>
                    </div>
                    <div class="text-green-500">
                        <i class="fa-solid fa-truck text-3xl"></i>
                    </div>
                </div>

                <!-- Card 3 -->
                <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-100 dark:border-gray-700 p-6 flex justify-between items-center hover:shadow-md transition">
                    <div>
                        <h3 class="text-sm text-gray-500 dark:text-gray-400">In stock</h3>
                        <p class="text-3xl font-bold text-gray-900 dark:text-gray-100 mt-1">1</p>
                        <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">Available items in storage</p>
                    </div>
                    <div class="text-yellow-500">
                        <i class="fa-solid fa-boxes-stacked text-3xl"></i>
                    </div>
                </div>


                <!-- Card 4 -->
                <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-100 dark:border-gray-700 p-6 flex justify-between items-center hover:shadow-md transition">
                    <div>
                        <h3 class="text-sm text-gray-500 dark:text-gray-400">Critial Assets</h3>
                        <p class="text-3xl font-bold text-gray-900 dark:text-gray-100 mt-1">1</p>
                        <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">Need Attention</p>
                    </div>
                    <div class="text-red-500">
                        <i class="fa-solid fa-triangle-exclamation text-3xl"></i>
                    </div>
                </div>

            </div>



            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-5">

                <!-- Card 1 -->
                <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-100 dark:border-gray-700 p-6 flex justify-between items-center hover:shadow-md transition">
                    <div>
                        <h3 class="text-sm text-gray-500 dark:text-gray-400">Assets by Category</h3>
                        <p class="text-lg font-bold text-gray-900 dark:text-gray-100 mt-1">Mouse</p>
                    </div>
                    <!-- Number in bordered box -->
                    <div class="flex items-center justify-center w-14 h-14 border-2 border-purple-500 rounded-xl text-purple-600 font-bold text-2xl">
                        3
                    </div>
                </div>

                <!-- Card 2 -->
                <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-100 dark:border-gray-700 p-6 flex justify-between items-center hover:shadow-md transition">
                    <div>
                        <h3 class="text-sm text-gray-500 dark:text-gray-400">Assets by Condition</h3>
                        <p class="text-lg font-bold text-gray-900 dark:text-gray-100 mt-1">Excellent</p>
                    </div>
                    <!-- Number in bordered box -->
                    <div class="flex items-center justify-center w-14 h-14 border-2 border-teal-500 rounded-xl text-teal-600 font-bold text-2xl">
                        3
                    </div>
                </div>


            </div>




            <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-100 dark:border-gray-700 p-6 w-full">
                <!-- Header -->
                <div class="flex justify-between items-center mb-4">
                    <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-100">Recent Assets</h3>
                    <a href="{{ route('assets.index') }}" class="text-sm text-indigo-600 dark:text-indigo-400 hover:underline">
                        View All
                    </a>
                </div>

                <!-- Asset List -->
                <div class="divide-y divide-gray-200 dark:divide-gray-700">
                    <!-- Asset Row -->
                    <div class="flex justify-between items-center py-4">
                        <div>
                            <p class="font-semibold text-gray-800 dark:text-gray-100">IVT0001</p>
                            <p class="text-sm text-gray-500 dark:text-gray-400">Mouse</p>
                        </div>

                        <div class="flex items-center space-x-3">
                            <div class="text-right">
                                <p class="font-semibold text-gray-800 dark:text-gray-100">₱1,000.00</p>
                                <p class="text-xs text-gray-500 dark:text-gray-400">Book Value</p>
                            </div>
                            <span class="px-3 py-1 rounded-full bg-green-100 text-green-700 text-xs font-medium">
                                Active
                            </span>
                        </div>
                    </div>

                    <!-- Asset Row -->
                    <div class="flex justify-between items-center py-4">
                        <div>
                            <p class="font-semibold text-gray-800 dark:text-gray-100">IVT0002</p>
                            <p class="text-sm text-gray-500 dark:text-gray-400">Mouse</p>
                        </div>

                        <div class="flex items-center space-x-3">
                            <div class="text-right">
                                <p class="font-semibold text-gray-800 dark:text-gray-100">₱1,000.00</p>
                                <p class="text-xs text-gray-500 dark:text-gray-400">Book Value</p>
                            </div>
                            <span class="px-3 py-1 rounded-full bg-green-100 text-green-700 text-xs font-medium">
                                Active
                            </span>
                        </div>
                    </div>

                    <!-- Asset Row -->
                    <div class="flex justify-between items-center py-4">
                        <div>
                            <p class="font-semibold text-gray-800 dark:text-gray-100">IVT0003</p>
                            <p class="text-sm text-gray-500 dark:text-gray-400">Mouse</p>
                        </div>

                        <div class="flex items-center space-x-3">
                            <div class="text-right">
                                <p class="font-semibold text-gray-800 dark:text-gray-100">₱0.00</p>
                                <p class="text-xs text-gray-500 dark:text-gray-400">Book Value</p>
                            </div>
                            <span class="px-3 py-1 rounded-full bg-gray-200 text-gray-700 text-xs font-medium">
                                Fully Depreciated
                            </span>
                        </div>
                    </div>
                </div>
            </div>



        </div>
    </div>
</x-app-layout>