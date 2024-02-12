<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    public function index()
    {
        // $products = Product::paginate(10);
        $products = Product::all();
        return response()->json([
            'status' => 'success',
            'data' => $products
        ], 200);
    }
}
