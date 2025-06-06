@extends('dashboard.layout.app')
@section('content')
    <style>
        .payment-grid {
            display: grid;
            grid-template-columns: 1fr 2fr 3fr 2fr;
            grid-gap: 10px;
            width: 100%;
        }

        .payment-grid-header, .payment-grid-row {
            display: contents;
        }

        .payment-grid div {
            padding: 10px;
            border-bottom: 1px solid #ddd;
        }

        .payment-grid-header div {
            font-weight: bold;
        }

        .payment-grid-row div {
            padding: 10px;
        }

        .payment-grid-row:last-child div {
            border-bottom: none;
        }

    </style>

    <div class="container-fluid main-content px-2 px-lg-4">
        <div style="display: none" class="row my-2 g-3 g-lg-4">
          <div class="col-md-6 col-lg-12 col-xxl-12">
            <div class="wallet-balance">
              <div class="left-wrapper">
                <div class="left">
                  <div class="d-flex align-items-center gap-2 mb-4">
                    <img src="assets/img/crypto/bitcoin.png" alt="">
                    <span class="fw-bold">Account</span>
                  </div>
                  <span>Main Balance</span>
                  <h2 class="text-white mt-2">${{ number_format($user->balance, 2) }}</h2>
                    <span class="mt-2">Profit</span>
                  <span class="primary">${{ number_format($user->profit, 2) }}</span>
                  <div class="d-flex gap-3 pt-4">
                    <a href="{{ route('user.withdrawal') }}" class="primary-btn-lg">Withdraw</a>
                    <a href="{{ route('user.deposit') }}" class="outline-btn-lg">Deposit</a>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="row my-2 g-3 g-lg-4">
          <div class="col-md-6 col-lg-5 col-xxl-4">
            <div class="wallet-balance ">
              @forelse($wallets as $item)
                    <div id="accordion">
                        <div class="card my-2 bg-dark">
                            <div class="card-header">
                                <a class="card-link d-flex align-items-center text-black collapsed"
                                   data-toggle="collapse" href="#collapse-{{ $item->id }}"
                                   aria-expanded="false">
                                    <div class="mr-2">
                                        <img src="{{ asset($item->avatar ?? 'img/wallet.png') }}"
                                             style="width: 30px; border-radius: 50%">
                                    </div>
                                    <div style="margin-left: 10px" class="text-capitalize text-white "> {{ $item->wallet }}</div>
                                </a>
                            </div>
                            <div id="collapse-{{ $item->id }}" class="collapse" data-parent="#accordion">
                                <div class="card-body">
                                    <h5>Address</h5>
                                    <div class="form-group">
                                        <input type="text" class="form-control" id="wallet-{{ $item->id }}"
                                               value="{{ $item->address }}" readonly>
                                    </div>
                                    <button class="btn btn-primary btn-block mt-2"
                                            onclick="copyFunction('{{ $item->id }}')">Copy address
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Toast notification -->
                    <div id="toast-{{ $item->id }}"
                         style="display: none; position: absolute; top: 20px; right: 20px; background-color: #4CAF50; color: white; padding: 10px 20px; border-radius: 5px; margin: 10px">
                        Address copied to clipboard!
                    </div>
                @empty
                    <h5 class="m-2">No Deposit Wallet</h5>
                @endforelse
            </div>
          </div>
          <div class="col-md-6 col-lg-7 col-xxl-7">
            <div class="right">
              <div style="background-color: #171f2a" class="card my-2 ">
                    <div class="card-header">
                        <h4 class="mb-0 text-center">Submit Payment</h4>
                    </div>
                    <div class="card-body px-3 py-5">
                        <form action="{{ route('user.payment') }}" method="POST" enctype="multipart/form-data"
                              class="mx-auto" style="max-width: 360px">
                            @csrf

                            <p>To deposit, choose the payment method and make the payment to the displayed
                                address. After payment has been made, come back to fill this form.</p>

                            @if(session()->has('success'))
                                <div class="alert alert-success">
                                    {{ session()->get('success') }}
                                </div>
                            @endif
                            <div class="form-group mb-2">
                                <div class="col-md-12">
                                    <label class="fw-semibold mb-2 mt-3">Payment Method</label>
                                    <select class="form-control" name="payment_method_id">
                                       @foreach($wallets as $item)
                                            <option value="{{ $item->id }}">{{ $item->wallet }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group mb-2">
                                <label>Amount</label>
                                <input type="number" name="amount" class="form-control" required="">
                            </div>
                            <div>
                                <label>Payment Proof</label>
                                <input type="file" class="form-control" name="proof">
                            </div>
                            <button class="btn btn-success btn-block mt-3">Send</button>
                        </form>
                    </div>
                </div>
            </div>
          </div>
        </div>

        <div class="col-md-12 py-3">
            <div style="background-color: #171f2a" class="card my-2">
                <div class="card-header">
                    <h4 class="mb-0">Deposits History</h4>
                </div>
                <div class="card-body px-3 py-5">
                    <div class="payment-grid">
                        <div style="color: white" class="payment-grid-header">
                            <div>#</div>
                            <div>Amount</div>
                            <div>Payment Method</div>
                            <div>Status</div>
                        </div>

                        @foreach($deposits as $index => $item)
                            <div style="color: white" class="payment-grid-row">
                                <div>{{ $index+1 }}</div>
                                <div>${{ number_format($item->amount, 2) ?? '' }}</div>
                                <div>{{ optional($item->payment_method)->wallet ?? '' }}</div>
                                <div>
                                    @if($item->status == 0)
                                        <span class="badge bg-warning">Pending</span>
                                    @else
                                        <span class="badge bg-success">Successful</span>
                                    @endif
                                </div>
                            </div>
                        @endforeach
                    </div>


                </div>
            </div>
        </div>



      </div>


    <script>
        document.getElementById("customFile").addEventListener("change", function () {
            var fileName = this.files[0].name;

            var label = this.nextElementSibling;
            label.textContent = fileName;
        });
    </script>





    <!-- Script -->
<script>
    // Function to toggle the collapse
    document.addEventListener('DOMContentLoaded', function () {
        const accordions = document.querySelectorAll('.card-link');
        accordions.forEach(accordion => {
            accordion.addEventListener('click', function (e) {
                const targetId = this.getAttribute('href').replace('#', '');
                const target = document.getElementById(targetId);
                const isOpen = target.classList.contains('show');

                // Close all open collapses
                document.querySelectorAll('.collapse.show').forEach(collapse => {
                    collapse.classList.remove('show');
                });

                // Toggle the clicked collapse
                if (!isOpen) {
                    target.classList.add('show');
                } else {
                    target.classList.remove('show');
                }

                e.preventDefault();
            });
        });
    });

    // Function to copy wallet address to clipboard
    function copyFunction(walletId) {
        const walletInput = document.getElementById('wallet-' + walletId);
        walletInput.select();
        document.execCommand("copy");

        // Show the toast notification
        const toast = document.getElementById('toast-' + walletId);
        toast.style.display = 'block';

        // Hide the toast after 2 seconds
        setTimeout(function () {
            toast.style.display = 'none';
        }, 2000);
    }
</script>

@endsection
