<?php
/**
 * The template for displaying search results pages
 *
 * @package real-estate-right-now
 * @subpackage Real_estate
 * @since real estate 1.0
 */
get_header(); ?>
	<section id="primary" class="content-area">
		<main id="main" class="site-main" role="main">
		<?php if ( have_posts() ) : ?>
			<header class="page-header">
            <div class="page-search">
				<img src="<?php echo esc_url(get_template_directory_uri()).'/images/search2.png'?>" alt="<?php esc_attr_e( 'Not Found', 'real-estate-right-now' ); ?>" />
            </div>
    			<h1 class="page-title"><?php printf( esc_attr( __( 'Search Results for: %s', 'real-estate-right-now' )), '<span>' . esc_html( get_search_query() ) . '</span>' ); ?></h1>
			</header><!-- .page-header -->
			<?php
			// Start the loop.
			while ( have_posts() ) : the_post();
				/**
				 * Run the loop for the search to output the results.
				 * If you want to overload this in a child theme then include a file
				 * called content-search.php and that will be used instead.
				 */
				get_template_part( 'template-parts/content', 'search' );
			// End the loop.
			endwhile;
			// Previous/next page navigation.
			the_posts_pagination( array(
				'prev_text'          => __( 'Previous page', 'real-estate-right-now' ),
				'next_text'          => __( 'Next page', 'real-estate-right-now' ),
				'before_page_number' => '<span class="meta-nav screen-reader-text">' . __( 'Page', 'real-estate-right-now' ) . ' </span>',
			) );
		// If no content, include the "No posts found" template.
		else :
			get_template_part( 'template-parts/content', 'none' );
		endif;
		?>
		</main><!-- .site-main -->
	</section><!-- .content-area -->
<?php get_sidebar(); ?>
<?php get_footer(); ?>