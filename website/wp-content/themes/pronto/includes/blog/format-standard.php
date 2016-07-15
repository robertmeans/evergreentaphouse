<?php
  if ( function_exists( 'get_option_tree') ) {
       	$theme_options = get_option('option_tree');  
  } 
	if( !isset($theme_options['blog_style'])) { $blog_style = "standard-right-sidebar"; }
  else { $blog_style = $theme_options['blog_style']; }
?>
    <?php if ( $blog_style != "masonry" || is_singular() ) { ?>

    
<?php if (has_post_thumbnail()) {
?><div class="blog-thumbnail">

    <a class="prettyPhoto" data-rel="prettyPhoto" href="<?php echo wp_get_attachment_url(get_post_thumbnail_id(get_the_ID())); ?>"><?php the_post_thumbnail(); ?></a>

    <div class="clearfix"></div>
</div>
<?php
}
?>
<div class="postdata">
    <?php if ( is_singular() ) { ?>
    <h1 class="blog-title"><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>"><?php the_title(); ?></a></h1>
    <?php }
    else { ?>
    <h3 class="blog-title"><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>"><?php the_title(); ?></a></h3>
    <?php } ?>           
</div>
    <?php } 
  
    elseif (  $blog_style == "masonry" && ! is_singular() ) { ?>
<?php if (has_post_thumbnail()) {
?><div class="blog-thumbnail">

    <a class="prettyPhoto" data-rel="prettyPhoto" href="<?php echo wp_get_attachment_url(get_post_thumbnail_id(get_the_ID())); ?>"><?php the_post_thumbnail(); ?></a>

    <div class="clearfix"></div>
</div>
<?php
                }
    ?>
<div class="postdata">
  	<h3 class="blog-title"><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>"><?php the_title(); ?></a></h3>

    <p class="blog-meta">
        <?php the_time('j F Y'); ?><i class="fa fa-circle"></i>
        <a href="<?php comments_link(); ?>"><?php comments_number( __('0', 'bliccaThemes'), __('1', 'bliccaThemes'), __('%', 'bliccaThemes') ); ?> <?php echo esc_html_e('Comments', 'bliccaThemes');?></a><i class="fa fa-circle"></i>
        <?php the_category('<span>,</span> '); ?>
    </p>              
</div>
		<?php } ?>