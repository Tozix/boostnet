<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Result;

class SpeedTestController extends Controller
{
    public function emptyResponse()
    {
        header("HTTP/1.1 200 OK");
        header('Access-Control-Allow-Origin: *');
        header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
        header("Cache-Control: post-check=0, pre-check=0", false);
        header("Pragma: no-cache");
        header("Connection: keep-alive");
        echo '';
    }
    public function result(Request $request)
    {
        if ($request->isMethod('post')) {
            $ip = ($_SERVER['REMOTE_ADDR']);
            $ispinfo = ($request["ispinfo"]);
            $j_server_id = json_decode($request["extra"]);
            $server_id = $j_server_id->{'server_id'};
            $ua = ($_SERVER['HTTP_USER_AGENT']);
            $lang = "";
            if (isset($_SERVER['HTTP_ACCEPT_LANGUAGE'])) $lang = ($_SERVER['HTTP_ACCEPT_LANGUAGE']);
            $dl = ($request["dl"]);
            $ul = ($request["ul"]);
            $ping = ($request["ping"]);
            $jitter = ($request["jitter"]);

            /*
        if($redact_ip_addresses){
            $ip="0.0.0.0";
            $ipv4_regex='/(?:(?:25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)\\.){3}(?:25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)/';
            $ipv6_regex='/(([0-9a-fA-F]{1,4}:){7,7}[0-9a-fA-F]{1,4}|([0-9a-fA-F]{1,4}:){1,7}:|([0-9a-fA-F]{1,4}:){1,6}:[0-9a-fA-F]{1,4}|([0-9a-fA-F]{1,4}:){1,5}(:[0-9a-fA-F]{1,4}){1,2}|([0-9a-fA-F]{1,4}:){1,4}(:[0-9a-fA-F]{1,4}){1,3}|([0-9a-fA-F]{1,4}:){1,3}(:[0-9a-fA-F]{1,4}){1,4}|([0-9a-fA-F]{1,4}:){1,2}(:[0-9a-fA-F]{1,4}){1,5}|[0-9a-fA-F]{1,4}:((:[0-9a-fA-F]{1,4}){1,6})|:((:[0-9a-fA-F]{1,4}){1,7}|:)|fe80:(:[0-9a-fA-F]{0,4}){0,4}%[0-9a-zA-Z]{1,}|::(ffff(:0{1,4}){0,1}:){0,1}((25[0-5]|(2[0-4]|1{0,1}[0-9]){0,1}[0-9])\.){3,3}(25[0-5]|(2[0-4]|1{0,1}[0-9]){0,1}[0-9])|([0-9a-fA-F]{1,4}:){1,4}:((25[0-5]|(2[0-4]|1{0,1}[0-9]){0,1}[0-9])\.){3,3}(25[0-5]|(2[0-4]|1{0,1}[0-9]){0,1}[0-9]))/';
            $hostname_regex='/"hostname":"([^\\\\"]|\\\\")*"/';
            $ispinfo=preg_replace($ipv4_regex,"0.0.0.0",$ispinfo);
            $ispinfo=preg_replace($ipv6_regex,"0.0.0.0",$ispinfo);
            $ispinfo=preg_replace($hostname_regex,"\"hostname\":\"REDACTED\"",$ispinfo);
            $log=preg_replace($ipv4_regex,"0.0.0.0",$log);
            $log=preg_replace($ipv6_regex,"0.0.0.0",$log);
            $log=preg_replace($hostname_regex,"\"hostname\":\"REDACTED\"",$log);
        }
        */
            header('Cache-Control: no-store, no-cache, must-revalidate, max-age=0, s-maxage=0');
            header('Cache-Control: post-check=0, pre-check=0', false);
            header('Pragma: no-cache');
            Result::unguard();
            $result = Result::create([
                'user_id' => "0",
                'server_id' => $server_id,
                'ping' => $ping,
                'jitter' => $jitter,
                'download' => $dl,
                'upload' => $ul,
            ]);
            Result::reguard();
        }
    }
    public function getip()
    {
        /*
            This script detects the client's IP address and fetches ISP info from ipinfo.io/
            Output from this script is a JSON string composed of 2 objects: a string called processedString which contains the combined IP, ISP, Contry and distance as it can be presented to the user; and an object called rawIspInfo which contains the raw data from ipinfo.io (will be empty if isp detection is disabled).
            Client side, the output of this script can be treated as JSON or as regular text. If the output is regular text, it will be shown to the user as is.
        */
        error_reporting(0);
        $ip = "";
        header('Content-Type: application/json; charset=utf-8');
        if (isset($_GET["cors"])) {
            header('Access-Control-Allow-Origin: *');
            header('Access-Control-Allow-Methods: GET, POST');
        }
        header('Cache-Control: no-store, no-cache, must-revalidate, max-age=0, s-maxage=0');
        header('Cache-Control: post-check=0, pre-check=0', false);
        header('Pragma: no-cache');
        if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
            $ip = $_SERVER['HTTP_CLIENT_IP'];
        } elseif (!empty($_SERVER['X-Real-IP'])) {
            $ip = $_SERVER['X-Real-IP'];
        } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
            $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
            $ip = preg_replace("/,.*/", "", $ip); # hosts are comma-separated, client is first
        } else {
            $ip = $_SERVER['REMOTE_ADDR'];
        }

        $ip = preg_replace("/^::ffff:/", "", $ip);

        if ($ip == "::1") { // ::1/128 is the only localhost ipv6 address. there are no others, no need to strpos this
            echo json_encode(['processedString' => $ip . " - localhost IPv6 access", 'rawIspInfo' => ""]);
            die();
        }
        if (stripos($ip, 'fe80:') === 0) { // simplified IPv6 link-local address (should match fe80::/10)
            echo json_encode(['processedString' => $ip . " - link-local IPv6 access", 'rawIspInfo' => ""]);
            die();
        }
        if (strpos($ip, '127.') === 0) { //anything within the 127/8 range is localhost ipv4, the ip must start with 127.0
            echo json_encode(['processedString' => $ip . " - localhost IPv4 access", 'rawIspInfo' => ""]);
            die();
        }
        if (strpos($ip, '10.') === 0) { // 10/8 private IPv4
            echo json_encode(['processedString' => $ip . " - private IPv4 access", 'rawIspInfo' => ""]);
            die();
        }
        if (preg_match('/^172\.(1[6-9]|2\d|3[01])\./', $ip) === 1) { // 172.16/12 private IPv4
            echo json_encode(['processedString' => $ip . " - private IPv4 access", 'rawIspInfo' => ""]);
            die();
        }
        if (strpos($ip, '192.168.') === 0) { // 192.168/16 private IPv4
            echo json_encode(['processedString' => $ip . " - private IPv4 access", 'rawIspInfo' => ""]);
            die();
        }
        if (strpos($ip, '169.254.') === 0) { // IPv4 link-local
            echo json_encode(['processedString' => $ip . " - link-local IPv4 access", 'rawIspInfo' => ""]);
            die();
        }

        /**
         * Optimized algorithm from http://www.codexworld.com
         *
         * @param float $latitudeFrom
         * @param float $longitudeFrom
         * @param float $latitudeTo
         * @param float $longitudeTo
         *
         * @return float [km]
         */
        function distance($latitudeFrom, $longitudeFrom, $latitudeTo, $longitudeTo)
        {
            $rad = M_PI / 180;
            $theta = $longitudeFrom - $longitudeTo;
            $dist = sin($latitudeFrom * $rad) * sin($latitudeTo * $rad) + cos($latitudeFrom * $rad) * cos($latitudeTo * $rad) * cos($theta * $rad);
            return acos($dist) / $rad * 60 * 1.853;
        }
        function getIpInfoTokenString()
        {
            $apikeyFile = "getIP_ipInfo_apikey.php";
            if (!file_exists($apikeyFile)) return "";
            require $apikeyFile;
            if (empty($IPINFO_APIKEY)) return "";
            return "?token=" . $IPINFO_APIKEY;
        }
        if (isset($_GET["isp"])) {
            $isp = "";
            $rawIspInfo = null;
            try {
                $json = file_get_contents("https://ipinfo.io/" . $ip . "/json" . getIpInfoTokenString());
                $details = json_decode($json, true);
                $rawIspInfo = $details;
                if (array_key_exists("org", $details)) {
                    $isp .= $details["org"];
                    $isp = preg_replace("/AS\d{1,}\s/", "", $isp); //Remove AS##### from ISP name, if present
                } else {
                    $isp .= "Unknown ISP";
                }
                if (array_key_exists("country", $details)) {
                    $isp .= ", " . $details["country"];
                }
                $clientLoc = NULL;
                $serverLoc = NULL;
                if (array_key_exists("loc", $details)) {
                    $clientLoc = $details["loc"];
                }
                if (isset($_GET["distance"])) {
                    if ($clientLoc) {
                        $locFile = "getIP_serverLocation.php";
                        $serverLoc = null;
                        if (file_exists($locFile)) {
                            require $locFile;
                        } else {
                            $json = file_get_contents("https://ipinfo.io/json" . getIpInfoTokenString());
                            $details = json_decode($json, true);
                            if (array_key_exists("loc", $details)) {
                                $serverLoc = $details["loc"];
                            }
                            if ($serverLoc) {
                                $lf = fopen($locFile, "w");
                                fwrite($lf, chr(60) . "?php\n");
                                fwrite($lf, '$serverLoc="' . addslashes($serverLoc) . '";');
                                fwrite($lf, "\n");
                                fwrite($lf, "?" . chr(62));
                                fclose($lf);
                            }
                        }
                        if ($serverLoc) {
                            try {
                                $clientLoc = explode(",", $clientLoc);
                                $serverLoc = explode(",", $serverLoc);
                                $dist = distance($clientLoc[0], $clientLoc[1], $serverLoc[0], $serverLoc[1]);
                                if ($_GET["distance"] == "mi") {
                                    $dist /= 1.609344;
                                    $dist = round($dist, -1);
                                    if ($dist < 15)
                                        $dist = "<15";
                                    $isp .= " (" . $dist . " mi)";
                                } else if ($_GET["distance"] == "km") {
                                    $dist = round($dist, -1);
                                    if ($dist < 20)
                                        $dist = "<20";
                                    $isp .= " (" . $dist . " km)";
                                }
                            } catch (Exception $e) {
                            }
                        }
                    }
                }
            } catch (Exception $ex) {
                $isp = "Unknown ISP";
            }
            echo json_encode(['processedString' => $ip . " - " . $isp, 'rawIspInfo' => $rawIspInfo]);
        } else {
            echo json_encode(['processedString' => $ip, 'rawIspInfo' => ""]);
        }
    }

    public function garbage(Request $request)
    {
        @ini_set('zlib.output_compression', 'Off');
        @ini_set('output_buffering', 'Off');
        @ini_set('output_handler', '');
        header('Access-Control-Allow-Origin: *');
        header('Content-Description: File Transfer');
        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename=random.dat');
        header('Content-Transfer-Encoding: binary');
        header('Cache-Control: no-store, no-cache, must-revalidate, max-age=0');
        header('Cache-Control: post-check=0, pre-check=0', false);
        header('Pragma: no-cache');

        $data = openssl_random_pseudo_bytes(1048576);

        $chunks = $request->ckSize ? intval($request->ckSize) : 4;

        if ($chunks > 100) {
            $chunks = 100;
        }

        for ($i = 0; $i < $chunks; $i++) {
            echo $data;
            flush();
        }
    }
}
