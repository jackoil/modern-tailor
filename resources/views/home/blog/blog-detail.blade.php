



@extends('home.layouts.home')

@section('title')
    صفحه ای {{ __($product->slug) }}
@endsection


@section('style')
    <style>
        body{

        }
     video {
       width: 100%;
       height: auto;
    }


    </style>
@endsection

@section('content')


   <!--================Blog Area =================-->
    <section class="  blog_area section-padding">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 posts-list">
                    <div class="single-post row">
                        <div class="col-lg-12">
                            <div class="feature-img">
                                <image style="width: 100%" class="img-fluid" src=" {{ env('PRODUCT_IMAGES_UPLOAD_PATH'). $product->primary_image ?? "" }} " alt="">
                            </div>
                            <hr/>
                            <div class= "col-s-6" >
                                <video width="700" height="90"   controls>
                                    <source src="{{   URL::asset($product->video)  ??   URL::asset("upload/files/products/images/test.mp4")}}" type="video/mp4">
                                        <source src="{{   URL::asset($product->video)  ??   URL::asset("upload/files/products/images/test.mp4")}}" type="video/webm">

                                  Your browser does not support the video tag.
                              </video>


                            </div>
                         <hr>
                        </div>

                        <div class="col-lg-3  col-md-3">
                            <div class="blog_info text-right">
                                <div class="post_tag">
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
                                <ul class="social-links">
                                    <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                                    <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                                    <li><a href="#"><i class="fa fa-github"></i></a></li>
                                    <li><a href="#"><i class="fa fa-behance"></i></a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-lg-9 col-md-9 blog_details">
                            <h5>{{$product->name}}</h5>
                            <p class="excert">
                                {{$product->description}}
                             </p>

                            <p>
                  {{$product->description}}
                            </p>
                        </div>
                        <div class="col-lg-12">
                            <div class="quotes">
                                {{$product->description}}

                            </div>
                            <div class="row">
                                <div class="col-6">
                                    <img class="img-fluid" src="{{ asset('images/blog/blog-details/post-img1.jpg') }}" alt="">
                                </div>
                                <div class="col-6">
                                    <img class="img-fluid" src="{{ asset('images/blog/blog-details/post-img2.jpg') }}" alt="">
                                </div>
                                @foreach ($product->images  as $image )

                                <div class="col-6">
                                    <img class="img-fluid" src="{{ $image->image }}" alt="">
                                </div>

                                @endforeach
                                <div class="col-lg-12 my-4">
                                    <p>
                                        {{$product->description}}
                                   </p>

                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="comments-area">
                        <h4>{{$product->approvedComments->count()}} {{__('Comments')}}</h4>
                        @if ($product->approvedComments )

                        @foreach( $product->approvedComments as $comment )
                        <div class="comment-list">
                            <div class="single-comment justify-content-between d-flex">
                                <div class="user justify-content-between d-flex">
                                    <div class="thumb">
                                        <img src="{{ asset('images/blog/blog-details/c1.jpg') }}" alt="">
                                    </div>
                                    <div class="desc">
                                        <h5><a href="#">{{ $comment->user->name }}</a></h5>
                                        <p class="date">{{verta($comment->created_at) }} </p>
                                        <p class="comment">
                                           {{$comment->text}}
                                        </p>
                                    </div>
                                </div>
                                <div class="reply-btn">
                                        <a href="" class="btn-reply text-uppercase">reply</a>
                                </div>
                            </div>
                        </div>
                        @endforeach
                        @endif
                        <div class="comment-list left-padding">
                            <div class="single-comment justify-content-between d-flex">
                                <div class="user justify-content-between d-flex">
                                    <div class="thumb">
                                        <img src="{{ asset('images/blog/blog-details/c2.jpg') }}" alt="">
                                    </div>
                                    <div class="desc">
                                        <h5><a href="#">Elsie Cum</a></h5>
                                        <p class="date">December 4, 2017 at 3:12 pm </p>
                                        <p class="comment">
                                            Never say goodbye till the end comes!
                                        </p>
                                    </div>
                                </div>
                                <div class="reply-btn">
                                        <a href="" class="btn-reply text-uppercase">reply</a>
                                </div>
                            </div>
                        </div>
                        <div class="comment-list left-padding">
                            <div class="single-comment justify-content-between d-flex">
                                <div class="user justify-content-b etween d-flex">
                                    <div class="thumb">
                                        <img src="{{ asset('images/blog/blog-details/c2.jpg') }}" alt="">
                                    </div>
                                    <div class="desc">
                                        <h5><a href="#">Annie Steph</a></h5>
                                        <p class="date">December 4, 2017 at 3:12 pm </p>
                                        <p class="comment">
                                            Never say goodbye till the end comes!
                                        </p>
                                    </div>
                                </div>
                                <div class="reply-btn">
                                        <a href="" class="btn-reply text-uppercase">reply</a>
                                </div>
                            </div>
                        </div>
                        <div class="comment-list">
                            <div class="single-comment justify-content-between d-flex">
                                <div class="user justify-content-between d-flex">
                                    <div class="thumb">
                                        <img src="{{ asset('images/blog/blog-details/c4.jpg') }}" alt="">
                                    </div>
                                    <div class="desc">
                                        <h5><a href="#">Maria Luna</a></h5>
                                        <p class="date">December 4, 2017 at 3:12 pm </p>
                                        <p class="comment">
                                            Never say goodbye till the end comes!
                                        </p>
                                    </div>
                                </div>
                                <div class="reply-btn">
                                        <a href="" class="btn-reply text-uppercase">reply</a>
                                </div>
                            </div>
                        </div>
                        <div class="comment-list">
                            <div class="single-comment justify-content-between d-flex">
                                <div class="user justify-content-between d-flex">
                                    <div class="thumb">
                                        <img src="{{ asset('images/blog/blog-details/c5.jpg') }}" alt="">
                                    </div>
                                    <div class="desc">
                                        <h5><a href="#">Ina Hayes</a></h5>
                                        <p class="date">December 4, 2017 at 3:12 pm </p>
                                        <p class="comment">
                                            Never say goodbye till the end comes!
                                        </p>
                                    </div>
                                </div>
                                <div class="reply-btn">
                                        <a href="" class="btn-reply text-uppercase">reply</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="comment-form">
                        <h4> {{ __('Leave a Reply')}} </h4>
                        <form method="POST" action="{{route('home.blog.addcomment' ,['slug' => $product->slug])}}">
                            @csrf
                            <div class="form-group form-inline">
                                <div class="form-group col-lg-6 col-md-6 name">
                                <input type="text" class="form-control" id="name" placeholder="Enter Name" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Enter Name'">
                                </div>
                                <div class="form-group col-lg-6 col-md-6 email">
                                <input type="email" class="form-control" id="email" placeholder="Enter email address" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Enter email address'">
                                </div>
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control" id="subject" placeholder="Subject" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Subject'">
                            </div>
                            <div class="form-group">
                                <textarea class="form-control mb-10" rows="5" name="text" placeholder="Messege" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Messege'" required=""></textarea>
                            </div>
                            <button type="submit" class="bbtns">{{ __('Post Comment') }} </button>
                        </form>
                    </div>
                </div>
                <div class="col-lg-4">

                    @include('home.blog.blog_left_sidebar')
                </div>
            </div>
        </div>
    </section>
    <!--================Blog Area =================-->

    <!-- Footer Area Starts -->
    <footer class="footer-area section-padding">
        <div class="footer-widget">
            <div class="container">
                <div class="row">
                    <div class="col-xl-2 col-lg-3">
                        <div class="single-widget-home mb-5 mb-lg-0">
                            <h3 class="mb-4">top products</h3>
                            <ul>
                                <li class="mb-2"><a href="#">managed website</a></li>
                                <li class="mb-2"><a href="#">managed reputation</a></li>
                                <li class="mb-2"><a href="#">power tools</a></li>
                                <li><a href="#">marketing service</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-xl-5 offset-xl-1 col-lg-6">
                        <div class="single-widget-home mb-5 mb-lg-0">
                            <h3 class="mb-4">newsletter</h3>
                            <p class="mb-4">You can trust us. we only send promo offers, not a single.</p>
                            <form action="#">
                                <input type="email" placeholder="Your email here" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Your email here'" required>
                                <button type="submit" class="template-btn">subscribe now</button>
                            </form>
                        </div>
                    </div>
                    <div class="col-xl-3 offset-xl-1 col-lg-3">
                        <div class="single-widge-home">
                            <h3 class="mb-4">instagram feed</h3>
                            <div class="feed">
                                <img src="{{asset('images/blog/feed1.jpg')}}" alt="feed">
                                <img src="{{asset('images/blog/feed2.jpg')}}" alt="feed">
                                <img src="{{asset('images/blog/feed3.jpg')}}" alt="feed">
                                <img src="{{asset('images/blog/feed4.jpg')}}" alt="feed">
                                <img src="{{asset('images/blog/feed5.jpg')}}" alt="feed">
                                <img src="{{asset('images/blog/feed6.jpg')}}" alt="feed">
                                <img src="{{asset('images/blog/feed7.jpg')}}" alt="feed">
                                <img src="{{asset('images/blog/feed8.jpg')}}" alt="feed">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        @endsection

