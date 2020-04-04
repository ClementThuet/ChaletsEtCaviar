<?php /**
 * @author Bill Minozzi
 * @copyright 2017
 */
if (!defined('ABSPATH'))
    exit; // Exit if accessed directly
 ?>
<style type="text/css">
<!-- 
<?php if (get_option('sidebar_search_page_result', 'no') == 'yes') { ?>
    #secondary, .sidebar-container
    {
        display: none !important; 
    }
<?php } ?>
#main
{  width: 100%!important;
   position:  absolute;}
-->
</style>
<?php global $wp;
global $query;
global $wp_query;
$wp_query->is_404 = false;
get_header();
//$output = '<div style="margin-top: 20px;">';
//$output .= '<div id="realestate_content">';
$output = '<div id="realestate_content">';
if (!isset($_GET['submit'])) {
    $_GET['submit'] = '';
} else
    $submit = sanitize_text_field($_GET['submit']);
if (isset($_GET['post_type'])) {
    $post_type = sanitize_text_field($_GET['post_type']);
}
if (isset($_GET['postNumber'])) {
    $postNumber = sanitize_text_field($_GET['postNumber']);
}
if (empty($postNumber)) {
    $postNumber = get_option('RealEstate_quantity', 6);
}
$output .= RealEstate_search(2);
    if (get_query_var('paged')) {
        $paged = get_query_var('paged');
    } elseif (get_query_var('page')) {
        $paged = get_query_var('page');
    }
    if(! isset($paged))
       $paged = realestate_get_page();
