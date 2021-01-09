@extends('catalog')

@section('catalogcontent')
    <div class="row justify-content-center">
        <div class="col-md-12">

            <h1>{{ $brand->name }}</h1>
            <p>{{ $brand->content }}</p>
            <div class="row">
                @foreach ($brand->products as $product)
                    @include('catalog.part.product')
                @endforeach
            </div>

        </div>
    </div>
    </div>


@endsection
@push('styles')

@endpush
@push('scripts')

@endpush
