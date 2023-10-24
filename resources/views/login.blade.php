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
    <main class="main-content mb-5 mt-5">
        <div class="login-content">
            <form action="{{ route('check_login') }}" method="post">
                <h5 class="text-center">Authentification</h5>
                @csrf
                {{-- @error('')
                
                @enderror --}}
                    
                
                @if(session('error'))
                    <div class="alert alert-danger d-flex align-items-center alert-dismissible fade show" role="alert">
                        <i class="las la-exclamation-triangle me-2"></i>
                        <div>
                            {{ session('error') }}
                        </div>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                <div class="form-group my-4">
                    <input type="text" class="form-control mb-3" id="username" name="username" @error('username') is-invalid @enderror required autofocus>
                    <label for="username" class="form-label">Nom d'utilisateur</label>
                </div>
                <div class="form-group my-4">
                    <input type="password" class="form-control mb-3" id="password" name="password" @error('password') is-invalid @enderror required>
                    <label for="password" class="form-label">Mot de passe</label>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group form-check form-switch my-2">
                            <input type="checkbox" class="form-check-input" id="remember" name="remember" role="switch">
                            <label for="remember" class="form-check-input">Souvien de moi</label>
                        </div>
                    </div>
                    <div class="col-md-6 text-end">
                        <a href="#" >Mot de passe oublier?</a>
                    </div>
                </div>
                <div class="d-grid gap-2">                
                    <button type="submit" class="btn btn-outline-primary my-2">
                        Se connecter
                    </button>
                </div>
            </form>
        </div>
    </main>

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