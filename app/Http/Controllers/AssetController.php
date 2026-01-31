<?php

namespace App\Http\Controllers;

use App\Models\Asset;
use App\Models\Category;
use App\Models\Department;
use Illuminate\Http\Request;

class AssetController extends Controller
{
    public function index(Request $request)
    {

        $categories = Category::all();
        $departments = Department::all();

        $assets = Asset::query()
            ->when(
                $request->search,
                fn($q) =>
                $q->where('asset_name', 'like', "%{$request->search}%")
            )
            ->when(
                $request->category,
                fn($q) =>
                $q->where('category_id', $request->category)
            )
            ->when(
                $request->department,
                fn($q) =>
                $q->where('department_id', $request->department)
            )
            ->when(
                $request->condition,
                fn($q) =>
                $q->where('condition', $request->condition)
            )
            ->latest()
            ->paginate(3);

        $data = [
            'categories' => $categories,
            'departments' => $departments,
            'assets' => $assets
        ];

        return view('assets.index', $data);
    }


    public function create()
    {
        $categories = Category::all();
        $departments = Department::all();

        $data = [
            'categories' => $categories,
            'departments' => $departments
        ];

        return view('assets.create', $data);
    }

    public function store(Request $request)
    {

        // dd($request->all());
        $validated = $request->validate([
            'asset_name' => 'required|string|max:255',
            'category_id' => 'required|string|max:255',
            'department_id' => 'required|string|max:255',
            'purchase_date' => 'required|date',
            'purchase_cost' => 'required|numeric',
            'useful_life' => 'required|integer|min:1',
            'supplier' => 'required|string|max:255',
            'condition' => 'required|string|max:255',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);


        // Handle file upload
        if ($request->hasFile('image')) {

            $validated['image'] = $request->file('image')->store('assets', 'public');
        }

        Asset::create($validated);

        return redirect()->route('assets.index')->with('success', 'Asset added successfully!');
    }

    public function edit(Asset $asset)
    {

        $categories = Category::all();
        $departments = Department::all();

        $data = [
            'categories' => $categories,
            'departments' => $departments,
            'asset' => $asset
        ];


        return view('assets.edit', $data);
    }

    public function update(Request $request, Asset $asset)
    {

        $validated = $request->validate([
            'asset_name' => 'required|string|max:255',
            'category_id' => 'required|string|max:255',
            'department_id' => 'required|string|max:255',
            'purchase_date' => 'required|date',
            'purchase_cost' => 'required|numeric',
            'useful_life' => 'required|integer|min:1',
            'supplier' => 'required|string|max:255',
            'condition' => 'required|string|max:255',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048'
        ]);

        $asset->is_deployed = $request->has('is_deployed');

        if ($asset->is_deployed) {
            $asset->deployed_name = $request->deployed_name;
            $asset->deployed_designation = $request->deployed_designation;
        } else {
            // Clear fields when not deployed
            $asset->deployed_name = null;
            $asset->deployed_designation = null;
        }


        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('assets', 'public');
        }

        $asset->update($validated);

        return redirect()->route('assets.index')->with('success', 'Asset updated successfully!');
    }

    public function destroy(Asset $asset)
    {
        if ($asset->image) {
            \Storage::disk('public')->delete($asset->image);
        }

        $asset->delete();

        return redirect()->route('assets.index')->with('success', 'Asset deleted successfully!');
    }
}
