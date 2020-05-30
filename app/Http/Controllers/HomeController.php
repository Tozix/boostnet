<?php

namespace BoostNet\Http\Controllers;

use Illuminate\Http\Request;
use BoostNet\User;
use BoostNet\Tarif;
use Auth;
use Illuminate\Support\Facades\Log;
use Session;
use Zipper;
use Storage;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    
        public function admin()
    {
        dd('Админка');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $account_id = Auth::id();
    	$user = User::where('id',$account_id)->first();
        return view('home.balance')->with('user', $user);
    }
    
     public function ChangeTarif(Request $request)
    {
         if ($request->isMethod('post')) {

    	$id = Auth::id();
        $user = User::where('id',$id)->first();
        $tarif = Tarif::where('id',$request->submit_audit)->first();

         
            if ($user->balance < $tarif->cost) {
                return redirect()->back()->withErrors(['money' => ['Не достаточно средств, пожалуйста пополните баланс!']])->withInput();
            } else {
                if ($user->tarif_id == $request->submit_audit) return redirect()->back()->withErrors(['tarif' => ['Переход на данный тариф не возможен, т.к. это ваш текущий тариф!']])->withInput();
                $user->update([ 'tarif_id' => $request->submit_audit, 'balance' => $user->balance-$tarif->cost ]); //Смена тарифа
                Session::flash('success', 'Тариф <b>"'.$tarif->name.'"</b> успешно подключен! С вашего баланса будет списано <b>'.$tarif->cost.'</b> рублей.');
                return redirect()->route('tarifs');
            }
     } else {
            $tarif = Tarif::where('status','1')->where('type','1')->get();
            return view('home.tarifs')->withData($tarif); 
         }
         
         //dd($user->id);
         //
         //Списываем бабло с юзера
         //
        
         
     }
    
        public function download($id)
    {
        
    	
            
        $openvpn_config=view('docshab.vpnconfig')->with(['server_port' => '999',
        'server_adr1' => 'ts1.boostnet.ru',
        'server_adr2' => 'ts2.boostnet.ru',
        'server_adr3' => 'ts3.boostnet.ru',
        'server_adr4' => 'ts4.boostnet.ru' ]);



        //Создаем файл с конфигом VPN
        Storage::put($id.'.ovpn', $openvpn_config);
        $config_file=storage_path('app/'.$id.'.ovpn');
        //Создаем файл с логином
        $password=User::where('name',$id)->value('vpn_password');
        Storage::put($id.'.login', $id."\n".$password);
        $login_file=storage_path('app/'.$id.'.login');
        //$fileName = $id.".zip"; // name of zip
        //$fileContents = "Hello world!";
        $zip_path = storage_path('app/'.$id.'.zip');
        Zipper::make($zip_path)->add($config_file)->add($login_file,'login.dat')->close();
        //Удаляем файлы
        Storage::delete([ $id.'.login', $id.'.ovpn' ]);

        //$zip_path = storage_path('configs/' . $id.'.config');
        return response()->download($zip_path);
    }
    
    
    
        public function showPayForm(Request $request)
    {
        if ($request->isMethod('post')) {
            $this->validate($request, [
                'money' => 'required|integer|between:1,99999',
            ], [], [
                'money' => 'Сумма',
            ]);
            $account_id = Auth::id();
            $apiUrl = config('payment.robokassa.apiUrl');
            $MrchLogin = config('payment.robokassa.MrchLogin');
            $secretKey1 = config('payment.robokassa.secretKey1');
            $secretKey2 = config('payment.robokassa.secretKey2');
            $InvId = time();
            $OutSum = $request->money;
            $SignatureValue = $MrchLogin . ':' . $OutSum . ':' . $InvId . ':' . $secretKey1 . ':shp_Account=' . $account_id;
            $SignatureValue = md5($SignatureValue);
           
            return redirect($apiUrl . '?MrchLogin=' . $MrchLogin . '&OutSum=' . $OutSum . '&InvId=' . $InvId . '&SignatureValue=' . $SignatureValue . '&shp_Account=' . $account_id);

        } else {
            return view('home.payment');
        }

    }
    
    

    
}
