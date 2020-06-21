@extends('admin.main')
@section('admincontent')
<div class="col-md-12">
<h4> Список пользователей</h4>
            <hr>
   <table class="table" id="table">
    <thead>
        <tr>
            <th class="text-center">Name</th>
            <th class="text-center">Email</th>
            <th class="text-center">VPN</th>
            <th class="text-center">Баланс</th>
            <th class="text-center">Тариф</th>
            <th class="text-center">Тип</th>
            <th class="text-center">VPNs</th>

            </tr>
        
    </thead>
<tbody>
@foreach($data as $item)

<tr class="item{{$item->id}}">
    <td><a href="{{ route('admin_user', ['action' => 'info' ,'id' => $item->id])}}">{{$item->name}}</a></td>
    <td>{{$item->email}}</td>
    <td>
    @switch($item->active_vpn)
    @case(0)
        <span class="badge badge-info">Новый</span>
        @break
    @case(1)
        <span class="badge badge-primary">В настройке</span>
        @break
    @case(2)
        <span class="badge badge-success">Активен</span>
        @break
    @case(3)
        <span class="badge badge-light">Неактивен</span>
        @break
    @case(8)
        <span class="badge badge-warning">Активен</span>
        @break
    @default
        <span class="badge badge-info">Активен</span>
@endswitch
    </td>
    <td>{{$item->balance}}</td>
    <td>{{$item->tarif->name}}</td>
    <td>
        @switch($item->type)
    @case(9)
        <span class="badge badge-pill badge-primary">Админ</span>
        @break
    @case(0)
        <span class="badge badge-pill badge-info">Обычный</span>
        @break
    @case(1)
        <span class="badge badge-pill badge-warning">Моб-ый</span>
        @break
    @case(2)
        <span class="badge badge-pill badge-success">Организация</span>
        @break
    @case(3)
        <span class="badge badge-pill badge-danger">Заблокирован</span>
        @break
    @default
        <span class="badge badge-pill badge-info">Обычный</span>
@endswitch
    </td>
    <td><a class="btn btn-link" href="{{ route('admin_user', ['action' => 'vpnlist' ,'id' => $item->id])}}">{{$item->accounts->count() }}</a></td>

</tr>
@endforeach
</tbody>
</table>
        </div>
@push('scripts')
<script>
  $(document).ready(function() {
    $('#table').DataTable({
    language: {
        url: 'https://cdn.datatables.net/plug-ins/1.10.19/i18n/Russian.json'
    },
   searching: true,
    ordering:  true
        

    });
} );
 </script>
@endpush

@endsection