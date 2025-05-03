

@extends('home.layouts.home')

@section('title')
    صفحه ای  blog
@endsection

<style>
    .banner-area1{
           /* background-image:  url("upload/files/banners/images/2025_1_28_19_30_36_438542_images (1).jpeg") ; */
         /* background-image: url( env('BANNER_IMAGES_UPLOAD_PATH').$bannerImage ); */
    }

</style>



@section('content')

    <!-- Banner Area Starts -->
    <section class="banner-area1    other-page"  style=" background-image:url('{{ $bannerImage }} ')"  >
        <div class="container">
            <div class="row">

                <div class="col-lg-12">
                    <h1>    صفحه   ی  blog   </h1>
                    <a href="{{route('home.index')}}">Home</a> <span>|</span> <a href="{{route('home.blog.index')}}">Blog Home</a>
                </div>
            </div>
        </div>
    </section>
    <!-- Banner Area End -->

    <!--================Blog Categorie Area =================-->
    <section class="blog_categorie_area">
        <div class="container">
            <div class="row">
                @foreach ($banners->get()   as $banner)

                <div class="col-lg-4 col-md-6 mb-4 mb-lg-0">
                    <div class="categories_post">
                        <img src="{{  env('BANNER_IMAGES_UPLOAD_PATH'). $banner->image   }}" alt="post">
                        <div class="categories_details">
                            <div class="categories_text">
                                <a href="blog-details.html"><h5>{{$banner->name}}</h5></a>
                                <div class="border_line"></div>
                                <p> {{$banner->description}}</p>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
                <div class="col-lg-4 col-md-6 mb-4 mb-lg-0">
                    <div class="categories_post">
                        <img src="{{ asset('/images/blog/blog/cat-post/cat-post-2.jpg') }}" alt="post">
                        <div class="categories_details">
                            <div class="categories_text">
                                <a href="blog-details.html"><h5>Politics</h5></a>
                                <div class="border_line"></div>
                                <p>Be a part of politics</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="categories_post">
                        <img src="{{ asset('/images/blog/blog/cat-post/cat-post-1.jpg') }}" alt="post">
                        <div class="categories_details">
                            <div class="categories_text">
                                <a href="blog-details.html"><h5>Food</h5></a>
                                <div class="border_line"></div>
                                <p>Let the food be finished</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--================Blog Categorie Area =================-->

    <!--================Blog Area =================-->
    <section class="blog_area">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-6 posts-list">


                    <div class="blog_left_sidebar">
                        @foreach ($products as $product)
                        <article class="row blog_item">
                           <div class="col-md-3">
                               <div class="blog_info text-right">
                                    <div class="post_tag">
                                        @foreach ($product->tags as $tag )
                                               <a href="#">{{$tag->name}},</a>
                                        @endforeach
                                        <a href="#">Food,</a>
                                        <a class="active" href="#">Technology,</a>
                                        <a href="#">Politics,</a>
                                        <a href="#">Lifestyle</a>
                                    </div>
                                    <ul class="blog_meta list">
                                        <li><a href="#">Mark wiens<i class="fa fa-user-o"></i></a></li>
                                        <li><a href="#"> {{ 'پست  شده در ' }}   {{ verta($product->created_at)->format(' l %d  %B %Y ساعت  h:m')  }}  <i class="fa fa-calendar-o"></i></a></li>
                                        <li><a href="#">{{ 'ویرایش شده در ' }}  {{ verta($product->updated_at)->format(' l %d  %B %Y ساعت  h:m')  }}   <i class="fa fa-calendar-o"></i></a></li>
                                        <li><a href="#"> 1.2M Views <i class="fa fa-eye"></i></a></li>
                                        <li><a href="#">{{  $product->approvedComments->count() }}   Comments <i class="fa fa-comment-o"></i></a></li>
                                    </ul>
                                </div>
                           </div>
                            <div class="col-md-9">
                                <div class="blog_post">
                                    <img src=" {{  env('PRODUCT_IMAGES_UPLOAD_PATH'). $product->primary_image   }} "
                                     alt="">
                                    <div class="blog_details">
                                        <a href="blog-details.html"><h4>{{ $product->name }}</h4></a>
                                        <p>MCSE boot camps have its supporters and its detractors. Some people do not understand why you should have to spend money on boot camp when you can get the MCSE study materials yourself at a fraction.</p>
                                        <a href="{{route('home.blog.view' , ['slug'=>  $product->slug     ])}}" class="template-btn">View More</a>
                                    </div>
                                </div>
                            </div>
                        </article>

                    @endforeach


                        <article class="row blog_item aria-hidden  " aria-hidden="true"  id="last_blog">
                           <div class="col-md-3">
                               <div class="blog_info text-right">
                                    <div class="post_tag">
                                        <a href="#">Food,</a>
                                        <a class="active" href="#">Technology,</a>
                                        <a href="#">Politics,</a>
                                        <a href="#">Lifestyle</a>
                                    </div>
                                    <ul class="blog_meta list">
                                        <li><a href="#">Mark wiens<i class="fa fa-user-o"></i></a></li>
                                        <li><a href="#">12 Dec, 2017<i class="fa fa-calendar-o"></i></a></li>
                                        <li><a href="#">1.2M Views<i class="fa fa-eye"></i></a></li>
                                        <li><a href="#">06 Comments<i class="fa fa-comment-o"></i></a></li>
                                    </ul>
                                </div>
                           </div>
                            <div class="col-md-9">
                                <div class="blog_post">
                                    <img src="{{ asset('images/blog/blog/main-blog/m-blog-5.jpg') }}" alt="">
                                    <div class="blog_details">
                                        <a href="blog-details.html"><h4>Telescopes 101</h4></a>
                                        <p>MCSE boot camps have its supporters and its detractors. Some people do not understand why you should have to spend money on boot camp when you can get the MCSE study materials yourself at a fraction.</p>
                                        <a href="blog-details.html" class="template-btn">View More</a>
                                    </div>
                                </div>
                            </div>
                        </article>

                     {{ $products->links() }}

                        {{-- <nav class="blog-pagination justify-content-center d-flex">
                            <ul class="pagination">
                                <li class="page-item">
                                    <a href="#" class="page-link" aria-label="Previous">
                                        <span aria-hidden="true">
                                            <span class="fa fa-angle-left"></span>
                                        </span>
                                    </a>
                                </li>

                                <li class="page-item"><a href="#" class="page-link">01</a></li>
                                <li class="page-item {{ 0==0 ?  "active": "" }}"><a href="#" class="page-link">02</a></li>
                                <li class="page-item"><a href="#" class="page-link">03</a></li>
                                <li class="page-item"><a href="#" class="page-link">04</a></li>
                                <li class="page-item"><a href="#" class="page-link">09</a></li>
                                <li class="page-item">
                                    <a href="#" class="page-link" aria-label="Next">
                                        <span aria-hidden="true">
                                            <span class="fa fa-angle-right"></span>
                                        </span>
                                    </a>
                                </li>
                            </ul>
                        </nav> --}}

                    </div>


                </div>
                <div class="col-lg-5 col-md-6 ">
                    @include('home.blog.blog_left_sidebar')
                </div>
            </div>
        </div>
    </section>
    <!--================Blog Area =================-->


    @endsection
