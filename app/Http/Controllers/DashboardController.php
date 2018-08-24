<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use App\Product;

class DashboardController extends Controller
{
    public function index()
    {
        $products = Product::all();
        $countCategories = Category::count();
        $countProducts = Product::count();

        $chart = [];

        foreach($products as $key => $value) {
            $chart[] = [$value->name, (int) $value->stock];
        }

        return view('dashboard', compact('countCategories', 'countProducts'))->with('stock', json_encode($chart));
    }
}
