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
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            <!-- Header -->
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between mb-6 space-y-2 sm:space-y-0">
                <div>
                    <h2 class="text-2xl font-bold text-gray-800 dark:text-gray-100">Reports</h2>
                    <p class="text-sm text-gray-500 dark:text-gray-400">Generate and export asset reports</p>
                </div>
            </div>

            <!-- Tabs -->
            <div class="flex flex-col sm:flex-row border-b border-gray-200 dark:border-gray-700 mb-4 rounded-lg overflow-hidden">

                <!-- Depreciation Tab -->
                <a href="{{ url('/reporting') }}"
                    class="flex-1 flex items-center justify-center space-x-2 py-2 font-medium border-b sm:border-b-0 sm:border-r border-gray-300 dark:border-gray-700
                    {{ request()->is('reporting') ? 'bg-white text-gray-800' : 'bg-gray-100 dark:bg-gray-800 text-gray-700 dark:text-gray-200 hover:bg-white hover:text-gray-800 transition' }}">
                    <i class="fa-solid fa-coins text-yellow-500"></i>
                    <span>Depreciation</span>
                </a>

                <!-- Inventory Tab -->
                <a href="{{ url('/reporting/inventory') }}"
                    class="flex-1 flex items-center justify-center space-x-2 py-2 font-medium border-b sm:border-b-0 sm:border-r border-gray-300 dark:border-gray-700
                    {{ request()->is('reporting/inventory') ? 'bg-white text-gray-800' : 'bg-gray-100 dark:bg-gray-800 text-gray-700 dark:text-gray-200 hover:bg-white hover:text-gray-800 transition' }}">
                    <i class="fa-solid fa-boxes-stacked text-blue-500"></i>
                    <span>Inventory</span>
                </a>

                <!-- Lifecycle Tab -->
                <a href="{{ url('/reporting/lifecycle') }}"
                    class="flex-1 flex items-center justify-center space-x-2 py-2 font-medium focus:outline-none
                    {{ request()->is('reporting/lifecycle') ? 'bg-white text-gray-800' : 'bg-gray-100 dark:bg-gray-800 text-gray-700 dark:text-gray-200 hover:bg-white hover:text-gray-800 transition' }}">
                    <i class="fa-solid fa-recycle text-green-500"></i>
                    <span>Lifecycle</span>
                </a>
            </div>

            <!-- Depreciation Report Card -->
            <div class="bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-xl p-5 shadow-sm">
                <!-- Header -->
                <div class="flex flex-col sm:flex-row justify-between sm:items-center mb-6 space-y-3 sm:space-y-0">
                    <div>
                        <h2 class="text-xl sm:text-2xl font-bold text-gray-800 dark:text-gray-100">
                            Depreciation Report
                        </h2>
                        <p class="text-sm text-gray-500 dark:text-gray-400">
                            Asset depreciation analysis and book values
                        </p>
                    </div>

                    <!-- Export button -->
                    <button
                        type="button"
                        class="flex items-center justify-center gap-2 bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium px-4 py-2 rounded-lg shadow-sm transition-all dark:bg-blue-500 dark:hover:bg-blue-600 w-full sm:w-auto">
                        <i class="fa-solid fa-download"></i>
                        Export to CSV
                    </button>
                </div>

                <!-- Stat Cards -->
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
                    <!-- Total Purchase Cost -->
                    <div class="bg-gray-50 dark:bg-gray-900 border border-gray-200 dark:border-gray-700 rounded-lg p-4 shadow-sm text-center">
                        <h3 class="text-sm font-medium text-gray-600 dark:text-gray-400 mb-1">Total Purchase Cost</h3>
                        <p class="text-2xl sm:text-3xl font-bold text-gray-800 dark:text-gray-100">₱{{ number_format($totalPurchaseCost, 2) }}</p>
                    </div>

                    <!-- Total Purchase Value -->
                    <div class="bg-gray-50 dark:bg-gray-900 border border-gray-200 dark:border-gray-700 rounded-lg p-4 shadow-sm text-center">
                        <h3 class="text-sm font-medium text-gray-600 dark:text-gray-400 mb-1">Total Purchase Value</h3>
                        <p class="text-2xl sm:text-3xl font-bold text-gray-800 dark:text-gray-100">₱{{ number_format($totalBookValue, 2) }}</p>
                    </div>

                    <!-- Total Depreciation -->
                    <div class="bg-gray-50 dark:bg-gray-900 border border-gray-200 dark:border-gray-700 rounded-lg p-4 shadow-sm text-center">
                        <h3 class="text-sm font-medium text-gray-600 dark:text-gray-400 mb-1">Total Depreciation</h3>
                        <p class="text-2xl sm:text-3xl font-bold text-gray-800 dark:text-gray-100">₱{{ number_format($totalDepreciation, 2) }}</p>
                    </div>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>