<?php 
/**
 * @author Bill Minozzi
 * @copyright 2017
 */
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
add_action('init', 'realestatePosts');
function realestatePosts () {
	register_post_type( 'products', 
		array( 
			'labels' => array(
				'name' => 'Products',
				'all_items' => 'All Properties',
				'singular_name' => 'Property',
				'add_new_item' => 'Add Property',
				'edit_item' => 'Edit Property',
				'search_items' => 'Search Properties',
				'view_item' => 'View Property',
				'not_found' => 'No Properties Found',
				'not_found_in_trash' => 'No Properties Found in Trash'
			),
			'public' => true,
			'publicly_queryable' => true,
			'show_ui' => true,
			'has_archive' => true,
			'show_in_menu' => false,
			'supports' => array (
				'title',
				'page-attributes',
				'editor',
				'thumbnail',
			),
			'taxonomies' => array( 'agents',
				'agents',
                'locations',
			),
			'exclude_from_search' => false,
			'_builtin' => false,
			'hierarchical' => false,
			'rewrite' => array("slug" => "product"),
		)
	);
};
add_action('init', 'RealEstate_taxonomies');
function RealEstate_taxonomies() { 
register_taxonomy( 'agents', 'products', array(
			'labels' => array(
				'name' => 'agents',
				'singular_name' => 'agents',
				'search_items' => 'Search agents',
				'popular_items' => 'Popular agents',
				'all_items' => 'All agents',
				'parent_item' => __( 'Parent agents', 'realestate' ),
  				'parent_item_colon' => __( 'Parent agents:' ),
				'edit_item' => __( 'Edit agents', 'realestate' ), 
				'update_item' => __( 'Update agents', 'realestate' ),
				'add_new_item' => __( 'Add New agents', 'realestate' ),
				'new_item_name' => __( 'New agents' , 'realestate'),
				'separate_items_with_commas' => __( 'Separate agents with commas', 'realestate' ),
				'add_or_remove_items' => __( 'Add or Remove agents' , 'realestate'),
				'choose_from_most_used' => __( 'Choose from the most used makers', 'realestate' ),
				'menu_name' => 'Agents',
			),
			'hierarchical' => true,
			'show_ui' => true, // Hide from menu
			'query_var' => true,
			'rewrite' => array( 'slug' => 'agents' ),
			'public' => true,
		)
	);
   register_taxonomy( 'locations', 'products', array(
			'labels' => array(
				// 'name' => _x('locations', 'taxonomy general name', 'realestate'),
				'name' => 'locations',
				'singular_name' => 'locations',
				'search_items' => 'Search locations',
				'popular_items' => 'Popular locations',
				'all_items' => 'All locations',
				'parent_item' => __( 'Parent locations', 'realestate' ),
  				'parent_item_colon' => __( 'Parent locations:' ),
				'edit_item' => __( 'Edit locations', 'realestate' ), 
				'update_item' => __( 'Update locations', 'realestate' ),
				'add_new_item' => __( 'Add New locations', 'realestate' ),
				'new_item_name' => __( 'New locations' , 'realestate'),
				'separate_items_with_commas' => __( 'Separate locations with commas', 'realestate' ),
				'add_or_remove_items' => __( 'Add or Remove locations' , 'realestate'),
				'choose_from_most_used' => __( 'Choose from the most used locations', 'realestate' ),
				'menu_name' => 'Locations',
			),
			'hierarchical' => true,
			'show_ui' => true, // hide from menu
			'query_var' => true,
			'rewrite' => array( 'slug' => 'agents' ),
			'public' => true,
		)
	);
}
/* Add new Fields to agent  Taxonomy */
function realestaterightnow_add_agents_fields() {
	?>
   	<div class="form-field">
		<label for="term_meta[myorder]"><?php _e( 'Order:', 'realestaterightnow' ); ?></label></th>
		<input type="text" name="term_meta[myorder]" id="term_meta[myorder]" value="" >
        <p><?php _e( 'Order to display. For example: 1 (first), 2 (second) and so on ...', 'realestaterightnow' ); ?></p>
    </div>    
	<div class="form-field">
		<label for="series_image"><?php _e( 'Profile Image:', 'realestaterightnow' ); ?></label>
        <div class="image-preview"><img class="image-preview" style="max-width: 150px;"></div>
		<br /><br />
        <input type="text" name="term_meta[image]" id="term_meta[image]" class="term_meta_image" value="">
    	<br />
            <p><?php _e( 'Just click the Button to Select Upload Image', 'realestaterightnow' ); ?></p>
        <input class="upload_image_button button" name="_add_series_image" id="_add_series_image" type="button" value="Select/Upload Image" />
		<input class="remove_image_button button" name="_remove_series_image" id="_remove_series_image" type="button" value="Remove Image" />
        <br /><br />
    </div>
  	<div class="form-field">
		<label for="term_meta[function]"><?php _e( 'Position:', 'realestaterightnow' ); ?></label>
		<input type="text" name="term_meta[function]" id="term_meta[function]" value="" >
        <p><?php _e( 'For example: Sales Manager, Agent, and so on ...', 'realestaterightnow' ); ?></p>
    </div> 
 	<div class="form-field">
		<label for="term_meta[phone]"><?php _e( 'Phone:', 'realestaterightnow' ); ?></label>
		<input type="text" name="term_meta[phone]" id="term_meta[phone]" class="term_meta[phone]" value="">
    </div>   
 	<div class="form-field">
		<label for="term_meta[email]"><?php _e( 'Email address:', 'realestaterightnow' ); ?></label>
		<input type="text" name="term_meta[email]" id="term_meta[email]" class="term_meta[email]" value="">
    </div>      
 	<div class="form-field">
		<label for="term_meta[skype]"><?php _e( 'Skype:', 'realestaterightnow' ); ?></label>
		<input type="text" name="term_meta[skype]" id="term_meta[skype]" class="term_meta[skype]" value="">
    </div>     
 	<div class="form-field">
		<label for="term_meta[facebook]"><?php _e( 'Facebook URL:', 'realestaterightnow' ); ?></label>
		<input type="text" name="term_meta[facebook]" id="term_meta[facebook]" class="term_meta[facebook]" value="">
    </div> 
  	<div class="form-field">
		<label for="term_meta[twitter]"><?php _e( 'Twitter URL:', 'realestaterightnow' ); ?></label>
		<input type="text" name="term_meta[twitter]" id="term_meta[twitter]" class="term_meta[twitter]" value="">
    </div>
    <div class="form-field">
		<label for="term_meta[linkedin]"><?php _e( 'Linkedin URL:', 'realestaterightnow' ); ?></label>
		<input type="text" name="term_meta[linkedin]" id="term_meta[linkedin]" class="term_meta[linkedin]" value="">
    </div>
    <div class="form-field">
		<label for="term_meta[youtube]"><?php _e( 'Youtube URL:', 'realestaterightnow' ); ?></label>
		<input type="text" name="term_meta[youtube]" id="term_meta[youtube]" class="term_meta[youtube]" value="">
    </div>  
    <div class="form-field"
		<label for="term_meta[instagram]"><?php _e( 'Instagram URL:', 'realestaterightnow' ); ?></label>
		<input type="text" name="term_meta[instagram]" id="term_meta[instagram]" class="term_meta[instazgram]" value="">
    </div>  
    <div class="form-field">
		<label for="term_meta[vimeo]"><?php _e( 'Vimeo URL:', 'realestaterightnow' ); ?></label>
		<input type="text" name="term_meta[vimeo]" id="term_meta[vimeo]" class="term_meta[vimeo]" value="">
    </div>         
<script>
			jQuery(document).ready(function() {
				jQuery('#_add_series_image').click(function() {
					wp.media.editor.send.attachment = function(props, attachment) {
						jQuery('.term_meta_image').val(attachment.url);
                        jQuery('.image-preview').attr('style','display:block');  
                        jQuery('.image-preview').attr('style','width:150px'); 
                        jQuery('.image-preview').attr('src',attachment.url);  
					}
					wp.media.editor.open(this);
					return false;
				});
 				jQuery('#_remove_series_image').click(function() {
						jQuery('.term_meta_image').val('');
                        jQuery('.image-preview').attr('style','display:none');  
                        jQuery('.profile_old').attr('style','display:none');  
					return false;
				});
                 jQuery('#submit').click(function() {
                        jQuery('.image-preview').attr('style','display:none');  
                        jQuery('.profile_old').attr('style','display:none');  
					return false;
				}); 
			});
</script>            
<?php
}
add_action( 'agents_add_form_fields', 'realestaterightnow_add_agents_fields', 10, 2 );
function realestaterightnow_edit_agents_fields($term) {
 $termMeta = get_option( 'agents_' . $term->term_id );
	?>
    <tr class="form-field">
    <th scope="row" valign="top">
		<label for="term_meta[myorder]"><?php _e( 'Order:', 'realestaterightnow' ); ?></label></th>
		<td>
        <input type="text" name="term_meta[myorder]" id="term_meta[myorder]" value="<?php if(!empty($termMeta['myorder'])){ esc_attr_e($termMeta['myorder']); } ?>" >
        <br /><i><?php _e( 'Order to display. For example: 1 (first), 2 (second) and so on ...', 'realestaterightnow' ); ?></i>
        </td>
   	</tr>   
      <tr class="form-field">    
      <th scope="row" valign="top">      
		<label for="term_meta[image]"><?php _e( 'Profile Image:', 'realestaterightnow' ); ?></label>
        <td>
        <div class="image-preview">
        <img class="image-preview" style="max-width: 150px;">
          <?php
           if(!empty($termMeta['image']))
            {
              $image_url = esc_url($termMeta['image']); 
              echo '<img class = "profile_old" src="'.$image_url.'" width="150px" />';
            }
          ?>      
        </div>
		<br /><br />
        <input type="text" name="term_meta[image]" id="term_meta[image]" class="term_meta_image" value="<?php if(!empty($termMeta['image'])){ esc_attr_e($termMeta['image']); } ?>">
    	<br /><br />
        <input class="upload_image_button button" name="_add_series_image" id="_add_series_image" type="button" value="Select/Upload Image" />
		<input class="remove_image_button button" name="_remove_series_image" id="_remove_series_image" type="button" value="Remove Image" />
        <br /><i><?php _e( 'Just click the Button to Select Upload Image', 'realestaterightnow' ); ?></i>
        </td>
   	</tr> 
    <tr class="form-field">
    <th scope="row" valign="top">
		<label for="term_meta[function]"><?php _e( 'Position:', 'realestaterightnow' ); ?></label></th>
		<td>
        <input type="text" name="term_meta[function]" id="term_meta[function]" value="<?php if(!empty($termMeta['function'])){ esc_attr_e($termMeta['function']); } ?>" >
        <br /><i><?php _e( 'For example: Sales Manager, Agent, and so on ...', 'realestaterightnow' ); ?></i>
        </td>
   	</tr>
    <tr class="form-field">
    <th scope="row" valign="top">
		<label for="term_meta[phone]"><?php _e( 'Phone:', 'realestaterightnow' ); ?></label></th>
		<td>
        <input type="text" name="term_meta[phone]" id="term_meta[phone]" value="<?php if(!empty($termMeta['phone'])){ esc_attr_e($termMeta['phone']); } ?>" >
        </td>
   	</tr>  
    <tr class="form-field">
    <th scope="row" valign="top">
		<label for="term_meta[email]"><?php _e( 'Email address:', 'realestaterightnow' ); ?></label></th>
		<td>
        <input type="text" name="term_meta[email]" id="term_meta[email]" value="<?php if(!empty($termMeta['email'])){ esc_attr_e($termMeta['email']); } ?>" >
        </td>
   	</tr>     
    <tr class="form-field">
    <th scope="row" valign="top">
		<label for="term_meta[skype]"><?php _e( 'Skype:', 'realestaterightnow' ); ?></label></th>
		<td>
        <input type="text" name="term_meta[skype]" id="term_meta[skype]" value="<?php if(!empty($termMeta['skype'])){ esc_attr_e($termMeta['skype']); } ?>" >
        </td>
   	</tr> 
    <tr class="form-field">
    <th scope="row" valign="top">
		<label for="term_meta[facebook]"><?php _e( 'Facebook URL:', 'realestaterightnow' ); ?></label></th>
		<td>
        <input type="text" name="term_meta[facebook]" id="term_meta[facebook]" value="<?php if(!empty($termMeta['facebook'])){ esc_attr_e($termMeta['facebook']); } ?>" >
        </td>
   	</tr> 
    <tr class="form-field">
    <th scope="row" valign="top">
		<label for="term_meta[twitter]"><?php _e( 'Twitter URL:', 'realestaterightnow' ); ?></label></th>
		<td>
        <input type="text" name="term_meta[twitter]" id="term_meta[twitter]" value="<?php if(!empty($termMeta['twitter'])){ esc_attr_e($termMeta['twitter']); } ?>" >
        </td>
   	</tr>
    <tr class="form-field">
    <th scope="row" valign="top">
		<label for="term_meta[linkedin]"><?php _e( 'Linkedin URL:', 'realestaterightnow' ); ?></label></th>
		<td>
        <input type="text" name="term_meta[linkedin]" id="term_meta[linkedin]" value="<?php if(!empty($termMeta['linkedin'])){ esc_attr_e($termMeta['linkedin']); } ?>" >
        </td>
   	</tr>   
    <tr class="form-field">
    <th scope="row" valign="top">
		<label for="term_meta[youtube]"><?php _e( 'Youtube URL:', 'realestaterightnow' ); ?></label></th>
		<td>
        <input type="text" name="term_meta[youtube]" id="term_meta[youtube]" value="<?php if(!empty($termMeta['youtube'])){ esc_attr_e($termMeta['youtube']); } ?>" >
        </td>
   	</tr>
    <tr class="form-field">
    <th scope="row" valign="top">
		<label for="term_meta[instagram]"><?php _e( 'Instagram URL:', 'realestaterightnow' ); ?></label></th>
		<td>
        <input type="text" name="term_meta[instagram]" id="term_meta[instagram]" value="<?php if(!empty($termMeta['instagram'])){ esc_attr_e($termMeta['instagram']); } ?>" >
        </td>
   	</tr>
    <tr class="form-field">
    <th scope="row" valign="top">
		<label for="term_meta[vimeo]"><?php _e( 'Vimeo URL:', 'realestaterightnow' ); ?></label></th>
		<td>
        <input type="text" name="term_meta[vimeo]" id="term_meta[vimeo]" value="<?php if(!empty($termMeta['vimeo'])){ esc_attr_e($termMeta['vimeo']); } ?>" >
        </td>
   	</tr>   
<script>
			jQuery(document).ready(function() {
				jQuery('#_add_series_image').click(function() {
					wp.media.editor.send.attachment = function(props, attachment) {
						jQuery('.term_meta_image').val(attachment.url);
                        jQuery('.image-preview').attr('src',attachment.url);  
                        jQuery('.profile_old').attr('style','display:none');  
                        jQuery('.image-preview').attr('style','display:block');  
                        jQuery('.image-preview').attr('style','width:150px'); 
                        jQuery('.image-preview').attr('src',attachment.url);  
                    }
					wp.media.editor.open(this);
					return false;
				});
 				jQuery('#_remove_series_image').click(function() {
						jQuery('.term_meta_image').val('');
                        jQuery('.image-preview').attr('style','display:none');  
                        jQuery('.profile_old').attr('style','display:none');  
					return false;
				}); 
			});
</script>  
<?php 
}
add_action( 'agents_edit_form_fields', 'realestaterightnow_edit_agents_fields', 10, 2 );
/**
 * Save the taxonomy custom meta
 */
