@extends('customer.layouts.master-two-col')

@section('head-tag')
<title>{{ $product->name }}</title>
@endsection

@section('content')


<!-- start cart -->
<section class="mb-4">
    <section class="container-xxl" >
        <section class="row">
            <section class="col">
                <!-- start vontent header -->
                <section class="content-header">
                    <section class="d-flex justify-content-between align-items-center">
                        <h2 class="content-header-title">
                            <span>{{ $product->name }}</span>
                        </h2>
                        <section class="content-header-link">
                            <!--<a href="#">مشاهده همه</a>-->
                        </section>
                    </section>
                </section>

                <section class="row mt-4">
                    <!-- start image gallery -->
                  
                    <section class="product-gallery">
                        <section class="row mt-4">
                     <!-- start image gallery -->
                     <section class="col-md-4">
                        <section class="content-wrapper bg-white p-3 rounded-2 mb-4">
                            <section class="product-gallery">
                                @php
                                    $images = $product->images()->get();
                                @endphp
                                <section class="product-gallery-selected-image mb-3">
                                    <img class="img-fluid rounded" 
                                    src="{{ asset($product->image['indexArray']['medium'] ?? 'path-to-default.jpg') }}" 
                                    alt="{{ $product->name }}" >
                                </section>
                                <section class="product-gallery-thumbs">
                                    @if ($product->images->isNotEmpty()) 
                                    @foreach ($product->images as $key => $image)
                                        @if (!empty($image->image['indexArray']['medium']))
                                            <div class="col-4 col-sm-3 col-md-2 mb-3">
                                                <img class="img-fluid img-thumbnail" 
                                                     src="{{ asset($image->image['indexArray']['medium']) }}" 
                                                     alt="Gallery Image {{ $key + 1 }}" 
                                                     data-input="{{ asset($image->image['indexArray']['medium']) }}"
                                                     style="max-height: 120px; object-fit: cover;"
                                                     
                                                     >
                                            </div>
                                        @endif
                                    @endforeach
                                @else
                                    <p class="text-center">هیچ تصویری برای این محصول ثبت نشده است.</p>
                                @endif

                                </section>
                            </section>
                        </section>
                    </section>
                    <!-- end image gallery -->                


                    <!-- start product info -->
                    <section class="col-md-5">

                        <section class="content-wrapper bg-white p-3 rounded-2 mb-4">

                            <!-- start vontent header -->
                            <section class="content-header mb-3">
                                <section class="d-flex justify-content-between align-items-center">
                                    <h2 class="content-header-title content-header-title-small">
                                        {{ $product->name }}
                                    </h2>
                                    <section class="content-header-link">
                                        <!--<a href="#">مشاهده همه</a>-->
                                    </section>
                                </section>
                            </section>
                            <section class="product-info">
                                <form id="add_to_cart" action="{{ route('customer.sales-process.add-to-cart', $product) }}" method="post" class="product-info">
                                    @csrf
                                @php
                                $colors = $product->colors()->get();
                                  @endphp

                                  @if($colors->count() != 0)
                                <p><span>رنگ انتخاب شده : <span id="selected_color_name"> {{ $colors->first()->color_name }}</span></span></p>
                                <p>
                                    @foreach ($colors as $key => $color)

                                    <label for="{{ 'color_' . $color->id }}" style="background-color: {{ $color->color ?? '#ffffff' }};" class="product-info-colors me-1" data-bs-toggle="tooltip" data-bs-placement="bottom" title="{{ $color->color_name }}"></label>

                                    <input class="d-none" type="radio" name="color" id="{{ 'color_' . $color->id }}" value="{{ $color->id }}" data-color-name="{{ $color->color_name }}" data-color-price={{ $color->price_increase }} @if($key == 0) checked @endif>
                                    @endforeach

                                </p>
                                @endif
                            
                                @php
                                $guarantees = $product->guarantees()->get();
                                  @endphp
                                  @if($guarantees->count() != 0)

                                <p><i class="fa fa-shield-alt cart-product-selected-warranty me-1"></i>
                                گارانتی :
                                <select name="guarantee" id="guarantee" class="p-1">
                                    @foreach ($guarantees as $key => $guarantee)
                                    <option value="{{ $guarantee->id }}" data-guarantee-price={{ $guarantee->price_increase }}  @if($key == 0) selected @endif>{{ $guarantee->name }}</option>
                                    @endforeach

                                </select>
                                </p>

                                @endif

                              
                                <p>
                                    @if($product->marketable_number > 0)
                                    <i class="fa fa-store-alt cart-product-selected-store me-1"></i> <span>کالا موجود در انبار</span>
                                    @else
                                    <i class="fa fa-store-alt cart-product-selected-store me-1"></i> <span>کالا ناموجود</span>
                                    @endif
                                </p>


                                {{-- add botton --}}
                                
                                <p>
                                    @if($product->marketable_number > 0)
                                    <i class="fa fa-store-alt cart-product-selected-store me-1"></i> <span>کالا موجود در انبار</span>
                                    @else
                                    <i class="fa fa-store-alt cart-product-selected-store me-1"></i> <span>کالا ناموجود</span>
                                    @endif
                                </p>
                                <p><a class="btn btn-light  btn-sm text-decoration-none" href="#"><i class="fa fa-heart text-danger"></i> افزودن به علاقه مندی</a></p>
                                <section>
                                    <section class="cart-product-number d-inline-block">
                                        <button class="cart-number cart-number-down" type="button">-</button>
                                        <input type="number" id="number" name="number" min="1" max="5" step="1" value="1">
                                        <button class="cart-number cart-number-up" type="button">+</button>
                                    </section>
                                </section>
                                
                                <p class="mb-3 mt-5">
                                    <i class="fa fa-info-circle me-1"></i>کاربر گرامی  خرید شما هنوز نهایی نشده است. برای ثبت سفارش و تکمیل خرید باید ابتدا آدرس خود را انتخاب کنید و سپس نحوه ارسال را انتخاب کنید. نحوه ارسال انتخابی شما محاسبه و به این مبلغ اضافه شده خواهد شد. و در نهایت پرداخت این سفارش صورت میگیرد. پس از ثبت سفارش کالا بر اساس نحوه ارسال که شما انتخاب کرده اید کالا برای شما در مدت زمان مذکور ارسال می گردد.
                                </p>
                            </section>
                        </section>

                    </section>
                    {{-- end add botton --}}

                    <!-- end product info -->

                    <section class="col-md-3">
                        <section class="content-wrapper bg-white p-3 rounded-2 cart-total-price">
                            <section class="d-flex justify-content-between align-items-center">
                                <p class="text-muted">قیمت کالا</p>
                                <p class="fw-bolder">
                                    <span id="final-price">0 تومان</span> 
                                </p>
                            </section>
                        
                            @if(!empty($amazingSale))
                            <section class="d-flex justify-content-between align-items-center">
                                <p class="text-muted">تخفیف کالا</p>
                                <p class="text-danger fw-bolder" id="product-discount-price" 
                                    data-product-discount-price="{{ ($product->price * ($amazingSale->percentage / 100) ) }}">
                                    {{ priceFormat($product->price * ($amazingSale->percentage / 100) ) }} <span class="small">تومان</span>
                                </p>
                            </section>
                            @endif
                            @if($product->marketable_number > 0)
                            <button id="next-level" class="btn btn-danger d-block w-100" onclick="document.getElementById('add_to_cart').submit();"><a href="{{route('customer.sales-process.cart')}}">افزودن به سبد خرید</a></button>
                            @else
                            <button id="next-level" class="btn btn-secondary disabled d-block">محصول نا موجود میباشد</button>
                            @endif
                         </section>
                        </form>
            </section>  
       


                            <section class="border-bottom mb-3"></section>

                           

                        
                        </section>
                    </section>
                </section>
            </section>
        </section>

    </section>
