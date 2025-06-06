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


        <div class="row my-2 g-3 g-lg-4">
          <div class="col-md-6 col-lg-12 col-xxl-12">
            <div class="right">

                <h3 class="text-center mt-3">Withdrawal</h3>
                <div style="background-color: #171f2a" class="card mb-3 mt-4">

                    <form action="{{ route('user.withdrawalStore') }}" method="POST"
                          class="card-body font-weight-bold">
                        @csrf
                        <div class="mx-auto" style="max-width: 400px">
                            <p>
                                To make a withdrawal, select payment method, amount and verify the address/bank you wish for
                                payment to
                                be made into.
                            </p>
                            @if(session()->has('success'))
                                <div class="alert alert-success">
                                    {{ session()->get('success') }}
                                </div>
                            @endif
                            <select id="withdrawalMethod" name="payment_method" class="form-control mb-3" onchange="toggleBeneficiaryFields()">
                                <option value="">Select Payment Method</option>
                                <option value="crypto">Crypto</option>
                                <option value="bank">Bank Transfer</option>
                                <option value="paypal">PayPal</option>
                            </select>

                            <div id="beneficiaryField6" style="display: none;">
                                <div class="form-group">
                                    <label>Wallet</label>
                                    <select name="wallet" id="" class="form-control">
                                        <option value="Bitcoin">Bitcoin</option>
                                        <option value="Ethereum">Ethereum</option>
                                        <option value="Solana">Solana</option>
                                        <option value="BNB">Binance Coin (BNB)</option>
                                    </select>
                                </div>
                                <div class="form-group mt-2" id="walletInfo">
                                    <label for="wallet">Your Address:</label>
                                    <input type="text" name="address" class="form-control" id="wallet">
                                </div>

                            </div>

                            <!-- Bank Transfer Fields -->
                            <div id="beneficiaryField1" style="display: none;">
                                <div class="form-group mt-2">
                                    <label>Bank Name:</label>
                                    <input type="text" name="bank_name" placeholder="Chase Bank" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label>Account Name:</label>
                                    <input type="text" name="acct_name" placeholder="John Doe" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label>Account Number:</label>
                                    <input type="number" name="acct_number" placeholder="29930192" class="form-control">
                                </div>
                                <div class="mb-3 rounded p-3 border">Your Account Manager may request further information.</div>
                            </div>
                            <!-- PayPal Field -->
                            <div id="beneficiaryField5" style="display: none;">
                                <div class="form-group mt-2" id="walletInfo">
                                    <label for="wallet">Paypal Email:</label>
                                    <input type="text" name="paypal" class="form-control" id="wallet">
                                </div>
                            </div>
                            <div class="form-group mt-2">
                                <label>Amount</label>
                                <input   type="number" step="0.000000000001" id="amount" name="amount" class="form-control">
                            </div>

                            <button class="btn btn-primary  btn-block mt-3" type="submit">Withdraw</button>
                        </div>
                    </form>

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

                        @foreach($withdrawal as $index => $item)
                            <div style="color: white" class="payment-grid-row">
                                <div>{{ $index+1 }}</div>
                                <div>${{ number_format($item->amount, 2) ?? '' }}</div>
                                <div>{{ $item->payment_method ?? '' }}</div>
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
        function toggleBeneficiaryFields() {
            const pairType = document.getElementById('withdrawalMethod').value;

            // All fields to hide/show
            const allFields = [
                'beneficiaryField1', // Bank Transfer Fields
                'beneficiaryField5', // PayPal Field
                'beneficiaryField6', // Crypto Field
            ];

            // Define the fields to show for each payment method
            const methodFields = {
                'bank': ['beneficiaryField1'],
                'paypal': ['beneficiaryField5'],
                'crypto': ['beneficiaryField6']
            };

            // Hide all fields
            allFields.forEach(function (fieldId) {
                document.getElementById(fieldId).style.display = 'none';
            });

            // Show the fields corresponding to the selected payment method
            if (methodFields[pairType]) {
                methodFields[pairType].forEach(function (fieldId) {
                    document.getElementById(fieldId).style.display = 'block';
                });
            }
        }
    </script>

@endsection
