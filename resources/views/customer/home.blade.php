@extends('customer.layouts.master-one-col')


@section('content')

@section('head-tag')
<style>
    .add-to-favorites {
        display: block;
        width: 100%;
        background-color: red;
        color: white;
        text-align: center;
        padding: 10px;
        font-size: 16px;
        text-decoration: none;
        border-radius: 0 0 8px 8px;
        transition: background-color 0.3s;
    }
    .add-to-favorites:hover {
        background-color: darkred;
    }
</style>
@endsection
<div class="toast" data-bs-delay="3000">
    <div class="toast-body">
      محصول به علاقه‌مندی‌ها اضافه شد.
    </div>
  </div>
  
    <!-- start slideshow -->
    <section class="container-xxl my-4">
        <section class="row align-items-stretch">
            <section class="col-md-8 pe-md-1">
                <div id="slideshow" class="carousel slide h-100" data-bs-ride="carousel">
                    <div class="carousel-inner h-100">
                        @foreach ($slideShowImages as $key => $slideShowImage)
                            <div class="carousel-item @if($key == 0) active @endif h-100">
                                <a class="w-100 d-block h-100 text-decoration-none" href="{{ urldecode($slideShowImage->url) }}">
                                    <img class="w-100 h-100 rounded-2 d-block object-fit-cover" src="{{ asset($slideShowImage->image) }}" alt="{{ $slideShowImage->title }}">
                                </a>
                            </div>
                        @endforeach
                    </div>
                    
                    <!-- Controls -->
                    <button class="carousel-control-prev" type="button" data-bs-target="#slideshow" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#slideshow" data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </button>
                </div>
            </section>
            
            <section class="col-md-4 ps-md-1 mt-2 mt-md-0 d-flex flex-column h-100">
                @foreach ($topBanners as $topBanner)
                    <section class="mb-2 flex-fill d-flex">
                        <a href="{{ urldecode($topBanner->url) }}" class="d-block w-100 h-100">
                            <img class="w-100 h-100 rounded-2 object-fit-cover" src="{{ asset($topBanner->image) }}" alt="{{ $topBanner->title }}">
                        </a>
                    </section>
                @endforeach
            </section>
        </section>
    </section>
    {{-- end --}}

            {{-- </section>
            <section class="col-md-4 ps-md-1 mt-2 mt-md-0">
                @foreach ($topBanners as $topBanner)
                <section class="mb-2">
                    <a href="{{ urldecode($slideShowImage->url) }}" class="d-block">
                        <img class="w-100 rounded-2" src="{{ asset($topBanner->image) }}" alt="{{ $topBanner->title }}">
                    </a>
                </section>
                @endforeach

            </section>
        </section>
    </section>
    <!-- end slideshow --> --}}



    <!-- start product lazy load -->
    <section class="mb-3">
        <section class="container-xxl">
            <section class="row">
                <section class="col">
                    <section class="content-wrapper bg-white p-3 rounded-2">
                        <!-- start content header -->
                        <section class="content-header">
                            <section class="d-flex justify-content-between align-items-center">
                                <h2 class="content-header-title">
                                    <span>پربازدیدترین کالاها</span>
                                </h2>
                                <section class="content-header-link">
                                    <a href="#">مشاهده همه</a>
                                </section>
                            </section>
                        </section>
                        <!-- start content header -->
                        <section class="lazyload-wrapper">
                            <section class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 g-3">

                                @foreach ($mostVisitedProducts as $mostVisitedProduct)
                                    <section class="col">
                                        <section class="lazyload-item-wrapper">
                                            <section class="product">
                                                <a class="product-link" href="{{route('customer.market.product' , $mostVisitedProduct )}}">
                                                    <section class="product-image">
                                                        <img class="w-100" src="{{ asset($mostVisitedProduct->image['indexArray']['medium']) }}" alt="{{ $mostVisitedProduct->name }}">
                                                    </section>
                                                    <section class="product-colors"></section>
                                                    <section class="product-name">
                                                        <h3>{{ Str::limit($mostVisitedProduct->name, 10) }}</h3>
                                                    </section>
                                                    <section class="product-price-wrapper">
                                                        <section class="product-discount"></section>
                                                        <section class="product-price">{{ priceFormat($mostVisitedProduct->price) }} تومان</section>
                                                    </section>
                                                </a>
                                            </section>
                                        </section>
                                    </section>
                                @endforeach
                            </section>
                        </section>
                    </section>
                </section>
            </section>
        </section>
    </section>
    
    <!-- end product lazy load -->



    <!-- start ads section -->
   <section class="mb-3">
    <section class="container-xxl">
        <!-- Two Column Banners -->
        <section class="row g-3 align-items-stretch py-4">
            @foreach ($middleBanners as $middleBanner)
                <section class="col-12 col-md-6 d-flex">
                    <a href="{{ urldecode($middleBanner->url) }}" class="d-block w-100 h-100">
                        <img class="img-fluid rounded-2 w-100 h-100 object-fit-cover" src="{{ asset($middleBanner->image) }}" alt="{{ $middleBanner->title }}">
                    </a>
                </section>
            @endforeach
        </section>
    </section>
