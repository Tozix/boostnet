@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12 mb-4">
            <!-- Call to Action Well -->
            <div class="card text-white bg-secondary text-center">
                <div class="card-body">
                    <p class="m-0">Админка</p>
                </div>
            </div>
        </div>
        <div class="col-md-12">
            <div class="row">
                <div class="col-md-3 mb-4">
                    <div class="list-group">
                        <a href="{{ route('admin.index')}}"
                            class="list-group-item list-group-item-action {{ Request::is('admin/index') ? 'active' : '' }}"><i
                                class="fa fa-swatchbook"></i> Главная</a>
                        <a href="{{ route('admin.catalog.category.index')}}"
                            class="list-group-item list-group-item-action {{ Request::is('admin/catalog/category*') ? 'active' : '' }} "><i
                                class="fa fa-users"></i> Категории</a>
                        <a href="{{ route('admin.catalog.brand.index')}}"
                            class="list-group-item list-group-item-action {{ Request::is('admin/catalog/brand*') ? 'active' : '' }} "><i
                                class="fa fa-users"></i> Бренды</a>
                        <a href="{{ route('admin.catalog.product.index')}}"
                            class="list-group-item list-group-item-action {{ Request::is('admin/catalog/product*') ? 'active' : '' }} "><i
                                class="fa fa-users"></i> Товары</a>
                        <a href="{{ route('admin.catalog.order.index')}}"
                            class="list-group-item list-group-item-action {{ Request::is('admin/catalog/order*') ? 'active' : '' }} "><i
                                class="fa fa-users"></i> Заказы</a>
                        <a href="{{ route('admin.user.index')}}"
                            class="list-group-item list-group-item-action {{ Request::is('admin/user*') ? 'active' : '' }} "><i
                                class="fa fa-users"></i> Пользователи</a>
                        <a href="{{ route('admin.page.index')}}"
                            class="list-group-item list-group-item-action {{ Request::is('admin/page*') ? 'active' : '' }} "><i
                                class="fa fa-users"></i> Статичные страницы</a>
                    </div>
                </div>
                <div class="col-md-9 mb-4">
                    <div class="card h-100">
                        <div class="card-body">
                            @if ($message = Session::get('success'))
                            <div class="alert alert-success alert-dismissible mt-0" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Закрыть">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                                {{ $message }}
                            </div>
                            @endif

                            @if ($errors->any())
                            <div class="alert alert-danger alert-dismissible mt-0" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Закрыть">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                                <ul class="mb-0">
                                    @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                            @endif
                            @yield('admincontent')
                        </div>
                    </div>
                </div>
            </div>

        </div>


    </div>
</div>


@endsection
@push('styles')
<!-- wysiwyg-редактор -->
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.css" rel="stylesheet">
@endpush
@push('scripts')
<!-- wysiwyg-редактор -->
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.js" defer></script>
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/lang/summernote-ru-RU.min.js" defer></script>
<script src="{{ asset('js/admin.js') }}" defer></script>
@endpush