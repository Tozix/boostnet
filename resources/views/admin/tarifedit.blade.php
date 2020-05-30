@extends('admin.main')
@section('admincontent')
<div class="col-md-12">
<h4> Изменить тариф</h4>
            <hr>
                    <form method="POST" action="">
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
                            
                            <label for="tarif_name" class="col-sm-4 col-form-label text-md-right">{{ __('Название тарифа') }}</label>

                            <div class="col-md-6">
                                <input id="tarif_name" type="text" class="form-control{{ $errors->has('tarif_name') ? ' is-invalid' : '' }}" name="tarif_name" value="{{ $tarif->name }}" required autofocus>

                                @if ($errors->has('tarif_name'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('tarif_name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="tarif_cost" class="col-md-4 col-form-label text-md-right">{{ __('Абонетская плата') }}</label>

                            <div class="col-md-6">
                                <input id="tarif_cost" type="text" class="form-control{{ $errors->has('tarif_cost') ? ' is-invalid' : '' }}" name="tarif_cost" value="{{ $tarif->cost }}" required autofocus>

                                @if ($errors->has('tarif_cost'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('tarif_cost') }}</strong>
                                    </span>
                                @endif
                                <small class="form-text text-info">Для Физ. лиц абонетская плата списывается еждневно!</small>
                                <small class="form-text text-info">Для Юр. лиц абонетская плата списывается ежемесячно!</small>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="tarif_type" class="col-sm-4 col-form-label text-md-right">{{ __('Тип тарифа') }}</label>

                            <div class="col-md-6">
                              <select class="form-control" id="tarif_type" name="tarif_type">
                                    <option value="1" {{ $tarif->type == 1 ? 'selected' : '' }}>Тариф для физического лица</option>
                                    <option value="2" {{ $tarif->type == 2 ? 'selected' : '' }}>Тариф для юридического лица</option>
                              </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="tarif_speed" class="col-sm-4 col-form-label text-md-right">{{ __('Скорость') }}</label>

                            <div class="col-md-6">
                                <input id="tarif_speed" type="text" class="form-control{{ $errors->has('tarif_speed') ? ' is-invalid' : '' }}" name="tarif_speed" value="{{ $tarif->speed }}" required autofocus>

                                @if ($errors->has('tarif_speed'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('tarif_speed') }}</strong>
                                    </span>
                                @endif
                                <small class="form-text text-info">Скорость указывается в БИТАХ!</small>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="tarif_description" class="col-sm-4 col-form-label text-md-right">{{ __('Описание тарифа') }}</label>

                            <div class="col-md-6">
                                <textarea class="form-control" id="tarif_description" name="tarif_description" rows="3" required autofocus>{{ $tarif->description }}</textarea>

                                @if ($errors->has('tarif_description'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('tarif_description') }}</strong>
                                    </span>
                                @endif
                                
                            </div>
                        </div>
                      
                        




                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Сохранить') }}
                                </button>

                            </div>
                        </div>
                    </form>
                
            
        </div>

@endsection