</section>
<!-- end cart -->



<!-- start product lazy load -->
<section class="mb-4">
    <section class="container-xxl" >
        <section class="row">
            <section class="col">
                <section class="content-wrapper bg-white p-3 rounded-2">
                    <!-- start vontent header -->
                    <section class="content-header">
                        <section class="d-flex justify-content-between align-items-center">
                            <h2 class="content-header-title">
                                <span>کالاهای مرتبط</span>
                            </h2>
                            <section class="content-header-link">
                                <!--<a href="#">مشاهده همه</a>-->
                            </section>
                        </section>
                    </section>
                    <!-- start vontent header -->

                    <section class="lazyload-wrapper">
                        <section class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 g-3">

                            @foreach ($relatedProducts as $relatedProduct)
                                <section class="col">
                                    <section class="lazyload-item-wrapper">
                                        <section class="product">
                                            <a class="product-link" href="{{route('customer.market.product' , $relatedProduct )}}">
                                                <section class="product-image">
                                                    <img class="w-100" src="{{ asset($relatedProduct->image['indexArray']['medium']) }}" alt="{{ $relatedProduct->name }}">
                                                </section>
                                                <section class="product-colors"></section>
                                                <section class="product-name">
                                                    <h3>{{ Str::limit($relatedProduct->name, 10) }}</h3>
                                                </section>
                                                <section class="product-price-wrapper">
                                                    <section class="product-discount"></section>
                                                    <section class="product-price">{{ priceFormat($relatedProduct->price) }} تومان</section>
                                                </section>
                                            </a>
                                        </section>
                                    </section>
                                </section>
                            @endforeach
                        </section>
                    </section>





