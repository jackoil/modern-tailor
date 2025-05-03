@extends('home.layouts.home')

@section('title')
    {{ __('main') }}
@endsection


@section('content')
    <div id="app">
        <div class="container">
            <h1> ---- سفارش ----   </h1>
            <h3> {{ $order['order']->user->name }} </h3>
            <hr>
            <h2> --- مبلغ ---  </h2>
            <h4> {{ $order['order']->total_amount }} </h4>

            <order :order="{{ $order['order'] }}"  :user="{{$order['order']->user}}" />

        </div>
    </div>
    <script src="{{ mix('js/app.js') }}"></script>
@endsection
