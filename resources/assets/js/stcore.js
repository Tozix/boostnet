console.log("Отрисовываем спидометры");
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

var target = document.getElementById('upload'); // your canvas element
var upload_gauge = new Gauge(target).setOptions(opts); // create sexy gauge!
upload_gauge.setTextField(document.getElementById("upload-textfield"));
upload_gauge.maxValue = 150; // set max gauge value
upload_gauge.setMinValue(0);  // Prefer setter over gauge.minValue = 0
upload_gauge.set(0);
upload_gauge.animationSpeed = 32; // set animation speed (32 is default value)

var target = document.getElementById('download'); // your canvas element
var download_gauge = new Gauge(target).setOptions(opts); // create sexy gauge!
download_gauge.setTextField(document.getElementById("download-textfield"));
download_gauge.maxValue = 150; // set max gauge value
download_gauge.setMinValue(0);  // Prefer setter over gauge.minValue = 0
download_gauge.set(0);
download_gauge.animationSpeed = 32; // set animation speed (32 is default value)

var w = null;

function startStop() {
    if (w != null) {
        w.postMessage('abort');
        w = null;
    } else {
        w = new Worker('/js/speedtest.min.js');

        setInterval(function () {
            if (w) w.postMessage('status')
        }, 200);

        w.onmessage = function (event) {
            var data = event.data.split(';');
            var status = Number(data[0]);
            console.log(status);
            if (status >= 4) {
                console.log("Тест окончен, нужно обновить кнопку на СТАРТ");
                w = null
            }
            else {
                upload_gauge.set(data[2]);
                download_gauge.set(data[1]);
            }
        };
        w.postMessage('start {"garbagePhp_chunkSize": 5, "time_ul":5, "time_dl":5, "test_order": "D_U", "url_dl": "/speedtest/garbage", "url_ul": "/speedtest/empty"}');
    }
}