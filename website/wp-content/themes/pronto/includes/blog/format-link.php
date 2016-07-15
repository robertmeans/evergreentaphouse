<div class="quoto-link-image">
	
  <?php 
	$bliccaThemes_format = "quoto-link-over no-image";
  if ( !has_post_thumbnail() ) {
  $bliccaThemes_format = "quoto-link-over no-image";  
  }
  ?>
	<div class="<?php echo esc_html($bliccaThemes_format); ?>">
    <i class="fa fa-link"></i>
		<a href="<?php the_permalink(); ?>"><h3 class="quoto-link-content"><?php the_title(); ?></h3></a>
		<h5 class="quoto-link-name"><?php echo get_the_content(); ?></h5>
	</div>	
</div>