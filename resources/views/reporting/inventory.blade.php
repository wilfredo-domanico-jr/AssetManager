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
                    <a
                        href="/export-inventory-summary-csv"
                        class="flex items-center justify-center gap-2 bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium px-4 py-2 rounded-lg shadow-sm transition-all dark:bg-blue-500 dark:hover:bg-blue-600 w-full sm:w-auto">
                        <i class="fa-solid fa-download"></i>
                        Export to CSV
                    </a>
                </div>

                @forelse ($assets as $asset)

                <!-- Inner Card 1 -->
                <div class="bg-gray-50 dark:bg-gray-900 border border-gray-200 dark:border-gray-700 rounded-lg p-4 shadow-inner mb-3">
                    <div class="flex justify-between items-start mb-6">
                        <div>
                            <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-100">{{$asset->asset_name}}</h3>
                            <p class="text-sm text-gray-600 dark:text-gray-400">
                                {{$asset->supplier}}
                            </p>
                        </div>
                        <div class="flex space-x-2">
                            <span class="px-3 py-1 rounded-full bg-gray-100 text-gray-700 text-xs font-medium">

                                {{ $asset->category->name ?? 'Not Available' }}
                            </span>
                            <span class="px-3 py-1 rounded-full 
                                        @if($asset->condition == 'Excellent') bg-green-100 text-green-700
                                        @elseif($asset->condition == 'Good') bg-blue-100 text-blue-700
                                        @else bg-yellow-100 text-yellow-700 @endif
                                        text-xs font-medium">
                                {{ $asset->condition ?? 'Unknown' }}
                            </span>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-6">
                        <div>
                            <span class="text-md text-gray-600 dark:text-gray-400 block">Department</span>
                            <p class="text-sm font-medium text-gray-800 dark:text-gray-200">{{ $asset->department->name ?? 'N/A' }}</p>
                        </div>

                        <div>
                            <span class="text-md text-gray-600 dark:text-gray-400 block">Purchase Date</span>
                            <p class="text-sm font-medium text-gray-800 dark:text-gray-200">{{ $asset->purchase_date->format('d/m/Y') }}</p>
                        </div>

                        <div>
                            <span class="text-md text-gray-600 dark:text-gray-400 block">Original Cost</span>
                            <p class="text-sm font-medium text-gray-800 dark:text-gray-200">₱{{number_format($asset->purchase_cost,2)}}</p>
                        </div>

                        <div>
                            <span class="text-md text-gray-600 dark:text-gray-400 block">Current Value</span>

                            @php

                            $purchaseCost = $asset->purchase_cost ?? 0;

                            $purchaseCost = $asset->purchase_cost ?? 0;
                            $usefulLife = $asset->useful_life ?? 1; // prevent divide by zero

                            // Parse the purchase date safely
                            $purchaseDate = $asset->purchase_date ? \Carbon\Carbon::parse($asset->purchase_date) : null;

                            // Ensure monthsUsed is always positive
                            $monthsUsed = $purchaseDate ? $purchaseDate->diffInMonths(\Carbon\Carbon::now()) : 0;

                            // Convert to years (decimal, not rounded)
                            $yearsUsed = $monthsUsed / 12;

                            // Straight-line depreciation
                            $depreciationPerYear = $purchaseCost / $usefulLife;
                            $bookValue = max($purchaseCost - ($depreciationPerYear * $yearsUsed), 0);
                            @endphp

                            <p class="text-sm font-medium text-gray-800 dark:text-gray-200">₱{{number_format($bookValue,2)}}</p>
                        </div>
                    </div>
                </div>

                @empty
                <div class="text-center text-gray-500 dark:text-gray-400 py-10">
                    <i class="fa-solid fa-box-open text-4xl mb-3"></i>
                    <p>No assets found.</p>
                </div>
                @endforelse

                {{ $assets->appends(request()->query())->links() }}





            </div>

        </div>
    </div>
</x-app-layout>