@extends('layouts.app')

@section('content')
    <div class="container">
<div class="row">
	        <div class="col-md-12 mb-4">
	                      <!-- Call to Action Well -->
      <div class="card text-white bg-secondary text-center">
        <div class="card-body">
          <p class="m-0">Админка</p>
        </div>
      </div>
	</div>
</div>
        <div class="row justify-content-center">
            <div class="col-md-12">
<div class="row">
                        <div class="col-md-3 mb-4">
<div class="list-group">
  <a href="{{ route('admin')}}" class="list-group-item list-group-item-action {{ Request::is('admin') ? 'active' : '' }}">Главная</a>
  <a href="{{ route('admin_user')}}" class="list-group-item list-group-item-action {{ Request::is('admin/user*') ? 'active' : '' }} ">Пользователи</a>
  <a href="{{ route('admin_org')}}" class="list-group-item list-group-item-action {{ Request::is('admin/org*') ? 'active' : '' }} ">Организации</a>
  <a href="{{ route('admin_tarif')}}" class="list-group-item list-group-item-action {{ Request::is('admin/tarif*') ? 'active' : '' }} ">Тарифы</a>
  <a href="{{ route('admin_server')}}" class="list-group-item list-group-item-action {{ Request::is('admin/server*') ? 'active' : '' }} ">Сервера</a>
  <a href="{{ route('admin_payments')}}" class="list-group-item list-group-item-action {{ Request::is('admin_payments') ? 'active' : '' }}">Платежи  </a>
  <a href="{{ route('admin_mailing')}}" class="list-group-item list-group-item-action {{ Request::is('admin_mailing') ? 'active' : '' }}">Рассылка  </a>

</div>
                    </div>
                            <div class="col-md-9 mb-4">
                        <div class="card h-100">
                            <div class="card-body">
@yield('admincontent')
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
