@extends('layouts.app')

@section('content')
<div class="container">
	<div class="row justify-content-center">
		<div class="col-md-12">
			<div class="row">
				<div class="col-md-6 mb-4">
						<div class="card-body">
							<h4>Доступный безлимитный интернет!</h4>
							<hr>
<h4><span class="fa fa-tachometer-alt"></span>  Скорость 4G/LTE до 100 Мбит/с</h4>
<h4><span class="fa fa-broadcast-tower"></span>  Полный БЕЗЛИМИТ</h4>
<h4><span class="fa fa-tools"></span>  Оборудование от <span class="badge badge-pill badge-primary">4500</span></h4>
<h4><span class="fa fa-ruble-sign"></span>  Абонентская плата от <span class="badge badge-pill badge-primary">500</span></h4>

							 
						</div>
						<div class="text-center"><a class="btn btn-primary btn-lg" href="{{ route('user.register') }}">Стать клиентом!</a></div>
					
				</div>

								<div class="col-md-6 mb-4">

						<div class="card-body">
														
							<img src="img/logo.svg" style="height: 90%;">
							

						</div>

				</div>




			</div>


	<hr>
				<!-- Content Row -->
			<div class="row">
				<div class="col-md-4 mb-4">
					<div class="card h-100">
						<div class="card-body">
							<div class="text-center"><i class="fas fa-network-wired fa-5x"></i>
							<hr>
							<h4 class="card-title">Услуги VPN</h4>

							</div>
							
							<p class="card-text">Мы предлагаем ускорить ваше текущее интернет соединение с помощью VPN
								технологии на скорости до 100 мбит в секунду.</p>
						</div>
						<h3 class="text-center">От 50 руб.</h3>
						<div class="card-footer text-center">
							<a href="{{ route('vpn') }}" class="btn btn-primary">Подробнее</a>
						</div>
					</div>
				</div>
				<!-- /.col-md-4 -->
				<div class="col-md-4 mb-4">
					<div class="card h-100">
						<div class="card-body">
							<div class="text-center"><i class="fas fa-fax fa-5x"></i>
							<hr>
							<h4 class="card-title">Интернет в офис</h4>
							
							</div>
							<p class="card-text">Далеко не у всех провайдеров есть возможность подключить удаленные
								офисы и другие не жилые помещения. Мы же можем обеспечить доступ к сети интернет
								абсолютно везде!</p>
						</div>
						<h3 class="text-center">От 700 руб.</h3>
						<div class="card-footer text-center">
							<a href="{{ route('anywhere') }}" class="btn btn-primary">Подробнее</a>
						</div>
					</div>
				</div>
				<!-- /.col-md-4 -->
				<div class="col-md-4 mb-4">
					<div class="card h-100">
						<div class="card-body">
							<div class="text-center"><i class="fas fa-home fa-5x"></i>
							<hr>
							<h4 class="card-title">Интернет за городом</h4>

							</div>
							<p class="card-text">С помощью нашего оборудования можем улучшить сигнал мобильного
								интернета любого оператора даже в самой отдаленной местности.</p>
						</div>
						<h3 class="text-center">От 500 руб.</h3>
						<div class="card-footer text-center">
							<a href="{{ route('bower') }}" class="btn btn-primary">Подробнее</a>
						</div>
					</div>
				</div>
				<!-- /.col-md-4 -->

			</div>
		</div>
	</div>
</div>
@endsection
@push('styles')

@endpush
@push('scripts')
@endpush
