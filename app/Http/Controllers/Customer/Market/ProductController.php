<?php

namespace App\Http\Controllers\Customer\Market;

use Illuminate\Http\Request;
use App\Models\Market\Product;
use App\Http\Controllers\Controller;

class ProductController extends Controller
{
    
    public function product(Product $product){

        // dd('hi');

        $relatedPosts = Product::all();
        return view('customer.market.product.product' , compact('product','relatedPosts'));


    }

    public function addComment(){



    }


}
