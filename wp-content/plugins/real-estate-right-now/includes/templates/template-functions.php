<?php 
/**
 * @author Bill Minozzi
 * @copyright 2017
 */
 function realestate_maps()
 {
    $googleapi = get_option('RealEstate_googlemapsapi'); 
    if( empty($googleapi))
       return;
    $post_product_id = get_the_ID(); 
    $googlemapname = realestate_findglooglemap();
    $value = get_post_meta($post_product_id, $googlemapname, true);
     if(empty($value) )
         return;
 if( gettype($value) != 'string')
     return;     
    $googlemap = explode(PHP_EOL, $value);
                if (isset($googlemap[0]))
                    $googlemap_latitude = $googlemap[0];
                 else
                    $googlemap_latitude = '';
                if (isset($googlemap[1]))
                    $googlemap_longitude = $googlemap[1];
                else
                    $googlemap_longitude = '';
                if (isset($googlemap[2]))
                    $googlemap_zoom = $googlemap[2];
                else
                    $googlemap_zoom = '';
                /*    
                if (isset($googlemap[3]))
                    $googlemap_address = $googlemap[3];
                else
                    $googlemap_address = '';
                 */
   if( ! empty($googlemap_latitude ) and ! empty($googlemap_longitude) and !empty($googlemap_zoom) )
   {
     echo '<div id="realestate_googleMap"></div>';
?>  
    <script>
      function realestate_initMap() {
        var guluru = {lat: <?php echo $googlemap_latitude;?>, lng: <?php echo $googlemap_longitude;?>};
        var map = new google.maps.Map(document.getElementById('realestate_googleMap'), {
          zoom: <?php echo $googlemap_zoom;?>,
          center: guluru
        });
        var marker = new google.maps.Marker({
          position: guluru,
          map: map
        });
      }
    </script>
    <script async defer src="https://maps.googleapis.com/maps/api/js?key=<?php echo $googleapi;?>&callback=realestate_initMap" type="text/javascript">
    </script>
<?php
   }   
   return true;
 }
