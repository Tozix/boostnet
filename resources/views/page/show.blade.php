@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h1>{{ $page->name }}</h1>
                </div>
                <div class="card-body">
                    {!! $page->content !!}
                </div>
                <div class="card-footer">
                    Добавлена: {{ $page->created_at->format('d.m.Y H:i') }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection