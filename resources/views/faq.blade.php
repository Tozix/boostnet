@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">

                <div class="row">
                    <div class="col-md-5 mb-5">
                        <div class="card">
                                                    <div class="card-body">
<div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
  <a class="nav-link active" id="v-pills-home-tab" data-toggle="pill" href="#v-pills-home" role="tab" aria-controls="v-pills-home" aria-selected="true">Настройка подключения L2TP/ICPEC Windows 10</a>
  <a class="nav-link" id="v-pills-profile-tab" data-toggle="pill" href="#v-pills-profile" role="tab" aria-controls="v-pills-profile" aria-selected="false">L2TP/ICPEC</a>
  <a class="nav-link" id="v-pills-messages-tab" data-toggle="pill" href="#v-pills-messages" role="tab" aria-controls="v-pills-messages" aria-selected="false">Какая-то хрень</a>
  <a class="nav-link" id="v-pills-settings-tab" data-toggle="pill" href="#v-pills-settings" role="tab" aria-controls="v-pills-settings" aria-selected="false">Еще какая-то хрень</a>
</div>
                               
                            </div>
                        </div>
                    </div>
                    <div class="col-md-7 mb-5">
                        <div class="card h-100">
                            <div class="card-body">
<div class="tab-content" id="v-pills-tabContent">
  <div class="tab-pane fade show active" id="v-pills-home" role="tabpanel" aria-labelledby="v-pills-home-tab">
<h4>L2Tp/ICPEC инструкиция по настройке в Windows 10</h4>
  <hr>
  
  <div class="text-center">
  <p>- Сперва нажмите кнопку <b>«Пуск» (1)</b> и выберите <b>«Параметры» (2)</b>.</p>
  <img src="/img/faq/2-1.jpg" class="img-fluid rounded" alt="...">
</div>
    <hr>
<div class="text-center">
<p>- В открытом окне <b>«параметров»</b> кликните подраздел <b>«Сеть и Интернет»</b>.</p>
  <img src="/img/faq/3-1.jpg" class="img-fluid rounded" alt="...">
</div>
    <hr>
<div class="text-center">
<p>- В меню <b>«VPN» (1)</b> перейдите к пункту <b>«Добавление VPN-подключения» (2)</b>.</p>
  <img src="/img/faq/l2tp.1.png" class="img-fluid rounded" alt="...">
</div>
   <hr>
<div class="text-center">
 <p>- Далее настроим vpn windows 10 с протоколом L2TP/IPsec для подключения к нашему серверу:</p>
  <img src="/img/faq/l2tp.2.png" class="img-fluid rounded" alt="...">
 
</div>
 <p> Поставщик услуг VPN: <b>"Windows(встроенные)"</b>.</p>
 <p><b>(1)</b> Имя подключения: <b>"boostnet.ru"</b>.</p>
 <p><b>(2)</b> Имя или адрес сервера: <b>"boostnet.ru"</b>.</p>
 <p><b>(3)</b> Тип VPN: <b>"L2TP/IPsec с предварительным ключем"</b>.</p>
 <p><b>(4)</b> Общий ключ: <b>"boostnet"</b>.</p>

 <p><b>(5)</b> Тип данных для входа: <b>"Имя пользователя и пароль"</b>.</p>

  <div class="text-center">
  <img src="/img/faq/l2tp.3.png" class="img-fluid rounded" alt="...">
 </div>
  <p><b>(6)</b> Имя пользователя: <b>"Ваш VPN логин"</b>. <em>(Указывается при регистрации)</em></p>
 <p><b>(7)</b> Пароль: <b>"Ваш VPN пароль"</b>.<em>(Указывается при регистрации)</em></p>
 <p><b>(8)</b> После заполнения нужной информации кликните кнопку <b>«Сохранить».</b>.</p>
 <hr>
<div class="text-center">
 <p>Теперь выберите только что-то созданое подключение и нажимите <b>"Подключиться"</b>.</p>
   <img src="/img/faq/l2tp.4.png" class="img-fluid rounded" alt="...">
    <p>При успешном соединении вы увидите надпись <b>"Подключено"</b>.</p>
<img src="/img/faq/l2tp.5.png" class="img-fluid rounded" alt="...">
</div>
  </div>
  <div class="tab-pane fade" id="v-pills-profile" role="tabpanel" aria-labelledby="v-pills-profile-tab">L2Tp/ICPEC инструкиция по настройке</div>
  <div class="tab-pane fade" id="v-pills-messages" role="tabpanel" aria-labelledby="v-pills-messages-tab">Здесь был вася</div>
  <div class="tab-pane fade" id="v-pills-settings" role="tabpanel" aria-labelledby="v-pills-settings-tab">З_десь были Катя и Марина</div>
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

@endpush
@push('scripts')

@endpush
