@extends('admin.index', ['title' => 'Просмотр бренда'])
@section('admincontent')
<div class="col-md-12">
<h1>Просмотр бренда</h1>
    <div class="row">
        <div class="col-md-6">
            <p><strong>Название:</strong> {{ $brand->name }}</p>
            <p><strong>ЧПУ (англ):</strong> {{ $brand->slug }}</p>
            <p><strong>Краткое описание</strong></p>
            @isset($brand->content)
            <p>{{ $brand->content }}</p>
            @else
            <p>Описание отсутствует</p>
            @endisset
        </div>
        <div class="col-md-6">
            @php
            if ($brand->image) {
            // $url = url('storage/catalog/brand/source/' . $brand->image);
            $url = Storage::disk('public')->url('catalog/brand/image/' . $brand->image);
            } else {
            // $url = Storage::disk('public')->url('catalog/brand/image/' . $brand->image);
            $url = Storage::disk('public')->url('catalog/brand/image/default.jpg');
            }
            @endphp
            <img src="{{ $url }}" alt="" class="img-fluid">
        </div>
    </div>
    <a href="{{ route('admin.catalog.brand.edit', ['brand' => $brand->id]) }}" class="btn btn-success">
        Редактировать бренд
    </a>
    <form method="post" class="d-inline" action="{{ route('admin.catalog.brand.destroy', ['brand' => $brand->id]) }}">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-danger">
            Удалить бренд
        </button>
    </form>

</div>

@endsection