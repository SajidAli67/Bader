
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Bader! Advocate</title>
    <link rel="shortcut icon" href="{{ asset('landing/images/fav.png') }}" type="image/x-icon">
    <link href="https://fonts.googleapis.com/css2?family=Work+Sans:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="shortcut icon" href="{{ asset('landing/images/fav-icon.png') }}">
    <link rel="stylesheet" href="{{ asset('landing/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('landing/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('landing/css/style.css') }}" />
    <link rel="stylesheet" href="{{ asset('landing/css/responsive.css') }}" />
    <link rel="stylesheet" href="{{ asset('landing/css/animate.css') }}">
    <link rel="stylesheet" href="{{ asset('landing/lib/aos/aos.css') }}">
    @if($currantLang=='ar')
        <style>
            ._main_nav{
                direction: rtl;
            }
            .slider .carousel-item ._nb_mc h2{
                text-align: right;
            }
            .slider .carousel-item ._nb_mc p{
                text-align: right;
            }
            ._po_jy_fr {
                direction: rtl;
            }
        </style>
    @endif
</head>
