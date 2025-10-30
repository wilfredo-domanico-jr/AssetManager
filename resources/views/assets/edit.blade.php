<x-app-layout>
    <x-slot name="header">
        <div>
            <h2 class="text-2xl font-bold text-gray-800 dark:text-gray-100">
                Asset Manager
            </h2>
            <p class="text-sm text-gray-500 dark:text-gray-400">
                Update existing equipment details and attachments
            </p>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <!-- Header -->
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between mb-6">
                <div>
                    <h2 class="text-2xl font-bold text-gray-800 dark:text-gray-100">Edit Asset</h2>
                    <p class="text-sm text-gray-500 dark:text-gray-400">
                        Modify the details of this existing asset record
                    </p>
                </div>
            </div>

             <!-- Form -->
            <div class="bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-xl shadow-sm p-6 space-y-6">

                <form id="editAssetForm"  class="space-y-6" method="POST" action="{{ route('assets.update', $asset->id) }}" enctype="multipart/form-data">
                      @csrf
                      @method('PUT') <!-- Use PUT method for update -->

                    <!-- Grid Container -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

                        <!-- Asset Name -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Asset Name</label>
                            <input type="text" name="asset_name" value="{{ old('asset_name', $asset->asset_name) }}"
                                class="mt-1 w-full p-2 border border-gray-300 dark:border-gray-700 rounded-lg
                                    dark:bg-gray-900 dark:text-gray-100 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">
                            @error('asset_name')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Category -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Category</label>
                            <select name="category_id"
                                class="mt-1 w-full p-2 border border-gray-300 dark:border-gray-700 rounded-lg
                                    dark:bg-gray-900 dark:text-gray-100 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">
                                <option value="" selected>Select Category</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}" {{ old('category_id', $asset->category_id) == $category->id ? 'selected' : '' }}>
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('category_id')
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
                                        <option value="{{ $department->id }}" {{ old('department', $asset->department) == $department->id ? 'selected' : '' }}>
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
                            <input type="date" name="purchase_date" value="{{ old('purchase_date', $asset->purchase_date) }}"
                                class="mt-1 w-full p-2 border border-gray-300 dark:border-gray-700 rounded-lg
                                    dark:bg-gray-900 dark:text-gray-100 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">
                            @error('purchase_date')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Purchase Cost -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Purchase Cost (₱)</label>
                            <input type="number" name="purchase_cost" value="{{ old('purchase_cost', $asset->purchase_cost) }}"
                                class="mt-1 w-full p-2 border border-gray-300 dark:border-gray-700 rounded-lg
                                    dark:bg-gray-900 dark:text-gray-100 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">
                            @error('purchase_cost')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Useful Life -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Useful Life (Years)</label>
                            <input type="number" name="useful_life" value="{{ old('useful_life', $asset->useful_life) }}"
                                class="mt-1 w-full p-2 border border-gray-300 dark:border-gray-700 rounded-lg
                                    dark:bg-gray-900 dark:text-gray-100 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">
                            @error('useful_life')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Supplier -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Supplier</label>
                            <input type="text" name="supplier" value="{{ old('supplier', $asset->supplier) }}"
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
                                <option value="Excellent" {{ old('condition', $asset->condition) == 'Excellent' ? 'selected' : '' }}>Excellent</option>
                                <option value="Good" {{ old('condition', $asset->condition) == 'Good' ? 'selected' : '' }}>Good</option>
                                <option value="Needs Repair" {{ old('condition', $asset->condition) == 'Needs Repair' ? 'selected' : '' }}>Needs Repair</option>
                            </select>
                            @error('condition')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Image Upload -->
                        <div class="md:col-span-2">
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Update Image</label>

                            <input type="file" id="editAssetImage" accept="image/*" name="image"
                                class="mt-1 block w-full text-sm text-gray-700 dark:text-gray-300 border border-gray-300 dark:border-gray-700 rounded-lg cursor-pointer bg-white dark:bg-gray-900 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">

                            <div id="editImagePreview" class="mt-3 flex justify-center">
                                @if (!empty($asset->image) && file_exists(public_path('storage/' . $asset->image)))
                                    <!-- Show current image -->
                                    <img id="editPreviewImg"
                                        src="{{ asset('storage/' . $asset->image) }}"
                                        class="w-48 h-48 object-cover rounded-lg shadow-md border border-gray-300 dark:border-gray-700"
                                        alt="Current Asset Image">
                                @else
                                    <!-- Placeholder if no image -->
                                    <div
                                        class="w-48 h-48 flex items-center justify-center text-gray-400 dark:text-gray-500 border-2 border-dashed border-gray-300 dark:border-gray-700 rounded-lg">
                                        <span class="text-sm">No image available</span>
                                    </div>
                                @endif
                            </div>

                            @error('image')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>

                    </div>

                    <!-- Description -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Description (Optional)</label>
                        <textarea name="description" rows="3"
                            class="mt-1 w-full p-2 border border-gray-300 dark:border-gray-700 rounded-lg
                                dark:bg-gray-900 dark:text-gray-100 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">{{ old('description', $asset->description) }}</textarea>
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
                            Update Asset
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        const editAssetImage = document.getElementById('editAssetImage');
        const editPreviewImg = document.getElementById('editPreviewImg');

        editAssetImage.addEventListener('change', (event) => {
            const file = event.target.files[0];
            if (file) {
                editPreviewImg.src = URL.createObjectURL(file);
            }
        });
    </script>
</x-app-layout>