function realestaterightnow_save_agents_fields($termId)
{
    if ( !empty( $_POST['term_meta'] ) )
    {
        $term_meta = get_option( 'agents_' . $termId );
        foreach ( $_POST['term_meta'] as $key => $val )
        {
            $term_meta[$key] = sanitize_text_field($val);
        }
        update_option( 'agents_' . $termId, $term_meta );
    }
}
/**
* Save the category data
*/
add_action( 'edited_agents', 'realestaterightnow_save_agents_fields');
add_action( 'create_agents', 'realestaterightnow_save_agents_fields');
//////////////
function realestate_custom_listing_save_data($post_id) {
    global $meta_box,  $post;
    if( isset($_POST['listing_meta_box_nonce']))
    {
        if (!wp_verify_nonce($_POST['listing_meta_box_nonce'], basename(__FILE__))) {
            return $post_id;
        }
    }
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return $post_id;
    }
    if ( isset($_POST['post_type']))
     { 
        if ('page' == sanitize_text_field($_POST['post_type'])) {
            if (!current_user_can('edit_page', $post_id)) {
                return $post_id;
            }
        } elseif (!current_user_can('edit_post', $post_id)) {
            return $post_id;
        }
    }
}
add_action('save_post', 'realestate_custom_listing_save_data');
add_image_size('featured_preview', 55, 55, true);
 // GET FEATURED IMAGE
