<?php
/**
 * The template for displaying archive pages.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package brewhouse
 */

get_header(); ?>

	<?php if (has_post_thumbnail( $post->ID ) ): 
	$image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'single-post-thumbnail' );
	$image = $image[0];  ?>
    
    <header class="entry-header">  
		<div id="scene"> 
            <img class="<?php if( get_theme_mod( 'disable_tipsy' ) == '') { ?> 
        	<?php echo ( 'layer' ); ?>
			<?php } // end tipsy background if ?> page-header" data-depth="0.10" src="<?php echo $image; ?>" alt="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>"> 
            <div class="page-entry-header">
        	<div class="<?php if( get_theme_mod( 'disable_tipsy' ) == '') { ?>
        	<?php echo ( 'layer' ); ?>
			<?php } // end tipsy background if ?> data" data-depth="0.40">
            	<h1 class="page-entry-title">
				<?php
						if ( is_category() ) :
							single_cat_title();

						elseif ( is_tag() ) :
							single_tag_title();

						elseif ( is_author() ) :
							printf( __( 'Author: %s', 'brewhouse' ), '<span class="vcard">' . get_the_author() . '</span>' );

						elseif ( is_day() ) :
							printf( __( 'Day: %s', 'brewhouse' ), '<span>' . get_the_date() . '</span>' );

						elseif ( is_month() ) :
							printf( __( 'Month: %s', 'brewhouse' ), '<span>' . get_the_date( _x( 'F Y', 'monthly archives date format', 'brewhouse' ) ) . '</span>' );

						elseif ( is_year() ) :
							printf( __( 'Year: %s', 'brewhouse' ), '<span>' . get_the_date( _x( 'Y', 'yearly archives date format', 'brewhouse' ) ) . '</span>' );

						elseif ( is_tax( 'post_format', 'post-format-aside' ) ) :
							_e( 'Asides', 'brewhouse' );

						elseif ( is_tax( 'post_format', 'post-format-gallery' ) ) :
							_e( 'Galleries', 'brewhouse' );

						elseif ( is_tax( 'post_format', 'post-format-image' ) ) :
							_e( 'Images', 'brewhouse' );

						elseif ( is_tax( 'post_format', 'post-format-video' ) ) :
							_e( 'Videos', 'brewhouse' );

						elseif ( is_tax( 'post_format', 'post-format-quote' ) ) :
							_e( 'Quotes', 'brewhouse' );

						elseif ( is_tax( 'post_format', 'post-format-link' ) ) :
							_e( 'Links', 'brewhouse' );

						elseif ( is_tax( 'post_format', 'post-format-status' ) ) :
							_e( 'Statuses', 'brewhouse' );

						elseif ( is_tax( 'post_format', 'post-format-audio' ) ) :
							_e( 'Audios', 'brewhouse' );

						elseif ( is_tax( 'post_format', 'post-format-chat' ) ) :
							_e( 'Chats', 'brewhouse' );

						else :
							_e( 'Archives', 'brewhouse' );

						endif;
					?>
            
            	</h1><!-- .page-entry-title -->
            </div><!-- .layer -->
            
            	<div class="<?php if( get_theme_mod( 'disable_tipsy' ) == '') { ?>
        		<?php echo ( 'layer' ); ?>
				<?php } // end if ?> data" data-depth="0.80"><a href="#jump-to"><i class="fa fa-angle-down"></i></a>
            	</div><!-- layer -->
            </div><!-- page-entry-header -->
            </div><!-- scene -->
            
            <?php
					// Show an optional term description.
					$term_description = term_description();
					if ( ! empty( $term_description ) ) :
						printf( '<div class="taxonomy-description">%s</div>', $term_description );
					endif;
				?>
