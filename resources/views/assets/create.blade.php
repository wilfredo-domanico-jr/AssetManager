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
                    <h2 class="text-2xl font-bold text-gray-800 dark:text-gray-100">Add New Asset</h2>
                    <p class="text-sm text-gray-500 dark:text-gray-400"> Fill out the details to register a new equipment asset</p>
                </div>
            </div>



            <div class="bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-xl shadow-sm p-6 space-y-6">

                <form id="addAssetForm" class="space-y-6" method="POST" action="{{ route('assets.store') }}" enctype="multipart/form-data">
                    @csrf
                    <!-- Grid Container -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <!-- Asset Name -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Asset Name</label>
                            <input type="text" name="asset_name" placeholder="e.g., ITV0002"
                                value="{{ old('asset_name') }}"
                                class="mt-1 w-full p-2 border border-gray-300 dark:border-gray-700 rounded-lg 
                dark:bg-gray-900 dark:text-gray-100 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">
                            @error('asset_name')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Category -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Category</label>
                            <select name="category"
                                class="mt-1 w-full p-2 border border-gray-300 dark:border-gray-700 rounded-lg 
                dark:bg-gray-900 dark:text-gray-100 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">
                                <option value="" selected>Select Category</option>
                                @foreach ($categories as $category)
                                <option value="{{ $category->id }}" {{ old('category') == $category->id ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                                @endforeach
                            </select>
                            @error('category')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Department -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Department</label>
                            <select name="department"
                                class="mt-1 w-full p-2 border border-gray-300 dark:border-gray-700 rounded-lg 
                dark:bg-gray-900 dark:text-gray-100 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">
                                <option value="" selected>Select Department</option>
                                @foreach ($departments as $department)
                                <option value="{{ $department->id }}" {{ old('department') == $department->id ? 'selected' : '' }}>
                                    {{ $department->name }}
                                </option>
                                @endforeach
                            </select>
                            @error('department')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Purchase Date -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Purchase Date</label>
                            <input type="date" name="purchase_date"
                                value="{{ old('purchase_date') }}"
                                class="mt-1 w-full p-2 border border-gray-300 dark:border-gray-700 rounded-lg 
                dark:bg-gray-900 dark:text-gray-100 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">
                            @error('purchase_date')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Purchase Cost -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Purchase Cost (₱)</label>
                            <input type="number" name="purchase_cost" placeholder="0.00"
                                value="{{ old('purchase_cost') }}"
                                class="mt-1 w-full p-2 border border-gray-300 dark:border-gray-700 rounded-lg 
                dark:bg-gray-900 dark:text-gray-100 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">
                            @error('purchase_cost')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Useful Life -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Useful Life (Years)</label>
                            <input type="number" name="useful_life" placeholder="e.g., 2"
                                value="{{ old('useful_life') }}"
                                class="mt-1 w-full p-2 border border-gray-300 dark:border-gray-700 rounded-lg 
                dark:bg-gray-900 dark:text-gray-100 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">
                            @error('useful_life')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Supplier -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Supplier</label>
                            <input type="text" name="supplier" placeholder="e.g., Freyfil"
                                value="{{ old('supplier') }}"
                                class="mt-1 w-full p-2 border border-gray-300 dark:border-gray-700 rounded-lg 
                dark:bg-gray-900 dark:text-gray-100 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">
                            @error('supplier')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Condition -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Condition</label>
                            <select name="condition"
                                class="mt-1 w-full p-2 border border-gray-300 dark:border-gray-700 rounded-lg 
                dark:bg-gray-900 dark:text-gray-100 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">
                                <option value="">Select Condition</option>
                                <option value="Excellent" {{ old('condition') == 'Excellent' ? 'selected' : '' }}>Excellent</option>
                                <option value="Good" {{ old('condition') == 'Good' ? 'selected' : '' }}>Good</option>
                                <option value="Needs Repair" {{ old('condition') == 'Needs Repair' ? 'selected' : '' }}>Needs Repair</option>
                            </select>
                            @error('condition')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Image Upload -->
                        <div class="md:col-span-2">
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Upload Image</label>
                            <input type="file" id="assetImage" accept="image/*" name="image"
                                class="mt-1 block w-full text-sm text-gray-700 dark:text-gray-300 border border-gray-300 dark:border-gray-700 rounded-lg cursor-pointer bg-white dark:bg-gray-900 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">
                            <div id="imagePreview" class="mt-3 flex justify-center">
                                <img id="previewImg" class="hidden w-48 h-48 object-cover rounded-lg shadow-md border border-gray-300 dark:border-gray-700" alt="Preview">
                            </div>
                            @error('image')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <!-- Description -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Description (Optional)</label>
                        <textarea name="description" rows="3" placeholder="Additional notes about this asset..."
                            class="mt-1 w-full p-2 border border-gray-300 dark:border-gray-700 rounded-lg 
            dark:bg-gray-900 dark:text-gray-100 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">{{ old('description') }}</textarea>
                        @error('description')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Buttons -->
                    <div class="flex justify-end space-x-2 pt-4 border-t border-gray-200 dark:border-gray-700">
                        <a href="{{ route('assets.index') }}"
                            class="px-4 py-2 bg-gray-200 dark:bg-gray-700 text-gray-800 dark:text-gray-100 rounded-lg hover:bg-gray-300 dark:hover:bg-gray-600">
                            Cancel
                        </a>
                        <button type="submit"
                            class="px-4 py-2 bg-indigo-600 text-white rounded-lg shadow hover:bg-indigo-700 focus:ring-2 focus:ring-indigo-500">
                            Save Asset
                        </button>
                    </div>
                </form>



            </div>




        </div>
    </div>

    <script>
        const assetImage = document.getElementById('assetImage');
        const previewImg = document.getElementById('previewImg');

        assetImage.addEventListener('change', (event) => {
            const file = event.target.files[0];
            if (file) {
                previewImg.src = URL.createObjectURL(file);
                previewImg.classList.remove('hidden');
            } else {
                previewImg.classList.add('hidden');
                previewImg.src = '';
            }
        });
    </script>

</x-app-layout>