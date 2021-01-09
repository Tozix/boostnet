@extends('layouts.app', ['title' => 'Страница не найдена'])

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">

            <div class="card mt-4 mb-4">
                <div class="card-header">
                    <h1>Страница не найдена</h1>
                </div>
                <div class="card-body">
                    <img src="{{ asset('img/404.png') }}" alt="" class="img-fluid">
                </div>
                <div class="card-footer">
                    <p>Запрошенная страница не найдена.</p>
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