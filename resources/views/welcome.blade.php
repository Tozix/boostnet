@extends('layouts.app')

@section('content')
<div class="container">
	<div class="row justify-content-center">
		<div class="col-md-12">



			@guest





			<div class="row">


				<div class="col-md-4 mb-4">
					<div class="card h-100">
						<div class="card-body">
							<h4>Экономить просто!</h4>
							<hr>


							<p class="card-text">VPN в Томске по небольшой стоимости — это реально! Нужно всего лишь
								пройти регистрацию на нашем сайте и выбрать интересующий вас тариф. Мы предоставляем
								услуги по ускорению вашего текущего интернет канала. Благодаря использованию современных
								технологий и качественного оборудования обеспечивается стабильное и безопасное
								соединение с глобальной сетью. </p>
							<div class="text-center"> <a class="btn btn-primary btn-lg"
									href="{{ route('register') }}">Стать клиентом!</a></div>
						</div>
					</div>
				</div>


				<div class="col-md-8 mb-4">
					<div class="card h-100">
						<div class="card-body">
							<h4>Тест возможной скорости интернета</h4>
							<hr>


							<div class="text-center">


								<div class="testGroup">
									<div class="testArea">
										<div class="testName">СКАЧАТЬ</div>
										<canvas id="dlMeter" class="meter"></canvas>
										<div id="dlText" class="meterText"></div>
										<div class="unit">Mbps</div>
									</div>
									<div class="testArea">
										<div class="testName">ЗАГРУЗИТЬ</div>
										<canvas id="ulMeter" class="meter"></canvas>
										<div id="ulText" class="meterText"></div>
										<div class="unit">Mbps</div>
									</div>
								</div>

								<div class="testGroup">
									<div class="testArea2">
										<div class="testName">Ping</div>
										<div id="pingText" class="meterText" style="color:#AA6060"></div>
										<div class="unit">ms</div>
									</div>
									<div class="testArea2">
										<div class="testName">Jitter</div>
										<div id="jitText" class="meterText" style="color:#AA6060"></div>
										<div class="unit">ms</div>
									</div>

								</div>
								<div id="loading">
									<p id="message"><span class="loadCircle"></span>Осуществляется поиск оптимального сервера...</p>
									</div>
									<div id="testWrapper" class="hidden">
								<div class="form-group row">
									<label for="server" class="col-sm-3 col-form-label text-md-right">Сервер</label>
		
									<div id="serverArea" class="col-md-6">
										<select class="form-control" id="server" onchange="s.setSelectedServer(SPEEDTEST_SERVERS[this.value])"></select>
									</div>
									<button type="button" id="startStopBtn" class="btn btn-primary my-2 my-sm-0" onclick="startStop()">НАЧАТЬ</button>
								</div>
										<div id="ipArea">
			<span id="ip"></span>
		</div>
							</div>
							</div>



						</div>
					</div>
				</div>
				





			</div>












			@else

			<div class="row">
				<div class="col-md-12 mb-4">
					<div class="card h-100">
						<div class="card-body">
							<h4>Тест возможной скорости интернета</h4>
							<hr>


							<div class="text-center">


								<div class="testGroup">
									<div class="testArea">
										<div class="testName">СКАЧАТЬ</div>
										<canvas id="dlMeter" class="meter"></canvas>
										<div id="dlText" class="meterText"></div>
										<div class="unit">Mbps</div>
									</div>
									<div class="testArea">
										<div class="testName">ЗАГРУЗИТЬ</div>
										<canvas id="ulMeter" class="meter"></canvas>
										<div id="ulText" class="meterText"></div>
										<div class="unit">Mbps</div>
									</div>
								</div>

								<div class="testGroup">
									<div class="testArea2">
										<div class="testName">Ping</div>
										<div id="pingText" class="meterText" style="color:#AA6060"></div>
										<div class="unit">ms</div>
									</div>
									<div class="testArea2">
										<div class="testName">Jitter</div>
										<div id="jitText" class="meterText" style="color:#AA6060"></div>
										<div class="unit">ms</div>
									</div>

								</div>
								<div id="loading">
									<p id="message"><span class="loadCircle"></span>Осуществляется поиск оптимального сервера...</p>
									</div>
									<div id="testWrapper" class="hidden">
								<div class="form-group row">
									<label for="server" class="col-sm-3 col-form-label text-md-right">Сервер</label>
		
									<div id="serverArea" class="col-md-6">
										<select class="form-control" id="server" onchange="s.setSelectedServer(SPEEDTEST_SERVERS[this.value])"></select>
									</div>
									<button type="button" id="startStopBtn" class="btn btn-primary my-2 my-sm-0" onclick="startStop()">НАЧАТЬ</button>
								</div>
							</div>
							</div>



						</div>
					</div>
				</div>




			</div>
			@endguest


			<div class="row">
				<div class="col-md-12 mb-4">
					<!-- Call to Action Well -->
					<div class="card text-white bg-secondary text-center">
						<div class="card-body">
							<p class="m-0">Скорость входящего соединения влияет на то, как быстро открываются сайты и скачиваются файлы.</p>
							<p class="m-0">Исходящее соединение используется при передаче данных с вашего компьютера в сеть — например, при отправке писем или загрузке фотографий в облако.</p>
						</div>
					</div>
				</div>
			</div>



			<!-- Content Row -->
			<div class="row">
				<div class="col-md-4 mb-4">
					<div class="card h-100">
						<div class="card-body">
							<h4 class="card-title">Ускорение интернета</h4>
							<p class="card-text">Мы предлагаем ускорить ваше текущее интернет соединение с помощью VPN
								технологии на скорости до 100 мбит в секунду.</p>
						</div>
						<div class="card-footer">
							<a href="{{ route('vpn') }}" class="btn btn-primary">Подробнее</a>
						</div>
					</div>
				</div>
				<!-- /.col-md-4 -->
				<div class="col-md-4 mb-4">
					<div class="card h-100">
						<div class="card-body">
							<h4 class="card-title">В любой точке</h4>
							<p class="card-text">Далеко не у всех провайдеров есть возможность подключить удаленные
								офисы и другие не жилые помещения. Мы же можем обеспечить доступ к сети интернет
								абсолютно везде!</p>
						</div>
						<div class="card-footer">
							<a href="{{ route('anywhere') }}" class="btn btn-primary">Подробнее</a>
						</div>
					</div>
				</div>
				<!-- /.col-md-4 -->
				<div class="col-md-4 mb-4">
					<div class="card h-100">
						<div class="card-body">
							<h4 class="card-title">Интернет за городом</h4>
							<p class="card-text">С помощью нашего оборудования можем улучшить сигнал мобильного
								интернета любого оператора даже в самой отдаленной местности.</p>
						</div>
						<div class="card-footer">
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
<link href="/css/speedtest.css" rel="stylesheet">
@endpush
@push('scripts')
<script type="text/javascript">
$( document ).ready(function() {
    initServers();
});
function I(i){return document.getElementById(i);}
	var SPEEDTEST_SERVERS = [
	@foreach($data as $item)
		{ 
			name: "{{$item->domain}}", 
			server: "//{{$item->domain}}",
			server_id: "{{$item->id}}",
			dlURL: "/speedtest/garbage.php", 
			ulURL: "/speedtest/empty.php", 
			pingURL: "/speedtest/empty.php",
			getIpURL: "/speedtest/getIP.php"
		},
		
		@endforeach
		{ 
			name: "Boost Net Main",
			server: "//{{ config('app.domain') }}",
			server_id: "0",
			dlURL: "/speedtest/garbage",
			ulURL: "/speedtest/empty",
			pingURL: "/speedtest/empty",
			getIpURL: "/speedtest/getip"
	    }


	];
</script>
<script src="{{ asset('js/speedtest.js')}}" defer></script>
<script src="{{ asset('js/stcore.js')}}" defer></script>
@endpush
