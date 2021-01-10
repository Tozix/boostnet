@extends('layouts.app')

@section('content')



    <div class="container">
        <div class="row">
            <div class="col-md-3">
                @include('layouts.part.roots')
                @include('layouts.part.brands')
            </div>
            <div class="col-md-9">
                @if ($message = Session::get('success'))
                    <div class="alert alert-success alert-dismissible mt-0" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Закрыть">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        {{ $message }}
                    </div>
                @endif

                @if ($errors->any())
                    <div class="alert alert-danger alert-dismissible mt-0" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Закрыть">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
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
