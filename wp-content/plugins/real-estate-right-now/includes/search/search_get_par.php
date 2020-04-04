<?php /**
 * @author Bill Minozzi
 * @copyright 2016
 */
if(isset($_GET['meta_purpose']))
  $purpose = sanitize_text_field($_GET['meta_purpose']);
else
  $purpose = '';
if(isset($_GET['meta_year']))
  $year = sanitize_text_field($_GET['meta_year']);
else
  $year = '';
if(isset($_GET['meta_purpose']))  
  $purpose = sanitize_text_field($_GET['meta_purpose']);
else
  $purpose = '';
if(isset($_GET['meta_beds']))    
   $beds = sanitize_text_field($_GET['meta_beds']);
else
  $beds = '';
if(isset($_GET['meta_baths']))    
   $baths = sanitize_text_field($_GET['meta_baths']);
else
  $baths = ''; 
if(isset($_GET['meta_price']))  
   $price = sanitize_text_field($_GET['meta_price']);
else
  $price = '';
if(isset($_GET['meta_price2']))  
   $price = sanitize_text_field($_GET['meta_price2']);
if(isset($_GET['meta_locations']))  
 $meta_locations = sanitize_text_field($_GET['meta_locations']);
else
 $meta_locations = '';
 /*
if(isset($_GET['meta_fuel']))  
 $fuel = sanitize_text_field($_GET['meta_fuel']);
else
 $fuel = '';
 */
$pos = strpos($price, '-');
if($pos !== false)
 {
    $priceMin = trim(substr($price, 0, $pos-1));
    $priceMax = trim(substr($price, $pos+1));
 }
 else
 {
    $priceMax = 9999999999;
    $priceMin = '';
 }  
$priceMin = (int)$priceMin;
$priceMax = (int)$priceMax;
/*
if ($year != '') {
    $yearKey = 'key';
    $yearVal = 'value';
    $yearName = 'car-year';
    $year = $year;
}
else
{
    $yearKey = '';
    $yearVal = '';
    $yearName = '';
    $year = '';
}
*/
if ($baths != '') {
    $bathsKey = 'key';
    $bathsVal = 'value';
    $bathsName = 'product-baths';
    $baths = $baths;
}
else
{
    $bathsKey = '';
    $bathsVal = '';
    $bathsName = '';
    $baths = '';
}
if ($beds != '') {
    $bedsKey = 'key';
    $bedsVal = 'value';
    $bedsName = 'product-beds';
    $beds = $beds;
}
else
{
    $bedsKey = '';
    $bedsVal = '';
    $bedsName = '';
    $beds = '';
}
if ($purpose != '') {
    $purposeKey = 'key';
    $purposeVal = 'value';
    $purposeName = 'product-purpose';
    $purpose = __($purpose, 'realestate');
}
else
{
    $purposeKey = '';
    $purposeVal = '';
    $purposeName = '';
    $purpose = '';
}