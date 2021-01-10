@extends('admin.index', ['title' => 'Редактирование страницы'])

@section('admincontent')
<h1>Редактирование страницы</h1>
<form method="post" action="{{ route('admin.page.update', ['page' => $page->id]) }}">
    @method('PUT')
    @include('admin.page.part.form')
</form>
@endsection