@extends('admin.main')
@section('admincontent')
<div class="col-md-12">
<h4> Список пользователей</h4>
            <hr>
   <table class="table" id="table">
    <thead>
        <tr>
            <th class="text-center">ID</th>
            <th class="text-center">Name</th>
            <th class="text-center">Email</th>
            <th class="text-center">VPN</th>
            <th class="text-center">Баланс</th>
            <th class="text-center">Тариф</th>
            <th class="text-center">Тип</th>

            </tr>
        
    </thead>
<tbody>
@foreach($data as $item)
<tr class="item{{$item->id}}">
    <td>{{$item->id}}</td>
    <td>{{$item->name}}</td>
    <td>{{$item->email}}</td>
    <td>{{$item->active_vpn}}</td>
    <td>{{$item->balance}}</td>
    <td>{{$item->tarif->name}}</td>
    <td>{{$item->type}}</td>

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