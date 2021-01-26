@extends('home', ['title' => 'Создание профиля'])

@section('homecontent')
<h1>Создание профиля</h1>
<form method="post" action="{{ route('user.profile.store') }}">
    @include('user.profile.part.form')
</form>
@endsection