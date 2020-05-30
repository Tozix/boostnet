@extends('admin.main')
@section('admincontent')
<div class="col-md-12">
<h4> Информация по организации</h4>
            <hr>

<div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <a href="{{ route('adm_org_edit',['id'=>$id])}}" type="button" class="btn btn-primary">Изменить реквизиты или другие данные</a>

                            </div>
                        </div>


@endsection