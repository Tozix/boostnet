@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="row">
                <div class="col-md-3 mb-4">
                    <div class="list-group">
                        <a href="{{ route('home')}}"
                            class="list-group-item list-group-item-action {{ Request::is('home') ? 'active' : '' }}">
                            Главная
                        </a>
                        <a href="{{ route('user.order.index')}}"
                            class="list-group-item list-group-item-action {{ Request::is('user/order*') ? 'active' : '' }} ">Мои
                            заказы
                        </a>
                        <a href="{{ route('user.profile.index')}}"
                            class="list-group-item list-group-item-action {{ Request::is('user/profile*') ? 'active' : '' }}">Профили
                            доставки
                        </a>

                        <a href="{{ route('payment')}}"
                            class="list-group-item list-group-item-action {{ Request::is('payment') ? 'active' : '' }}">Оплата
                        </a>
                    </div>
                </div>
                <div class="col-md-9 mb-4">
                    <div class="card h-100">
                        <div class="card-body">
                            @yield('homecontent')
                        </div>
                    </div>
                </div>
            </div>

        </div>


    </div>
</div>


@endsection
@push('styles')

@endpush
@push('scripts')

@endpush