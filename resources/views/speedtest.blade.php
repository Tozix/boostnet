@extends('layouts.app')

@section('content')
<div class="container">
	<div class="row justify-content-center">
		<div class="col-md-12">










				


			<div class="row">
				<div class="col-md-12 mb-4">
					<div class="card h-100">
						<div class="card-body">
							<h4>Замер скорости интернета</h4>
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
