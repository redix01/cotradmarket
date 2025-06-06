<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="shortcut icon" href="assets/img/favicon.ico" type="image/x-icon">
  <link rel="stylesheet" href="{{ asset('assets/css/bootstrap_custom.css') }}">
  <link rel="stylesheet"
    href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200">
  <link rel="stylesheet" href="{{ asset('assets/css/nice-select.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/css/styles.css') }}">
  <title>{{ env('APP_NAME') }}</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.0/css/all.min.css" integrity="sha512-BnbUDfEUfV0Slx6TunuB042k9tuKe3xrD6q4mg5Ed72LTgzDIcLPxg6yI2gcMFRyomt+yJJxE+zJwNmxki6/RA==" crossorigin="anonymous" referrerpolicy="no-referrer" />

<style>
        .form-control {
            display: block;
            width: 100%;
            padding: 0.375rem 0.75rem;
            font-size: 1rem;
            font-weight: 400;
            line-height: 1.5;
            color: #fdfeff;
            background-color: #171f2a;
            background-clip: padding-box;
            border: 1px solid #5b5b5b;
            -webkit-appearance: none;
            -moz-appearance: none;
            appearance: none;
            border-radius: 0.375rem;
            transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
        }
        .form-control:focus {
        background-color: black;
        color: white;
        border-color: #ffffff; /* Optional: to change the border color when focused */
        outline: none; /* Optional: to remove the default focus outline */
    }

    </style>
</head>

<body>
  <div class="d-flex wrapper" id="wrapper">
    <!-- Sidebar -->
    <div id="sidebar-wrapper" class="sidebar-wrapper">
      <div class="sidebar-heading">
        <a href="{{ route('index') }}">
            <h3>{{ env('APP_NAME') }}</h3>
{{--          <img id="logo" src="assets/img/logo.png" alt="">--}}
        </a>
      </div>
      <nav class="sidebar mb-4">
        <ul class="nav flex-column" id="nav_accordion">
          <li class="nav-item">
            <a class="nav-link active d-flex gap-2 align-items-center" href="{{ route('user.dashboard') }}">
              <img src="{{ asset('assets/img/dashboard_icon.png') }}" alt="">
              <span class="fw-semibold">Dashboard</span>
            </a>
          </li>
            <li class="nav-item">
            <a class="nav-link d-flex gap-2 align-items-center" href="{{ route('user.deposit') }}">
              <span class="material-symbols-outlined fw-lighter">
                account_balance_wallet
              </span>
              <span class="fw-semibold">Deposit</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link d-flex gap-2 align-items-center" href="{{ route('user.withdrawal') }}">
              <span class="fa fa-arrow-up">

              </span>
              <span class="fw-semibold">Withdraw</span>
            </a>
          </li>
            <li class="nav-item">
            <a class="nav-link d-flex gap-2 align-items-center" href="{{ route('user.tradeRoom') }}">
              <span class="material-symbols-outlined fw-lighter">
                insights
              </span>
              <span class="fw-semibold">Trade Room</span>
            </a>
          </li>
            <li class="nav-item">
            <a class="nav-link d-flex gap-2 align-items-center" href="{{ route('user.sub.plans') }}">
              <span class="material-symbols-outlined fw-lighter">
                percent
              </span>
              <span class="fw-semibold">Subscription</span>
            </a>
          </li>
            <li class="nav-item">
            <a class="nav-link d-flex gap-2 align-items-center" href="{{ route('user.expert-trader.index') }}">
              <span class="fa fa-users">
              </span>
              <span class="fw-semibold">Expert Trader</span>
            </a>
          </li>

          <li class="nav-item">
            <a class="nav-link d-flex gap-2 align-items-center" href="{{ route('user.profile') }}">
              <span class="material-symbols-outlined fw-lighter">
                settings
              </span>
              <span class="fw-semibold">Settings</span>
            </a>
          </li>

        </ul>

      </nav>
    </div>


    <!-- Page Content -->
    <div id="page-content-wrapper" class="page-content-wrapper">
      <nav class="navbar navbar-expand-lg py-lg-3 px-2 px-lg-4 d-flex fixed-top justify-content-between">
        <div class="d-flex align-items-center">
          <div class="d-flex align-items-center d-lg-none">
            <span class="material-symbols-outlined menu-toggle" id="menu-toggle">
              menu
            </span>
          </div>

        </div>

        <div class="d-flex gap-3 p-lg-2 p-lg-0 align-items-center justify-content-end">


          <div class="nav-item dropdown">
            <a class="d-flex gap-2 align-items-center" href="#" id="navbarDropdown4" role="button"
              data-bs-toggle="dropdown" aria-expanded="false">
              <img style="border-radius: 50%" height="50" width="50" class="img-fluid" src="{{ asset('img/trader.jpg') }}" alt="user">
              <div class="d-flex flex-column d-none d-xl-block">
                <p class="mb-0 text-white fw-semibold">{{ auth()->user()->name }}</p>
              </div>
            </a>
            <ul class="dropdown-menu dropdown-menu-end user shadow border-0" aria-labelledby="navbarDropdown4"
              onclick="event.stopPropagation()">
              <li>
                <a class="dropdown-item d-flex align-items-center gap-2" href="#">
                  <span class="material-symbols-outlined fw-light">
                    account_circle
                  </span>
                  Profile</a>
              </li>
              <li>
                <a class="dropdown-item d-flex align-items-center gap-2" href="settings.html">
                  <span class="material-symbols-outlined fw-light"> settings </span>
                  Settings</a>
              </li>
              <li>
                  <form method="POST" action="{{ route('logout') }}">
                    @csrf

                    <x-dropdown-link class="dropdown-item d-flex align-items-center gap-1" :href="route('logout')"
                            onclick="event.preventDefault();
                                        this.closest('form').submit();">
                        <span class="material-symbols-outlined fw-light"> logout </span>
                  Log Out
                    </x-dropdown-link>
                </form>
              </li>
            </ul>
          </div>
        </div>
        <!-- For pc -->
      </nav>
        @include('dashboard.layout.alert')
      @yield('content')
    </div>

    <!-- /#page-content-wrapper -->
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
  <script src="{{ asset('assets/js/jquery.nice-select.js') }}"></script>
  <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
  <script src="{{ asset('assets/js/main.js') }}"></script>
  <script src="{{ asset('assets/js/chart.js') }}"></script>
</body>


<!-- Mirrored from cryptdash.vercel.app/ by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 25 Jul 2024 12:42:43 GMT -->
</html>
