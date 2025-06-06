@extends('dashboard.layout.app')
@section('content')

<div class="container-fluid main-content px-2 px-lg-4">
        <div class="row my-2 g-3 g-lg-4">
          <div class="col-md-6 col-xl-4 col-xxl-3">
            <div class="price-box">
              <div class="d-flex align-items-center justify-content-between">
                <div>
                  <p class="text-white mb-0">Main Balance</p>
                  <h4 class="fw-semibold text-white my-2">${{ number_format($user->balance, 2) ?? '' }}</h4>
                </div>
                <img src="assets/img/crypto/bitcoin.png" alt="">
              </div>
              <div class="chart">
                <canvas id="chart_3"></canvas>
              </div>
            </div>
          </div>
          <div class="col-md-6 col-xl-4 col-xxl-3">
            <div class="price-box">
              <div class="d-flex align-items-center justify-content-between">
                <div>
                  <p class="text-white mb-0">Profit</p>
                  <h4 class="fw-semibold text-white my-2">${{ number_format($user->profit, 2) ?? '' }}</h4>
                </div>
                <img src="assets/img/crypto/etherium.png" alt="">
              </div>
              <div class="chart">
                <canvas id="chart_2"></canvas>
              </div>
            </div>
          </div>
          <div class="col-md-6 col-xl-4 col-xxl-3">
            <div class="price-box">
              <div class="d-flex align-items-center justify-content-between">
                <div>
                  <p class="text-white mb-0">CoinbasePRO</p>
                  <h4 class="fw-semibold text-white my-2">${{ number_format($user->coinbase, 2) ?? '' }}</h4>
                </div>
                <img src="{{ asset('assets/img/crypto/binance.png') }}" alt="">
              </div>
              <div class="chart">
                <canvas id="chart_5"></canvas>
              </div>
            </div>
          </div>
          <div class="col-md-6 col-xl-4 col-xxl-3">
            <div class="price-box">
              <div class="d-flex align-items-center justify-content-between">
                <div>
                  <p class="text-white mb-0">Traded ROI</p>
                  <h4 class="fw-semibold text-white my-2">${{ number_format($trades, 2) }}</h4>
                </div>
                <img src="assets/img/crypto/dogecoin.png" alt="">
              </div>
              <div  class="chart">
                <canvas id="chart_4"></canvas>
              </div>
            </div>
          </div>
          <div class="col-md-6 col-xl-4 col-xxl-3">
            <div class="price-box">
              <div class="d-flex align-items-center justify-content-between">
                <div>
                  <p class="text-white mb-0">Total Withdrawal</p>
                  <h4 class="fw-semibold text-white my-2">${{ number_format($withdrawal, 2) }}</h4>
                </div>
                <img src="assets/img/crypto/binance.png" alt="">
              </div>
              <div class="chart">
                <canvas id="chart_5"></canvas>
              </div>
            </div>
          </div>
            <div class="col-md-6 col-xl-4 col-xxl-3">
            <div class="price-box">
              <div class="d-flex align-items-center justify-content-between">
                <div>
                  <p class="text-white mb-0">Total Deposits</p>
                  <h4 class="fw-semibold text-white my-2">${{ number_format($deposit, 2) }}</h4>
                </div>
                <img src="assets/img/crypto/binance.png" alt="">
              </div>
              <div class="chart">
                <canvas id="chart_5"></canvas>
              </div>
            </div>
          </div>


        </div>

        <!-- Main Chart Area -->


        <!-- Tables -->
        <div class="row my-2 g-3 gx-lg-4 pb-3">
          <div class="col-xl-12 col-xxl-12">
            <div class="mainchart px-3 px-md-4 py-3 py-lg-4 ">
             <!-- TradingView Widget BEGIN -->
<div class="tradingview-widget-container">
  <div class="tradingview-widget-container__widget"></div>
  <div class="tradingview-widget-copyright"><a href="https://www.tradingview.com/" rel="noopener nofollow" target="_blank"><span class="blue-text">Track all markets on TradingView</span></a></div>
  <script type="text/javascript" src="https://s3.tradingview.com/external-embedding/embed-widget-crypto-coins-heatmap.js" async>
      {
      "dataSource": "Crypto",
      "blockSize": "24h_vol_cmc",
      "blockColor": "change",
      "locale": "en",
      "symbolUrl": "",
      "colorTheme": "dark",
      "hasTopBar": false,
      "isDataSetEnabled": false,
      "isZoomEnabled": true,
      "hasSymbolTooltip": true,
      "isMonoSize": false,
      "width": "100%",
      "height": 500
    }
      </script>
    </div>
<!-- TradingView Widget END -->
            </div>
          </div>
        </div>

        @include('dashboard.layout.footer')

     <div style="display: none" class="row my-2 g-3 gx-lg-4">
          <div class="col-xl-7 col-xxl-9">
            <div class="mainchart px-3 px-md-4 py-3 py-lg-4">
              <div class="d-flex w-100 flex-wrap justify-content-between pb-4 bottom-border">
                <h4 class="mb-0">Monthly Overall Growth</h4>
                <div class="d-flex align-items-center gap-3">
                  <button class="outline-btn">Week</button>
                  <button class="outline-btn">Month</button>
                  <button class="outline-btn">Year</button>
                </div>
              </div>
              <div class="chart-container">
                <canvas id="chart_1"></canvas>
              </div>
            </div>
          </div>
          <div class="col-xl-5 col-xxl-3">
            <div class="doughnut">
              <div id="donut_wrapper" class="position-relative">
                <div id="donutchart"></div>
              </div>
              <p class="large text-center mt-3">Total Balance</p>
              <h3 class="text-white text-center">0.3475948</h3>
              <p class="primary text-center">11,032.24 USD</p>
              <div class="d-flex justify-content-center">
                <button class="primary-btn">Withdraw</button>
              </div>
            </div>
          </div>
        </div>
</div>

@endsection
