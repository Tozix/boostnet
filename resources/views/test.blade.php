@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="row">
                                    {{--<div class="col-md-4">--}}
                                        {{--<canvas class="speedometr" id="ping"></canvas>--}}
                                        {{--<h4 class="text-center" id="ping-textfield"></h4>--}}
                                    {{--</div>--}}
                                    <div class="col-md-6">
                                        <canvas class="speedometr" id="download"></canvas>
                                        <h4 class="text-center"><span id="download-textfield"></span > Mбит/сек</h4>
                                    </div>
                                    <div class="col-md-6">
                                        <canvas class="speedometr" id="upload"></canvas>
                                        <h4 class="text-center"><span id="upload-textfield">0</span> Mбит/сек</h4>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                Тут текст
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('styles')
    <style>
        .speedometr {
            width: 100% !important;
            height: auto !important;
        }
    </style>
@endpush
@push('scripts')
    {{--<script src="/js/speedtest.min.js"></script>--}}
    <script src="/js/gauge.js"></script>
    <script>
        var opts = {
            angle: 0.15, // The span of the gauge arc
            lineWidth: 0.2, // The line thickness
            radiusScale: 1, // Relative radius
            pointer: {
                length: 0.6, // // Relative to gauge radius
                strokeWidth: 0.035, // The thickness
                color: '#000000' // Fill color
            },
            limitMax: false,     // If false, max value increases automatically if value > maxValue
            limitMin: false,     // If true, the min value of the gauge will be fixed
            colorStart: '#6FADCF',   // Colors
            colorStop: '#8FC0DA',    // just experiment with them
            strokeColor: '#E0E0E0',  // to see which ones work best for you
            generateGradient: true,
            highDpiSupport: true,     // High resolution support

        };
        // var target = document.getElementById('ping'); // your canvas element
        // var ping_gauge = new Gauge(target).setOptions(opts); // create sexy gauge!
        // ping_gauge.setTextField(document.getElementById("ping-textfield"));
        // ping_gauge.maxValue = 500; // set max gauge value
        // ping_gauge.setMinValue(0);  // Prefer setter over gauge.minValue = 0
        // ping_gauge.animationSpeed = 32; // set animation speed (32 is default value)

        var target = document.getElementById('upload'); // your canvas element
        var upload_gauge = new Gauge(target).setOptions(opts); // create sexy gauge!
        upload_gauge.setTextField(document.getElementById("upload-textfield"));
        upload_gauge.maxValue = 100; // set max gauge value
        upload_gauge.setMinValue(0);  // Prefer setter over gauge.minValue = 0
        upload_gauge.animationSpeed = 32; // set animation speed (32 is default value)

        var target = document.getElementById('download'); // your canvas element
        var download_gauge = new Gauge(target).setOptions(opts); // create sexy gauge!
        download_gauge.setTextField(document.getElementById("download-textfield"));
        download_gauge.maxValue = 100; // set max gauge value
        download_gauge.setMinValue(0);  // Prefer setter over gauge.minValue = 0
        download_gauge.animationSpeed = 32; // set animation speed (32 is default value)

        var w = new Worker('/js/speedtest.min.js'); // create new worker
        setInterval(function () { w.postMessage('status') }, 100); // ask for status every 100ms
        w.onmessage = function (event) { // when status is received, split the string and put the values in the appropriate fields
            var data = event.data.split(';'); // string format: status;download;upload;ping (speeds are in mbit/s) (status: 0=not started, 1=downloading, 2=uploading, 3=ping, 4=done, 5=aborted)
            // ping_gauge.set(data[3]);
            upload_gauge.set(data[2]);
            download_gauge.set(data[1]);
        };
	w.postMessage('start {"url_dl": "/speedtest/garbage", "url_ul": "/speedtest/empty"}')
    </script>
@endpush
