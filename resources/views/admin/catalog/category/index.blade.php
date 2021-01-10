@extends('admin.index', ['title' => 'Все категории каталога'])
@section('admincontent')
<div class="col-md-12">
<h1>Все категории</h1>
<a href="{{ route('admin.catalog.category.create') }}" class="btn btn-success mb-4">
    Добавить категорию
</a>
    <table class="table table-bordered">
        <tr>
            <th width="30%">Наименование</th>
            <th width="65%">Описание</th>
            <th><i class="fas fa-edit"></i></th>
            <th><i class="fas fa-trash-alt"></i></th>
        </tr>
        @include('admin.catalog.category.part.tree', ['level' => -1, 'parent' => 0])
    </table>
    

</div>

@endsection