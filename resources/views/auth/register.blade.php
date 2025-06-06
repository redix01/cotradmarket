
<!DOCTYPE html>
<html lang="en">
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
                        <form action="{{ route('register') }}" method="POST">
                            @csrf

                            <h4 class="text-center text-white">Sign Up</h4>
                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                            <div>
                                <label class="fw-semibold mb-2 mt-3" for="password">Name</label>
                                <input type="text" name="name" id="password" placeholder="Full Name" class="form-control py-2" required>

                            </div>
                            <div>
                                <label class="fw-semibold mb-2 mt-3" for="password">E-mail</label>
                            <input type="email" name="email" id="password" placeholder="E-mail ........" class="form-control py-2" required>
                            </div>
                            <div>
                                <label class="fw-semibold mb-2 mt-3" for="password">Password</label>
                                <input type="password" name="password" id="password" placeholder="Password ........"
                                class="form-control py-2" required>
                            </div>
                            <div>
                                <label class="fw-semibold mb-2 mt-3" for="password">Password Confirmation</label>
                                <input type="password" name="password_confirmation" id="password" placeholder="Password Confirmation........"
                                class="form-control py-2" required>
                            </div>
                            <div class="m-3">
                                <img src="{{ captcha_src() }}" id="captcha_image" alt="captcha">
                                <input type="text" name="captcha" required placeholder="Enter CAPTCHA">
                                <button type="button" class="btn btn-link" onclick="refreshCaptcha()">Refresh</button>
    {{--                            <strong>Solve the captcha</strong>--}}
                            </div>

                            <script type="text/javascript">
                                function refreshCaptcha() {
                                    var captchaImage = document.getElementById('captcha_image');
                                    captchaImage.src = '{{ captcha_src() }}' + '?' + Math.random();
                                }
                            </script>

                            <div class="d-flex justify-content-center mt-4">
                                <button type="submit" class="primary-outline">Sign Up</button>
                            </div>
                            <p class="mt-3">Have an account already? <a class="text-primary" href="{{ route('login') }}">Sign In</a></p>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </section>
</body>


<!-- Mirrored from cryptdash.vercel.app/signin.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 25 Jul 2024 12:43:27 GMT -->
</html>
