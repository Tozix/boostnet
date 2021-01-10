@extends('admin.index', ['title' => 'Редактирование товара'])

@section('admincontent')
<h1>Редактирование товара</h1>
<form method="post" enctype="multipart/form-data"
    action="{{ route('admin.catalog.product.update', ['product' => $product->id]) }}">
    @method('PUT')
    @include('admin.catalog.product.part.form')
</form>
@endsection