function RealEstate_get_featured_image($post_ID) {
    $post_thumbnail_id = get_post_thumbnail_id($post_ID);
    if ($post_thumbnail_id) {
        $post_thumbnail_img = wp_get_attachment_image_src($post_thumbnail_id, 'featured_preview');
        return $post_thumbnail_img[0];
    }
}
// ADD NEW COLUMN
add_action('admin_head', 'RealEstate_my_admin_custom_styles');
function RealEstate_my_admin_custom_styles() {
    $output_css = '<style type="text/css">
        .featured_image { width:150px !important; overflow:hidden }
    </style>';
    echo $output_css;
}
function RealEstate_columns_head($defaults) {
    $defaults['product-price'] = 'Price';
    $defaults['featured_image'] = __('Featured Image');
    $defaults['product-featured'] = 'Featured';
    $defaults['product-year'] = 'Year';
    return $defaults;
}
// SHOW THE FEATURED IMAGE
function RealEstate_columns_content($column_name, $post_ID) {
    if ($column_name == 'featured_image') {
        $post_featured_image = RealEstate_get_featured_image($post_ID);
 		$image_id = get_post_thumbnail_id($post_ID);
		$image_url = wp_get_attachment_image_src($image_id,'medium', true);	
		$image = str_replace("-".$image_url[1]."x".$image_url[2], "", $image_url[0]);
        $thumb = RealEstate_theme_thumb($image, 150, 75, 'br'); // Crops from bottom right
        if ($post_featured_image) {
            echo '<img src="' . $thumb . '" width="150px" height="75px" />';
        }
        else
          {
            echo '<img src="'.REALESTATEURL.'assets/images/image-no-available.jpg" width="100px" />';}
    }
    elseif ($column_name == 'product-year'){
         echo get_post_meta( $post_ID, 'product-year', true ); 
    }
    elseif ($column_name == 'product-price'){
         $price = get_post_meta( $post_ID, 'product-price', true );
         if(! empty($price)) 
            echo  realestate_currency() . $price ; 
         else
            echo  __('Call For Price', 'realestate', 'realestate');
    }
    elseif ($column_name == 'product-featured'){
         $r = get_post_meta( $post_ID, 'product-featured', true ); 
         if($r == 'enabled')
           {echo 'Yes';}
         else
           {echo 'No';}
    }
}
if(isset($_GET['post_type'])){
    if (sanitize_text_field($_GET['post_type']) == 'products')
      {
        add_filter('manage_posts_columns', 'RealEstate_columns_head');
        add_action('manage_posts_custom_column', 'RealEstate_columns_content', 10, 2);
      }
  }