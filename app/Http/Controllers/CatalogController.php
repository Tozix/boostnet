<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class CatalogController extends Controller
{
    public function index(Request $request)
    {
        $new = Product::whereNew(true)->latest()->limit(3)->get();
        $hit = Product::whereHit(true)->latest()->limit(3)->get();
        $sale = Product::whereSale(true)->latest()->limit(3)->get();
        return view('catalog.index', compact('new', 'hit', 'sale'));
    }
    public function category(Category $category)
    {

        // получаем всех потомков этой категории
        $descendants = $category->getAllChildren($category->id);
        $descendants[] = $category->id;
        // товары этой категории и всех потомков
        $products = Product::whereIn('category_id', $descendants)->paginate(6);
        return view('catalog.category', compact('category', 'products'));
    }

    public function brand(Brand $brand)
    {
        $products = $brand->products()->paginate(6);
        return view('catalog.brand', compact('brand', 'products'));
    }
    public function product(Product $product)
    {
        return view('catalog.product', compact('product'));
    }
}
