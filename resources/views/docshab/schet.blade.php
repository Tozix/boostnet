<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    
    <style type="text/css">
    body {font-family: dompdf_arial;}.
        * { 
            font-family: arial;
            font-size: 14px;
            line-height: 14px;
        }
        table {
            margin: 0 0 15px 0;
            width: 100%;
            border-collapse: collapse; 
            border-spacing: 0;
        }        
        table td {
            padding: 5px;
        }    
        table th {
            padding: 5px;
            font-weight: bold;
        }

        .header {
            margin: 0 0 0 0;
            padding: 0 0 15px 0;
            font-size: 12px;
            line-height: 12px;
            text-align: center;
        }
        
        /* Реквизиты банка */
        .details td {
            padding: 3px 2px;
            border: 1px solid #000000;
            font-size: 12px;
            line-height: 12px;
            vertical-align: top;
        }

        h1 {
            margin: 0 0 10px 0;
            padding: 10px 0 10px 0;
            border-bottom: 2px solid #000;
            font-weight: bold;
            font-size: 20px;
        }

        /* Поставщик/Покупатель */
        .contract th {
            padding: 3px 0;
            vertical-align: top;
            text-align: left;
            font-size: 13px;
            line-height: 15px;
        }    
        .contract td {
            padding: 3px 0;
        }        

        /* Наименование товара, работ, услуг */
        .list thead, .list tbody  {
            border: 2px solid #000;
        }
        .list thead th {
            padding: 4px 0;
            border: 1px solid #000;
            vertical-align: middle;
            text-align: center;
        }    
        .list tbody td {
            padding: 0 2px;
            border: 1px solid #000;
            vertical-align: middle;
            font-size: 11px;
            line-height: 13px;
        }    
        .list tfoot th {
            padding: 3px 2px;
            border: none;
            text-align: right;
        }    

        /* Сумма */
        .total {
            margin: 0 0 20px 0;
            padding: 0 0 10px 0;
            border-bottom: 2px solid #000;
        }    
        .total p {
            margin: 0;
            padding: 0;
        }
        
        /* Руководитель, бухгалтер */
        .sign {
            position: relative;
        }
        .sign table {
            width: 60%;
        }
        .sign th {
            padding: 40px 0 0 0;
            text-align: left;
        }
        .sign td {
            padding: 40px 0 0 0;
            border-bottom: 1px solid #000;
            text-align: right;
            font-size: 12px;
        }
        
        .sign-1 {
            position: absolute;
            left: 149px;
            top: 10px;
        }    
        .sign-2 {
            position: absolute;
            left: 149px;
            top: 0;
        }    
        .printing {
            position: absolute;
            left: 471px;
            top: -15px;
        }
        .mp {
            position: absolute;
            left: 491px;
            top: 40px;
        }
    </style>
</head>
<body>
    <p class="header">
        Внимание! Оплата данного счета означает согласие с условиями поставки товара.
        Уведомление об оплате обязательно, в противном случае не гарантируется наличие
        товара на складе. Товар отпускается по факту прихода денег на р/с Поставщика,
        самовывозом, при наличии доверенности и паспорта.
    </p>

    <table class="details">
        <tbody>
            <tr>
                <td colspan="2" style="border-bottom: none;">АО "ТИНЬКОФФ БАНК" </td>
                <td>БИК</td>
                <td style="border-bottom: none;">044525974</td>
            </tr>
            <tr>
                <td colspan="2" style="border-top: none; font-size: 10px;">Банк получателя</td>
                <td>Сч. №</td>
                <td style="border-top: none;">30101810145250000974</td>
            </tr>
            <tr>
                <td width="25%">ИНН 702401369550</td>
                <td width="30%">КПП </td>
                <td width="10%" rowspan="3">Сч. №</td>
                <td width="35%" rowspan="3">40802810200000050439</td>
            </tr>
            <tr>
                <td colspan="2" style="border-bottom: none;">ИП Емельянов Никита Владимирович</td>
            </tr>
            <tr>
                <td colspan="2" style="border-top: none; font-size: 10px;">Получатель</td>
            </tr>
        </tbody>
    </table>

    <h1>Счет на оплату № {{$number}} от {{$date}}.</h1>

    <table class="contract">
        <tbody>
            <tr>
                <td width="15%">Поставщик:</td>
                <th width="85%">
                    ИП Емельянов Никита Владимирович,  ИНН 702401369550,  636035,ОБЛ ТОМСКАЯ, Г. СЕВЕРСК, УЛ. ЛЕНИНА, д. 22, кв. 17,  тел.: +79528801390
                </th>
            </tr>
            <tr>
                <td>Покупатель:</td>
                <th>
                    {{$pokupatel}}
                </th>
            </tr>
        </tbody>
    </table>

    <table class="list">
        <thead>
            <tr>
                <th width="5%">№</th>
                <th width="54%">Наименование товара, работ, услуг</th>
                <th width="8%">Коли-<br>чество</th>
                <th width="5%">Ед.<br>изм.</th>
                <th width="14%">Цена</th>
                <th width="14%">Сумма</th>
            </tr>
        </thead>
        <tbody>
        
  @foreach ($prods as $prod)
                        <tr>
                <td align="center">{{ $loop->iteration }}</td>
                <td align="left">{{ $prod['name'] }}</td>
                <td align="right">{{ $prod['count']}}</td>
                <td align="left">{{ $prod['unit']}}</td>
                <td align="right">{{ $prod['price']}}</td>
                <td align="right">{{ $prod['count']*$prod['price']}}</td>
            </tr>
@endforeach


       
        </tbody>
        <tfoot>
            <tr>
                <th colspan="5">Итого:</th>
                <th>{{ $total_num }}</th>
            </tr>
            <tr>
                <th colspan="5">Без налога (НДС)</th>
                <th>-</th>
            </tr>
            <tr>
                <th colspan="5">Всего к оплате:</th>
                <th> {{ $total_num }} </th>
            </tr>
            
        </tfoot>
    </table>
    
        <div class="total">
        <p>Всего наименований {{ $count_prods }}, на сумму {{ $total_format }} руб.</p>
        <p><strong>{{ $total_text }}</strong></p>
    </div>
    
    <div class="sign">
        <img height="80" class="sign-1" src="{{ $img_path }}/sign.png">
        <img width="150" height="150" class="printing" src="{{ $img_path }}/pechat.png">
        <div class="mp">М.П.</div>

        <table>
            <tbody>
                <tr>
                    <th width="30%">Предприниматель</th>
                    <td width="70%">Емельянов Н.В.</td>
                </tr>
             
                
                                    
            </tbody>
        </table>

    </div>
</body>
</html>