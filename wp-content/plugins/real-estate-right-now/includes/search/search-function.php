<?php /**
 * @author Bill Minozzi
 * @copyright 2017
 */
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
add_action('wp_enqueue_scripts', 'RealEstateregister_slider');
function RealEstateregister_slider()
{
    wp_register_script('search-slider', REALESTATEURL .
        'includes/search/search_slider.js', array('jquery'), null, true);
    wp_enqueue_script('search-slider');
 //   wp_register_style('jqueryuiSkin', REALESTATEURL . 'assets/jquery/jqueryui.css',
 //       array(), '1.12.1');
 //   wp_enqueue_style('jqueryuiSkin');
}
function RealEstate_search($is_show_room)
{
    global $postNumber, $wp, $post, $page_id, $meta_purpose, $realestate_purpose;
    $my_title = __("Search", 'realestate');
    if ($is_show_room == '0') // widget
        {
        $searchlabel = 'search-label-widget';
        $selectboxmeta = 'select-box-meta-widget';
        $selectbox = 'select-box-widget';
        $inputbox = 'input-box-widget';
        $searchItem = 'searchItem-widget';
        $searchItem2 = 'searchItem2-widget';
        $RealEstatesubmitwrap = 'RealEstate-submitBtn-widget';
        $RealEstate_search_box = 'RealEstate-search-box-widget';
        $current_page_url = esc_url(home_url() . '/RealEstate_show_room_2/');
        $RealEstate_search_type = 'search-widget';
        $afieldsId = realestate_get_fields('widget');
    } elseif ($is_show_room == '1') // pag
    {
        $searchlabel = 'search-label';
        $selectboxmeta = 'select-box-meta';
        $selectbox = 'select-box';
        $inputbox = 'input-box';
        $searchItem = 'searchItem';
        $searchItem2 = 'searchItem';
        $RealEstatesubmitwrap = 'RealEstate-submitBtn';
        $RealEstate_search_box = 'RealEstate-search-box';
        $current_page_url = home_url(esc_url(add_query_arg(null, null)));
        $RealEstate_search_type = 'page';
        $afieldsId = realestate_get_fields('search');
    } elseif ($is_show_room == '2') // search result
    {
        $searchlabel = 'search-label';
        $selectboxmeta = 'select-box-meta';
        $selectbox = 'select-box';
        $inputbox = 'input-box';
        $searchItem = 'searchItem';
        $searchItem2 = 'searchItem';
        $RealEstatesubmitwrap = 'RealEstate-submitBtn';
        $RealEstate_search_box = 'RealEstate-search-box';
        $current_page_url = esc_url(home_url() . '/RealEstate_show_room_2/');
        $RealEstate_search_type = 'search-widget';
        $afieldsId = realestate_get_fields('search');
    }
        $showsubmit = false; 
        //  $afieldsId = realestate_get_fields('search');
        $totfields = count($afieldsId);
        $ametadataoptions = array();
        $output = '<div class="' . $RealEstate_search_box . '">';
        $output .= '<div class="RealEstate-search-cuore">';
        $output .= '<div class="RealEstate-search-cuore-fields">';
        $output .= '<form method="get" id="searchform3" action="' . $current_page_url . '">';
        if (isset($page_id)) {
            if ($page_id <> '0') {
                $output .= '        <input type="hidden" name="page_id" value="' . $page_id .
                    '" />';
            }
        }      
       if (!isset($_GET['meta_purpose'])) {
        $_GET['meta_purpose'] = '';
       }
       if (!isset($_GET['meta_beds'])) {
        $_GET['meta_beds'] = '';
       }  
       if (!isset($_GET['meta_baths'])) {
        $_GET['meta_baths'] = '';
       }   
  // purpose
        $output .= ' <div class="' . $searchItem . '">
    						<span class="' . $searchlabel . '">' . __('Purpose', 'realestate') .
            ':</span>';
        if ($is_show_room <> 0)
            $output .= '<div id="bdp_oneline"></div>';
        $meta_purpose = sanitize_text_field($_GET['meta_purpose']);
//        die($meta_purpose);
        if( isset($realestate_purpose))
        { 
            $realestate_purpose = trim($realestate_purpose);
            if($realestate_purpose <> '')
            $meta_purpose =  $realestate_purpose; 
        }       
        $output .=  '<select id="rent_sale" class="' . $selectboxmeta . '" name="meta_purpose">
                    <option ' . (($meta_purpose == 'Rent') ? 'selected="selected"' :
            '') . '  value ="Rent"> ' . __('Rent', 'realestate') . 
                   '</option>
                    <option ' . (($meta_purpose == 'Sale') ? 'selected="selected"' :
            '') . '  value ="Sale"> ' . __('Sale', 'realestate') . '</option>
                    </select> 
    		</div>';
  // Beds
          $meta_beds = sanitize_text_field($_GET['meta_beds']);    
          $output .= ' <div class="' . $searchItem . '">
    						<span class="' . $searchlabel . '">' . __('Beds', 'realestate') .
            ':</span>';
        if ($is_show_room <> 0)
            $output .= '<div id="bdp_oneline"></div>';
        $output .=  '<select class="' . $selectboxmeta . '" name="meta_beds">
    							<option ' . (($meta_beds == 'All') ? 'selected="selected"' :
            '') . '  value ="">' . __("All", "realestate") . '</option>';
       $max_beds = realestate_get_max_beds();
           for($i = 1; $i <= $max_beds; $i++ )
           {
                 $output .= '<option ' . (($meta_beds == $i) ? 'selected="selected"' : '') . ' value ="' . $i .  '"> '  . $i .  '</option>';           
           }
           $output .= ' </select> 
    		</div>'; 
