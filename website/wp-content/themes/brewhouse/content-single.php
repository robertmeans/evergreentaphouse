<?php
/**
 * @package brewhouse
 */
?>


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
					<?php } // end tipsy background if ?> data" data-depth="0.40"><h2><?php the_title( '<h1 class="page-entry-title">', '</h1>' ); ?></h2>
            	</div><!-- layer --> 
             
            	<div class="<?php if( get_theme_mod( 'disable_tipsy' ) == '') { ?>
        			<?php echo ( 'layer' ); ?>
					<?php } // end tipsy background if ?> data" data-depth="0.80"><a href="#jump-to"><i class="fa fa-angle-down"></i></a>
            	</div><!-- layer --> 
            
            </div><!-- page-entry-header -->  
        
        </div><!-- #scene --> 
	</header><!-- .entry-header --> 
   
	<?php else :  ?>
    
   	<header class="entry-header">  
		<div id="scene">
          
            <div class="page-entry-header">
        	
            	<div class="<?php if( get_theme_mod( 'disable_tipsy' ) == '') { ?>
        			<?php echo ( 'layer' ); ?>
					<?php } // end tipsy background if ?> data" data-depth="0.40"><h2><?php the_title( '<h1 class="page-entry-title">', '</h1>' ); ?></h2>
            	</div><!-- layer --> 
             
            	<div class="<?php if( get_theme_mod( 'disable_tipsy' ) == '') { ?>
        			<?php echo ( 'layer' ); ?>
					<?php } // end tipsy background if ?> data" data-depth="0.80"><a href="#jump-to"><i class="fa fa-angle-down"></i></a>
            	</div><!-- layer --> 
            
            </div><!-- page-entry-header -->  
        
        </div><!-- #scene --> 
	</header><!-- .entry-header --> 
	
	<?php endif; ?>

	<div id="jump-to" class="entry-content">
		<div class="grid grid-pad">
			<div class="col-1-1">
				<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
					<header> 
						<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>

						<div class="entry-meta">
							<?php brewhouse_posted_on(); ?>
						</div><!-- .entry-meta -->
					</header><!-- .entry-header -->

					<div class="entry-content">
						<?php the_content(); ?>
						<?php
							wp_link_pages( array(
							'before' => '<div class="page-links">' . __( 'Pages:', 'brewhouse' ),
							'after'  => '</div>',
							) );
						?>
					</div><!-- .entry-content -->

					<footer class="col-1-1 entry-footer">
					<?php
					/* translators: used between list items, there is a space after the comma */
					$category_list = get_the_category_list( __( ', ', 'brewhouse' ) );

					/* translators: used between list items, there is a space after the comma */
					$tag_list = get_the_tag_list( '', __( ', ', 'brewhouse' ) );

					if ( ! brewhouse_categorized_blog() ) {
					// This blog only has 1 category so we just need to worry about tags in the meta text
					if ( '' != $tag_list ) {
					$meta_text = __( 'This entry was tagged %2$s. Bookmark the <a href="%3$s" rel="bookmark">permalink</a>.', 'brewhouse' );
					} else {
					$meta_text = __( 'Bookmark the <a href="%3$s" rel="bookmark">permalink</a>.', 'brewhouse' );
					}
					} else {
					// But this blog has loads of categories so we should probably display them here
					if ( '' != $tag_list ) {
					$meta_text = __( 'This entry was posted in %1$s and tagged %2$s. Bookmark the <a href="%3$s" rel="bookmark">permalink</a>.', 'brewhouse' );
					} else {
					$meta_text = __( 'This entry was posted in %1$s. Bookmark the <a href="%3$s" rel="bookmark">permalink</a>.', 'brewhouse' );
					}
					} // end check for categories on this blog

					printf(
					$meta_text,
					$category_list,
					$tag_list,
					get_permalink()
					);
					?>

					<?php edit_post_link( __( 'Edit', 'brewhouse' ), '<span class="edit-link">', '</span>' ); ?>
					</footer><!-- .entry-footer -->
                </article><!-- #post-## -->
			</div><!-- col-1-1 -->
		</div><!-- grid -->
	</div><!-- content --> 