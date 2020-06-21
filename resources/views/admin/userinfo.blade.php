@extends('admin.main')
@section('admincontent')
<div class="col-md-12">
<h4> Пользователь: {{$user->name}}</h4>
 <a href="{{ route('admin_user', ['action' => 'edit' ,'id' => $user->id])}}" type="button" class="btn btn-primary btn-sm">Изменить</a>
<a href="{{ route('admin_user', ['action' => 'vpnlist' ,'id' => $user->id])}}" type="button" class="btn btn-primary btn-sm">VPN Аккаунты</a>
<a href="{{ route('admin_user', ['action' => 'vpn' ,'id' => $user->id])}}" type="button" class="btn btn-primary btn-sm">Еще не придумал</a>
                                  <table class="table table-th-block">
 <tbody>
 	
 <tr><td class="active">Номер счета:</td><td>vpncat{{ $user->id }}</td></tr>
 <tr><td class="active">Ваш логин:</td><td>{{ $user->name }}</td></tr>
 @switch($user->active_vpn)
    @case(0)
 <tr><td class="active">Статус VPN:</td><td><span class="badge badge-pill badge-warning">Новый</span></td></tr>
        @break
    @case(1)
 <tr><td class="active">Статус VPN:</td><td><span class="badge badge-pill badge-primary">В настройке</span></td></tr>
        @break 
    @case(2)
 <tr><td class="active">Статус VPN:</td><td><span class="badge badge-pill badge-success">Активен</span></td></tr>
        @break
    @case(3)
 <tr><td class="active">Статус VPN:</td><td><span class="badge badge-pill badge-light">Неактивен</span></td></tr>
        @break
    @case(8)
 <tr><td class="active">Статус VPN:</td><td><span class="badge badge-pill badge-warning">Доп. настройка</span></td></tr>
        @break

    @default
 <tr><td class="active">Статус VPN:</td><td><span class="badge badge-pill badge-danger">Не выбран тариф</span></td></tr>
@endswitch 
     

 <tr><td class="active">Остаток:</td><td>{{ $user->balance }} <a href="{{ route('payment')}}">( Пополнить баланс )</a> </td></tr>
 <tr><td class="active">Оплата в сутки:</td><td> {{ $user->tarif->cost }} руб.</td></tr>
 <tr><td class="active">Тарифный план:</td><td>{{ $user->tarif->name }} <a href="{{ route('tarifs')}}">( Сменить )</a></td></tr>

</tbody>
 </table>
        </div>

@endsection