@extends('admin.main')
@section('admincontent')
<div class="col-md-12">
<h4>Изменить организацию</h4>
            <hr>
                    <form method="POST" action="#">
                        @csrf
	@if (count($errors) > 0)
	<div class="alert alert-danger">
		<ul>
			@foreach ($errors->all() as $error)
				<li>{!! $error !!}</li>
			@endforeach
		</ul>
	</div>
	@elseif(session('success'))
	<div class="alert alert-success"><span class="glyphicon glyphicon-ok"></span><em> {!! session('success') !!}</em></div>
	@endif
                        <div class="form-group row">
                            <label for="org_email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Адрес организации') }}</label>

                            <div class="col-md-6">
                                <input id="org_email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="org_email" value="{{ $org->org_email }}" required autofocus>

                                @if ($errors->has('org_email'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('org_email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="org_tel" class="col-sm-4 col-form-label text-md-right">{{ __('Телефон организации') }}</label>

                            <div class="col-md-6">
                                <input id="org_tel" type="tel" class="form-control{{ $errors->has('org_tel') ? ' is-invalid' : '' }}" name="org_tel" value="{{ $org->org_tel }}" required autofocus>

                                @if ($errors->has('org_tel'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('org_tel') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="org_name" class="col-sm-4 col-form-label text-md-right">{{ __('Название организации') }}</label>

                            <div class="col-md-6">
                                <input id="org_name" type="text" class="form-control{{ $errors->has('org_name') ? ' is-invalid' : '' }}" name="org_name" value="{{ $org->org_name }}" required autofocus>

                                @if ($errors->has('org_name'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('org_name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="org_inn" class="col-sm-4 col-form-label text-md-right">{{ __('ИНН организации') }}</label>

                            <div class="col-md-6">
                                <input id="org_inn" type="text" class="form-control{{ $errors->has('org_inn') ? ' is-invalid' : '' }}" name="org_inn" value="{{ $org->org_inn }}" required autofocus>

                                @if ($errors->has('org_inn'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('org_inn') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="org_kpp" class="col-sm-4 col-form-label text-md-right">{{ __('КПП Организации') }}</label>

                            <div class="col-md-6">
                                <input id="org_kpp" type="text" class="form-control{{ $errors->has('org_kpp') ? ' is-invalid' : '' }}" name="org_kpp" value="{{ $org->org_kpp }}" required autofocus>

                                @if ($errors->has('org_kpp'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('org_kpp') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="org_bik" class="col-sm-4 col-form-label text-md-right">{{ __('БИК банка') }}</label>

                            <div class="col-md-6">
                                <input id="org_bik" type="text" class="form-control{{ $errors->has('org_bik') ? ' is-invalid' : '' }}" name="org_bik" value="{{ $org->org_bik }}" required autofocus>

                                @if ($errors->has('org_bik'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('org_bik') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="org_rschet" class="col-sm-4 col-form-label text-md-right">{{ __('Рассчетный счет') }}</label>

                            <div class="col-md-6">
                                <input id="org_rschet" type="text" class="form-control{{ $errors->has('org_rschet') ? ' is-invalid' : '' }}" name="org_rschet" value="{{ $org->org_rschet }}" required autofocus>

                                @if ($errors->has('org_rschet'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('org_rschet') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="org_korschet" class="col-sm-4 col-form-label text-md-right">{{ __('Корреспондентский счет') }}</label>

                            <div class="col-md-6">
                                <input id="org_korschet" type="text" class="form-control{{ $errors->has('org_korschet') ? ' is-invalid' : '' }}" name="org_korschet" value="{{ $org->org_korschet }}" required autofocus>

                                @if ($errors->has('org_korschet'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('org_korschet') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="org_bank" class="col-sm-4 col-form-label text-md-right">{{ __('Наименование банка и отделения') }}</label>

                            <div class="col-md-6">
                                <input id="org_bank" type="text" class="form-control{{ $errors->has('org_bank') ? ' is-invalid' : '' }}" name="org_bank" value="{{ $org->org_bank }}" required autofocus>

                                @if ($errors->has('org_bank'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('org_bank') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="org_dir_fio" class="col-sm-4 col-form-label text-md-right">{{ __('ФИО руководителя') }}</label>

                            <div class="col-md-6">
                                <input id="org_dir_fio" type="text" class="form-control{{ $errors->has('org_dir_fio') ? ' is-invalid' : '' }}" name="org_dir_fio" value="{{ $org->org_dir_fio }}" required autofocus>

                                @if ($errors->has('org_dir_fio'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('org_dir_fio') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="org_dir_dol" class="col-sm-4 col-form-label text-md-right">{{ __('Должность руководителя') }}</label>

                            <div class="col-md-6">
                                <input id="org_dir_dol" type="text" class="form-control{{ $errors->has('org_dir_dol') ? ' is-invalid' : '' }}" name="org_dir_dol" value="{{ $org->org_dir_dol }}" required autofocus >

                                @if ($errors->has('org_dir_dol'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('org_dir_dol') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="address_ur" class="col-sm-4 col-form-label text-md-right">{{ __('Юридический адрес организации') }}</label>

                            <div class="col-md-6">
                                <input id="address_ur" type="text" class="form-control{{ $errors->has('address_ur') ? ' is-invalid' : '' }}" name="address_ur" value="{{ $org->address_ur }}" required autofocus>

                                @if ($errors->has('address_ur'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('address_ur') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="address_fact" class="col-sm-4 col-form-label text-md-right">{{ __('Фактический, почтовый адрес') }}</label>

                            <div class="col-md-6">
                                <input id="address_fact" type="text" class="form-control{{ $errors->has('address_fact') ? ' is-invalid' : '' }}" name="address_fact" value="{{ $org->address_fact }}" required autofocus>

                                @if ($errors->has('address_fact'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('address_fact') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="org_contacts" class="col-sm-4 col-form-label text-md-right">{{ __('Контактное лицо и другая информация') }}</label>

                            <div class="col-md-6">
                                <textarea id="org_contacts" type="text" class="form-control" name="org_contacts" class="form-control {{ $errors->has('org_contacts') ? ' is-invalid' : '' }}" id="exampleTextarea" rows="3" required autofocus>{{ $org->org_contacts }}</textarea>
                                @if ($errors->has('org_contacts'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('org_contacts') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        




                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Добавить') }}
                                </button>

                            </div>
                        </div>
                    </form>
                
            
        </div>

@endsection