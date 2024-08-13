<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('login.css') }}">
</head>

<body>
    <div class="overlay">
        <!-- LOGN IN FORM by Omar Dsoky -->
        <form method="POST" action="{{ route('login') }}">
            @csrf
            <!--   con = Container  for items in the form-->
            <div class="con">
                <!--     Start  header Content  -->
                <header class="head-form">

                    <img src="{{ asset('logos/main.jpg') }}" alt="placeholder image" width="50%" class="img-fluid"
                        style="border-radius: 100px">

                    <img src="" alt="">

                    <h2>Inicio de Sesion</h2>
                    <!--     A welcome message or an explanation of the login form -->
                    <p>Bienvenido esperamos que estes bien y que tengas un buen dia</p>
                </header>
                <!--     End  header Content  -->
                <br>
                <div class="field-set">

                    <!--   user name -->
                    <span class="input-item">
                        <i class="fa fa-user-circle"></i>
                    </span>
                    <!--   user name Input-->
                    <input class="form-input" id="txt-input" type="text" placeholder="@email"
                        value="{{ old('email') }}" required autofocus="on" name="email"> <br>
                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                    <br>

                    <!--   Password -->

                    <span class="input-item">
                        <i class="fa fa-key"></i>
                    </span>
                    <!--   Password Input-->
                    <input class="form-input" type="password" placeholder="Password" id="pwd" name="password"
                        required>
                    @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                    <!--      Show/hide password  -->
                    <span>
                        <i class="fa fa-eye" aria-hidden="true" type="button" id="eye"></i>
                    </span>


                    <br>
                    <!--        buttons -->
                    <!--      button LogIn -->
                    <button class="log-in" type="submit"> Log In </button>
                </div>



                <!--   End Conrainer  -->
            </div>

            <!-- End Form -->
        </form>
    </div>
</body>
<!-- Change code above this line -->

</html>
