<div class="quoto-link-image">

  <?php 
	$bliccaThemes_format = "quoto-link-over no-image";
  if ( !has_post_thumbnail() ) {
  $bliccaThemes_format = "quoto-link-over no-image";  
  }
  ?>
	<div class="<?php echo esc_html($bliccaThemes_format); ?>">
    <i class="fa fa-quote-left"></i>
		<a href="<?php the_permalink(); ?>"><h3 class="quoto-link-content"><?php echo get_the_content(); ?></h3></a>
		<h5 class="quoto-link-name"><?php the_title(); ?></h5>
	</div>	
</div>