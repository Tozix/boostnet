@extends('admin.index', ['title' => 'Все бренды каталога'])
@section('admincontent')
<div class="col-md-12">
  <h1>Все бренды каталога</h1>
<a href="{{ route('admin.catalog.brand.create') }}" class="btn btn-success mb-4">
    Создать бренд
</a>
<table class="table table-bordered">
    <tr>
        <th width="30%">Наименование</th>
        <th width="65%">Описание</th>
        <th><i class="fas fa-edit"></i></th>
        <th><i class="fas fa-trash-alt"></i></th>
    </tr>
    @foreach($brands as $brand)
    <tr>
        <td>
            <a href="{{ route('admin.catalog.brand.show', ['brand' => $brand->id]) }}">
                {{ $brand->name }}
            </a>
        </td>
        <td>{{ iconv_substr($brand->content, 0, 150) }}</td>
        <td>
            <a href="{{ route('admin.catalog.brand.edit', ['brand' => $brand->id]) }}">
                <i class="far fa-edit"></i>
            </a>
        </td>
        <td>
            <form action="{{ route('admin.catalog.brand.destroy', ['brand' => $brand->id]) }}" method="post">
                @csrf
                @method('DELETE')
                <button type="submit" class="m-0 p-0 border-0 bg-transparent">
                    <i class="far fa-trash-alt text-danger"></i>
                </button>
            </form>
        </td>
    </tr>
    @endforeach
</table>

</div>

@endsection