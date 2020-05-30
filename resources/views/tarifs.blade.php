@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">


                        <div class="card h-100">
                            <div class="card-body">
 <h4>Список тарифов</h4>
 <ul class="nav nav-pills">
  <li class="nav-item">
    <a class="nav-link active" data-toggle="tab" href="#user">VPN стандарт</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" data-toggle="tab" href="#org">VPN бизнес</a>
  </li>
  <hr>
</ul>
<div id="myTabContent" class="tab-content">
  <div class="tab-pane fade active show" id="user">
 
    <div class="row">
      @foreach($data as $item)
      @if ($item->type == 1)
               <div class="col-md-6 mb-4">
                <div class="card h-100">
                  <div class="card-body">
                    <h4 class="card-title">{{$item->name}}</h4>
                    <p class="card-text">Скорость доступа до <b>{{$item->speed/1000000}}мбит/c</b></p>
                    <p class="card-text">Стоимость в день: <b>{{$item->cost}} руб.</b></p>
                  </div>
                  <div class="card-footer">
                    <button type="submit" name="submit_audit" value="{{$item->id}}" class="btn btn-primary">Перейти</button>
                  </div>
                </div>
                
              </div>
              @endif
          @endforeach  
            
      </div>

  </div>
  <div class="tab-pane fade" id="org">
    <div class="row">
      @foreach($data as $item)
      @if ($item->type == 2)
              <div class="col-md-6 mb-4">
                <div class="card h-100">
                  <div class="card-body">
                    <h4 class="card-title">{{$item->name}}</h4>
                    <p class="card-text">Скорость доступа до <b>{{$item->speed/1000000}}мбит/c</b></p>
                    <p class="card-text">Стоимость в день: <b>{{$item->cost}} руб.</b></p>
                  </div>
                  <div class="card-footer">
                    <button type="submit" name="submit_audit" value="{{$item->id}}" class="btn btn-primary">Перейти</button>
                  </div>
                </div>
                
              </div>
              @endif
          @endforeach  
            
      </div>

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



                            </div>
                        </div>

                </div>

                </div>
      



@endsection
@push('styles')

@endpush
@push('scripts')

@endpush
