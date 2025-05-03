@extends('admin.layouts.admin')

@section('title')
    index comments
@endsection

<style>
    .blog-author {
        padding: 40px 30px;
        background: #fbf9ff;
        margin-top: 50px;

        @media(max-width: 600px) {
            padding: 20px 8px;
        }

        img {
            width: 90px;
            height: 90px;
            border-radius: 50%;
            margin-right: 30px;

            @media(max-width: 600px) {
                margin-right: 15px;
                width: 45px;
                height: 45px;
            }
        }

        a {
            display: inline-block;

            // color: $title-color;
            &:hover {
                color: $btn_bg;
            }
        }

        p {
            margin-bottom: 0;
            font-size: 15px;
        }

        h4 {
            font-size: 16px;
        }
    }

    .media-body {

        h3 {
            font-size: 16px;
            margin-bottom: 0;
            font-size: 16px;
            color: #2a2a2a;

            a {
                &:hover {
                    color: $theme-color2;
                }
            }
        }

        p {
            color: #8a8a8a;
        }
    }
</style>

<link href="{{ asset('/css/blog.css') }}" rel="stylesheet">

@section('content')

<div class="row">

<div class="col-xl-12 col-md-12 mb-4 p-4 bg-white">
    <div class="d-flex flex-column text-center flex-md-row justify-content-md-between mb-4">
        <h5 class="font-weight-bold mb-3 mb-md-0">لیست کامنت ها ({{ $comments->total() }})</h5>

    </div>

    <div class="table-responsive">
        <table class="table table-bordered table-striped text-center">

            <thead>
                <tr>
                    <th>#</th>
                    <th>نام کاربر</th>
                    <th>نام محصول</th>
                    <th>متن کامنت</th>
                    <th>وضعیت</th>
                    <th>عملیات</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($comments as $key => $comment)
                <tr>
                    <th>
                        {{ $comments->firstItem() + $key }}
                    </th>
                    <th>
                        {{-- <a href="{{  }}"> --}}
                            {{ $comment->user->name == null ? $comment->user->cellphone : $comment->user->name  }}
                        {{-- </a> --}}
                    </th>
                    <th>
                        <a href="{{ route('admin.products.show' , ['product' => $comment->product->id]) }}">
                            {{ $comment->product->name }}
                        </a>
                    </th>
                    <th>
                        {{ $comment->text }}
                    </th>
                    <th
                        class="{{ $comment->getRawOriginal('approved') ? 'text-success' : 'text-danger' }}"
                    >
                        {{ $comment->approved }}
                    </th>
                    <th>
                        <a class="btn btn-sm btn-outline-success"
                            href="{{ route('admin.comments.show', ['comment' => $comment->id]) }}">نمایش</a>
                        <a class="btn btn-sm btn-outline-info mr-3"
                            href="{{ route('admin.comments.change-approve', ['comment' => $comment->id]) }}">ویرایش</a>

                            <form action="{{ route('admin.comments.destroy', ['comment' => $comment->id]) }}" method="POST">
                                @csrf
                                @method('DELETE')

                                <button class="btn btn-sm btn-outline-danger" type="submit">حذف</button>
                            </form>
                    </th>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>

    <div class="d-flex justify-content-center mt-5">
        {{ $comments->render() }}
    </div>
</div>
</div>

    <div class="blog-author">
        <div class="media align-items-center">
            <img src="{{ asset('images/author.png') }}" alt="">
            <div class="media-body">
                <a href="#">
                    @auth
                        <h4>{{Auth::user()->name}}</h4>
                    @else
                        <h4>Harvard milan</h4>
                    @endauth

                </a>
                <p>Second divided from form fish beast made. Every of seas all gathered use saying you're, he
                    our dominion twon Second divided from</p>
            </div>
        </div>
    </div>
    <div class="comments-area">
        <h4>{{ $comments->count() }} Comments </h4>

        @foreach ($comments as $comment)
            <div class="comment-list">
                <div class="single-comment justify-content-between d-flex">
                    <div class="user justify-content-between d-flex">
                        <div class="thumb">
                            <img src="{{ asset('images/comment_' . (($comment->id % 3) + 1) . '.png') }}" alt="">
                        </div>
                        <div class="desc">
                            <p class="comment">
                                {{ $comment->text }}
                            </p>
                            <div class="d-flex justify-content-between">
                                <div class="  p-3 align-items-center">
                                    <h5>
                                        <a href="#">{{ $comment->user->name }}</a>
                                    </h5>
                                    <p class="date">{!! Carbon::parse($comment->created_at)->toDayDateTimeString() !!}</p>
                                </div>
                                <div class="reply-btn">
                                    <a href="#" class="btn-reply text-uppercase">reply</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach

    </div>
@endsection
