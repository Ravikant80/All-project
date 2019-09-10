<?php
use Carbon\Carbon;

function getAdminAccBalance(){
    
 $admindata = \App\Admin::first();
 return $admindata;
}

function formatDate($postDate) {

        $now = Carbon::now()->toDateTimeString();

        $diff = date_diff(date_create($now), date_create($postDate));

        $day = $diff->format("%d");

        $hour = $diff->format("%h");

        $minutes = $diff->format("%i");

        $seconds = $diff->format("%s");

        $year = $diff->format("%Y");

        if ($day < 1) {

            if ($hour < 1) {
                return $diff->format('%i Minutes ago');
            } else {
                return $diff->format('%h Hours ago');
            }
        } else {


            $dateTime = explode(" ", $postDate);
            $data = explode("-", $dateTime[0]);

            $Y = $data[0];
            $m = $data[1];
            $d = $data[2];

            $data2 = explode(":", $dateTime[1]);
            $H = $data2[0];
            $i = $data2[1];
            $s = $data2[2];


            return date("D, d M Y", mktime($H, $i, 0, $m, $d, $Y)); //$diff->format('%d Day, %h Hours %i Minutes');
        }
    }
    
    function btcBuyValue(){        
        $basic_setting = App\BasicSetting::first();
        $cfavalues= \App\UsdToCfas::orderBy('updated_at','DESC')->first();
        
        $url='https://bitpay.com/api/rates';
        $json=json_decode( file_get_contents( $url ) );
        $dollar=$btc=0;

        foreach( $json as $obj ){
        if( $obj->code=='USD' )$btc=$obj->rate;
        }
        $dollar=1 / $btc;
        /*
        echo "usd to btc".$dollar;
        echo "<br/>";
        echo "btc to usd".$btc;
        echo "<br/>";
        echo "cfa to btc".$dollar/$cfavalues->cfa_value;
        echo "<br/>";
        echo "btc to cfa".$btc*$cfavalues->cfa_value;
        echo "<br/>";
        echo "1 btc 20 $ sell commission".($btc-$basic_setting->btc_sell_commision)*$cfavalues->cfa_value;
        echo "<br/>";
        echo "1 cfa to btc 20$ Buy commission".(($dollar/$cfavalues->cfa_value) +($dollar/($cfavalues->cfa_value*$basic_setting->btc_buy_commision)));
        echo "<br/>";
        //echo "20 $ commision in btc".($dollar*$basic_setting->btc_buy_commision);
        //echo "20 $ usd to cfa ".((1/$cfavalues->cfa_value)*$basic_setting->btc_buy_commision);
       //$cfa = round($dollar * ((1/$cfavalues->cfa_value) /$basic_setting->btc_buy_commision),8);

        //$cfa2 = round($dollar * (($btc-$basic_setting->btc_sell_commision)*$cfavalues->cfa_value),8);

         */
        
         
       // $cfa2 = round(($btc-$basic_setting->btc_sell_commision)*$cfavalues->cfa_value);
       
      // $cfa = round((($dollar/$cfavalues->cfa_value) +($dollar/($cfavalues->cfa_value*$basic_setting->btc_buy_commision))),8);
       $cfa = round(($btc+$basic_setting->btc_buy_commision)*$cfavalues->cfa_value);
        
        return $cfa;
        
    }
    
     function btcSellValue(){
         
          $basic_setting = \App\BasicSetting::first();
        $cfavalues= \App\UsdToCfas::orderBy('updated_at','DESC')->first();
        
        $url='https://bitpay.com/api/rates';
        $json=json_decode( file_get_contents( $url ) );
        $dollar=$btc=0;

        foreach( $json as $obj ){
            if( $obj->code=='USD' )$btc=$obj->rate;
        }
        $dollar=1 / $btc;

        $cfa2 = round(($btc-$basic_setting->btc_sell_commision)*$cfavalues->cfa_value);
        
        return $cfa2;
        
    }
    function getCfaValues(){

        $cfavalues= \App\UsdToCfas::orderBy('updated_at','DESC')->first();

        return $cfavalues->cfa_value;

    }
    function usdBuyValue(){

      $basic_setting = \App\BasicSetting::first();
      $cfavalues= \App\UsdToCfas::orderBy('updated_at','DESC')->first();
      
      $url='https://bitpay.com/api/rates';
      $json=json_decode( file_get_contents( $url ) );
      $dollar=$btc=0;

      foreach( $json as $obj ){
        if( $obj->code=='USD' )$btc=$obj->rate;
     }
    $dollar=1 / $btc;

    $usd1 = round($btc+$basic_setting->btc_buy_commision);
    
    return $usd1;

}

 function usdSellValue(){

      $basic_setting = \App\BasicSetting::first();
      $cfavalues= \App\UsdToCfas::orderBy('updated_at','DESC')->first();
      
      $url='https://bitpay.com/api/rates';
      $json=json_decode( file_get_contents( $url ) );
      $dollar=$btc=0;

      foreach( $json as $obj ){
        if( $obj->code=='USD' )$btc=$obj->rate;
     }
    $dollar=1 / $btc;

    $usd2 = round($btc-$basic_setting->btc_sell_commision);
    
    return $usd2;

}
    
    
    ?>
    