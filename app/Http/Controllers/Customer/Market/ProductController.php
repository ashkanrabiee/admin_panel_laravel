<?php

namespace App\Http\Controllers\Customer\Market;

use Illuminate\Http\Request;
use App\Models\Market\Product;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Content\Comment;
class ProductController extends Controller
{
    
    public function product(Product $product)
{
    // لود کردن تصاویر گالری همراه با محصول برای بهینه‌سازی
    $product->load('images'); 

    // دریافت ۱۰ محصول پر بازدید
    $mostVisitedProducts = Product::latest()->take(10)->get();

    // دریافت محصولات مرتبط (در آینده می‌توان بر اساس دسته‌بندی فیلتر کرد)
    $relatedProducts = Product::all();

    return view('customer.market.product.product', compact('product', 'relatedProducts', 'mostVisitedProducts'));

}

public function addComment(Product $product, Request $request)
{
    $request->validate([
        'body' => 'required|max:2000'
    ]);

    $inputs['body'] = str_replace(PHP_EOL, '<br/>', $request->body);
    $inputs['author_id'] = Auth::user()->id;
    $inputs['commentable_id'] = $product->id;
    $inputs['commentable_type'] = Product::class;
    Comment::create($inputs);
    return back();
}


}
