@extends('homeorg.main')
@section('homecontent')
                                <h4>Список тарифов</h4>
@if (count($errors) > 0)
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{!! $error !!}</li>
                                @endforeach
                            </ul>
                        </div>
                    @elseif(session('success'))
                        <div class="alert alert-success"><span
                                    class="glyphicon glyphicon-ok"></span><em> {!! session('success') !!}</em></div>
                    @endif
    <form method="POST" action="#">
                        @csrf
<div class="row">
    
	        <div class="col-md-12 mb-4">
                
	                      <!-- Call to Action Well -->
      <div class="card text-white bg-secondary text-center">
        <div class="card-body">
          <p class="m-0">При переходе на другой тариф списывается абонетская плата соответсвующая месячной стоимости.</p>
        </div>
      </div>
	</div>
</div>
<div class="row">
@foreach($data as $item)
        <div class="col-md-6 mb-4">
          <div class="card h-100">
            <div class="card-body">
              <h4 class="card-title">{{$item->name}}</h4>
              <p class="card-text">Скорость доступа до <b>{{$item->speed/1000000}}мбит/c</b></p>
              <p class="card-text">Стоимость в месяц: <b>{{$item->cost}} руб.</b></p>
            </div>
            <div class="card-footer">
              <button type="submit" name="submit_audit" value="{{$item->id}}" class="btn btn-primary">Перейти</button>
            </div>
          </div>
          
        </div>
    @endforeach  
      
</div>
<div class="row">
	        <div class="col-md-12 mb-4">
	                      <!-- Call to Action Well -->
      <div class="card text-white bg-secondary text-center">
        <div class="card-body">
          <p class="m-0">В тарифах указна максимально возможная ширина канала, при большой загруженности сети, скорость может быть ниже заявленной.</p>
        </div>
      </div>
	</div>
</div>
        </form>
@endsection
