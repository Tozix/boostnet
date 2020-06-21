@extends('admin.main')
@section('admincontent')
<div class="col-md-12">
<h4> Изменить пользователя</h4>
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
                            
                            <label for="name" class="col-sm-4 col-form-label text-md-right">{{ __('Имя пользователя') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ $user->name }}" required autofocus>

                                @if ($errors->has('name'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('Абонетская плата') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="text" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ $user->email }}" required autofocus>

                                @if ($errors->has('email'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                                <small class="form-text text-info">Не желательно менять, явлется логином для авторизации</small>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="type" class="col-sm-4 col-form-label text-md-right">{{ __('Тип аккаунта') }}</label>

                            <div class="col-md-6">
                              <select class="form-control" id="type" name="type">
                                    <option value="9" {{ $user->type == 9 ? 'selected' : '' }}>Админ</option>
                                    <option value="2" {{ $user->type == 2 ? 'selected' : '' }}>Организация</option>
                                    <option value="1" {{ $user->type == 1 ? 'selected' : '' }}>Мобильный пользователь</option>
                                    <option value="0" {{ $user->type == 0 ? 'selected' : '' }}>Обычный пользователь VPN</option>
                              </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="tarif_id" class="col-sm-4 col-form-label text-md-right">{{ __('Тип аккаунта') }}</label>

                            <div class="col-md-6">
                              <select class="form-control" id="tarif_id" name="tarif_id">
	                            @foreach($tarif_list as $item)
                                <option value="{{$item->id}}" {{ $item->id == $user->tarif_id  ? 'selected' : '' }}>{{$item->name}}</option>
		                        @endforeach
                              </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="balance" class="col-sm-4 col-form-label text-md-right">{{ __('Баланс') }}</label>

                            <div class="col-md-6">
                                <input id="balance" type="text" class="form-control{{ $errors->has('balance') ? ' is-invalid' : '' }}" name="balance" value="{{ $user->balance }}" required autofocus>

                                @if ($errors->has('balance'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('balance') }}</strong>
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