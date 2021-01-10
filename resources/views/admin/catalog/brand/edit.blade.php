@extends('admin.index', ['title' => 'Редактирование бренда'])
@section('admincontent')
<h1>Редактирование бренда</h1>
<form method="post" enctype="multipart/form-data" action="{{ route('admin.catalog.brand.update', ['brand' => $brand->id]) }}">
    @method('PUT')
    @include('admin.catalog.brand.part.form')
</form>

@endsection