</section>

    <!-- end ads section -->


    <!-- start product lazy load -->
    <section class="mb-3">
        <section class="container-xxl" >
            <section class="row">
                <section class="col">
                    <section class="content-wrapper bg-white p-3 rounded-2">
                        <!-- start vontent header -->
                        <section class="content-header">
                            <section class="d-flex justify-content-between align-items-center">
                                <h2 class="content-header-title">
                                    <span>پیشنهاد آمازون به شما</span>
                                </h2>
                                <section class="content-header-link">
                                    <a href="#">مشاهده همه</a>
                                </section>
                            </section>
                        </section>
                      
           <!-- start content header -->
           <section class="lazyload-wrapper">
            <section class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 g-4">
                @foreach ($offerProducts as $offerProduct)
                    <section class="col">
                        <section class="lazyload-item-wrapper">
                            <section class="product card shadow-sm border-0 rounded position-relative">
                                <a class="product-link text-decoration-none" href="{{ route('customer.market.product', $offerProduct) }}">
                                    <section class="product-image overflow-hidden rounded-top position-relative">
                                        <img class="w-100 img-fluid" src="{{ asset($offerProduct->image['indexArray']['medium']) }}" alt="{{ $offerProduct->name }}" style="object-fit: cover; height: 200px;">
                                    </section>
                                    <section class="product-body p-3">
                                        <section class="product-name mb-2">
                                            <h5 class="text-dark text-truncate" style="max-width: 100%;">{{ Str::limit($offerProduct->name, 20) }}</h5>
                                        </section>
                                        <section class="product-price-wrapper d-flex justify-content-between align-items-center">
                                            <section class="product-price text-danger fw-bold">{{ priceFormat($offerProduct->price) }} تومان</section>
                                            <section class="product-discount badge bg-success">٪ تخفیف</section>
                                        </section>
                                    </section>
                                </a>    
                                @guest
                                <button class="btn btn-light btn-sm text-decoration-none add_to_favorite" data-bs-toggle="tooltip" data-url="{{ route('customer.market.add-to-favorite', $offerProduct) }}" data-bs-placement="left" title="افزودن به علاقه مندی">
                                    <i class="fa fa-heart text-dark"></i>
                                </button>    
                                @endguest
        
                                @auth
                                @if ($offerProduct->user->contains(auth()->user()->id))
                                <button class="btn btn-light btn-sm text-decoration-none add_to_favorite" data-bs-toggle="tooltip" data-url="{{ route('customer.market.add-to-favorite', $offerProduct) }}" data-bs-placement="left" title="حذف از علاقه مندی">
                                    <i class="fa fa-heart text-danger"></i>
                                </button>
                                @else
                                <button class="btn btn-light btn-sm text-decoration-none add_to_favorite" data-bs-toggle="tooltip" data-url="{{ route('customer.market.add-to-favorite', $offerProduct) }}" data-bs-placement="left" title="اضافه به علاقه مندی">
                                    <i class="fa fa-heart text-dark"></i>
                                </button>
                                @endif    
                                @endauth
                            </section>
                        </section>
                    </section>
                @endforeach
            </section>
        </section>
        

    @if(!empty($bottomBanner))
    <!-- start ads section -->
    <section class="mb-3">
        <section class="container-xxl">
            <!-- one column -->
            <section class="row py-4">
                <section class="col">
                    <a href="{{ urldecode($bottomBanner->url) }}">
                        <img class="d-block rounded-2 w-100" src="{{ asset($bottomBanner->image) }}" alt="{{ $bottomBanner->title }}">
                    </a>
                </section>
            </section>

        </section>
    </section>
    <!-- end ads section -->

    @endif



    <!-- start brand part-->
  

    <section class="brand-part mb-4 py-4">
        <section class="container-xxl">
            <section class="row">
                <section class="col">
                    <!-- start vontent header -->
                    <section class="content-header">
                        <section class="d-flex align-items-center">
                            <h2 class="content-header-title">
                                <span>برندهای ویژه</span>
                            </h2>
                        </section>
                    </section>
                    <!-- start vontent header -->
                    <section class="brands-wrapper py-4" >
                        <section class="brands dark-owl-nav owl-carousel owl-theme">
                            @foreach ($brands as $brand)
                            

                            <section class="item">
                                <section class="brand-item">
                                    <a href="#">
                                        <img class="rounded-2" src="{{ asset($brand->logo['indexArray']['medium']) }}" alt="">
                                    </a>
                                </section>
                            </section>

                            @endforeach

                        </section>
                    </section>
                </section>
            </section>
        </section>
    </section>
    <!-- end brand part-->



@endsection


@section('script')

<script>
    $(document).ready(function() {
    // برای هر دکمه‌ای که کلاس add_to_favorite دارد
    $('.add_to_favorite').click(function() {
        var url = $(this).attr('data-url'); // URL که در data-url است
        var element = $(this); // دکمه‌ای که روی آن کلیک شده

        // ارسال درخواست AJAX به سرور
        $.ajax({
            url: url,
            type: 'GET', // یا 'POST' بسته به نیاز سرور شما
            success: function(result) {
                // بررسی وضعیت برگشتی از سرور
                if (result.status == 1) {
                    // وضعیت افزودن به علاقه‌مندی
                    $(element).children().first().addClass('text-danger');
                    $(element).attr('title', 'حذف از علاقه مندی ها');
                    $(element).attr('data-bs-original-title', 'حذف از علاقه مندی ها');
                } else if (result.status == 2) {
                    // وضعیت حذف از علاقه‌مندی
                    $(element).children().first().removeClass('text-danger');
                    $(element).attr('title', 'افزودن به علاقه مندی ها');
                    $(element).attr('data-bs-original-title', 'افزودن به علاقه مندی ها');
                } else if (result.status == 3) {
                    // در صورتی که خطایی رخ دهد
                    $('.toast').toast('show');
                }
            },
            error: function() {
                // در صورت بروز خطا
                alert("خطا در برقراری ارتباط با سرور");
            }
        });
    });
});

</script>




@endsection


