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

    <div class="py-6 sm:py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            <!-- Header -->
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between mb-6 space-y-2 sm:space-y-0">
                <div>
                    <h2 class="text-xl sm:text-2xl font-bold text-gray-800 dark:text-gray-100">Reports</h2>
                    <p class="text-sm text-gray-500 dark:text-gray-400">Generate and export asset reports</p>
                </div>
            </div>

          
            <!-- Tabs -->
            <div class="flex flex-col sm:flex-row border-b border-gray-200 dark:border-gray-700 mb-4 rounded-lg overflow-hidden">

                <!-- Depreciation Tab -->
                <a href="{{ url('/reports') }}"
                    class="flex-1 flex items-center justify-center space-x-2 py-2 font-medium border-b sm:border-b-0 sm:border-r border-gray-300 dark:border-gray-700
                    {{ request()->is('reports') ? 'bg-white text-gray-800' : 'bg-gray-100 dark:bg-gray-800 text-gray-700 dark:text-gray-200 hover:bg-white hover:text-gray-800 transition' }}">
                    <i class="fa-solid fa-coins text-yellow-500"></i>
                    <span>Depreciation</span>
                </a>

                <!-- Inventory Tab -->
                <a href="{{ url('/reports/inventory') }}"
                    class="flex-1 flex items-center justify-center space-x-2 py-2 font-medium border-b sm:border-b-0 sm:border-r border-gray-300 dark:border-gray-700
                    {{ request()->is('reports/inventory') ? 'bg-white text-gray-800' : 'bg-gray-100 dark:bg-gray-800 text-gray-700 dark:text-gray-200 hover:bg-white hover:text-gray-800 transition' }}">
                    <i class="fa-solid fa-boxes-stacked text-blue-500"></i>
                    <span>Inventory</span>
                </a>

                <!-- Lifecycle Tab -->
                <a href="{{ url('/reports/lifecycle') }}"
                    class="flex-1 flex items-center justify-center space-x-2 py-2 font-medium focus:outline-none
                    {{ request()->is('reports/lifecycle') ? 'bg-white text-gray-800' : 'bg-gray-100 dark:bg-gray-800 text-gray-700 dark:text-gray-200 hover:bg-white hover:text-gray-800 transition' }}">
                    <i class="fa-solid fa-recycle text-green-500"></i>
                    <span>Lifecycle</span>
                </a>
            </div>

           
            <div class="bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-xl p-5 shadow-sm">
                <!-- Header -->
                <div class="flex flex-col sm:flex-row justify-between sm:items-center mb-6 space-y-3 sm:space-y-0">
                    <div>
                        <h2 class="text-xl sm:text-2xl font-bold text-gray-800 dark:text-gray-100">
                           Inventory Summary Report
                        </h2>
                        <p class="text-sm text-gray-500 dark:text-gray-400">
                             Complete asset inventory with current values
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

                <!-- Inner Card 1 -->
                <div class="bg-gray-50 dark:bg-gray-900 border border-gray-200 dark:border-gray-700 rounded-lg p-4 shadow-inner mb-3">
                    <div class="flex justify-between items-start mb-6">
                        <div>
                            <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-100">ITV0001</h3>
                            <p class="text-sm text-gray-600 dark:text-gray-400">
                                Freyfil
                            </p>
                        </div>
                        <div class="flex space-x-2">
                            <span class="px-3 py-1 rounded-full bg-gray-100 text-gray-700 text-xs font-medium">
                                Mouse
                            </span>
                            <span class="px-3 py-1 rounded-full bg-green-100 text-green-700 text-xs font-medium">
                                Excellent
                            </span>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-6">
                        <div>
                            <span class="text-md text-gray-600 dark:text-gray-400 block">Location</span>
                            <p class="text-sm font-medium text-gray-800 dark:text-gray-200">Main Office</p>
                        </div>

                        <div>
                            <span class="text-md text-gray-600 dark:text-gray-400 block">Purchase Date</span>
                            <p class="text-sm font-medium text-gray-800 dark:text-gray-200">16/10/2025</p>
                        </div>

                        <div>
                            <span class="text-md text-gray-600 dark:text-gray-400 block">Original Cost</span>
                            <p class="text-sm font-medium text-gray-800 dark:text-gray-200">₱1,000.00</p>
                        </div>

                        <div>
                            <span class="text-md text-gray-600 dark:text-gray-400 block">Current Value</span>
                            <p class="text-sm font-medium text-gray-800 dark:text-gray-200">₱1,000.00</p>
                        </div>
                    </div>
                </div>

                  <!-- Inner Card 2 -->
                <div class="bg-gray-50 dark:bg-gray-900 border border-gray-200 dark:border-gray-700 rounded-lg p-4 shadow-inner mb-3">
                    <div class="flex justify-between items-start mb-6">
                        <div>
                            <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-100">ITV0001</h3>
                            <p class="text-sm text-gray-600 dark:text-gray-400">
                                Freyfil
                            </p>
                        </div>
                        <div class="flex space-x-2">
                            <span class="px-3 py-1 rounded-full bg-gray-100 text-gray-700 text-xs font-medium">
                                Mouse
                            </span>
                            <span class="px-3 py-1 rounded-full bg-green-100 text-green-700 text-xs font-medium">
                                Excellent
                            </span>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-6">
                        <div>
                            <span class="text-md text-gray-600 dark:text-gray-400 block">Location</span>
                            <p class="text-sm font-medium text-gray-800 dark:text-gray-200">Main Office</p>
                        </div>

                        <div>
                            <span class="text-md text-gray-600 dark:text-gray-400 block">Purchase Date</span>
                            <p class="text-sm font-medium text-gray-800 dark:text-gray-200">16/10/2025</p>
                        </div>

                        <div>
                            <span class="text-md text-gray-600 dark:text-gray-400 block">Original Cost</span>
                            <p class="text-sm font-medium text-gray-800 dark:text-gray-200">₱1,000.00</p>
                        </div>

                        <div>
                            <span class="text-md text-gray-600 dark:text-gray-400 block">Current Value</span>
                            <p class="text-sm font-medium text-gray-800 dark:text-gray-200">₱1,000.00</p>
                        </div>
                    </div>
                </div>


            </div>

        </div>
    </div>
</x-app-layout>
