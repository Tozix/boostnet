<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Tarif;
use Auth;
use Illuminate\Support\Facades\Log;
use Session;

class HomeorgController extends Controller
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


    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $account_id = Auth::id();
        $user = User::where('id', $account_id)->first();
        return view('homeorg.balance')->with('user', $user);
    }

    public function ChangeTarif(Request $request)
    {
        if ($request->isMethod('post')) {

            $id = Auth::id();
            $user = User::where('id', $id)->first();
            $tarif = Tarif::where('id', $request->submit_audit)->first();


            if ($user->balance < $tarif->cost) {
                return redirect()->back()->withErrors(['money' => ['Не достаточно средств, пожалуйста пополните баланс!']])->withInput();
            } else {
                if ($user->tarif_id == $request->submit_audit) return redirect()->back()->withErrors(['tarif' => ['Переход на данный тариф не возможен, т.к. это ваш текущий тариф!']])->withInput();
                $user->update(['tarif_id' => $request->submit_audit, 'balance' => $user->balance - $tarif->cost]); //Смена тарифа
                Session::flash('success', 'Тариф <b>"' . $tarif->name . '"</b> успешно подключен! С вашего баланса будет списано <b>' . $tarif->cost . '</b> рублей.');
                return redirect()->route('tarifs_org');
            }
        } else {
            $tarif = Tarif::where('status', '1')->where('type', '2')->get();
            return view('homeorg.tarifs')->withData($tarif);
        }

        //dd($user->id);
        //
        //Списываем бабло с юзера
        //


    }

    public function download($id)
    {
        $file_path = storage_path('openvpn/' . $id . '.zip');
        return response()->download($file_path);
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
