<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Foreverfit | Fat Calculator</title>

    <!-- BOOTSTRAP CORE STYLE  -->
    <link href="/css/bootstrap.css" rel="stylesheet" type="text/css" media="all" />
    <!-- FONT AWESOME STYLE  -->
    <link href="/css/font-awesome.css" rel="stylesheet" type="text/css" media="all" />
    <!-- DATATABLE STYLE  -->
    <link href="/js/dataTables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" media="all" />
    <!-- CUSTOM STYLE  -->
    <link href="/css/style.css" rel="stylesheet" type="text/css" media="all" />
    <!-- GOOGLE FONT -->
    <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type="text/css" media="all" />
    <!-- DATE STYLE  -->
    <link href="/js/date/styles.css" type="text/css" rel="stylesheet">
    
     <!-- push target to head -->
    @stack('styles')
</head>
<body>
    <div id="app">
        <div id="formWrapper">  
        @guest
        @else
        <div class="navbar navbar-inverse set-radius-zero" >
            <div cl ass="container">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="{{ url('/') }}" >
                        <img style="margin-top: -5%;" src="/img/logo.png" />
                    </a>
                </div>
                <div class="right-div" style="margin-right: 0.5%;width: 24%;">
                    <span style="font-weight: bold; text-transform: capitalize;font-size: 1.5em;">{{ Auth::user()->first_name }} {{ Auth::user()->last_name }}</span>
                    
                    <input type="submit" onclick="event.preventDefault();document.getElementById('logout-form').submit();"
                        class="login pull-right" value="Salir">

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        {{ csrf_field() }}
                    </form>
                </div>
            </div>
        </div>
            
        <!-- LOGO HEADER END-->
        @if (Auth::user()->type == 'USER')
            <section id="menu-top" class="menu-section">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="navbar-collapse collapse ">
                                <ul class="nav navbar-nav navbar-right">
                                    <li>
                                        <a href="{{ route('home') }}" >Fat Calculator</a>
                                    </li>
                                    <li>
                                        <a href="{{ route('photo') }}" >Sube Tu Foto</a>
                                    </li>
                                    <li>
                                        <a href="{{ route('questionnaire.index') }}" class="menu-top-active">Knowing You</a>
                                        
                                        @if (Auth::user()->register === 'FALSE')
                                            <div class="dialog" style="display:none;">
                                                <div class="title">¡No olvides completar nuestro cuestionario para comenzar el programa!</div>
                                            </div>
                                        @endif
                                    </li>
                                </ul>
                            </div>
                        </div>
        
                    </div>
                </div>
            </section>
        @endif
        <!-- MENU SECTION END-->
        @endguest

        @yield('content')
        </div>
    </div>

    <!-- Scripts -->
    <script src="/js/app.js"></script>
    <!-- CORE JQUERY  -->
    <script src="/js/jquery-1.10.2.js"></script>
    <!-- BOOTSTRAP SCRIPTS  -->
    <script src="/js/bootstrap.js"></script>
    <!-- DATATABLE SCRIPTS  -->
    <script src="/js/dataTables/jquery.dataTables.js"></script>
    <script src="/js/dataTables/dataTables.bootstrap.js"></script>
    <!-- CUSTOM SCRIPTS  -->
    <script src="/js/custom.js"></script>
    <!-- DATE SCRIPTS  -->   
    <script src="/js/date/datepicker.js"></script>
        
    <script>
        $(document).ready(function() {
            /*var input = document.querySelector('input[name="birthdate"]');
            if (input!==null && input.length !== 0) {
                input.addEventListener('input', () => {
                  console.log('input', input.value);
                });
                
                var picker = datepicker(input);
            }*/
            
            var input2 = document.querySelector('input[name="dateSearch"]');
            if (input2!==null && input2.length !== 0) {
                input2.addEventListener('input', () => {
                  document.formSearch.submit();
                });
                
                var picker2 = datepicker(input2);
            } 
        })
    </script>
        
    <!-- push target to footer -->
    @stack('scripts')
</body>
</html>
