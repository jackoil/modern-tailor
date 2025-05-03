@extends('admin.layouts.admin')

@section('title')
    صفحه ای ورود
@endsection
 <!-- Custom styles for this template-->

 <link href="{{ asset('/css/404.css') }}" rel="stylesheet">
@section('content')


          <div class="container-fluid">

            <!-- 404 Error Text -->
            <div class="text-center">
              <div class="error mx-auto" data-text="404">404</div>
              <p class="lead text-gray-800 mb-5">! صفحه پیدا نشد  </p>
              <p class="text-gray-500 mb-3">

                متاسفانه این صفحه پیدا نشد و باید برگردیم به صفحه اصلی

            </p>
              <a href="{{route('dashboard')}}"> بازگشت به داشبورد &larr;

              </a>
            </div>

          </div>


@endsection
