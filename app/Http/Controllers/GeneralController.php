<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;
use App\Models\Category;
use View;

class GeneralController extends Controller
{
    public function searchCategory(Request $request)
    {
    $categories = Category::all(); 
    $items = Item::query();

    if ($request->has('category') && $request->category != 'all') {
        $items->where('category_id', $request->category);
    }

    $items = $items->get();

    return view('general.search', compact('items', 'categories'));
    }

    public function getUserDashboard()
    {
        $items=Item::with('category')->paginate(6);
        $categories = Category::all(); 
        return View::make('general.dashboard',compact('items','categories'));
    }
    public function showItemDetail($id)
    {
        $item = Item::with('category')->find($id);
        return View::make('general.item_details',compact('item'));
    }
}
