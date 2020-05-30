@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">


                        <div class="card h-100">
                            <div class="card-body">
 <h4>Список тарифов</h4>

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
<div class="row">

        <div class="col-md-6 mb-4">
          <div class="card h-100">
            <div class="card-body">
              <h4 class="card-title">Базовый</h4>
              <p class="card-text">Скорость доступа до <b>10мбит/c</b></p>
              <p class="card-text">Стоимость в день: <b>5 руб.</b></p>
            </div>

          </div>
            
        </div>
        <div class="col-md-6 mb-4">
          <div class="card h-100">
            <div class="card-body">
              <h4 class="card-title">Буст 20</h4>
              <p class="card-text">Скорость доступа до <b>20мбит/c</b></p>
              <p class="card-text">Стоимость в день: <b>7 руб.</b></p>
            </div>

          </div>
        </div>
        <div class="col-md-6 mb-4">
          <div class="card h-100">
            <div class="card-body">
              <h4 class="card-title">Буст 50</h4>
              <p class="card-text">Скорость доступа до <b>50 мбит/c</b></p>
              <p class="card-text">Стоимость в день: <b>10 руб.</b></p>
            </div>

          </div>
        </div>
        <div class="col-md-6 mb-4">
          <div class="card h-100">
            <div class="card-body">
              <h4 class="card-title">Буст Макс</h4>
              <p class="card-text">Скорость доступа до <b>100 мбит/c</b></p>
              <p class="card-text">Стоимость в день: <b>17 руб.</b></p>
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
