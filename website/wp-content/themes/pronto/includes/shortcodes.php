<?php

/***************************/
/*      Share Your Page    */
/***************************/
function bliccaThemes_share_widget(){
$thumb_src = wp_get_attachment_image_src( get_post_thumbnail_id(), 'full', true );
    ?>
<div class="socials-share">
         <div class="share-text"><?php echo esc_attr_e('Share', 'bliccaThemes'); ?>:</div>
         <div class="facebook-share" data-url="<?php esc_js(the_permalink());?>" data-title="<?php esc_js(the_title());?>"><i class="fa fa-facebook"></i></div>
         <div class="google-share" data-url="<?php esc_js(the_permalink());?>" data-title="<?php esc_js(the_title());?>"><i class="fa fa-google-plus"></i></div>
         <div class="twitter-share" data-url="<?php esc_js(the_permalink());?>" data-title="<?php esc_js(the_title());?>"><i class="fa fa-twitter"></i></div>
         <div class="pinterest-share" data-url="<?php esc_js(the_permalink());?>" data-title="<?php esc_js(the_title());?>" data-img="<?php echo esc_js($thumb_src[0]); ?>"><i class="fa fa-pinterest"></i></div>
</div><?php
}