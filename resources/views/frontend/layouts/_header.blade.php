<div class="maan-mid-bar">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-sm-8">
                <div class="maan-header-adds">
                    
                    @if (advertisement())
                        {!! advertisement()->header_ads !!}
                    @else
                        <a href="  https://www.google.com/ " target="_blank">
                            <img src=" {{ asset('public/frontend/img/header-adds/adds.jpg') }} " alt="{{ asset('public/frontend/img/header-adds/adds.jpg') }}">
                        </a>
                    @endif


                </div>
            </div>
           @if(1==2)
            <div class="col-sm-3 col-lg-2">

                <?php
                $curl = curl_init();
                curl_setopt_array($curl, [
                    CURLOPT_URL => "https://www.goldapi.io/api/XAU/USD",
                    CURLOPT_RETURNTRANSFER => true,
                    CURLOPT_FOLLOWLOCATION => true,
                    CURLOPT_ENCODING => "",
                    CURLOPT_MAXREDIRS => 10,
                    CURLOPT_TIMEOUT => 30,
                    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                    CURLOPT_CUSTOMREQUEST => "GET",
                    CURLOPT_HTTPHEADER => [
                        "x-access-token: goldapi-34nkqrlh1bvc39-io",
                    ],
                ]);
                $response = curl_exec($curl);
                $err = curl_error($curl);
                curl_close($curl);
                if ($err) {
                    echo "cURL Error #:" . $err;
                } else {
                    $data = json_decode($response);
                        $gold_price = $data->price; 
                        ?>

                <div class="tv-embed-widget-wrapper__body js-embed-widget-body">
                    <div class="tv-single-ticker-widget">
                        <div class="tv-ticker-item-last__header">
                            <div class="js-header-icon">
                                <img class="tv-circle-logo tv-circle-logo--xsmall tv-ticker-item-last__icon" src="https://s3-symbol-logo.tradingview.com/metal/gold.svg" alt="">
                            </div>
                            <div>
                                <div class="tv-ticker-item-last__short-name">
                                    <span class="js-symbol-short-name">XAUUSD</span>
                                    <span class="tv-ticker-item-last__session-status">

                                    </span>
                                </div>
                                <div class="tv-ticker-item-last__title js-symbol-description-name" dir="ltr" title="Gold Spot / U.S. Dollar">Gold Spot / U.S. Dollar</div>
                            </div>
                        </div>
                        <div class="tv-ticker-item-last__body">
                            <span class="tv-ticker-item-last__last js-symbol-last apply-overflow-tooltip">
                                <?php  echo $gold_price." ". $data->currency; ?> </span>
                            <span style="    font-size: 14px;  margin-left: 7px;   color: green;"> <i class="fa fa-angle-up"></i> <?php  echo $data->chp. "%" . "(". $data->ch. ")"; }?>  </span>
                        </div>

	            </div>
</div>


            </div>

            <div class="col-md-2">
                <div class="row">
            <?php $curl = curl_init();
                curl_setopt_array($curl, [
                    CURLOPT_URL => "https://apidojo-yahoo-finance-v1.p.rapidapi.com/market/v2/get-quotes?symbols=%5EBSESN",
                    CURLOPT_RETURNTRANSFER => true,
                    CURLOPT_FOLLOWLOCATION => true,
                    CURLOPT_ENCODING => "",
                    CURLOPT_MAXREDIRS => 10,
                    CURLOPT_TIMEOUT => 30,
                    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                    CURLOPT_CUSTOMREQUEST => "GET",
                    CURLOPT_HTTPHEADER => [
                        "x-rapidapi-key: 8fe159f834msh38c85cf0cd1fec6p1bf688jsnc86788ec2601",
                        "x-rapidapi-host: apidojo-yahoo-finance-v1.p.rapidapi.com",
                    ],
                ]);
                $response = curl_exec($curl);
                $err = curl_error($curl);
                curl_close($curl);
                if ($err) {
                    echo "cURL Error #:" . $err;
                } else {
                    $data = json_decode($response);
                
                    $sensex_value = $data->quoteResponse->result[0]->regularMarketPrice;
                    echo 'BSE Sensex Value: ' . $sensex_value  ;
                    // " - ". $data->quoteResponse->result[0]->regularMarketChange. " - ".$data->quoteResponse->result[0]->regularMarketChangePercent
                } ?>
                </div>
                <div class="row">
<?php
                $curl = curl_init();
                curl_setopt_array($curl, [
                    CURLOPT_URL => "https://www.goldapi.io/api/XAG/USD",
                    CURLOPT_RETURNTRANSFER => true,
                    CURLOPT_FOLLOWLOCATION => true,
                    CURLOPT_ENCODING => "",
                    CURLOPT_MAXREDIRS => 10,
                    CURLOPT_TIMEOUT => 30,
                    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                    CURLOPT_CUSTOMREQUEST => "GET",
                    CURLOPT_HTTPHEADER => [
                        "x-access-token: goldapi-34nkqrlh1bvc39-io",
                    ],
                ]);
                $response = curl_exec($curl);
                $err = curl_error($curl);
                curl_close($curl);
                if ($err) {
                    echo "cURL Error #:" . $err;
                } else {
                    $data = json_decode($response);

                        $gold_price = $data->price;
                        echo 'Silver Price: ' . $gold_price." ". $data->currency;

                } ?>
                </div>
            </div>
          @endif
        </div>
    </div>
</div>
