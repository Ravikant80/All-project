<?php
use App\Product;

function getPoductDetails($id){

  $productsData = Product::findOrFail($id);
  return $productsData;
}
 ?>
