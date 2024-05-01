<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <meta name="description" content="Hallo, ik ben Piet Korfmaker. Een web developer bij Postis IT Group. Ik houd mij bezig met het schrijven van code die zowel in de back- als de frontend draait.">
        <meta name="keywords"
            content="Piet, Jouke, Korfmaker, Piet Korfmaker, Piet Jouke Korfmaker, pietonline.com, Laravel, Vue, programmeren, Bootstrap, projecten, applicatie ontwikkeling, ervaring, portfolio, laravel programmeur, programmeur nederland, programmeur, portfolio Piet, portfolio Piet Korfmaker, Applicatie ontwikkelaar, friesepoort, friese poort, bulma, Roc Friesepoort, rocfriese poort, Js, pietkorfmaker, postis, postis it, b&t, bnt, b&t onderwijs, bnt onderwijs">


        <meta property="og:url" content="https://pietonline.com/">
        <meta property="og:image" content="https://pietonline.com/storage/images/0A71Gt8u09NqksEca8IXUWseuKAkYCuQW99H6H12.jpg">
        <meta property="og:description"
            content="Hallo, ik ben Piet Korfmaker. Een web developer bij Postis IT Group. Ik houd mij bezig met het schrijven van code die zowel in de back- als de frontend draait.">
        <meta property="og:title" content="Piet Korfmaker | pietonline.com">
        <meta property="og:site_name" content="Piet Korfmaker | pietonline.com">
        <meta property="og:see_also" content="https://pietonline.com/">
        <meta property="og:type" content="website">


        <meta name="twitter:card" content="summary_large_image">
        <meta name="twitter:site" content="@PietKorfmaker">
        <meta name="twitter:url" content="https://pietonline.com">
        <meta name="twitter:title" content="Piet Korfmaker | pietonline.com">
        <meta name="twitter:description"
            content="Hallo, ik ben Piet Korfmaker. Een web developer bij Postis IT Group. Ik houd mij bezig met het schrijven van code die zowel in de back- als de frontend draait.">
        <meta name="twitter:image" content="https://pietonline.com/storage/images/0A71Gt8u09NqksEca8IXUWseuKAkYCuQW99H6H12.jpg">

        <meta name="HandheldFriendly" content="True">
        <meta name="MobileOptimized" content="340">

        <title>{{ config('app.name', 'Pietonline.com') }}</title>

        <!-- Font Awesome -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen bg-gray-100">
            <main class="min-h-screen">
                @yield('content')
            </main>
        </div>
        @stack('scripts')
    </body>
</html>
