@extends('admin.main')
@section('admincontent')
<div class="col-md-12">
<h4> Изменить имя VPN аккаунта</h4>
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
                            
                            <label for="name" class="col-sm-4 col-form-label text-md-right">{{ __('Имя VPN') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ $vpn->name }}" required autofocus>

                                @if ($errors->has('name'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('name') }}</strong>
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