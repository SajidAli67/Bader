@php
$settings = App\Models\Utility::settings();
$logo=asset('storage/uploads/logo/');
$company_logo=App\Models\Utility::get_company_logo();
$company_favicon = $settings['company_favicon'] ?? '';
@endphp
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon"
        href="{{ $logo . '/' . (isset($company_favicon) && !empty($company_favicon) ? $company_favicon : 'favicon.png') . '?' . time() }}"
        type="image">
    <title>Contract</title>
    <style>
        * {
            margin: 0px;
            padding: 0px;
        }

        .points {
            text-align: right;
            margin: 20px 50px;
            line-height: 1.7;
        }
        .footer{
            margin-top: 40px;
        }
        .footer img{
            width: 100%;
            height: 50px;
        }

        @page {
            size: A4;
            margin: 30px 20px;
        }

        @media print {
            .points {
                font-size:15px;
                text-align: right;
                margin: 0px 0px;
                line-height: 1.5;
            }
        }
    </style>
</head>

<body onload="window.print()">
    <table width="100%">
        <tr>
            <td width="35%" align="center">
                <h3> Bader Group <br> Lawyers &<br> Consultants</h3>

            </td>
            <td width="30%" align="center">
                <img src="{{ $logo .'/'. (isset($company_logo) && !empty($company_logo) ? $company_logo : 'logo-dark.png').'?'.time() }}" alt="" width="100">
            </td>
            <td dir="rtl" width="35%">
                <h3>شركة بدر بن فرج الزهراني للمحاماة والاستشارات القانونية </h3><br>
                <span>الرقم الضريبي: 312075757500003 </span><br>
                <span> ترخيص رقم : 421432 </span><br>
                <span>سجل تجاري: 4032274878 </span><br>

            </td>
        </tr>
    </table>
    <div>
        <table width="100%">
            <tr>
                <td style="text-align: center;">
                   ({{ $contract->contract_no }})
                </td>
                <td >
                    <div style="text-align: center; font-size: 24px;" width="50%">

                        <strong> بسم الله الرحمن الرحيم </strong><br>
                        <strong>عقد أتعاب محاماة</strong>
                    </div>
                </td>
                <td width="25%">

                </td>
            </tr>
        </table>

    </div>

    <div style="text-align: center; margin-top: 10px;">
        <p> الحمد لله والصلاة والسلام على نبينا محمد وعلى أله وصحبه اجمعين وبعد</p>
    </div>

    <div style="text-align: center; margin-top: 10px;">
      <p> : <span> الموافق</span> <span>{{ date('d-m-Y', strtotime($contract->created_at)) }} </span>  <span>  وتم الاتفاق بين كل من </span>   <span> {{ date('l', strtotime($contract->created_at)) }}  </span>  <span> فقد ابرم هذا العقد في يوم </span> </p>
         </div>
    <div style="text-align: right; margin-top: 20px;">
    <strong> الطرف الأول:</strong>  بدر فرج مفرح الزهراني سعودي الجنسية بموجب السجل المدني رقم: 1035209350وعنوانه الطائف
    </div>
   <div style="text-align: right; margin-top: 20px;">
   <strong>الطرف الثاني: </strong>{{  $client->name }} (سعودي الجنسية) بموجب الهوية رقم: ({{ $clientDetail->id_card}} ) رقم الجوال ({{ $clientDetail->mobile_number }}) وعنوانه(الطائف)<br> بصفته اصيلا عن نفسه ووكيلا عن باقي الورثة بموجب الوكالة رقم (462856497) وتاريخ{{ date('d-m-Y', strtotime($contract->created_at)) }}
   </div>

   <div style="text-align: center; margin-top: 20px;">
    ({{$clientDetail->mobile_number}}) : جوال رقم  
    </div>

    <div style="text-align: center; margin-top: 20px; font-size: 24px;">
        <strong>التمهيد</strong>
    </div>

    <div class="points">
        @foreach($points as $point)
        <p>{{ $point }}</p>
        @endforeach
     
    </div>
    <table width="100%" style="margin-top: 20px;" >
        <tr >
            <td align="right" width="33%">: توقيع الطرف الأول</td>
            <td align="right" width="33%">: الختم </td>
            <td align="right" width="33%">: توقيع الطرف الثاني </td>
        </tr>
    </table>

    <div class="footer">
        <img src="{{ asset('storage/uploads/footer/footer.png') }}" alt="">
    </div>
</body>

</html>