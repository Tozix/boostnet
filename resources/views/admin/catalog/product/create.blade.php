@extends('admin.index', ['title' => 'Создание товара'])

@section('admincontent')
<h1>Создание нового товара</h1>
<form method="post" action="{{ route('admin.catalog.product.store') }}" enctype="multipart/form-data">
    @include('admin.catalog.product.part.form')
</form>
@endsection