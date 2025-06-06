 @extends('home.layouts.home')

 @section('title')
     صفحه ای ورود
 @endsection

 @section('head')
     <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

     <!-- Custom styles for this template-->
     <link href="{{ asset('css/sb-admin-2.min.css') }}" rel="stylesheet">
 @endsection

 @section('content')
     <div class="bg-gradient-primary">

         <div class="container">

             <!-- Outer Row -->
             <div class="row justify-content-center">

                 <div class="col-xl-10 col-lg-12 col-md-9">

                     <div class="card o-hidden border-0 shadow-lg my-5">
                         <div class="card-body p-0">
                             <!-- Nested Row within Card Body -->
                             <div class="row">
                                 <div class="col-lg-6 d-none d-lg-block bg-password-image"></div>
                                 <div class="col-lg-6">
                                     <div class="p-5">
                                         <div class="text-center">
                                             <h1 class="h4 text-gray-900 mb-2"> ! فراموشی رمز عبور </h1>
                                             <p class="mb-4">
                                                 ایمیل یا شماره تلفن را وارد نمایید
                                             </p>
                                         </div>
                                         <form class="user" method="POST" action="{{ route('password.request') }}">
                                            @csrf

                                             <div class="form-group">
                                                 <input type="email" class="form-control form-control-user" name="email"
                                                     id="exampleInputEmail" aria-describedby="emailHelp"
                                                     placeholder="ایمیل ...">
                                             </div>
                                             <button type='submit' class="btn btn-primary btn-user btn-block">
                                                 بازیابی رمز عبور
                                             </button>
                                         </form>


                                         @if (session('status'))
                                             <div class=" alert alert-success mb-4 font-medium text-sm text-green-600" role="alert">
                                                 {{ session('status') }}
                                             </div>
                                         @endif
                                         <hr>
                                         <div class="text-center">
                                             <a class="small" href="{{ route('register') }}"> ایجاد حساب ! </a>
                                         </div>
                                         <div class="text-center">
                                             <a class="small" href="{{ route('login') }}"> آیا حساب داری ؟ لاگین ! </a>
                                         </div>
                                     </div>
                                 </div>
                             </div>
                         </div>
                     </div>

                 </div>

             </div>

         </div>



     </div>
 @endsection