if (isset($submit)) {
    require_once (REALESTATEPATH . 'includes/search/search_get_par.php');
    $afieldsId = realestate_get_fields('all');
    $totfields = count($afieldsId);
    $afilter = array();
    for ($i = 0; $i < $totfields; $i++) {
        $post_id = $afieldsId[$i];
        $ametadata = realestate_get_meta($post_id);
        $keyname = 'product-' . $ametadata[12];
        $metaname = 'meta_' . $ametadata[12];
        if (isset($_GET[$metaname])) {
            $keyval = trim(sanitize_text_field($_GET[$metaname]));
            if ($keyval != 'All') {
                if ($ametadata[1] == 'checkbox') {
                    if ($keyval == 'enabled') {
                        $afilter[] = array(
                            'key' => $keyname,
                            'value' => $keyval,
                            'compare' => 'EXISTS');
                    }
                    else
                    {
                        echo $keyname;
                        $afilter[] = array(
                            'key' => $keyname,
                            'value' => 'enabled',
                            'compare' => 'NOT EXISTS');                       
                    }
                } else // not checkbox
                {
                    if ( !empty($keyval))
                    {
                    $afilter[] = array(
                        'key' => $keyname,
                        // serialize())
                        'value' => $keyval,
                        'compare' => 'LIKE');
                    }
                }
            }
        }
    } // end Loop fields
            if(isset($_GET['meta_price']))  
               $price = sanitize_text_field($_GET['meta_price']);
            else
              $price = '';
            if(isset($_GET['meta_price2']))  
               $price = sanitize_text_field($_GET['meta_price2']);
            if ($price != '') {
        $pos = strpos($price, '-');
        if ($pos !== false) {
            $priceMin = trim(substr($price, 0, $pos - 1));
            $priceMax = trim(substr($price, $pos + 1));
                      $afilter[] = array(
                     // array(
                      'relation' => 'OR',
                       array(
                        'key' => 'product-price',
                        'value' => array($priceMin, $priceMax),
                        'type' => 'numeric',
                        'compare' => 'BETWEEN'),
                      array(
                        'key' => 'product-price',
                        'value' => '0',
                        'type' => 'numeric',  
                        'compare' => '='),
                  );                
        }
    } // end meta_price
    // meta_purpose
    if (isset($_GET['meta_purpose'])) {
        if (isset($_GET['meta_purpose']))
            $purpose = sanitize_text_field($_GET['meta_purpose']);
        else
            $purpose = '';
        $afilter[] = array('key' => 'product-purpose', 'value' => $purpose);
    } // end meta_purpose
    // meta_beds
    if (isset($_GET['meta_beds'])) {
        if (isset($_GET['meta_beds']))
            $beds = sanitize_text_field($_GET['meta_beds']);
        else
            $beds = '';
        if (!empty($beds)) {
            $afilter[] = array('key' => 'product-beds', 'value' => $beds);
        }
    } // end meta_beds
    // meta_baths
    if (isset($_GET['meta_baths'])) {
        if (isset($_GET['meta_baths']))
            $baths = sanitize_text_field($_GET['meta_baths']);
        else
            $baths = '';
        if (!empty($baths)) {
            $afilter[] = array('key' => 'product-baths', 'value' => $baths);
        }
    } // end meta_baths
    // Featured
    if (isset($_GET['meta_order']))
        $order = trim(sanitize_text_field($_GET['meta_order']));
    else
        $order = '';
    if (!empty($order)) {
        if ($order == 'price_high') {
            $wmetakey = 'product-price';
            $wmetaorder = 'DESC';
        }
        if ($order == 'price_low') {
            $wmetakey = 'product-price';
            $wmetaorder = 'ASC';
        }
        if ($order == 'year_high') {
            $wmetakey = 'product-year';
            $wmetaorder = 'DESC';
        }
        if ($order == 'year_low') {
            $wmetakey = 'product-year';
            $wmetaorder = 'ASC';
        }
    } // no order
    $args = array(
        'post_type' => 'products',
        'showposts' => $postNumber,
        'paged' => $paged,
        );
    if (!empty($order)) {
        $args['orderby'] = 'meta_value';
        $args['meta_type'] = 'NUMERIC';
        $args['meta_key'] = $wmetakey;
        $args['order'] = $wmetaorder;
    }
    $args['meta_query'] = $afilter;
   if(!empty($meta_locations) and $meta_locations <> 'All')
            {
               $args['tax_query'] = array(                
                               array(
                        'taxonomy' => 'locations',
                        'field' => 'name',
                        'terms' => $meta_locations,
                    ),
                 );
            }    
} else // submit
{
    $args = array(
        'post_type' => 'products',
        'showposts' => $postNumber,
        'paged' => $paged,
        'order' => 'DESC');
}
//
/*
echo '<pre>';
print_r($args);
echo '</pre>';
*/
    $wp_query = new WP_Query($args);
    $qposts = $wp_query->post_count;
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




        $year = get_post_meta(get_the_ID(), 'product-year', true);
        $beds = get_post_meta(get_the_ID(), 'product-beds', true);
        $baths = get_post_meta(get_the_ID(), 'product-baths', true);
        $area = get_post_meta(get_the_ID(), 'product-area', true);
        $output .= '<div>';
        $output .= '<a href="' . get_permalink() . '">';
        $output .= '<div class="RealEstate_gallery_2016">';
            
        $output .= '<img class="RealEstate_caption_img" src="' . $image . '" alt="' .
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
ob_start();
the_posts_pagination(array(
    'mid_size' => 2,
    'prev_text' => __('Back', 'realestate'),
    'next_text' => __('Onward', 'realestate'),
    ));
$output .= ob_get_contents();
ob_end_clean();
$output .= '</div>';
$output .= '</div>';
wp_reset_postdata();
wp_reset_query();
if ($qposts < 1) {
    $output .= '<br /><h4>' . __('Not Found !', 'realestate') . '</h4>';
}
echo $output;
$registered_sidebars = wp_get_sidebars_widgets();
if (get_option('sidebar_search_page_result', 'no') == 'yes') {
    foreach ($registered_sidebars as $sidebar_name => $sidebar_widgets) {
        unregister_sidebar($sidebar_name);
    }
}
get_footer(); ?>