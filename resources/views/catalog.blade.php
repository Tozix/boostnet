@extends('layouts.app')

@section('content')



    <div class="container">
        <div class="row">
            <div class="col-md-3">
                @include('catalog.part.roots')
                @include('catalog.part.brands')
            </div>
            <div class="col-md-9">
                @yield('catalogcontent')
            </div>
        </div>
    </div>













@endsection
@push('styles')

@endpush
@push('scripts')
    <script src="{{ asset('js/catalog.js') }}" defer></script>
@endpush
