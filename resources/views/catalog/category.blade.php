@extends('catalog')

@section('catalogcontent')

    <div class="row justify-content-center">
        <div class="col-md-12">

            <h1>{{ $category->name }}</h1>
            <p>{{ $category->content }}</p>
            <div class="row">
                @foreach ($category->products as $product)
                    @include('catalog.part.product')
                @endforeach
            </div>

        </div>
    </div>



@endsection
@push('styles')

@endpush
@push('scripts')

@endpush
