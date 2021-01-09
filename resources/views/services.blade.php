@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="row">
                    <div class="col-md-3 mb-4">
                        <div class="list-group">
                            <a href="{{ route('vpn') }}"
                                class="list-group-item list-group-item-action {{ Request::is('vpn') ? 'active' : '' }}">
                                Ускорение интернета
                            </a>
                            <a href="{{ route('anywhere') }}"
                                class="list-group-item list-group-item-action {{ Request::is('anywhere') ? 'active' : '' }}">
                                В любой точке
                            </a>
                            <a href="{{ route('bower') }}"
                                class="list-group-item list-group-item-action {{ Request::is('bower') ? 'active' : '' }}">
                                Интернет за городом
                            </a>

                        </div>
                    </div>
                    <div class="col-md-9 mb-4">
                        <div class="card h-100">
                            <div class="card-body">
                                @yield('servicecontent')
                            </div>
                        </div>
                    </div>
                </div>

            </div>


        </div>
    </div>


@endsection
@push('styles')

@endpush
@push('scripts')

@endpush
