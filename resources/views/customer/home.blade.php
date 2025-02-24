@extends('customer.layouts.master-one-col')


@section('content')


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
                                                <a class="product-link" href="#">
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
                        <!-- start vontent header -->
                        {{-- <section class="lazyload-wrapper" >
                            <section class="lazyload light-owl-nav owl-carousel owl-theme">

                                @foreach ($offerProducts as $offerProduct)

                               <section class="col">
                                        <section class="lazyload-item-wrapper">
                                            <section class="product">
                                                <a class="product-link" href="#">
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

 --}}


           <!-- start content header -->
           <section class="lazyload-wrapper">
            <section class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 g-3">

                @foreach ($offerProducts as $offerProduct)
                    <section class="col">
                        <section class="lazyload-item-wrapper">
                            <section class="product">
                                <a class="product-link" href="#">
                                    <section class="product-image">
                                        <img class="w-100" src="{{ asset($offerProduct->image['indexArray']['medium']) }}" alt="{{ $offerProduct->name }}">
                                    </section>
                                    <section class="product-colors"></section>
                                    <section class="product-name">
                                        <h3>{{ Str::limit($offerProduct->name, 10) }}</h3>
                                    </section>
                                    <section class="product-price-wrapper">
                                        <section class="product-discount"></section>
                                        <section class="product-price">{{ priceFormat($offerProduct->price) }} تومان</section>
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