<!-- end product lazy load -->

<!-- start description, features and comments -->
<section class="mb-4">
    <section class="container-xxl" >
        <section class="row">
            <section class="col">
                <section class="content-wrapper bg-white p-3 rounded-2">
                    <!-- start content header -->
                    <section id="introduction-features-comments" class="introduction-features-comments">
                        <section class="content-header">
                            <section class="d-flex justify-content-between align-items-center">
                                <h2 class="content-header-title">
                                    <span class="me-2"><a class="text-decoration-none text-dark" href="#introduction">معرفی</a></span>
                                    <span class="me-2"><a class="text-decoration-none text-dark" href="#features">ویژگی ها</a></span>
                                    <span class="me-2"><a class="text-decoration-none text-dark" href="#comments">دیدگاه ها</a></span>
                                </h2>
                                <section class="content-header-link">
                                    <!--<a href="#">مشاهده همه</a>-->
                                </section>
                            </section>
                        </section>
                    </section>
                    <!-- start content header -->

                    <section class="py-4">

                        <!-- start vontent header -->
                        <section id="introduction" class="content-header mt-2 mb-4">
                            <section class="d-flex justify-content-between align-items-center">
                                <h2 class="content-header-title content-header-title-small">
                                    {{ strip_tags(html_entity_decode($product->introduction)) }}
                                </h2>
                                <section class="content-header-link">
                                    <!--<a href="#">مشاهده همه</a>-->
                                </section>
                            </section>
                        </section>
                        
                        </section>
                        <section class="product-introduction mb-4">
                            خلاصه کتاب اثر مرکب «انتخاب‌های شما تنها زمانی معنی دار است که آنها را به دلخواه به رؤیاهای خود متصل کنید. انتخاب‌های شایسته و انگیزشی، همان‌هایی هستند که شما به عنوان هدف خود و هسته اصلی زندگی خود در بالاترین ارزش‌های خود تعین می‌کنید. شما باید چیزی را بخواهید و می‌دانید که چرا شما آن را می‌خواهید یا به راحتی می‌توانید آن از دست بدهید.» «اولین گام در جهت تغییر، آگاهی است. اگر می‌خواهید از جایی که هستید به جایی که می‌خواهید بروید، باید با درک انتخاب‌هایی که شما را از مقصد مورد نظر خود دور می‌کنند، شروع کنید.» «فرمول کامل برای به دست آوردن خوش شانسی: آماده‌سازی (رشد شخصی) + نگرش (باور / ذهنیت) + فرصت (چیز خوبی که راه را هموار می‌کند) + اقدام (انجام کاری در مورد نظر) = شانس» «ما همه می‌توانیم انتخاب‌های بسیار خوبی داشته باشیم. ما می‌توانیم همه چیز را کنترل کنیم. این در توانایی ماست که همه چیز را تغییر دهیم. به جای اینکه غرق در گذشته شویم، باید دوباره انرژی خود را جمع کنیم، می‌توانیم از تجربیات گذشته برای حرکت‌های مثبت و سازنده استفاده کنیم.» برای ایجاد تغییر، ما نیاز به این داریم که عادات و رفتار خوب را ایجاد کنیم، که در کتاب از آن به عنوان تکانش یاد می شود. تکانش بدین معنی که با ریتم منظم و دائمی و ثبات قدم همراه باشید. حرکت های افراطی و تفریطی، موضع های عجله ای و جوگیر شدن و عدم ریتم مناسب موجب خواهد شد که ثبات قدم نداشته باشیم و حتی شاید از مسیر اصلی دور شویم و تکانش ما با لرزه های فراوان و یا حتی سکون و سکوت مواجه شود. واقعیت رهرو آن است که آهسته و پیوسته رود اینجا پدیدار می گردد و باید همیشه بدانیم هیچ چیز مثل عدم ثبات قدم و نداشتن ریتم مناسب در زمان تغییر، نمی تواند تکانش را با مشکل مواجه کند! متن بالا شاید بهترین خلاصه ای باشد که می شود از کتاب نوشت!
                        </section>

                        <!-- start vontent header -->
                        <section id="features" class="content-header mt-2 mb-4">
                            <section class="d-flex justify-content-between align-items-center">
                                <h2 class="content-header-title content-header-title-small">
                                    ویژگی ها
                                </h2>
                                <section class="content-header-link">
                                    <!--<a href="#">مشاهده همه</a>-->
                                </section>
                            </section>
                        </section>
                        <section class="product-features mb-4 table-responsive">
                            <table class="table table-bordered border-white">
                                {{-- {{dd($product->values())}} --}}
                                @foreach ($product->values()->get() as $value)
                                <tr>
                                    <td>{{$value->attribute()->first()->name}}</td>
                                    <td>{{ json_decode($value->value)->value }} {{ $value->attribute()->first()->unit }}</td>
                                </tr>
                                @endforeach

                                @foreach ($product->metas()->get() as $meta)
                                <tr>
                                    <td>{{ $meta->meta_key }}</td>
                                    <td>{{ $meta->meta_value }}</td>
                                </tr>
                                @endforeach


                            </table>
                        </section>

                        <!-- start vontent header -->
                        <section id="comments" class="content-header mt-2 mb-4">
                            <section class="d-flex justify-content-between align-items-center">
                                <h2 class="content-header-title content-header-title-small">
                                    دیدگاه ها
                                </h2>
                                <section class="content-header-link">
                                    <!--<a href="#">مشاهده همه</a>-->
                                </section>
                            </section>
                        </section>
                        <section class="product-comments mb-4">

                            <section class="comment-add-wrapper">
                                <button class="comment-add-button" type="button" data-bs-toggle="modal" data-bs-target="#add-comment" ><i class="fa fa-plus"></i> افزودن دیدگاه</button>
                                <!-- start add comment Modal -->
                                <section class="modal fade" id="add-comment" tabindex="-1" aria-labelledby="add-comment-label" aria-hidden="true">
                                    <section class="modal-dialog">
                                        <section class="modal-content">
                                            <section class="modal-header">
                                                <h5 class="modal-title" id="add-comment-label"><i class="fa fa-plus"></i> افزودن دیدگاه</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </section>

                                            @guest
                                            <section class="modal-body">
                                                <p>کاربر گرامی لطفا برای ثبت نظر ابتدا وارد حساب کاربری خود شوید </p>
                                                <p>لینک ثبت نام و یا ورود
                                                    <a href="{{ route('auth.customer.login-register-form') }}">کلیک کنید</a>
                                                </p>
                                            </section>
                                        @endguest
                                        

                                            @auth
                                                
                                            
                                            <section class="modal-body">
                                                <form class="row" action="{{route('customer.market.add-comment',$product)}}" method="POST">
                                                    @csrf

                                                    {{-- <section class="col-6 mb-2">
                                                        <label for="first_name" class="form-label mb-1">نام</label>
                                                        <input type="text" class="form-control form-control-sm" id="first_name" placeholder="نام ...">
                                                    </section>

                                                    <section class="col-6 mb-2">
                                                        <label for="last_name" class="form-label mb-1">نام خانوادگی</label>
                                                        <input type="text" class="form-control form-control-sm" id="last_name" placeholder="نام خانوادگی ...">
                                                    </section> --}}

                                                    <section class="col-12 mb-2">
                                                        <label for="comment" class="form-label mb-1">دیدگاه شما</label>
                                                        <textarea class="form-control form-control-sm" id="comment" placeholder="دیدگاه شما ..." rows="4" name="body"></textarea>
                                                    </section>
                                                    <section class="modal-footer py-1">
                                                        <button type="submit" class="btn btn-sm btn-primary">ثبت دیدگاه</button>
                                                        <button type="button" class="btn btn-sm btn-danger" data-bs-dismiss="modal">بستن</button>
                                                    </section>
                                                </form>
                                            </section>
                                            <section class="modal-footer py-1">
                                                
                                                @endauth
                                            </section>
                                        </section>
                                    </section>
                                </section>
                            </section>
                       
                            @foreach ($product->activeComments() as $activeComment)
                            <section class="product-comment">
                                <section class="product-comment-header d-flex justify-content-start">
                                    <section class="product-comment-date">{{ jalaliDate($activeComment->created_at) }}</section>
                                    @php
                                        $author = $activeComment->user()->first();
                                    @endphp
                                    <section class="product-comment-title">
                                        @if(empty($author->first_name) && empty($author->last_name))
                                            ناشناس
                                            @else
                                            {{ $author->first_name . ' ' . $author->last_name }}
                                        @endif
                                    </section>
                                </section>
                                <section class="product-comment-body @if($activeComment->answers()->count() > 0) border-bottom  @endif">
                                 {!! $activeComment->body !!}
                                </section>

                                @foreach ($activeComment->answers()->get() as $commentAnswer)
                                <section class="product-comment">
                                    <section class="product-comment-header d-flex justify-content-start">
                                        <section class="product-comment-date">{{ jalaliDate($commentAnswer->created_at) }}</section>
                                        @php
                                            $author = $commentAnswer->user()->first();
                                        @endphp
                                        <section class="product-comment-title">
                                            @if(empty($author->first_name) && empty($author->last_name))
                                                ناشناس
                                                @else
                                                {{ $author->first_name . ' ' . $author->last_name }}
                                            @endif
                                        </section>
                                    </section>
                                    <section class="product-comment-body @if($commentAnswer->answers()->count() > 0) border-bottom @endif">
                                     {!! $commentAnswer->body !!}
                                    </section>
                                </section>
                                @endforeach



                        </section>
                        @endforeach
                    </section>

                </section>
            </section>
        </section>
    </section>
