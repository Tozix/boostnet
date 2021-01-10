@extends('admin.index')
@section('admincontent')
<div class="col-md-12">
<h1>Редактирование категории</h1>
<h1>Редактирование категории</h1>
    <form method="post" enctype="multipart/form-data"
        action="{{ route('admin.catalog.category.update', ['category' => $category->id]) }}">
        @method('PUT')
        @include('admin.catalog.category.part.form')
    </form>
</div>

@endsection