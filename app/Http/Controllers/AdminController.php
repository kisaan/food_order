<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Item;
use App\Models\Category;
use View;

class AdminController extends Controller
{
    public function getAdminDashboard()
    {
        return View::make('admin.dashboard');
    }
    public function getCategory()
    {
        $categories = Category::all();
        return View::make('admin.category.list',compact('categories'));
    }
    public function storeCategory(Request $request)
    {
        $request->validate([
            'category' => 'required|string|max:255',
        ]);

        try {
            $category = new Category();
            $category->category = $request->category;
            $category->save();

            return response()->json(['message' => 'Category added successfully!'], 200);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Error adding category.'], 500);
        }
    }
    public function editCategory($id)
    {
        $category = Category::find($id);
        return View::make('admin.category.edit',compact('category'));
    }
    public function updateCategory(Request $request, $id)
    {
    $request->validate([
        'category' => 'required|string|max:255',
    ]);

    try {
        $category = Category::findOrFail($id);
        $category->category = $request->category;
        $category->save();

        return redirect('/admin/categories')->with('success', 'Category updated successfully!');
    } catch (\Exception $e) {
        return redirect()->back()->with('error', 'Failed to update category.');
    }
    }
    public function destroyCategory($id)
    {
        try {
            $category = Category::findOrFail($id);
            $category->delete();

            return redirect()->back()->with('success', 'Category deleted successfully!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to delete the category.');
        }
    }
    public function getItem()
    {
        $items = Item::with('category')->get();
        //dd($items);
        $categories = Category::all();
        return View::make('admin.item.list',compact('items','categories'));
    }

    public function storeItem(Request $request)
    {
        $request->validate([
            'category_id' => 'required|exists:categories,id',
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'image' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        try {
            $imagePath = $request->file('image')->store('items', 'public');
            $item = Item::create([
                'category_id' => $request->category_id,
                'name' => $request->name,
                'description' => $request->description,
                'price' => $request->price,
                'image' => $imagePath,
            ]);

            return response()->json(['message' => 'Item created successfully!'], 200);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Failed to create item.'], 500);
        }
    }

    public function editItem($id)
    {
        $item = Item::find($id);
        $categories = Category::all();
        return View::make('admin.item.edit',compact('item','categories'));
    }

    public function updateItem(Request $request, $id)
    {
    $request->validate([
        'category_id' => 'required|exists:categories,id',
        'name' => 'required|string|max:255',
        'description' => 'nullable|string',
        'price' => 'required|numeric|min:0',
        'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
    ]);

    try {
        $item = Item::findOrFail($id);

        $item->category_id = $request->category_id;
        $item->name = $request->name;
        $item->description = $request->description;
        $item->price = $request->price;

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('items', 'public');
            $item->image = $imagePath;
        }

        $item->save();

        return redirect()->route('item.list')->with('success', 'Item updated successfully!');
      } catch (\Exception $e) {
        return redirect()->back()->with('error', 'Failed to update the item.');
      }
    }

    public function destroyItem($id)
    {
        try {
            $item = Item::findOrFail($id);
            $item->delete();

            return redirect()->back()->with('success', 'Item deleted successfully!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to delete the item.');
        }
    }
}