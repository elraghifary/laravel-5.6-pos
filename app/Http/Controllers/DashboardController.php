<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;

class DashboardController extends Controller
{
    public function index()
    {
        $products = Product::all();
        $array = [];
        foreach($products as $key => $value) {
            $array[] = [$value->name, (int) $value->stock];
        }
        return view('dashboard')->with('stock', json_encode($array));
    }
}
