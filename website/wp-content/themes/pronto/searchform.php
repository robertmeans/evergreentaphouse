<div class="search">
        <form method="get" action="<?php echo esc_url(home_url()); ?>">
            <input type="text" name="s" class="search-query" placeholder="<?php echo esc_attr_e('Type and hit enter to search', 'bliccaThemes');?>" value="<?php the_search_query(); ?>">
            <button class="search-icon" type="submit"><i class="fa fa-search"></i></button>     
        </form>
 </div>