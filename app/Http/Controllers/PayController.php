<?php

namespace BoostNet\Http\Controllers;

use Illuminate\Http\Request;
use BoostNet\User;
use Illuminate\Support\Facades\Log;
class PayController extends Controller
{

    public function successPay(Request $request)
    {
        Log::channel('custom')->info('Success Pay: Обратились к файлу');
        //Успешный платеж
        $secretKey1 = config('payment.robokassa.secretKey1');
        if ($request->isMethod('post')) {
            $SignatureValue = $request->OutSum . ':' . $request->InvId . ':' . $secretKey1 . ':shp_Account=' . $request->shp_Account;
            $SignatureValue = md5($SignatureValue);
            if ($SignatureValue == $request->SignatureValue) {
                 Log::channel('custom')->info('Success Pay: Сигны совпадают! Все заебок');
                return redirect('https://boostnet.ru/home');
            } else {
                
                Log::channel('custom')->info('Success Pay: ' . $request->SignatureValue . '  А у нас сигна: ' . $SignatureValue);
            }

        }
    }
        public function failPay(Request $request)
    {
        //Отказ от платежа
            Log::channel('custom')->info('Fail Pay: Обратились к файлу');
        if ($request->isMethod('post')) {
            //Log::useFiles(storage_path() . '/logs/pay_unsuc.log');
            Log::channel('custom')->info('Fail Pay: Отказ от платежа');

        }

    }

    public function resultPay(Request $request)
    {
        Log::channel('custom')->info('Result Pay: Обратились к файлу');
        //Обработка данных от робокассы
        
        if ($request->isMethod('post') and $request->SignatureValue) {
            $secretKey2 = config('payment.robokassa.secretKey2');
            
            Log::channel('custom')->info('Result Pay: Получили сигну: '.$request->SignatureValue);
            $SignatureValue = $request->OutSum . ':' . $request->InvId . ':' . $secretKey2 . ':shp_Account=' . $request->shp_Account;
            $SignatureValue = strtoupper(md5($SignatureValue));
            $SignatureValueRobo = strtoupper($request->SignatureValue);
            Log::channel('custom')->info('Result Pay: Сравниваем Сигны: '.$SignatureValue.' - '.$SignatureValueRobo);
            if ($SignatureValue == $SignatureValueRobo) {
                Log::channel('custom')->info('Result Pay: Сигны совпадают! Начисляем деньги: ' . $request->OutSum . ' юзеру: ' . $request->shp_Account);
                $user = User::where('id', $request->shp_Account)->increment('balance', $request->OutSum);
                echo "OK" . $request->InvId . "\n";
            } else {
                Log::channel('custom')->info('Result Pay: Сигны не совпали: '.$SignatureValue.' - '.$SignatureValueRobo);
            }


        }
        
    }
    
}
