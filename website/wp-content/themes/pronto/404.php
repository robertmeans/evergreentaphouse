<?php get_header();?>

<div class="bliccaThemes-waypoint" data-animate-down="on-sticky" data-animate-up="off-sticky">  
<div class="error-page">
  <div class="container">
    <div class="row">
<p><span><strong><?php echo esc_html_e('404', 'bliccaThemes');?></strong> <?php echo esc_html_e('Something went wrong here!', 'bliccaThemes');?></span><br>
            <?php echo esc_html_e('Oops! Sorry, an error has occured. Requested page not found!', 'bliccaThemes');?></p>
    <span class="buton b_asset buton-2 buton-large"><a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php echo esc_html_e('GET ME BACK TO HOME PAGE', 'bliccaThemes');?></a></span>
    </div>
  </div>
</div>
</div>
<?php get_footer();?>

