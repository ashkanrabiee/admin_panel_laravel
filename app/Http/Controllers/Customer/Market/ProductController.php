<?php

namespace App\Http\Controllers\Customer\Market;

use Illuminate\Http\Request;
use App\Models\Market\Product;
use App\Http\Controllers\Controller;

class ProductController extends Controller
{
    
    public function product(Product $product)
{
    // لود کردن تصاویر گالری همراه با محصول برای بهینه‌سازی
    $product->load('images'); 

    // دریافت ۱۰ محصول پر بازدید
    $mostVisitedProducts = Product::latest()->take(10)->get();

    // دریافت محصولات مرتبط (در آینده می‌توان بر اساس دسته‌بندی فیلتر کرد)
    $relatedPosts = Product::all();

    return view('customer.market.product.product', compact('product', 'relatedPosts', 'mostVisitedProducts'));


    

}


    public function addComment(){



    }


}
