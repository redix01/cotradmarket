
<!DOCTYPE html>
<html lang="en">


<!-- Mirrored from cryptdash.vercel.app/signin.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 25 Jul 2024 12:43:25 GMT -->
<!-- Added by HTTrack --><meta http-equiv="content-type" content="text/html;charset=utf-8" /><!-- /Added by HTTrack -->
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="assets/img/favicon.ico" type="image/x-icon">
    <title>{{ env('APP_NAME') }}</title>
    <link href="https://cdn.jsdelivr.net/npm/remixicon@2.5.0/fonts/remixicon.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/bootstrap_custom.css">
    <link rel="stylesheet" href="assets/css/styles.css">
</head>

<body>
    <section class="signin">
        <div class="signin-inner">
            <h3 class="text-center my-3">{{ env('APP_NAME') }}</h3>
            <div class="row d-flex align-items-center g-3">
                <div class="col-md-6 offset-md-3">
                    <div class="form-wrapper">
                        <form action="{{ route('login') }}" method="POST">
                            @csrf

                            <h4 class="text-center text-white">Sign In</h4>
                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                            <label class="fw-semibold mb-2 mt-3" for="password">E-mail</label>
                            <input type="email" name="email" id="password" placeholder="E-mail ........" class="form-control py-2" required>

                            <label class="fw-semibold mb-2 mt-3" for="password">Password</label>
                            <input type="password" name="password" id="password" placeholder="Password ........"
                                class="form-control py-2" required>

                            <div class="mt-2 d-flex justify-content-between flex-wrap gap-2">
                                <div class="text-right">
                                @if (Route::has('password.request'))
                                    <a class="text-primary" href="{{ route('password.request') }}">
                                        {{ __('Forgot password?') }}
                                    </a>
                                @endif

                            </div>

                            <!-- Honeypot: invisible to humans, bots will fill it -->
                            <div style="position:absolute;left:-9999px;top:-9999px;height:0;width:0;overflow:hidden;" aria-hidden="true">
                                <label for="website">Website</label>
                                <input type="text" name="website" id="website" tabindex="-1" autocomplete="off">
                            </div>

                            </div>
                            <div class="d-flex justify-content-center mt-4">
                                <button type="submit" class="primary-outline">Sign In</button>
                            </div>
                            <p class="mt-3">Don't have an account yet? <a class="text-primary" href="{{ route('register') }}">Sign Up</a></p>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </section>
</body>


<!-- Mirrored from cryptdash.vercel.app/signin.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 25 Jul 2024 12:43:27 GMT -->
</html>