// Baths
          $meta_baths = sanitize_text_field($_GET['meta_baths']);   
          $output .= ' <div class="' . $searchItem . '">
    						<span class="' . $searchlabel . '">' . __('Baths', 'realestate') .
            ':</span>';
        if ($is_show_room <> 0)
            $output .= '<div id="bdp_oneline"></div>';
        $output .=  '<select class="' . $selectboxmeta . '" name="meta_baths">
                               <option ' . (($meta_baths == 'All') ? 'selected="selected"' :
            '') . '  value ="">' . __("All", "realestate") . '</option>';
       $max_baths = realestate_get_max_baths();
           for($i = 1; $i <= $max_baths; $i++ )
           {
                 $output .= '<option ' . (($meta_baths == $i) ? 'selected="selected"' : '') . ' value ="' . $i .  '"> '  . $i .  '</option>';           
           }
           $output .= ' </select> 
    		</div>';     		
    // Location
    $alocations = realestate_get_locations();
    $qlocations = count($alocations);
    if ((trim(get_option('realestate_show_location', 'yes')) == 'yes') and $qlocations > 0) {
        // $showsubmit = true;
     if(isset($_GET['meta_locations']))  
       $meta_locations = sanitize_text_field($_GET['meta_locations']);
     else
       $meta_locations = '';       
        $output .= '	 
     					<div class="' . $searchItem . '">
    						<span class="' . $searchlabel . '">' . __('Location', 'realestate') .
            ':</span>';
        if ($is_show_room <> 0)
            $output .= '<div id="bdp_oneline"></div>';
        $output .= ' 
                            <select class="' . $selectboxmeta .
            '" name="meta_locations">
    							<option ' . (($meta_locations == '') ? 'selected="selected"' : '') .
            ' value =""> ' . __('All', 'realestate') . ' </option>';
        for ($i = 0; $i < $qlocations; $i++) {
          //  die('$make');
            $output .= '<option ' . (($meta_locations == trim($alocations[$i])) ? 'selected="selected"' :
                '') . '  value ="' . $alocations[$i] . '"> ' . $alocations[$i] . '</option>';
        }
        $output .= '</select></div>';
    }
  // Location
    for ($i = 0; $i < $totfields; $i++) {
        $post_id = $afieldsId[$i];
        $ametadata = realestate_get_meta($post_id);
        $field_value = array(
            'field_label', // 0
            'field_typefield', // 1
            'field_drop_options', // 2
            'field_searchbar', // 3
            'field_searchwidget', //4
            'field_rangemin', // 5
            'field_rangemax', //6
            'field_rangestep', // 7
            'field_slidemin', // 8
            'field_slidemax', // 9
            'field_slidestep', // 10
            'field_order', // 11
            'field_name'); // 12
        if (!empty($ametadata[0]))
            $search_label = $ametadata[0];
        else
            $search_label = $ametadata[12];
        $search_name = $ametadata[12];
        $meta = 'meta_'.$ametadata[12];
        if (!isset($_GET[$search_name])) {
            $_GET[$search_name] = '';
        }
       if (isset($_GET[$meta]))
          $realestate_meta_con = trim(sanitize_text_field($_GET[$meta]));
       else
          $realestate_meta_con = ' '; 
        $typefield = $ametadata[1];
        // Dropdown
        if ($typefield == 'dropdown') {
            $showsubmit = true;
            $output .= '<div class="' . $searchItem . '">';
            $output .= '<span class="' . $searchlabel . '">' . $search_label . ':</span>';
            if ($is_show_room <> 0)
                $output .= '<div id="bdp_oneline"></div>';
            $output .= '<select class="' . $selectboxmeta . '" name="'.$meta.'">';
            $options = explode("\n", $ametadata[2]);
            // $output .= '<option>All</option>';
            //$output .= '<option>'. __('All', 'realestate') .'</option>';
            $output .= '<option value="All">'. __('All', 'realestate') .'</option>';

            foreach ($options as $option) {
                $output .= '<option ';
                if(trim($realestate_meta_con) == trim($option))
                  {
                    $output .= ' selected="selected" ';
                   }  
                $output .= '>' . $option . '</option>';
            }
            $output .= '</select>';
            $output .= '</div>'; // SearchItem;
        } // end Dropdown
        // Select Range
        if ($typefield == 'rangeselect') {
            $showsubmit = true;
            $output .= '<div class="' . $searchItem . '">';
            $output .= '<span class="' . $searchlabel . '">' . $search_label . ':</span>';
            if ($is_show_room <> 0)
                $output .= '<div id="bdp_oneline"></div>';
            $output .= '<select class="' . $selectboxmeta . '" name="'.$meta.'">';
            $init = $ametadata[5];
            $max = $ametadata[6];
            $step = $ametadata[7];
            $options = array();
            $output .= '<option value="All">'. __('All', 'realestate') .'</option>';
            for ($z = $init; $z <= $max; $z += $step) {
                $option = $z;
                $output .= '<option ' . ($realestate_meta_con == $option ?
                        ' selected="selected"' : '') . '>' . $option . '</option>';
            }
            $output .= '</select>';
            $output .= '</div>'; // SearchItem;
        } // end Dropdown       
         // Checkbox
        if ($typefield == 'checkbox') {
            $showsubmit = true;
            if (isset($_GET[$meta]))
                $realestate_meta_con = sanitize_text_field($_GET[$meta]);
            else
                $realestate_meta_con = ' ';
            $output .= '<div class="' . $searchItem . '">';
            $output .= '<span class="' . $searchlabel . '">' . $search_label . ':</span>';
            if ($is_show_room <> 0)
                $output .= '<div id="bdp_oneline"></div>';
            $output .= '<select class="' . $selectboxmeta .'" name="'.$meta.'">';
               // $output .= '<option value = "All" ' . ($realestate_meta_con == 'All' ? ' selected="selected"' : '') . '>All</option>';
                $output .= '<option value="All">'. __('All', 'realestate') .'</option>';
                $output .= '<option value = "enabled" ' . ($realestate_meta_con == "enabled"  ? ' selected="selected"' : '') . '>'. __('Yes', 'realestate') .'</option>';
                $output .= '<option value = "" ' . ($realestate_meta_con == '' ? ' selected="selected"' : '') . '>'. __('No', 'realestate') .'</option>';
            $output .= '</select>';
            $output .= '</div>'; // SearchItem;
        } // end Checkbox
    } // end Loop       
        // Slider
         $showsubmit = true;
         if( isset($realestate_purpose)) 
            $meta_purpose =  $realestate_purpose;
         if (isset($meta_purpose))
            if ($meta_purpose != '')
               $max_car_value = realestate_get_max($meta_purpose);
            else
               $max_car_value = realestate_get_max('');
        if ($is_show_room != '0') // no widget
           {
            $output .= '<div class="realestate-price-slider">';
            $output .= '<span class="realestatelabelprice">' . __('Price Range', 'realestate') . ':</span>';
            $output .= '<input type="text" name="meta_price" id="meta_price" readonly>';
            // slider
            if ($is_show_room == '1')
                $output .= '<div id="realestate_meta_price" class="realestateslider" ></div>';
            else
                $output .= '<div id="realestate_meta_price" class="realestateslider" style="margin-top:0px;" ></div>';
            $output .= '<input type="hidden" name="meta_price_max" id="meta_price_max" value="'.$max_car_value.'">';
            if(isset($_GET['meta_price']))
              $price = sanitize_text_field($_GET['meta_price']);
            else
              $price = '';
            /*
            $pos = strpos($price, '-');
            if ($pos === false)
                $price = '';
            else {
                $priceMin = trim(substr($price, 0, $pos - 1));
                $priceMax = trim(substr($price, $pos + 1));
                $output .= '<input type="hidden" name="choice_price_min" id="choice_price_min" value="' .
                    $priceMin . '">';
                $output .= '<input type="hidden" name="choice_price_max" id="choice_price_max" value="' .
                    $priceMax . '">';
            }
            */
            $pos = strpos($price, '-');
            if ($pos === false)
               {    
                  $price = '';
                  $priceMin = '0';
                  $priceMax = $max_car_value;
               }            
            else {
                $priceMin = trim(substr($price, 0, $pos - 1));
                $priceMax = trim(substr($price, $pos + 1));
               }             
            $output .= '</div>';
         }  // show room != 0 
        if ($is_show_room == '0') // widget
           {
            $output .= '<div class="realestate-price-slider2">';
            $output .= '<span class="realestatelabelprice2">' . __('Price', 'realestate') . ':</span>';
            $output .= '<input type="text" name="meta_price2" id="meta_price2" readonly>';
                $output .= '<div id="realestate_meta_price2" class="realestateslider" "></div>';
            $output .= '<input type="hidden" name="meta_price_max2" id="meta_price_max2" value="'.$max_car_value.'">';
            if(isset($_GET['meta_price2']))
              $price = sanitize_text_field($_GET['meta_price2']);
            else
              $price = '';
            $pos = strpos($price, '-');
            if ($pos === false)
                $price = '';
            else {
                $priceMin = trim(substr($price, 0, $pos - 1));
                $priceMax = trim(substr($price, $pos + 1));
                $output .= '<input type="hidden" name="choice_price_min2" id="choice_price_min2" value="' .
                    $priceMin . '">';
                $output .= '<input type="hidden" name="choice_price_max2" id="choice_price_max2" value="' .
                    $priceMax . '">';
            }
            $output .= '</div>';
         }  // show room = 0          
    // Submit
    if ($showsubmit) {
        $output .= '<div class="RealEstate-submitBtnWrap">';
        $output .= '<input type="submit" name="submit" id="' . $RealEstatesubmitwrap .
            '" value=" ' . __('Search', 'realestate') . '" />';
        $output .= '</div>';
        $output .= '<input type="hidden" name="RealEstate_post_type" value="products" />';
        $output .= '<input type="hidden" name="postNumber" value="' . $postNumber .
            '" />';
        $output .= '<input type="hidden" name="RealEstate_search_type" value="' . $RealEstate_search_type .
            '" />';
    }
    $output .= '</form></div></div></div>  <!-- end of Basic -->';
    return $output;
}
?>