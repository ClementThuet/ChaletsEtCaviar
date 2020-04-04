<?php /**
 * @author Bill Minozzi
 * @copyright 2017
 */
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
function realestate_show_products($atts)
{
     Global $realestate_purpose, $meta_purpose;
/*   
    [realestate purpose="sale"]
    [realestate purpose="rent"]
*/


  $output = '<div id="realestate_content">';     
      
  if (isset($atts['onlybar']))
      {
         $output .= realestate_search(1);
         $output .= '</div'; 
         return $output;
       }
       
       
      
    if (isset($atts['purpose'])) {
        $realestate_purpose = trim($atts['purpose']);
    } else {
        $realestate_purpose = '';
    }
    if($realestate_purpose == 'rent')
      $realestate_purpose = 'Rent';
    elseif($realestate_purpose == 'sale')
      $realestate_purpose = 'Sale'; 
    if (isset($atts['option'])) {
        $realestate_option = trim($atts['option']);
    } else {
        $realestate_option = 'DESC';
    }
    if (isset($atts['pagination'])) {
        $realestate_pagination = trim($atts['pagination']);
    } else {
        $realestate_pagination = 'yes';
    }
    if (isset($atts['search'])) {
        $realestate_show_search = trim($atts['search']);
    } else {
        $realestate_show_search = 'yes';
    }
    if (isset($atts['option'])) {
        $RealEstate_option = trim($atts['option']);
    } else {
        $RealEstate_option = '';
    }

    if (!isset($_GET['submit'])) {
        $_GET['submit'] = '';
    } else
        $submit = sanitize_text_field($_GET['submit']);
    if (isset($_GET['postNumber'])) {
        $postNumber = sanitize_text_field($_GET['postNumber']);
    }
    if (isset($atts['max'])) {
        $postNumber = trim($atts['max']);
    }
    // orderby
    if (isset($atts['orderby']))
        $orderby = trim($atts['orderby']);
    else
        $orderby = '';
    if (!isset($postNumber)) {
        $postNumber = get_option('RealEstate_quantity', 6);
    }
    if (empty($postNumber)) {
        $postNumber = get_option('RealEstate_quantity', 6);
    }
    if ($realestate_show_search == 'yes')
        $output .= RealEstate_search(1);
    if (get_query_var('paged')) {
        $paged = get_query_var('paged');
    } elseif (get_query_var('page')) {
        $paged = get_query_var('page');
    }
    if(! isset($paged))
       $paged = realestate_get_page();
    global $wp_query;
    wp_reset_query();
    if (isset($_GET['realestate_search_type'])) {
        require_once (REALESTATEPATH . 'includes/search/search_get_par.php');
        $args = array(
            'post_type' => 'products',
            'showposts' => $postNumber,
            'paged' => $paged,
            );
    } else {
        // Shortcodes
        if ($realestate_option == 'lasts') {
            $args = array(
                'post_type' => 'products',
                'showposts' => $postNumber,
                'paged' => $paged,
                'orderby' => 'date',
                'order' => 'DESC');
        } elseif ($realestate_option == 'featureds') {
            $args = array(
                'post_type' => 'products',
                'showposts' => $postNumber,
                'paged' => $paged,
                'orderby' => 'date',
                'meta_key' => 'product-featured',
                'meta_compare' => '!=',
                'meta_value' => '',
                'order' => 'DESC');
    /*    
    } elseif ($realestate_purpose <> '') {
        $args = array(
            'post_type' => 'products',
            'showposts' => $postNumber,
            'paged' => $paged,
            'orderby' => 'date',
            'meta_query' => array(array('key' => 'product-purpose', 'value' => $realestate_purpose), ),
            'order' => 'DESC');
   */      
        } else {
            $args = array(
                'post_type' => 'products',
                'showposts' => $postNumber,
                'paged' => $paged,
                'orderby' => 'date',
                'order' => 'ASC');
        }
        // orderby
        if (!empty($orderby)) {
            $args['orderby'] = 'meta_value';
            $args['meta_type'] = 'NUMERIC';
            if ($orderby == 'price_high') {
                $args['meta_key'] = 'product-price';
                $args['order'] = 'DESC';
            }
            if ($orderby == 'price_low') {
                $args['meta_key'] = 'product-price';
                $args['order'] = 'ASC';
            }
            if ($orderby == 'year_high') {
                $args['meta_key'] = 'product-year';
                $args['order'] = 'DESC';
            }
            if ($orderby == 'year_low') {
                $args['meta_key'] = 'product-year';
                $args['order'] = 'ASC';
            }
        } else {
            $args['orderby'] = 'date';
            $args[] = 'ASC';
        }
    }
      $afilter = array();
      $afilter['key'] = 'product-purpose';
      if ($realestate_purpose <> '')
        $afilter['value'] = $realestate_purpose; // 'Rent';
    $args['meta_query']  = array($afilter);  
    if (isset($_GET['realestate_search_type'])) {
        require_once (REALESTATEPATH . 'includes/search/search_get_par.php');
        $args = array(
            'post_type' => 'products',
            'showposts' => $postNumber,
            'paged' => $paged,
            );
    } else {
        // Shortcodes
        if ($realestate_option == 'lasts') {
            $args = array(
                'post_type' => 'products',
                'showposts' => $postNumber,
                'paged' => $paged,
                'orderby' => 'date',
                'order' => 'DESC');
        } elseif ($realestate_option == 'featureds') {
            $args = array(
                'post_type' => 'products',
                'showposts' => $postNumber,
                'paged' => $paged,
                'orderby' => 'date',
                'meta_key' => 'product-featured',
                'meta_compare' => '!=',
                'meta_value' => '',
                'order' => 'DESC');
        } else {
            $args = array(
                'post_type' => 'products',
                'showposts' => $postNumber,
                'paged' => $paged,
                'orderby' => 'date',
                'order' => 'ASC');
        }
        // orderby
        if (!empty($orderby)) {
            $args['orderby'] = 'meta_value';
            $args['meta_type'] = 'NUMERIC';
            if ($orderby == 'price_high') {
                $args['meta_key'] = 'product-price';
                $args['order'] = 'DESC';
            }
            if ($orderby == 'price_low') {
                $args['meta_key'] = 'product-price';
                $args['order'] = 'ASC';
            }
            if ($orderby == 'year_high') {
                $args['meta_key'] = 'product-year';
                $args['order'] = 'DESC';
            }
            if ($orderby == 'year_low') {
                $args['meta_key'] = 'product-year';
                $args['order'] = 'ASC';
            }
        } else {
            $args['orderby'] = 'date';
            $args[] = 'ASC';
        }
    }
      $afilter = array();
      $afilter['key'] = 'product-purpose';
    //  $afilter['value'] = 'Rent';
   //   $args['meta_query']  = array($afilter); 
       if ($realestate_purpose <> '')
        $afilter['value'] = $realestate_purpose; // 'Rent';
      $args['meta_query']  = array($afilter);
    global $wp_query;
    wp_reset_query();      
    $wp_query = new WP_Query($args);
  /*
   echo '<pre>';
     print_r($wp_query);
 echo '</pre>';  
  */  
    $qposts = $wp_query->post_count;
    $ctd = 0;
    $ctd = 0;
    $RealEstate_measure = get_option('RealEstate_measure', 'M2');
    $output .= '<div class="RealEstateGallery">';
    $output .= '<div class="RealEstate_container">';
    while ($wp_query->have_posts()):
        $wp_query->the_post();
        $ctd++;
        $price = get_post_meta(get_the_ID(), 'product-price', true);
        if ($price <> '' and $price != '0') {
            $price = number_format_i18n($price,0);
        } else
            $price = '';
        $image_id = get_post_thumbnail_id();
        if (empty($image_id)) {
            $image = REALESTATEIMAGES . 'imagenoavailable800x600_br.jpg';
           // $image = str_replace("-", "", $image);
           $thumb = $image;
        } else {
            $image_url = wp_get_attachment_image_src($image_id, 'medium', true);
            $image = str_replace("-" . $image_url[1] . "x" . $image_url[2], "", $image_url[0]);
            $thumb = aq_resize($image, '300', '225', true, true, true );
      
        }
        
        
        //$thumb = $image;
        // $thumb = aq_resize($image, '300', '225', true, true, true );
      
      
        $year = get_post_meta(get_the_ID(), 'product-year', true);
        $beds = get_post_meta(get_the_ID(), 'product-beds', true);
        $baths = get_post_meta(get_the_ID(), 'product-baths', true);
        $area = get_post_meta(get_the_ID(), 'product-area', true);
        $output .= '<div>';
        $output .= '<a href="' . get_permalink() . '">';
        $output .= '<div class="RealEstate_gallery_2016">';
        $output .= '<img class="RealEstate_caption_img" src="' . $thumb . '" alt="' .
            get_the_title() . '" />';
        $output .= '<div class="RealEstate_caption_text">';
        $output .= ($price <> '' ? realestate_currency() . $price : __('Call for Price',
            'realestate'));
        $output .= '<br />';
        $output .= ($year <> '' ? __('Year', 'realestate') . ': ' . $year . '<br />' : '');
        $output .= ($beds <> '' ? __('Beds', 'realestate') . ': ' . $beds . '<br />' : '');
        $output .= ($baths <> '' ? __('Baths', 'realestate') . ': ' . $baths . '<br />' : '');
        $output .= ($area <> '' ? __('Area', 'realestate') . ': ' . $area . '<br />' : '');
        $output .= '</div>';
        $output .= '<div class="RealEstateTitle">' . get_the_title() . '</div>';
        $output .= '</a>';
        $output .= '</div>';
        $output .= '</div>';
        if ($ctd < $qposts) {
            if ($ctd % 3 == 0) {
                $output .= '</div>';
                $output .= '<div class="RealEstate_container">';
            }
        }
    endwhile;   
    $output .= '</div>'; 
    $output .= '<br/> <br/>'; 
    if ($realestate_pagination == 'yes') {
        $output .= '<div class="realestate_navigation">';
        $output .= '';
        ob_start();
        the_posts_pagination(array(
            'mid_size' => 2,
            'prev_text' => __('Back', 'realestate'),
            'next_text' => __('Onward', 'realestate'),
            ));
        $output .= ob_get_contents();
        ob_end_clean();
        $output .= '</div>';
    }
    $output .= '</div>';
    wp_reset_postdata();
    wp_reset_query();
    if ($qposts < 1) {
        $output .= '<h4>' . __('Not Found !', 'realestate') . '</h4>';
    }
    return $output;
}
add_shortcode('realestate', 'realestate_show_products'); ?>