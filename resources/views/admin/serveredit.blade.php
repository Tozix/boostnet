@extends('admin.main')
@section('admincontent')
<div class="col-md-12">
<h4> Редактирование сервера</h4>
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
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Имя сервера') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ $server->name }}" required autofocus>

                                @if ($errors->has('name'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                                <small class="form-text text-info">Будет отображаться в списке серверов</small>
                            </div>
                        </div>

                        <div class="form-group row">
                            
                            <label for="domain" class="col-sm-4 col-form-label text-md-right">{{ __('Имя домена') }}</label>

                            <div class="col-md-6">
                                <input id="domain" type="text" class="form-control{{ $errors->has('domain') ? ' is-invalid' : '' }}" name="domain" value="{{ $server->domain }}" required autofocus>

                                @if ($errors->has('domain'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('domain') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="ip" class="col-md-4 col-form-label text-md-right">{{ __('IP Сервера') }}</label>

                            <div class="col-md-6">
                                <input id="ip" type="text" class="form-control{{ $errors->has('ip') ? ' is-invalid' : '' }}" name="ip" value="{{ $server->ip }}" required autofocus>

                                @if ($errors->has('ip'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('ip') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="city" class="col-md-4 col-form-label text-md-right">{{ __('Город расположения') }}</label>

                            <div class="col-md-6">
                                <input id="city" type="text" class="form-control{{ $errors->has('city') ? ' is-invalid' : '' }}" name="city" value="{{ $server->city }}" required autofocus>

                                @if ($errors->has('city'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('city') }}</strong>
                                    </span>
                                @endif
                                <small class="form-text text-info">Город на латинице!</small>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="speed" class="col-sm-4 col-form-label text-md-right">{{ __('Ширина канала') }}</label>

                            <div class="col-md-6">
                                <input id="speed" type="text" class="form-control{{ $errors->has('speed') ? ' is-invalid' : '' }}" name="speed" value="{{ $server->speed }}" required autofocus>

                                @if ($errors->has('speed'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('speed') }}</strong>
                                    </span>
                                @endif
                                <small class="form-text text-info">Скорость указывается в БИТАХ!</small>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="description" class="col-sm-4 col-form-label text-md-right">{{ __('Описание сервера') }}</label>

                            <div class="col-md-6">
                                <textarea class="form-control" id="description" name="description" rows="3" required autofocus>{{ $server->description }}</textarea>

                                @if ($errors->has('description'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('description') }}</strong>
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