@extends('catalog')

@section('catalogcontent')


    <div class="row justify-content-center">
        <div class="col-md-12">

            <h1>Каталог товаров</h1>
            <p>Текст</p>
            <div class="row">
                @foreach ($roots as $root)
                    @include('catalog.part.category', ['category' => $root])
                @endforeach
            </div>

        </div>
    </div>


@endsection
@push('styles')

@endpush
@push('scripts')

@endpush
