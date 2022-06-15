<?php
 use Carbon\Carbon; 

 function toRupiah($value){
    return "Rp. ".number_format($value, 0, ',', '.').",-";
 }

 function format($value, $format){
    return Carbon::parse($value)->format($format);
 }
?>