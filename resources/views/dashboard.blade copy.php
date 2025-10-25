<x-app-layout>
    <x-slot name="header">
        <div>
            <h2 class="text-2xl font-bold text-gray-800 dark:text-gray-100">
                Computer Store Inventory
            </h2>
            <p class="text-sm text-gray-500 dark:text-gray-400">
                Track and manage your equipment assets
            </p>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

                <!-- Card 1 -->
                <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-100 dark:border-gray-700 p-6 flex justify-between items-center hover:shadow-md transition">
                    <div>
                        <h3 class="text-sm text-gray-500 dark:text-gray-400">Total Assets</h3>
                        <p class="text-3xl font-bold text-gray-900 dark:text-gray-100 mt-1">7</p>
                        <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">$34,197.99 total</p>
                    </div>
                    <div class="text-indigo-500">
                        <i class="fa-solid fa-box text-3xl"></i>
                    </div>
                </div>

                <!-- Card 2 -->
                <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-100 dark:border-gray-700 p-6 flex justify-between items-center hover:shadow-md transition">
                    <div>
                        <h3 class="text-sm text-gray-500 dark:text-gray-400">Deployed Assets</h3>
                        <p class="text-3xl font-bold text-gray-900 dark:text-gray-100 mt-1">2</p>
                        <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">$2,898.99 total</p>
                    </div>
                    <div class="text-blue-500">
                        <i class="fa-solid fa-box-open text-3xl"></i>
                    </div>
                </div>

                <!-- Card 3 -->
                <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-100 dark:border-gray-700 p-6 flex justify-between items-center hover:shadow-md transition">
                    <div>
                        <h3 class="text-sm text-gray-500 dark:text-gray-400">In Stock</h3>
                        <p class="text-3xl font-bold text-gray-900 dark:text-gray-100 mt-1">5</p>
                        <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">$31,299.00 total</p>
                    </div>
                    <div class="text-green-500">
                        <i class="fa-solid fa-cubes text-3xl"></i>
                    </div>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>
