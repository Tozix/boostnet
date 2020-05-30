@extends('admin.main')
@section('admincontent')
<div class="col-md-12">
    <h4> Список Серверов</h4>
    <hr>
    <table class="table" id="table">
        <thead>
            <tr>
                <th class="text-center">Имя домена</th>
                <th class="text-center">IP Адрес</th>
                <th class="text-center">Город</th>
                <th class="text-center">Пользователей</th>
                <th class="text-center">Скорость Мб/c</th>
                <th class="text-center">Статус</th>
                <th class="text-center"></th>
            </tr>

        </thead>
        <tbody>
            @foreach($data as $item)
            <tr class="item{{$item->id}}">
                <td>{{$item->domain}}</td>
                <td>{{$item->ip}}</td>
                <td>{{$item->city}}</td>
                <td>{{$item->num_users}}</td>
                <td>{{$item->speed/1048576}}</td>
                <td>
                    @if($item->status==1)
                    <span class="badge badge-success">Активен</span>
                    @else
                    <span class="badge badge-danger">Выключен</span>
                    @endif
                </td>

                <td><a href="{{ route('admin_server', ['action' => 'edit' ,'id' => $item->id])}}" type="button"
                        class="btn btn-primary btn-sm">Изменить</a>
                    @if($item->status!=1)
                    <a href="{{ route('admin_server', ['action' => 'enable' ,'id' => $item->id])}}" type="button"
                        class="btn btn-success btn-sm">Включить</a>
                    @else
                    <a href="{{ route('admin_server', ['action' => 'disable' ,'id' => $item->id])}}" type="button"
                        class="btn btn-danger btn-sm">Выключить</a>
                    @endif
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@push('scripts')
<script>
    $(document).ready(function () {
        $('#table').DataTable({
            "columnDefs": [{
                "width": "30%",
                "targets": 6
            }],
            language: {
                url: 'https://cdn.datatables.net/plug-ins/1.10.19/i18n/Russian.json'
            },
            dom: "<'row'<'col-sm-12 col-md-6'<'top'>><'col-sm-12 col-md-6'f>>" +
                "<'row'<'col-sm-12'tr>>" +
                "<'row'<'col-sm-12 col-md-4'l><'col-sm-12 col-md-4'i><'col-sm-12 col-md-4'p>>",
            fnInitComplete: function () {
                $('div.top').html('<a href="{{ route('admin_server', ['action' => 'add'])}}" type="button" class="btn btn-primary">Добавить сервер</a>');
                $('div.bottom').html('bottom');
                $('div.clear').html('clear');
            }


        });

    });
</script>
@endpush

@endsection
