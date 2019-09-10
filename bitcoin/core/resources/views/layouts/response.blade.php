<?php
$blockchain = file_get_contents('https://blockchain.info/ticker');

$btc_array = json_decode($blockchain, true);
//print_r($btc_array);
$usd_buy  = $btc_array['USD']['buy'];
$usd_sell = $btc_array['USD']['sell'];
?>
<span>Buy: <?=$usd_buy?> $ &nbsp;&nbsp; | &nbsp;&nbsp; Sell: <?=$usd_sell?> $</span>