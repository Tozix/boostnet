@extends('admin.index', ['title' => 'Создание нового бренда'])
@section('admincontent')
<h1>Создание нового бренда</h1>
<form method="post" action="{{ route('admin.catalog.brand.store') }}" enctype="multipart/form-data">
    @include('admin.catalog.brand.part.form')
</form>
@endsection