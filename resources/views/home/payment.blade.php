@extends('home.main')
@section('homecontent')
        <div class="col-md-12">
<h4> Пополнить счет</h4>
            <hr>
                    <form method="POST" action="#">
                        @csrf

                        <div class="form-group row">
                            <label for="money" class="col-sm-4 col-form-label text-md-right">{{ __('Сумма платежа') }}</label>

                            <div class="col-md-6">
                                <input id="money" type="number" class="form-control{{ $errors->has('money') ? ' is-invalid' : '' }}" name="money" value="{{ old('money') }}" required autofocus min=10 max=10000>

                                @if ($errors->has('money'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('money') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>




                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Перейти к оплате') }}
                                </button>

                            </div>
                        </div>
                    </form>
                
            
        </div>

@endsection
