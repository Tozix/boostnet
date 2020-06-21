@extends('admin.main')
@section('admincontent')
<div class="col-md-12">
<h4> Список VPN аккаунтов пользователя</h4>
            <hr>
    @if(session('success'))
	<div class="alert alert-success"><span class="fa fa-user-check"></span><em> {!! session('success') !!}</em></div>
	@endif
   <table class="table" id="table">
    <thead>
        <tr>
            <th class="text-center">Name</th>
            <th class="text-center">ipAddress</th>
            <th class="text-center">Статус</th>
            <th class="text-center"></th>
            </tr>
        
    </thead>
<tbody>
@foreach($vpn as $item)

<tr class="item{{$item->id}}">
    <td>{{$item->name}}</a></td>
    <td>{{$item->ipAddress}}</td>
    <td>
    @switch($item->status)
    @case(0)
        <span class="badge badge-primary">В настройке</span>
        @break
    @case(1)
        <span class="badge badge-success">Активен</span>
        @break
    @case(3)
        <span class="badge badge-light">Неактивен</span>
        @break
    @case(9)
        <span class="badge badge-warning">Резерв</span>
        @break
    @default
        <span class="badge badge-info">Активен</span>
@endswitch
    </td>
    <td><a href="{{ route('admin_user', ['action' => 'edit_vpn' ,'id' => $item->id])}}" type="button" class="btn btn-primary btn-sm">Изменить</a>
        <a href="{{ route('admin_user', ['action' => 'get_conf' ,'id' => $item->id])}}" type="button" class="btn btn-info btn-sm">Получить конфиг</a>
        @if($item->status!=1)
        <a href="{{ route('admin_user', ['action' => 'enable_vpn' ,'id' => $item->id])}}" type="button" class="btn btn-success btn-sm">Включить</a>
        @else
        <a href="{{ route('admin_user', ['action' => 'disable_vpn' ,'id' => $item->id])}}" type="button" class="btn btn-danger btn-sm">Выключить</a>
        @endif
        
        </td>
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
        dom: "<'row'<'col-sm-12 col-md-6'<'top'>><'col-sm-12 col-md-6'f>>" +
"<'row'<'col-sm-12'tr>>" +
"<'row'<'col-sm-12 col-md-4'l><'col-sm-12 col-md-4'i><'col-sm-12 col-md-4'p>>",
        fnInitComplete: function(){
           $('div.top').html('<a href="{{ route('admin_user', ['action' => 'add' ,'id' => $id])}}" type="button" class="btn btn-primary btn">Добавить VPN Аккаунт</a>');
           $('div.bottom').html('bottom');
           $('div.clear').html('clear');
         }


    });
        
} );
 </script>
@endpush

@endsection