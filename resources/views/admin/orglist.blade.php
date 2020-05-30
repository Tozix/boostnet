@extends('admin.main')
@section('admincontent')
<div class="col-md-12">
<h4> Список организаций</h4>
            <hr>

   <table class="table" id="table">
    <thead>
        <tr>
            <th class="text-center">Логин</th>
            <th class="text-center">Название</th>
            <th class="text-center">Email</th>
            <th class="text-center">ИНН</th>
            <th class="text-center">Баланс</th>
            <th class="text-center">Тариф</th>


            </tr>
        
    </thead>
<tbody>
@foreach($data as $item)
<tr class="item{{$item->id}}">
    <td>{{$item->user->name}}</td>
    <td><a href="{{route('admin_org', ['action' => 'edit','id' => $item->id])}}">{{$item->org_name}}</a></td>
    <td>{{$item->org_email}}</td>
    <td>{{$item->org_inn}}</td>
    <td>{{$item->user->balance}}</td>
    <td>{{$item->user->tarif->name}}</td>


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
           $('div.top').html('<a href="{{ route('admin_org', ['action' => 'add'])}}" type="button" class="btn btn-primary">Добавить организацию</a>');
           $('div.bottom').html('bottom');
           $('div.clear').html('clear');
         }


    });
        
} );
 </script>
@endpush

@endsection