function realestate_content_detail(){
    $post_product_id = get_the_ID();
    ?>
    <div class="multi-content">
        <div id="sliderWrapper">
                 <?php
                   if (get_post_meta(get_the_ID(), 'product-address', true) != '') { 
                         $address = trim(get_post_meta(get_the_ID(), 'product-address', 'true'));
                         if(! empty($address)) 
                         {
                           echo '<div class="featuredTitle">'; 
                           echo '&nbsp;&nbsp;&nbsp;';
                           echo __('Address', 'realestate').': ';  
                          // echo esc_attr($term1->name);
                           echo $address;
                           echo '</div><br />'; 
                         } 
                   }
                 realestate_maps();
                 $terms3 = get_the_terms( get_the_id(), 'locations');
                 $term3 = $terms3[0]; 
                 if(is_object($term3))
                    {
                         echo '<div class="featuredTitle">'; 
                         echo __('Location', 'realestate').': ';  
                         echo esc_attr($term3->name); 
                         echo '</div><br />';
                    } 
                 ?>
             <div class="featuredTitle"> 
             <?php echo __('Details', 'realestate');?> </div>
  			 <div class="featuredCar">
             <?php 
              if (get_post_meta($post_product_id, 'product-beds', 'true') != '') { ?>
             <div class="featuredList">             
             <span class="carBold"> <?php echo __('Beds', 'realestate');?>: </span><?php echo get_post_meta($post_product_id, 'product-beds', 'true');
              ?> 
             </div><!-- End of featured list -->
             <?php }
              if (get_post_meta($post_product_id, 'product-baths', 'true') != '') { ?>
             <div class="featuredList">             
             <span class="carBold"> <?php echo __('Baths', 'realestate');?>: </span><?php echo get_post_meta($post_product_id, 'product-baths', 'true');
             ?> 
             </div><!-- End of featured list -->
             <?php }
             if (get_post_meta($post_product_id, 'product-area', 'true') != '') { ?>
             <div class="featuredList">             
             <span class="carBold"> 
             <?php echo $RealEstate_measure = get_option('RealEstate_measure', 'M2');?>:           
             </span><?php echo get_post_meta($post_product_id, 'product-area', 'true');
             ?> 
             </div><!-- End of featured list -->
             <?php }
        $afieldsId = realestate_get_fields('all');
        $totfields = count($afieldsId);
        $ametadataoptions = array();
        for ($i = 0; $i < $totfields; $i++) {
            $post_id = $afieldsId[$i];
            $ametadata = realestate_get_meta($post_id);        
            if (!empty($ametadata[0]))
                $label = $ametadata[0];
            else
                $label = $ametadata[12];
            $field_id = 'product-'.$ametadata[12];
            $value = get_post_meta($post_product_id, $field_id, true);
             $typefield = $ametadata[1];
             if ($value != '' and $typefield != 'googlemap' ) 
             { 
                 if ($typefield == 'checkbox')
                 {
                   if($value == 'enabled')
                     $value = 'Ok';
                   else
                     $value = 'No';
                 }
                  ?>
                 <div class="featuredList">             
                 <span class="multiBold"> <?php echo $label;?>: </span><?php echo '<b>'.$value.'</b>';?> 
                 </div><!-- End of featured list --><?php }
             }
             ?>
             </div><!-- End of featured multi -->
             </div> <!-- end of Slider Content --> 
             </div> <!-- end of Slider Wrapper -->  
     <?php }
 function realestate_content_info () { ?>
 <div class="contentInfo">
         <div class="multiPriceSingle">
         	<?php 
            $price = get_post_meta(get_the_ID(), 'product-price', true);
           if ($price <> '' and $price != '0')
             { 
                $price =   number_format_i18n($price,0);
                $price = realestate_currency() . $price;
             }
             else
                $price =  __('Call for Price', 'realestate'); 
            echo $price;
    		?> 
         </div>
         <div class="multiPurposeSingle">
         	<?php 
            $purpose = get_post_meta(get_the_ID(), 'product-purpose', true);
    		// die($year);
            if ( $purpose <> '') 
    			echo __($purpose, 'realestate');
    		?> 
         </div>
         <div class="multiYearSingle">
         	<?php 
            $year = get_post_meta(get_the_ID(), 'product-year', true);
    		// die($year);
            if ( $year <> '') 
    			echo __('Year', 'realestate').': '.$year;
    		?> 
         </div>
         <div class="multiContent">
         	<?php the_content(); ?>
         </div> 
            <?php 
            $year = get_post_meta(get_the_ID(), 'multi-year', 'true'); 
            if($year)
            { ?>
            <div class="multiDetail">
                 <?php echo __('Year', 'realestate').': ';
                   echo $year; 
                ?>
                <!--
                <div class="multiBasicRow"><span class="singleInfo"><?php echo __(get_option('RealEstate_measure', 'Miles'), 'realestate')?>: </span> <?php echo get_post_meta(get_the_ID(), 'multi-miles', 'true'); ?></div>
                <div class="multiBasicRow"><span class="singleInfo"><?php echo __('Cond', 'realestate');?>: </span> <?php echo get_post_meta(get_the_ID(), 'multi-con', 'true'); ?></div>
                <div class="multiBasicRow"><span class="singleInfo"><?php echo __('HP', 'realestate');?>:&nbsp; </span> <?php echo get_post_meta(get_the_ID(), 'multi-hp', 'true'); ?></div>
                -->
            </div>
            <?php } ?> 
 </div>	 
 <?php }
