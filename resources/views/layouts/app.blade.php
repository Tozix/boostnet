<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
   <script src="{{ asset('js/app.js')}}" defer></script>
   <script src="{{ asset('js/jquery.min.js') }}"></script>

    <!-- Fonts -->
    <!-- <link rel="dns-prefetch" href="https://fonts.gstatic.com">-->
    <!--  <link href="https://fonts.googleapis.com/css?family=Raleway:300,400,600" rel="stylesheet" type="text/css"> -->

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">


    @stack('styles')
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-dark bg-dark">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'BoostNet') }}
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">
      <li class="nav-item">
        <a class="nav-link {{ Request::is('/') ? 'active' : '' }}" href="{{ url('/') }}">Главная</a>
      </li>

      <li class="nav-item">
        <a class="nav-link {{ Request::is('contacts') ? 'active' : '' }}" href="{{ route('contacts') }}">Контакты</a>
      </li>
      <li class="nav-item">
        <a class="nav-link {{ Request::is('vpn') ? 'active' : '' }}" href="{{ route('vpn') }}">Услуги</a>
      </li>
      <li class="nav-item">
        <a class="nav-link {{ Request::is('tarifs') ? 'active' : '' }}" href="{{ route('tarifs') }}">Тарифы и стоимость</a>
      </li>
      <li class="nav-item">
        <a class="nav-link {{ Request::is('tarifs') ? 'active' : '' }}" href="{{ route('tarifs') }}">Тарифы и стоимость</a>
      </li>
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            <li><a class="nav-link" href="{{ route('login') }}"><i class="fa fa-user"></i> Личный кабинет</a></li>

                        @else
                        
                        
                        
                        
                        
                        
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    <i class="fa fa-user-tie"></i> {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        Выйти
                                    </a>
                <a class="dropdown-item" href="{{ route('home') }}">Личный кабинет</a> 
                                     @if(checkPermission(['admin']))
                          <a class="dropdown-item" href="{{ route('admin') }}">Админко</a>
                          <a class="dropdown-item" href="{{ route('home_org') }}">ЛК юр. лица</a>
                                    @endif


                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            @yield('content')
        </main>
    </div>
</body>
<!--<script type="text/javascript" src="https://vk.com/js/api/openapi.js?159"></script>

VK Widget 
<div id="vk_community_messages"></div>
<script type="text/javascript">
VK.Widgets.CommunityMessages("vk_community_messages", 173224258, {tooltipButtonText: "Есть вопрос?"});
</script>
-->


    @stack('scripts')
</html>
