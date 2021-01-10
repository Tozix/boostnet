@extends('admin.index', ['title' => 'Создание новой страницы'])

@section('admincontent')
<h1>Создание новой страницы</h1>
<form method="post" action="{{ route('admin.page.store') }}">
    @include('admin.page.part.form')
</form>
@endsection