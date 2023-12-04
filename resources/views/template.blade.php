<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vente</title>
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('lineawesome/css/line-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('datatable/datatables.min.css') }}">
    <link rel="stylesheet" href="{{ asset("css/style.css") }}">
    <style>
      
        .lds-dual-ring.hidden { 
            display: none;
        }
        .lds-dual-ring {
            display: inline-block;
            width: 80px;
            height: 80px;
        }
        .lds-dual-ring:after {
            content: " ";
            display: block;
            width: 64px;
            height: 64px;
            margin: 25% auto;
            border-radius: 50%;
            border: 6px solid #fff;
            border-color: #fff transparent #fff transparent;
            animation: lds-dual-ring 1.2s linear infinite;
        }
        @keyframes    lds-dual-ring {
            0% {
                transform: rotate(0deg);
            }
            100% {
                transform: rotate(360deg);
            }
        }
        .overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100vh;
            background: rgba(0,0,0,.8);
            z-index: 999;
            opacity: 1;
            transition: all 0.5s;
        }
      
    </style>
</head>

<body>
    <div class="sidebar-left bg-layout">
        @if (auth()->user()->is_admin === 1)
            @include("layout.admin")      
        @elseif (auth()->user()->is_admin === 2)
            @include("layout.commerce")          
        @else
            @include("layout.vente")
        @endif
    </div>
    <header class="main-header bg-layout">
        <a href="#" class="home-header"></a>
        <div class="datetime ">
            <div class="time">
                <span id="hour"></span>:<span id="minute"></span>:<span id="seconde"></span>
            </div>
            <div class="date">
                
            </div>
        </div>
        
        <div class="user-header">
            <div> 
                <button class="btn btn-primary"> 
                    <a href="{{ route('logout') }}" class="sidebar-link">
                            <i class="la la-sign-out fs-4 mb-1"></i>
                            <span>Se deconnecter</span>
                    </a>
                </button>
            </div>
        </div>
    </header>
    
    <main class="main-content">
        
        <div class="content">
            @yield('content')
        </div>
    </main>
    <div id="loader" class="lds-dual-ring hidden overlay"></div>
    <script src="{{ asset('js/jquery-3.6.0.min.js') }}"></script>
    <script src="{{ asset('js/popper.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('datatable/datatables.min.js') }}"></script>
    <script src="{{ asset('js/sweetalert2.min.js') }}"></script>
    <script src="{{ asset('js/date-euro.js') }}"></script>
    <script src="{{ asset('datatable/date_uk.js') }}"></script>
    <script src="{{ asset('js/main.js') }}"></script>
    @stack('js')
</body>

</html>