</section>
<!-- end description, features and comments -->

@endsection

 
@section('script')
{{-- <script>
    document.addEventListener("DOMContentLoaded", function() {
        let colorLabels = document.querySelectorAll('.color-label');
        let selectedColorName = document.getElementById('selected_color_name');

        colorLabels.forEach(label => {
            label.addEventListener('click', function() {
                let colorName = this.getAttribute('data-color-name');
                let relatedInput = document.getElementById(this.getAttribute('for'));
                
                // انتخاب اینپوت مربوطه
                relatedInput.checked = true;
                
                // تغییر متن رنگ انتخاب‌شده
                selectedColorName.innerText = colorName;
            });
        });
    });
</script>  --}}

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
$(document).ready(function () {
    bill(); // اجرای اولیه محاسبه قیمت

    // تغییر رنگ
    $(document).on('change', 'input[name="color"]', function () {
        bill();
    });

    // تغییر گارانتی
    $(document).on('change', '#guarantee', function () {
        bill();
    });

    // دکمه کاهش تعداد
    $(document).on('click', '.cart-number-down', function () {
        let value = parseInt($('#number').val()) || 1;
        if (value > 1) {
            $('#number').val(value - 1);
            bill();
        }
    });

    // دکمه افزایش تعداد
    $(document).on('click', '.cart-number-up', function () {
        let value = parseInt($('#number').val()) || 1;
        if (value < 5) {
            $('#number').val(value + 1);
            bill();
        }
    });

    // تغییر تعداد با وارد کردن عدد
    $(document).on('input', '#number', function () {
        let value = parseInt($(this).val()) || 1;
        if (value < 1) {
            $(this).val(1);
            value = 1;
        }
        if (value > 5) {
            $(this).val(5);
            value = 5;
        }
        bill();
    });
});