</header><!-- .entry-header -->
   
	<?php else :  ?>
    
   	<header class="entry-header">  
		<div id="scene"> 
            <div class="page-entry-header">
        	<div class="<?php if( get_theme_mod( 'disable_tipsy' ) == '') { ?>
        	<?php echo ( 'layer' ); ?>
			<?php } // end tipsy background if ?> data" data-depth="0.40">
            	<h1 class="page-entry-title">
				<?php
						if ( is_category() ) :
							single_cat_title();

						elseif ( is_tag() ) :
							single_tag_title();

						elseif ( is_author() ) :
							printf( __( 'Author: %s', 'brewhouse' ), '<span class="vcard">' . get_the_author() . '</span>' );

						elseif ( is_day() ) :
							printf( __( 'Day: %s', 'brewhouse' ), '<span>' . get_the_date() . '</span>' );

						elseif ( is_month() ) :
							printf( __( 'Month: %s', 'brewhouse' ), '<span>' . get_the_date( _x( 'F Y', 'monthly archives date format', 'brewhouse' ) ) . '</span>' );

						elseif ( is_year() ) :
							printf( __( 'Year: %s', 'brewhouse' ), '<span>' . get_the_date( _x( 'Y', 'yearly archives date format', 'brewhouse' ) ) . '</span>' );

						elseif ( is_tax( 'post_format', 'post-format-aside' ) ) :
							_e( 'Asides', 'brewhouse' );

						elseif ( is_tax( 'post_format', 'post-format-gallery' ) ) :
							_e( 'Galleries', 'brewhouse' );

						elseif ( is_tax( 'post_format', 'post-format-image' ) ) :
							_e( 'Images', 'brewhouse' );

						elseif ( is_tax( 'post_format', 'post-format-video' ) ) :
							_e( 'Videos', 'brewhouse' );

						elseif ( is_tax( 'post_format', 'post-format-quote' ) ) :
							_e( 'Quotes', 'brewhouse' );

						elseif ( is_tax( 'post_format', 'post-format-link' ) ) :
							_e( 'Links', 'brewhouse' );

						elseif ( is_tax( 'post_format', 'post-format-status' ) ) :
							_e( 'Statuses', 'brewhouse' );

						elseif ( is_tax( 'post_format', 'post-format-audio' ) ) :
							_e( 'Audios', 'brewhouse' );

						elseif ( is_tax( 'post_format', 'post-format-chat' ) ) :
							_e( 'Chats', 'brewhouse' );

						else :
							_e( 'Archives', 'brewhouse' );

						endif;
					?>
            
            	</h1><!-- .page-entry-title -->
            </div><!-- .layer -->
            
            	<div class="<?php if( get_theme_mod( 'disable_tipsy' ) == '') { ?>
        		<?php echo ( 'layer' ); ?>
				<?php } // end if ?> data" data-depth="0.80"><a href="#jump-to"><i class="fa fa-angle-down"></i></a>
            	</div><!-- layer -->
            </div><!-- page-entry-header -->
            </div><!-- scene -->
            
            <?php
					// Show an optional term description.
					$term_description = term_description();
					if ( ! empty( $term_description ) ) :
						printf( '<div class="taxonomy-description">%s</div>', $term_description );
					endif;
				?>
</header><!-- .entry-header -->
	
	<?php endif; ?>

		<div id="jump-to" class="entry-content">
            <div class="grid grid-pad blog-archive">
                <div class="col-1-1 text-center">

				<?php if ( have_posts() ) : ?>

				<?php /* Start the Loop */ ?>
				<?php while ( have_posts() ) : the_post(); ?>

				<?php
					/* Include the Post-Format-specific template for the content.
					 * If you want to override this in a child theme, then include a file
					 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
					 */
					get_template_part( 'content', get_post_format() );
				?>

				<?php endwhile; ?>

				<?php brewhouse_paging_nav(); ?>

				<?php else : ?>

				<?php get_template_part( 'content', 'none' ); ?>

				<?php endif; ?>

				</div><!-- .text-center -->
        	</div><!-- blog-archive -->
        </div><!-- entry-content --> 

<?php get_footer(); ?>
