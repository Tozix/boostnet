@extends('home.main')
@section('homecontent')
                                <h4>Инструкция для работы с OpenVPN</h4>
       <hr>
<p>Рады приветствовать Вас на нашем сайте! Настоящая инструкция призвана помочь Вам настроить VPN-подключение при помощи клиента OpenVPN для операционной системы Windows 7/10.<p>

<p>Для того, что бы настроить VPN-канал через OpenVPN для ОС Windows 7/10 Вам нужны:</p>


    <ol>
        <li>Операционная система Windows 7;</li>
        <li>Программа OpenVPN; <a href="https://swupdate.openvpn.org/community/releases/openvpn-install-2.4.6-I602.exe"><span class="badge badge-pill badge-primary">Скачать</span></a></li>
        <li>Ваш конфигурационный файл. <a href="/getconfig/{{ Auth::user()->name }}/"><span class="badge badge-pill badge-primary">Скачать</span></a></li>
    </ol>

<p>Итак, приступим к настройке VPN-подключения с помощью OpenVPN.</p>

<p>1. Первое, что Вам нужно сделать, это скачать на свой компьютер установщик программы OpenVPN (взять ее можно на официальном сайте). Скачиваем в любое удобное для вас место. Затем запускаем установщик. И в появившемся окне жмем "Запустить".</p>
<img src="/img/faq/win71.png" class="img-fluid rounded" alt="...">
<p>2. В самом начале установки нажимаем кнопку "Next" («Далее»)</p>
<img src="/img/faq/win73.png" class="img-fluid rounded" alt="...">
<p>3. Затем Вам будет предложено ознакомиться с лицензией на использование устанавливаемого программного обеспечения, после прочтения которого кликаете «I Agree» («Принимаю»)</p>
<img src="/img/faq/win72.png" class="img-fluid rounded" alt="...">
<p>4. В следующем окне перечислен набор компонентов, которые будут установлены на Ваш компьютер, здесь ничего не меняете и нажимаете снова «Next» («Далее»)</p>
<img src="/img/faq/win74.png" class="img-fluid rounded" alt="...">
<p>5. В этом окне вы можете выбрать путь, куда устанавливать программу, по умолчанию OpenVPN будет установлена в папку <b>C:\Program Files\OpenVPN</b>. Если Вас этот путь устраивает, нажимаете кнопку «Install» («Установить»)</p>
<img src="/img/faq/win75.png" class="img-fluid rounded" alt="...">
<p>6. Во время установки программы на экран будет выведено окно, где Вам нужно подтвердить установку драйвера, нажимаете «Установить»</p>
<img src="/img/faq/tap.png" class="img-fluid rounded" alt="...">
<p>7. Ждете окончания процесс установки программы и нажимаете в очередной раз кнопку «Next» («Далее»)</p>
<img src="/img/faq/win77.png" class="img-fluid rounded" alt="...">
<p>8. После того, как установка завершится, нажимаете кнопку «Finish» («Завершить»)</p>
<img src="/img/faq/win78.png" class="img-fluid rounded" alt="...">
<p>9. Теперь Вам нужно извлечь конфигурациионные файлы из ранее скаченого архива, если вы не скачали файл, то сделать это можно по ссылке <a href="/getconfig/{{ Auth::user()->name }}/"><span class="badge badge-pill badge-primary">Скачать</span></a>. (Название архива сопадает с вашим логином на нашем сайте)</p>
<img src="/img/faq/unzip.png" class="img-fluid rounded" alt="...">
<p>10. Перейдите в папку с извлечеными файла. Вы должны увидеть 3 файла<b>(ca, config, login)</b> как на скриншоте ниже.</p>
<img src="/img/faq/files.png" class="img-fluid rounded" alt="...">
<p>11. Теперь Вам нужно скопировать конфигурационный файлы, ранее извлеченные из архива, в папку по этому пути: <b>C:\Program Files\OpenVPN\config</b>, для этого заходите в указанную папку, вызываете контекстное меню и выбираете «Вставить»</p>
<img src="/img/faq/win79.png" class="img-fluid rounded" alt="...">
<p>12. После этого у вас на экране появится запрос о доступе, где Вы нажимаете «Продолжить»</p>
<img src="/img/faq/win710.png" class="img-fluid rounded" alt="...">
<p>13. Для того, что бы OpenVPN работал корректно, его нужно запускать с администраторскими правами. В операционной системе для этого Вы должны изменить свойства совместимости. Для этого заходите в меню «Пуск» и щелкаете по ярлыку OpenVPN-GUI(Внешний вид ярылка можеть отличаться от, того что на скриншоте) правой кнопкой мыши и выбираете пункт «Свойства»</p>
<img src="/img/faq/win711.png" class="img-fluid rounded" alt="...">
<p>14. Переходите во вкладку «Совместимость» и выставляете «Галочку» напротив пункта «Выполнять эту программу от имени администратора», затем нажимаете «ОК»</p>
<img src="/img/faq/win714.png" class="img-fluid rounded" alt="...">
<p>15. Запускаете OpenVPN-GUI из меню «Пуск»</p>
<img src="/img/faq/win715.png" class="img-fluid rounded" alt="...">
<p>16.  Открываете меню программы в трее (справа в углу) и выбираете пункт «Connect/Подключить» («Подключить»)</p>
<img src="/img/faq/tray.png" class="img-fluid rounded" alt="...">
<p>17.  После этого у Вас на экране должно запуститься окно с содержимым лога подключения</p>
<img src="/img/faq/connect.png" class="img-fluid rounded" alt="...">
<p class="mb-0">18.  Если Вы все сделали верно, в трее появится подсказка о подключении VPN</p>


<hr>

<legend>Клиент OpenVPN</legend>
<a href="https://swupdate.openvpn.org/community/releases/openvpn-install-2.4.6-I602.exe"><button type="button" class="btn btn-primary">Скачать</button></a>

<legend>Файл конфигурации</legend>
<a href="/getconfig/{{ Auth::user()->name }}/"><button type="button" class="btn btn-primary">Скачать</button></a>





@endsection