function realestate_detail() {
  echo '<div class="multi-content">';
	while ( have_posts() ) : the_post(); 
       realestate_title_detail();
       realestate_content_info (); 
      ?> 
     <div class="multicontentWrap">
	 <?php realestate_content_detail (); ?>
     </div><?php
     break;
	 endwhile; // end of the loop.
     echo '</div>';
}
function realestate_title_detail(){
global $realestate_the_title;
   $realestate_the_title = get_the_title(); ?>
    <div class="multi-detail-title">  <?php the_title(); ?> </div>
<?php }
function RealEstate_theme_thumb($url, $width, $height=0, $align='') {
        if (get_the_post_thumbnail()=='') {
    	  	$url = REALESTATEIMAGES.'imagenoavailable.jpg';
		}
       return $url;
}
function realestaterightnow_profile()
{
global $post;
$terms = get_the_terms( $post->ID, 'agents' );
 if ( ! empty( $terms ) && ! is_wp_error( $terms ) ){
    foreach ( $terms as $term ) {
    }
 }
 if( !isset($term->term_id))
    return;
  $termId = $term->term_id;
 //echo 'certo: '.$termId;
 //echo '<hr>';
/* 
 $agents_custom_fields = get_option( "taxonomy_term_$termId" );  
die("taxonomy_term_$termId");
die('xx '.$agents_custom_fields);
*/
 $termName = $term->name;
  //echo 'Name: '. $termName;
 // echo '<hr>';
 $termMeta = get_option( 'agents_' . $termId );
// print_r($termMeta);
 // print_r($termMeta);
  echo '<div class = "realestaterightnow_profile">';
    echo '<div class = "realestaterightnow_wrapprofile">';
      echo '<div class = "realestaterightnow_fotoprofile">';
          if(! empty($termMeta['image']))
          {
            echo '<img class = "reatestateimg-circle" src="'.$termMeta["image"].'"  />';
          }
          else
          {
             $image = REALESTATEIMAGES . 'imagenoavailable800x400_br.jpg';
             echo '<img class = "reatestateimg-circle" src="'.$image.'"  />';
          }
      echo '</div>'; 
     echo '<div class = "realestaterightnow_textoprofile">';
      echo '<div class = "realestaterightnow_nameprofile">';
      if(!empty($termName)){ esc_attr_e($termName); }
      echo '</div>';
      echo '<div class = "realestaterightnow_titleprofile">';
      if(!empty($termMeta['function'])){ esc_attr_e($termMeta['function']); }
      echo '</div>';     
      echo '<div class = "realestaterightnow_descriptionprofile">';
      echo substr(term_description( $termId, 'agents' ),0,140);
      //echo 'description description description description description ';
      echo '</div>';
    ?>
     <div class = "realestaterightnow_iconsprofile"> 
      <?php 
          if(! empty($termMeta['phone']))
          {
            echo '<i class="fa fa-phone" aria-hidden="true"></i>';
            echo '&nbsp;'.$termMeta['phone'];
            echo '<br />';
          }
          if(! empty($termMeta['skype']))
          {
            echo '<i class="fa fa-skype" aria-hidden="true"></i>';
            echo '&nbsp;'.$termMeta['skype'];
            echo '<br />';
          }
          if(! empty($termMeta['email']))
          {
            echo ' <a href="mailto:'.$termMeta['email'].'"><i class="fa fa-envelope-o" aria-hidden="true"></i></a> ';
            echo '&nbsp;';
          }      
          if(! empty($termMeta['facebook']))
          {
            echo ' <a href="http://facebook.com/'.$termMeta['facebook'].'"><i class="fa fa-facebook" aria-hidden="true"></i></a> ';
            echo '&nbsp;';
          }
          if(! empty($termMeta['twitter']))
          {
            echo ' <a href="http://twitter.com/'.$termMeta['twitter'].'"><i class="fa fa-twitter" aria-hidden="true"></i></a> ';
            echo '&nbsp;';
          }   
          if(! empty($termMeta['linkedin']))
          {
            echo ' <a href="http://linkedin.com/'.$termMeta['linkedin'].'"><i class="fa fa-linkedin" aria-hidden="true"></i></a> ';
            echo '&nbsp;';
          }
          if(! empty($termMeta['instagram']))
          {
            echo ' <a href="http://instagram.com/'.$termMeta['instagram'].'"><i class="fa fa-instagram" aria-hidden="true"></i></a> ';
            echo '&nbsp;';
          } 
          if(! empty($termMeta['vimeo']))
          {
            echo '<a href="http://vimeo.com/'.$termMeta['vimeo'].'"><i class="fa fa-vimeo" aria-hidden="true"></i></a> ';
            echo '&nbsp;';
          }       
          if(! empty($termMeta['youtube']))
          {
            echo '<a href="http://youtube.com/'.$termMeta['youtube'].'"><i class="fa fa-youtube" aria-hidden="true"></i></a> ';
            echo '&nbsp;';
          }          
      ?>
  </div>
  <?php
      echo '</div>'; 
   echo '</div>';      
   echo '</div>';  
 echo '</div>';     
}