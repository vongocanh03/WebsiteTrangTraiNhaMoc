<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    // Hiển thị tất cả danh mục và sản phẩm
    public function index()
    {
        $categories = Category::all(); // Lấy tất cả danh mục

        // Lấy sản phẩm của từng danh mục
        $categoryProducts = [];
        foreach ($categories as $category) {
            $categoryProducts[$category->id] = $category->products; // Lưu sản phẩm của mỗi danh mục
        }

        // Trả về view với danh mục và sản phẩm
        return view('home', compact('categories', 'categoryProducts'));
    }

    // Hiển thị sản phẩm của một danh mục cụ thể
    public function showCategory($id)
    {
        // Lấy danh mục theo ID
        $category = Category::findOrFail($id);
        
        // Lấy tất cả sản phẩm của danh mục đó
        $products = $category->products;

        // Lấy tất cả danh mục để hiển thị trên thanh điều hướng
        $categories = Category::all();
        
        // Trả về view với danh mục và sản phẩm của danh mục đó
        return view('home', compact('categories', 'category', 'products'));
    }
}
