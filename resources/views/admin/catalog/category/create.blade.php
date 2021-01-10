@extends('admin.index')
@section('admincontent')
<div class="col-md-12">
 <h1>Создание новой категории</h1>
    <form method="post" action="{{ route('admin.catalog.category.store') }}" enctype="multipart/form-data">
        @include('admin.catalog.category.part.form')
    </form>

@endsection