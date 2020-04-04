<?php
/**
 * The template part for displaying a message that posts cannot be found
 *
 * @package real-estate-right-now
 * @subpackage Real_estate
 * @since real estate 1.0
 */
?>
<section class="no-results not-found">
	<header class="page-header">
		<h1 class="page-title"><?php esc_attr_e( 'Nothing Found', 'real-estate-right-now' ); ?></h1>
	</header><!-- .page-header -->
            <div class="content-none">
				<img src="<?php echo esc_url(get_template_directory_uri().'/images/search2.png')?>" alt="<?php esc_attr_e( 'Not Found', 'real-estate-right-now' ); ?>" />
			</div>
            <br /><br />
	<div class="page-content">
		<?php if ( is_home() && current_user_can( 'publish_posts' ) ) : ?>
			<p><?php printf( esc_attr( __( 'Ready to publish your first post? <a href="%1$s">Get started here</a>.', 'real-estate-right-now' )), esc_url( admin_url( 'post-new.php' ) ) ); ?></p>
		<?php elseif ( is_search() ) : ?>
			<p><?php esc_attr_e( 'Sorry, but nothing matched your search terms. Please try again with some different keywords.', 'real-estate-right-now' ); ?></p>
			<?php get_search_form(); ?>
		<?php else : ?>
			<p><?php esc_attr_e( 'It seems we can&rsquo;t find what you&rsquo;re looking for. Perhaps searching can help.', 'real-estate-right-now' ); ?></p>
			<?php get_search_form(); ?>
		<?php endif; ?>
	</div><!-- .page-content -->
</section><!-- .no-results -->