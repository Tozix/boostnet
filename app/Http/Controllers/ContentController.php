<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Server;
use App\Models\Tarif;

class ContentController extends Controller
{

    public function ServerList()
    {
        $server = Server::where('status', '1')->get();
        return view('speedtest')->withData($server);
    }
    public function TarifList()
    {
        $tarif = Tarif::where('status', '1')->get();
        return view('tarifs')->withData($tarif);
    }
}
