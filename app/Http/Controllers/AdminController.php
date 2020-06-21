<?php

namespace BoostNet\Http\Controllers;

use BoostNet\Account;
use BoostNet\Org;
use BoostNet\Server;
use BoostNet\Tarif;
use BoostNet\User;
use Dompdf\Dompdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Session;

class AdminController extends Controller
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
        return view('admin.stat');

        /*
    return view('admin.main')->with(['balance' => $user,
    'status' => $user->active_vpn,
    'tarif'   => $tarif]); */

    }

    private function format_price($value)
    {
        return number_format($value, 2, ',', ' ');
    }

    // Сумма прописью.
    private function str_price($value)
    {
        $value = explode('.', number_format($value, 2, '.', ''));

        $f = new \NumberFormatter('ru', \NumberFormatter::SPELLOUT);
        $str = $f->format($value[0]);

        // Первую букву в верхний регистр.
        $str = mb_strtoupper(mb_substr($str, 0, 1)) . mb_substr($str, 1, mb_strlen($str));

        // Склонение слова "рубль".
        $num = $value[0] % 100;
        if ($num > 19) {
            $num = $num % 10;
        }
        switch ($num) {
            case 1:$rub = 'рубль';
                break;
            case 2:
            case 3:
            case 4:$rub = 'рубля';
                break;
            default:$rub = 'рублей';
        }

        return $str . ' ' . $rub . ' ' . $value[1] . ' копеек.';
    }

    // Формируем PDF
    public function pdf()
    {

        $prods = array(
            array(
                'name' => 'Профиль 20*20',
                'count' => 10,
                'unit' => 'м',
                'price' => 550,
                'nds' => 10,
            ),
            array(
                'name' => 'Абонетская плата за декабрь',
                'count' => 1,
                'unit' => 'шт',
                'price' => 200,
                'nds' => 0,
            ));

        $img_path = storage_path('sign');

        $total = $nds = 0;
        foreach ($prods as $i => $row) {
            $total += $row['price'] * $row['count'];
            $nds += ($row['price'] * $row['nds'] / 100) * $row['count'];
        }

        $dompdf = new Dompdf();
        $html = view('docshab.schet')->with(['number' => '1',
            'date' => '5 декабря 2018г.',
            'total_num' => $total,
            'total_format' => $this->format_price($total),
            'prods' => $prods,
            'count_prods' => count($prods),
            'img_path' => $img_path,
            'total_text' => $this->str_price($total),
            'pokupatel' => 'ООО "Рога и копыта"']);
        $dompdf->loadHtml($html, 'utf-8');
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();

        // Вывод файла в браузер:
        $dompdf->stream('schet-10', array("Attachment" => 0));
        //echo $html;

    }
    public function server($action = 'def', $id = null, Request $request)
    {
        switch ($action) {
            case "def":
                $data = Server::all();
                return view('admin.serverlist')->withData($data);
                break;
            case "disable":
                $server = Server::where('id', $id)->update(['status' => '0']);
                if ($server) {
                    return redirect()->back();
                }
                break;
            case "enable":
                $server = Server::where('id', $id)->update(['status' => '1']);
                if ($server) {
                    return redirect()->back();
                }
                break;
            case "add":
                if ($request->isMethod('post')) {
                    $this->validate($request, [
                        'name' => 'required|max:100',
                        'domain' => 'required|max:100',
                        'ip' => 'required|ipv4',
                        'city' => 'required|alpha_num',
                        'speed' => 'required|numeric|max:1073741824',
                        'description' => 'required|string|max:400',

                    ], [], [
                        'name' => 'Название сервера',
                        'domain' => 'Имя домена',
                        'ip' => 'IP Адрес сервера',
                        'city' => 'Город расположения',
                        'speed' => 'Ширина канала',
                        'description' => 'Описание сервера',
                    ]);
                    Server::unguard();
                    $server = Server::create([
                        'name' => $request->name,
                        'domain' => $request->domain,
                        'ip' => $request->ip,
                        'city' => $request->city,
                        'speed' => $request->speed,
                        'status' => 0,
                        'description' => $request->description,
                    ]);
                    Server::reguard();
                    Session::flash('success', 'Сервер ' . $server->name . ' успешно добавлен в систему!');
                    return redirect()->route('admin_server', ['action' => $action]);

                } else {
                    return view('admin.serveradd');
                }

                break;
            case "edit":
                $server = Server::where('id', $id)->first();
                if ($request->isMethod('post')) {
                    $this->validate($request, [
                        'name' => 'required|max:100',
                        'domain' => 'required|max:100',
                        'ip' => 'required|ipv4',
                        'city' => 'required|alpha_num',
                        'speed' => 'required|numeric|max:1073741824',
                        'description' => 'required|string|max:400',

                    ], [], [
                        'name' => 'Имя сервера',
                        'domain' => 'Доменное имя',
                        'ip' => 'IP Адрес сервера',
                        'city' => 'Город расположения',
                        'speed' => 'Ширина канала',
                        'description' => 'Описание сервера',
                    ]);
                    Server::unguard();
                    $server->update([
                        'name' => $request->name,
                        'domain' => $request->domain,
                        'ip' => $request->ip,
                        'city' => $request->city,
                        'speed' => $request->speed,
                        'description' => $request->description,
                    ]);
                    Server::reguard();
                    Session::flash('success', 'Сервер успешно изменен!');
                    return redirect()->route('admin_server', ['action' => $action, 'id' => $server->id]);

                } else {
                    return view('admin.serveredit')->with(['server' => $server]);
                }

                break;
        }
    }

    public function user($action = 'def', $id = null, Request $request)
    {
        switch ($action) {
            case "edit_vpn":
                $vpn = Account::where('id', $id)->first();
                if ($request->isMethod('post')) {
                    $this->validate($request, [
                        'name' => 'required|max:400',
                    ], [], [
                        'name' => 'Имя VPN аккаунта',
                    ]);
                    Account::unguard();
                    $vpn->update([
                        'name' => $request->name,
                    ]);
                    Account::reguard();
                    Session::flash('success', 'Изменения внесены!');
                    return redirect()->route('admin_user', ['action' => 'vpnlist', 'id' => $vpn->user_id]);

                } else {
                    return view('admin.usereditvpn')->with(['vpn' => $vpn]);
                }
                break;
            case "edit":
                $user = User::where('id', $id)->first();
                if ($request->isMethod('post')) {
                    $this->validate($request, [
                        'email' => 'required|string|email|max:80',
                        'name' => 'required|max:400',
                        'balance' => 'required|max:250',
                    ], [], [
                        'email' => 'E-Mail Пользователя',
                        'name' => 'Имя пользователя',
                        'balance' => 'Баланс пользователя',
                    ]);
                    User::unguard();
                    $user->update([
                        'name' => $request->name,
                        'email' => $request->email,
                        'balance' => $request->balance,
                        'type' => $request->type,
                        'tarif_id' => $request->tarif_id,
                    ]);
                    User::reguard();
                    Session::flash('success', 'Изменения внесены!');
                    return redirect()->route('admin_user', ['action' => $action, 'id' => $user->id]);

                } else {
                    $tarif_list = Tarif::where('status', '1')->get();
                    return view('admin.useredit')->with(['user' => $user, 'tarif_list' => $tarif_list]);
                }
                break;
            case "get_conf":
                $vpn = Account::where('id', $id)->first();
                $server = Server::where('status', '1')->get();
                if ($request->isMethod('post')) {
                    $s_conf = Server::where('id', $request->server_id)->first();
                    //dd($s_conf);
                    if($request->internet==='on') $allowedip='0.0.0.0/0';
                    else $allowedip=$vpn->ipAddress.'/24'; 
                    if($request->tunnel==='on') {
                        $endpoint='tcp://127.0.0.1:5555';
                        $excludedips='8.8.8.8/32,'.$s_conf->ip.'/24,176.58.123.25/24,94.25.232.0/24,94.25.208.0/24';
                    } else {
                        $endpoint=$s_conf->domain.':35053';
                        $excludedips='8.8.8.8/24,'.$s_conf->ip.'';
                    } 
                    $config = '[Interface]
Address = '.$vpn->ipAddress.'/24
PrivateKey = '.$vpn->private_key.'
DNS = 8.8.8.8,8.8.4.4,1.1.1.1
ExcludedIPs = '.$excludedips.'
[Peer]
PublicKey = oDdrze88EEQ8kO71XHz42NDYRlhiL6xc7uha49EPhGE=
AllowedIPs = '.$allowedip.'
Endpoint = '.$endpoint.'
PersistentKeepalive = 25';
                    Session::flash('success', $config);
                    return view('admin.uservpnconf')->with(['vpn' => $vpn, 'server' => $server, 'server_id' => $request->server_id, 'internet' => $request->internet, 'tunnel' => $request->tunnel]);
                } else {
                    $internet = "on";
                    $tunnel = "off";
                    return view('admin.uservpnconf')->with(['vpn' => $vpn, 'server' => $server, 'server_id' => '1', 'internet' => $internet, 'tunnel' => $tunnel]);
                }

                break;
            case "info":
                $user = User::where('id', $id)->first();
                return view('admin.userinfo')->with('user', $user);
                break;
            case "vpnlist":
                $vpn = Account::where('user_id', $id)->get();
                return view('admin.vpnlist')->with(['vpn' => $vpn, 'id' => $id]);
                break;
            case "add":
                $account = User::where('id', $id)->update(['active_vpn' => '8']);
                if ($account) {
                    Session::flash('success', 'Аккаунт будет добавлен в течении 1 минуты!');
                    return redirect()->back();
                }
                break;
            case "disable_vpn":
                $account = Account::where('id', $id)->update(['status' => '0']);
                if ($account) {
                    return redirect()->back();
                }
                break;
            case "enable_vpn":
                $account = Account::where('id', $id)->update(['status' => '1']);
                if ($account) {
                    return redirect()->back();
                }
                break;
            case "def":
                $data = User::all();
                return view('admin.userlist')->withData($data);
                break;
        }
    }

    //Функция управления тарифами
    public function tarif($action = 'def', $id = null, Request $request)
    {
        switch ($action) {
            case "disable":
                $tarif = Tarif::where('id', $id)->update(['status' => '0']);
                if ($tarif) {
                    return redirect()->back();
                }
                break;
            case "enable":
                $tarif = Tarif::where('id', $id)->update(['status' => '1']);
                if ($tarif) {
                    return redirect()->back();
                }
                break;
            case "edit":
                $tarif = Tarif::where('id', $id)->first();
                if ($request->isMethod('post')) {
                    //dd($request);

                    $this->validate($request, [
                        'tarif_name' => 'required|max:100',
                        'tarif_cost' => 'required|numeric|max:2000',
                        'tarif_speed' => 'required|numeric|max:100000000',
                        'tarif_description' => 'required|string|max:400',

                    ], [], [
                        'tarif_name' => 'Название тарифа',
                        'tarif_cost' => 'Абонетская плата',
                        'tarif_speed' => 'Скорость',
                        'tarif_description' => 'Описание тарифа',
                    ]);
                    Tarif::unguard();
                    $tarif->update([
                        'name' => $request->tarif_name,
                        'cost' => $request->tarif_cost,
                        'type' => $request->tarif_type,
                        'speed' => $request->tarif_speed,
                        'status' => 0,
                        'description' => $request->tarif_description,
                    ]);
                    Tarif::reguard();
                    Session::flash('success', 'Тариф успешно изменен!');
                    return redirect()->route('admin_tarif', ['action' => $action, 'id' => $tarif->id]);

                } else {
                    return view('admin.tarifedit')->with(['tarif' => $tarif]);
                }

                break;
            case "add":
                if ($request->isMethod('post')) {
                    $this->validate($request, [
                        'tarif_name' => 'required|max:100',
                        'tarif_cost' => 'required|numeric|max:2000',
                        'tarif_speed' => 'required|numeric|max:100000000',
                        'tarif_description' => 'required|string|max:400',

                    ], [], [
                        'tarif_name' => 'Название тарифа',
                        'tarif_cost' => 'Абонетская плата',
                        'tarif_speed' => 'Скорость',
                        'tarif_description' => 'Описание тарифа',
                    ]);
                    Tarif::unguard();
                    $tarif = Tarif::create([
                        'name' => $request->tarif_name,
                        'cost' => $request->tarif_cost,
                        'type' => $request->tarif_type,
                        'speed' => $request->tarif_speed,
                        'status' => 0,
                        'description' => $request->tarif_description,
                    ]);
                    Tarif::reguard();
                    Session::flash('success', 'Тариф ' . $tarif->name . ' успешно добавлен в систему!');
                    return redirect()->route('admin_tarif', ['action' => $action]);

                } else {
                    return view('admin.tarifadd');
                }

                break;
            case "def":
                $data = Tarif::all();
                return view('admin.tariflist')->withData($data);
                break;
        }

    }

    public function org($action = 'def', $id = null, Request $request)
    {
        switch ($action) {
            case "info":
                return view('admin.orginfo')->with(['id' => $id]);
                break;
            case "add":
                if ($request->isMethod('post')) {
                    //dd($request);
                    $this->validate($request, [
                        'name' => 'required|max:100|regex:/(^[A-Za-z0-9 ]+$)+/',
                        'org_email' => 'required|string|email|max:80',
                        'org_tel' => 'required|max:100',
                        'org_name' => 'required|max:400',
                        'org_inn' => 'required|regex:/(^[0-9]+$)+/|min:10|max:12',
                        'org_kpp' => 'regex:/(^[0-9]+$)+/|min:9|max:9',
                        'org_bik' => 'required|regex:/(^[0-9]+$)+/|max:9|min:9',
                        'org_rschet' => 'required|regex:/(^[0-9]+$)+/|min:20|max:20',
                        'org_korschet' => 'required|regex:/(^[0-9]+$)+/|max:20|min:20',
                        'org_bank' => 'required|max:250',
                        'org_dir_fio' => 'required|max:250',
                        'org_dir_dol' => 'required|max:250',
                        'address_ur' => 'required|max:250',
                        'address_fact' => 'required|max:250',
                        'org_contacts' => 'required|max:400',
                    ], [], [
                        'name' => 'Логин',
                        'org_email' => 'E-Mail Адрес организации',
                        'org_tel' => 'Телефон организации',
                        'org_name' => 'Название организации',
                        'org_inn' => 'ИНН организации',
                        'org_kpp' => 'КПП Организации',
                        'org_bik' => 'БИК банка',
                        'org_rschet' => 'Рассчетный счет',
                        'org_korschet' => 'Корреспондентский счет',
                        'org_bank' => 'Наименование банка и отделения',
                        'org_dir_fio' => 'ФИО руководителя',
                        'org_dir_dol' => 'Должность руководителя',
                        'address_ur' => 'Юридический адрес организации',
                        'address_fact' => 'Фактический, почтовый адрес',
                        'org_contacts' => 'Контактное лицо и другая информация',
                    ]);
                    //Генирируем пароль
                    $clear_password = str_random(8);
                    $password = Hash::make($clear_password);
                    $user = User::where('email', $request->org_email)->first();
                    if (!$user) {
                        //Добавляем юзера в таблицу
                        User::create([
                            'name' => $request->name,
                            'email' => $request->org_email,
                            'password' => $password,
                            'type' => '2',
                        ]);

                        //костыль блять очередной, не хочу искать изящное решение и так пойдет
                        $user = User::where('email', $request->org_email)->first(); //НАХУЯ???
                        //Добавляем информацию в таблицу организации
                        Org::unguard();
                        $org = Org::create([
                            'user_id' => $user->id,
                            'org_tel' => $request->org_tel,
                            'org_email' => $request->org_email,
                            'org_name' => $request->org_name,
                            'org_inn' => $request->org_inn,
                            'org_kpp' => $request->org_kpp,
                            'org_bik' => $request->org_bik,
                            'org_rschet' => $request->org_rschet,
                            'org_korschet' => $request->org_korschet,
                            'org_bank' => $request->org_bank,
                            'org_dir_fio' => $request->org_dir_fio,
                            'org_dir_dol' => $request->org_dir_dol,
                            'address_ur' => $request->address_ur,
                            'address_fact' => $request->address_fact,
                            'org_contacts' => $request->org_contacts,
                        ]);
                        Org::reguard();
                        Session::flash('success', 'Организация ' . $org->name . ' успешно добавлена в систему.<hr> Данные для входа в систему:<br>Login: ' . $org->org_email . '<br>Пароль: ' . $clear_password . ' не проебите, иначе придется менять пароль.');

                    } else {
                        return redirect()->back()->withErrors(['org_email' => ['Организация с такой почтой уже зарегистрирована в системе']])->withInput();
                    }

                }

                return view('admin.orgadd');
                break;
            case "edit":
                $org = Org::where('id', $id)->first();
                if ($request->isMethod('post')) {
                    //dd($request);
                    $this->validate($request, [
                        'org_email' => 'required|string|email|max:80',
                        'org_tel' => 'required|max:100',
                        'org_name' => 'required|max:400',
                        'org_inn' => 'required|regex:/(^[0-9]+$)+/|min:10|max:12',
                        'org_kpp' => 'regex:/(^[0-9]+$)+/|min:9|max:9',
                        'org_bik' => 'required|regex:/(^[0-9]+$)+/|max:9|min:9',
                        'org_rschet' => 'required|regex:/(^[0-9]+$)+/|min:20|max:20',
                        'org_korschet' => 'required|regex:/(^[0-9]+$)+/|max:20|min:20',
                        'org_bank' => 'required|max:250',
                        'org_dir_fio' => 'required|max:250',
                        'org_dir_dol' => 'required|max:250',
                        'address_ur' => 'required|max:250',
                        'address_fact' => 'required|max:250',
                        'org_contacts' => 'required|max:400',
                    ], [], [
                        'org_email' => 'E-Mail Адрес организации',
                        'org_tel' => 'Телефон организации',
                        'org_name' => 'Название организации',
                        'org_inn' => 'ИНН организации',
                        'org_kpp' => 'КПП Организации',
                        'org_bik' => 'БИК банка',
                        'org_rschet' => 'Рассчетный счет',
                        'org_korschet' => 'Корреспондентский счет',
                        'org_bank' => 'Наименование банка и отделения',
                        'org_dir_fio' => 'ФИО руководителя',
                        'org_dir_dol' => 'Должность руководителя',
                        'address_ur' => 'Юридический адрес организации',
                        'address_fact' => 'Фактический, почтовый адрес',
                        'org_contacts' => 'Контактное лицо и другая информация',
                    ]);
                    Org::unguard();
                    $org->update([
                        'org_tel' => $request->org_tel,
                        'org_email' => $request->org_email,
                        'org_name' => $request->org_name,
                        'org_inn' => $request->org_inn,
                        'org_kpp' => $request->org_kpp,
                        'org_bik' => $request->org_bik,
                        'org_rschet' => $request->org_rschet,
                        'org_korschet' => $request->org_korschet,
                        'org_bank' => $request->org_bank,
                        'org_dir_fio' => $request->org_dir_fio,
                        'org_dir_dol' => $request->org_dir_dol,
                        'address_ur' => $request->address_ur,
                        'address_fact' => $request->address_fact,
                        'org_contacts' => $request->org_contacts,
                    ]);
                    Org::reguard();
                    Session::flash('success', 'Изменения внесены!');
                    return redirect()->route('admin_org', ['action' => $action, 'id' => $org->id]);

                }return view('admin.orgedit')->with(['org' => $org]);
                break;
            case "def":
                $data = Org::all();
                return view('admin.orglist')->withData($data);
                break;
        }
    }

}
