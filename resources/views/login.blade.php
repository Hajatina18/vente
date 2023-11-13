<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vente</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="lineawesome/css/line-awesome.min.css">
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <header class="main-header">
        <a href="#" class="home-header"></a>
        <div class="datetime">
            <div class="time">
                <span id="hour"></span>:<span id="minute"></span>:<span id="seconde"></span>
            </div>
            <div class="date">

            </div>
        </div>
        <div class="user-header">

        </div>
    </header>
     
        {{-- <main class=" mb-5 mt-5">
            
            <div class="main-content-area login-content">
                form
            </div>
        
        </main> --}}

        <div class="container">
            <div class="row">
                <div class="col-md-10 mx-auto rounded shadow bg-white">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="m-5 text-center">
                                <h1>Bienvenue</h1>
                            </div>
                                <form action="{{ route('check_login') }}" method="post" class="mb-5">
                                    @csrf
                    
                                    @if(session('error'))
                                        <div class="alert alert-danger d-flex align-items-center alert-dismissible fade show" role="alert">
                                            <i class="las la-exclamation-triangle me-2"></i>
                                            <div>
                                                {{ session('error') }}
                                            </div>
                                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                        </div>
                                    @endif
                    
                                    <div class="form-group mb-3">                                  
                                        <label for="username" class="form-label">Nom d'utilisateur</label>
                                        <input type="text" class="form-control" id="username" name="username" required>
                                    </div>
                                    <div class="form-group mb-3">
                                        <label for="password" class="form-label">Mot de passe</label>
                                        <input type="password" class="form-control" id="password" name="password" required>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-6">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" id="remember-me">
                                                <label class="form-check-label" for="remember-me">Souviens de moi</label>
                                            </div>
                                        </div>
                                       
                                    </div>

                                    <button type="submit" class="btn btn-outline-primary ">
                                        Se connecter
                                    </button>
                                </form> 
                            
                        </div>
                        <div class="col-md-6">
                            <div>
                                <img src="./login_img.svg" alt="login" class="img-fluid p-5">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>





    

    <script src="js/jquery-3.6.0.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/main.js"></script>
    <script type="text/javascript">
        $(".form-group > .form-control").on('blur', function(){
            if($(this).val()){
                $(this).parents('.form-group').children('.form-label').addClass("active");
            }
        });
    </script>
</body>

</html>