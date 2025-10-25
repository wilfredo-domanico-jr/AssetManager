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


            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between mb-6">
                <div>
                    <h2 class="text-2xl font-bold text-gray-800 dark:text-gray-100">Assets</h2>
                    <p class="text-sm text-gray-500 dark:text-gray-400">Manage your inventory and equipment</p>
                </div>

                <a href="{{ url('/assets/create') }}"
                    class="inline-flex items-center mt-4 sm:mt-0 px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white text-sm font-medium rounded-lg shadow-sm transition">
                    <i class="fa-solid fa-plus mr-2"></i>
                    Add Asset
                </a>
            </div>


            <div class="flex flex-col md:flex-row md:items-center md:space-x-4 space-y-2 md:space-y-0 w-full mb-6">

                <!-- Search Field -->
                <div class="relative w-full md:w-[35%]">
                    <input type="text" name="search" placeholder="Search assets..."
                        class="w-full pl-10 pr-4 py-2 border border-gray-300 dark:border-gray-700 rounded-lg shadow-sm 
                   focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 
                   dark:bg-gray-800 dark:text-gray-100">
                    <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                        <i class="fa-solid fa-magnifying-glass text-gray-400 dark:text-gray-300"></i>
                    </div>
                </div>

                <!-- Dropdown 1: Category -->
                <div class="relative w-full md:w-[20%]">
                    <select name="category"
                        class="w-full px-4 py-2 border border-gray-300 dark:border-gray-700 rounded-lg shadow-sm 
                   focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 
                   dark:bg-gray-800 dark:text-gray-100 appearance-none">
                        <option value="" selected>All Categories</option>
                        <option value="ppe">PPE</option>
                        <option value="small-tools">Small Tools</option>
                    </select>
                    <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center pr-3">
                        <i class="fa-solid fa-chevron-down text-gray-400 dark:text-gray-300"></i>
                    </div>
                </div>

                <!-- Dropdown 2: Location -->
                <div class="w-full md:w-[22%]">
                    <select name="location"
                        class="w-full px-4 py-2 border border-gray-300 dark:border-gray-700 rounded-lg shadow-sm 
                   focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 
                   dark:bg-gray-800 dark:text-gray-100">
                        <option value="">All Locations</option>
                        <option value="main-office">Main Office</option>
                        <option value="warehouse-1">Warehouse 1</option>
                        <option value="warehouse-2">Warehouse 2</option>
                    </select>
                </div>

                <!-- Dropdown 3: Condition -->
                <div class="w-full md:w-[23%]">
                    <select name="condition"
                        class="w-full px-4 py-2 border border-gray-300 dark:border-gray-700 rounded-lg shadow-sm 
                   focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 
                   dark:bg-gray-800 dark:text-gray-100">
                        <option value="">All Conditions</option>
                        <option value="excellent">Excellent</option>
                        <option value="good">Good</option>
                        <option value="needs-repair">Needs Repair</option>
                    </select>
                </div>

            </div>



            <div class="bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-xl shadow-sm p-4 space-y-4">

                <!-- Inner Card 1 -->
                <div class="bg-gray-50 dark:bg-gray-900 border border-gray-200 dark:border-gray-700 rounded-lg p-4 shadow-inner">
                    <div class="flex justify-between items-start mb-6">
                        <div>
                            <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-100">ITV0001</h3>
                            <div class="flex flex-wrap gap-2 mt-1">
                                <span class="px-3 py-1 rounded-full bg-gray-100 text-gray-700 text-xs font-medium">Mouse</span>
                                <span class="px-3 py-1 rounded-full bg-green-100 text-green-700 text-xs font-medium">Excellent</span>
                                <span class="px-3 py-1 rounded-full bg-blue-100 text-blue-700 text-xs font-medium">Active</span>
                            </div>
                        </div>
                        <div class="flex space-x-3 text-gray-500 dark:text-gray-300">
                            <i class="fa-solid fa-pen hover:text-blue-500 cursor-pointer"></i>
                            <i class="fa-solid fa-trash hover:text-red-500 cursor-pointer"></i>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-6">
                        <div>
                            <span class="text-md text-gray-600 dark:text-gray-400 block">Purchase Cost</span>
                            <p class="text-sm font-medium text-gray-800 dark:text-gray-200">₱1,000.00</p>
                        </div>

                        <div>
                            <span class="text-md text-gray-600 dark:text-gray-400 block">Book Value</span>
                            <p class="text-sm font-medium text-gray-800 dark:text-gray-200">₱1,000.00</p>
                        </div>

                        <div>
                            <span class="text-md text-gray-600 dark:text-gray-400 block">Age</span>
                            <p class="text-sm font-medium text-gray-800 dark:text-gray-200">0.0 years</p>
                        </div>

                        <div>
                            <span class="text-md text-gray-600 dark:text-gray-400 block">Location</span>
                            <p class="text-sm font-medium text-gray-800 dark:text-gray-200">Main Office</p>
                        </div>
                    </div>
                </div>

                <!-- Inner Card 1 -->
                <div class="bg-gray-50 dark:bg-gray-900 border border-gray-200 dark:border-gray-700 rounded-lg p-4 shadow-inner">
                    <div class="flex justify-between items-start mb-6">
                        <div>
                            <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-100">ITV0001</h3>
                            <div class="flex flex-wrap gap-2 mt-1">
                                <span class="px-3 py-1 rounded-full bg-gray-100 text-gray-700 text-xs font-medium">Mouse</span>
                                <span class="px-3 py-1 rounded-full bg-green-100 text-green-700 text-xs font-medium">Excellent</span>
                                <span class="px-3 py-1 rounded-full bg-blue-100 text-blue-700 text-xs font-medium">Active</span>
                            </div>
                        </div>
                        <div class="flex space-x-3 text-gray-500 dark:text-gray-300">
                            <i class="fa-solid fa-pen hover:text-blue-500 cursor-pointer"></i>
                            <i class="fa-solid fa-trash hover:text-red-500 cursor-pointer"></i>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-6">
                        <div>
                            <span class="text-md text-gray-600 dark:text-gray-400 block">Purchase Cost</span>
                            <p class="text-sm font-medium text-gray-800 dark:text-gray-200">₱1,000.00</p>
                        </div>

                        <div>
                            <span class="text-md text-gray-600 dark:text-gray-400 block">Book Value</span>
                            <p class="text-sm font-medium text-gray-800 dark:text-gray-200">₱1,000.00</p>
                        </div>

                        <div>
                            <span class="text-md text-gray-600 dark:text-gray-400 block">Age</span>
                            <p class="text-sm font-medium text-gray-800 dark:text-gray-200">0.0 years</p>
                        </div>

                        <div>
                            <span class="text-md text-gray-600 dark:text-gray-400 block">Location</span>
                            <p class="text-sm font-medium text-gray-800 dark:text-gray-200">Main Office</p>
                        </div>
                    </div>
                </div>


                

            </div>




        </div>
    </div>



</x-app-layout>