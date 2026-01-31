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
                        <p class="text-3xl font-bold text-gray-900 dark:text-gray-100 mt-1">{{$totalAssets}}</p>
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
                        <p class="text-3xl font-bold text-gray-900 dark:text-gray-100 mt-1">{{$deployedAssets}}</p>
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
                        <p class="text-3xl font-bold text-gray-900 dark:text-gray-100 mt-1">{{$inStockAssets}}</p>
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
                        <p class="text-3xl font-bold text-gray-900 dark:text-gray-100 mt-1">{{$criticalAsset}}</p>
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
                        <p class="text-lg font-bold text-gray-900 dark:text-gray-100 mt-1">{{ $highestByCategory->category_name ?? 'N/A' }}</p>

                    </div>
                    <!-- Number in bordered box -->
                    <div class="flex items-center justify-center w-14 h-14 border-2 border-purple-500 rounded-xl text-purple-600 font-bold text-2xl">
                        {{ $highestByCategory->total ?? 0 }}
                    </div>
                </div>

                <!-- Card 2 -->
                <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-100 dark:border-gray-700 p-6 flex justify-between items-center hover:shadow-md transition">
                    <div>
                        <h3 class="text-sm text-gray-500 dark:text-gray-400">Assets by Condition</h3>
                        <p class="text-lg font-bold text-gray-900 dark:text-gray-100 mt-1">{{$highestCondition->condition ?? 'N/A' }}</p>
                    </div>
                    <!-- Number in bordered box -->
                    <div class="flex items-center justify-center w-14 h-14 border-2 border-teal-500 rounded-xl text-teal-600 font-bold text-2xl">
                        {{$highestCondition->total ?? 0 }}
                    </div>
                </div>


            </div>


            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-5">

                <!-- Card 1 -->
                <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-100 dark:border-gray-700 p-6 flex justify-between items-center hover:shadow-md transition">
                    <div id="invStatusChart" style="width: 100%;"></div>
                </div>

                <!-- Card 2 -->
                <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-100 dark:border-gray-700 p-6 flex justify-between items-center hover:shadow-md transition">

                </div>


            </div>




            <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-100 dark:border-gray-700 p-6 w-full">
                <!-- Header -->
                <div class="flex justify-between items-center mb-4">
                    <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-100">Recent Assets</h3>

                    @if ($recentAssets->isNotEmpty())
                    <a href="{{ route('assets.index') }}" class="text-sm text-indigo-600 dark:text-indigo-400 hover:underline">
                        View All
                    </a>
                    @endif
                </div>

                <!-- Asset List -->
                <div class="divide-y divide-gray-200 dark:divide-gray-700">
                    @if ($recentAssets->isNotEmpty())
                    @foreach ($recentAssets as $asset)
                    <div class="flex justify-between items-center py-4 border-b border-gray-200 dark:border-gray-700">
                        <div>
                            <p class="font-semibold text-gray-800 dark:text-gray-100">{{ $asset->asset_name ?? 'N/A' }}</p>
                            <p class="text-sm text-gray-500 dark:text-gray-400">{{ $asset->category->name ?? 'No category' }}</p>
                        </div>

                        <div class="flex items-center space-x-3">
                            <div class="text-right">
                                <p class="font-semibold text-gray-800 dark:text-gray-100">

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

                                    ₱{{ number_format($bookValue, 2) }}
                                </p>
                                <p class="text-xs text-gray-500 dark:text-gray-400">Book Value</p>
                            </div>

                            <span class="px-3 py-1 rounded-full text-xs font-medium
                            @if ($asset->condition == 'Excellent')
                                bg-green-100 text-green-700
                            @elseif ($asset->condition == 'Good')
                                bg-blue-100 text-blue-700
                            @elseif ($asset->condition == 'Needs Repair')
                                bg-yellow-100 text-yellow-700
                            @else
                                bg-gray-100 text-gray-700
                            @endif">
                                {{ $asset->condition ?? 'Unknown' }}
                            </span>
                        </div>
                    </div>
                    @endforeach
                    @else
                    <div class="text-center py-8 text-gray-500 dark:text-gray-400">
                        No recent asset
                    </div>
                    @endif
                </div>
            </div>




        </div>
    </div>


    <script>
        var invStatusOptions = {
            chart: {
                type: 'donut',
                width: '100%',
                height: 350
            },
            series: [30, 40, 35, 50, 49],
            labels: ['Deployed', 'Available', 'Maintenance', 'Retired'],
            legend: {
                position: 'bottom'
            },
            dataLabels: {
                enabled: true
            },
            plotOptions: {
                pie: {
                    donut: {
                        size: '60%',
                        labels: {
                            show: true,
                            total: {
                                show: true,
                                label: 'Total',
                                fontSize: '16px'
                            }
                        }
                    }
                }
            }
        };

        var invStatusChart = new ApexCharts(
            document.querySelector("#invStatusChart"),
            invStatusOptions
        );

        invStatusChart.render();
    </script>
</x-app-layout>