function bill() {
    let selectedColor = $('input[name="color"]:checked');
    let selectedGuarantee = $('#guarantee option:selected');
    let number = parseInt($('#number').val()) || 1;

    // نمایش نام رنگ انتخاب‌شده
    if (selectedColor.length) {
        $("#selected_color_name").html(selectedColor.attr('data-color-name'));
    }

    // دریافت قیمت‌ها
    let productBasePrice = parseFloat($('#product_price').attr('data-product-original-price')) || 0; // قیمت پایه
    let selectedColorPrice = parseFloat(selectedColor.attr('data-color-price')) || 0;
    let selectedGuaranteePrice = parseFloat(selectedGuarantee.attr('data-guarantee-price')) || 0;
    let productDiscountPrice = parseFloat($('#product-discount-price').attr('data-product-discount-price')) || 0;

    // بررسی مقدار `NaN` و جلوگیری از خراب شدن محاسبات
    if (isNaN(productBasePrice)) productBasePrice = 0;
    if (isNaN(selectedColorPrice)) selectedColorPrice = 0;
    if (isNaN(selectedGuaranteePrice)) selectedGuaranteePrice = 0;
    if (isNaN(productDiscountPrice)) productDiscountPrice = 0;

    console.log("Base Price: ", productBasePrice);
    console.log("Color Price: ", selectedColorPrice);
    console.log("Guarantee Price: ", selectedGuaranteePrice);
    console.log("Discount Price: ", productDiscountPrice);

    // محاسبه قیمت نهایی
    let productPrice = productBasePrice + selectedColorPrice + selectedGuaranteePrice;
    let finalPrice = number * (productPrice - productDiscountPrice);

    // بررسی مقدار `NaN` در خروجی نهایی و جایگزینی با مقدار معتبر
    if (isNaN(finalPrice)) {
        finalPrice = 0;
    }

    // نمایش قیمت در صفحه
    $('#product-price').html(productPrice.toLocaleString()); // نمایش قیمت پایه به‌علاوه گارانتی یا رنگ انتخاب‌شده
    $('#final-price').html(finalPrice.toLocaleString()); // مقدار نهایی نمایش داده شود
}


</script>


<script>

$(document).ready(function() {
    var s = $("#introduction-features-comments");
    var pos = s.position();
    $(window).scroll(function() {
        var windowpos = $(window).scrollTop();

        if (windowpos >= pos.top) {
            s.addClass("stick");
        } else {
            s.removeClass("stick");
        }
    });
});

</script>







@endsection