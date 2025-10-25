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

                <form id="editAssetForm" class="space-y-6">
                    <!-- Grid Container -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

                        <!-- Asset Name -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Asset Name</label>
                            <input type="text" name="asset_name" value="ITV0002"
                                class="mt-1 w-full p-2 border border-gray-300 dark:border-gray-700 rounded-lg
                                    dark:bg-gray-900 dark:text-gray-100 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">
                        </div>

                        <!-- Category -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Category</label>
                            <select name="category"
                                class="mt-1 w-full p-2 border border-gray-300 dark:border-gray-700 rounded-lg
                                    dark:bg-gray-900 dark:text-gray-100 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">
                                <option value="">Select Category</option>
                                <option value="Mouse">Mouse</option>
                                <option value="Keyboard" selected>Keyboard</option>
                                <option value="Monitor">Monitor</option>
                            </select>
                        </div>

                        <!-- Location -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Location</label>
                            <select name="location"
                                class="mt-1 w-full p-2 border border-gray-300 dark:border-gray-700 rounded-lg
                                    dark:bg-gray-900 dark:text-gray-100 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">
                                <option value="">Select Location</option>
                                <option value="Main Office" selected>Main Office</option>
                                <option value="Warehouse 1">Warehouse 1</option>
                                <option value="Warehouse 2">Warehouse 2</option>
                            </select>
                        </div>

                        <!-- Purchase Date -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Purchase Date</label>
                            <input type="date" name="purchase_date" value="2023-08-10"
                                class="mt-1 w-full p-2 border border-gray-300 dark:border-gray-700 rounded-lg
                                    dark:bg-gray-900 dark:text-gray-100 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">
                        </div>

                        <!-- Purchase Cost -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Purchase Cost (₱)</label>
                            <input type="number" name="purchase_cost" value="2500"
                                class="mt-1 w-full p-2 border border-gray-300 dark:border-gray-700 rounded-lg
                                    dark:bg-gray-900 dark:text-gray-100 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">
                        </div>

                        <!-- Useful Life -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Useful Life (Years)</label>
                            <input type="number" name="useful_life" value="3"
                                class="mt-1 w-full p-2 border border-gray-300 dark:border-gray-700 rounded-lg
                                    dark:bg-gray-900 dark:text-gray-100 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">
                        </div>

                        <!-- Supplier -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Supplier</label>
                            <input type="text" name="supplier" value="Freyfil"
                                class="mt-1 w-full p-2 border border-gray-300 dark:border-gray-700 rounded-lg
                                    dark:bg-gray-900 dark:text-gray-100 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">
                        </div>

                        <!-- Condition -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Condition</label>
                            <select name="condition"
                                class="mt-1 w-full p-2 border border-gray-300 dark:border-gray-700 rounded-lg
                                    dark:bg-gray-900 dark:text-gray-100 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">
                                <option value="">Select Condition</option>
                                <option value="Excellent" selected>Excellent</option>
                                <option value="Good">Good</option>
                                <option value="Needs Repair">Needs Repair</option>
                            </select>
                        </div>

                        <!-- Image Upload -->
                        <div class="md:col-span-2">
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Update Image</label>
                            <input type="file" id="editAssetImage" accept="image/*"
                                class="mt-1 block w-full text-sm text-gray-700 dark:text-gray-300 border border-gray-300 dark:border-gray-700 rounded-lg cursor-pointer bg-white dark:bg-gray-900 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">
                            <div id="editImagePreview" class="mt-3 flex justify-center">
                                <img id="editPreviewImg" src="/storage/assets/itv0002.jpg"
                                    class="w-48 h-48 object-cover rounded-lg shadow-md border border-gray-300 dark:border-gray-700"
                                    alt="Current Asset Image">
                            </div>
                        </div>
                    </div>

                    <!-- Description -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Description (Optional)</label>
                        <textarea name="description" rows="3"
                            class="mt-1 w-full p-2 border border-gray-300 dark:border-gray-700 rounded-lg
                                dark:bg-gray-900 dark:text-gray-100 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">Mechanical keyboard assigned to HR Department</textarea>
                    </div>

                    <!-- Buttons -->
                    <div class="flex justify-end space-x-2 pt-4 border-t border-gray-200 dark:border-gray-700">
                        <button type="button" id="cancelEditAsset"
                            class="px-4 py-2 bg-gray-200 dark:bg-gray-700 text-gray-800 dark:text-gray-100 rounded-lg hover:bg-gray-300 dark:hover:bg-gray-600">
                            Cancel
                        </button>
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
