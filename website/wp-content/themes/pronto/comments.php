<?php
// Do not delete these lines
    if (!empty($_SERVER['SCRIPT_FILENAME']) && 'comments.php' == basename($_SERVER['SCRIPT_FILENAME']))
        die ('Please do not load this page directly. Thanks!');

    if ( post_password_required() ) { ?>
        <p class="nocomments" style="margin-bottom:0px;"><?php echo esc_attr_e('This post is password protected. Enter the password to view comments.', 'bliccaThemes'); ?></p>
    <?php
        return;
    }
?>
 
    <?php // You can start editing here -- including this comment! ?>
 
    <?php if ( have_comments() ) : ?>
        

        <?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // are there comments to navigate through? If so, show navigation ?>
        <nav role="navigation" id="comment-nav-above" class="site-navigation comment-navigation">
            <h4 class="assistive-text"><?php echo esc_html_e( 'Comment navigation', 'bliccaThemes' ); ?></h4>
            <div class="nav-previous"><?php previous_comments_link( __( '&larr; Older Comments', 'bliccaThemes' ) ); ?></div>
            <div class="nav-next"><?php next_comments_link( __( 'Newer Comments &rarr;', 'bliccaThemes' ) ); ?></div>
        </nav><!-- #comment-nav-before .site-navigation .comment-navigation -->
        <?php endif; // check for comment navigation ?>
 
        <ol class="commentlist">
          <h3 class="comment-title"><?php comments_number( 'No Comment', '1 Comment', '% Comments' ); ?></h3>
            <?php
                /* Loop through and list the comments. Tell wp_list_comments()
                 */
                wp_list_comments( array( 'callback' => 'bliccaThemes_comment' ) );
            ?>
        </ol><!-- .commentlist -->
 
        <?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // are there comments to navigate through? If so, show navigation ?>
        <nav role="navigation" id="comment-nav-below" class="site-navigation comment-navigation">
            <h4 class="assistive-text"><?php echo esc_html_e( 'Comment navigation', 'bliccaThemes' ); ?></h4>
            <div class="nav-previous"><?php previous_comments_link( __( '&larr; Older Comments', 'bliccaThemes' ) ); ?></div>
            <div class="nav-next"><?php next_comments_link( __( 'Newer Comments &rarr;', 'bliccaThemes' ) ); ?></div>
        </nav><!-- #comment-nav-below .site-navigation .comment-navigation -->
        <?php endif; // check for comment navigation ?>
 
    <?php endif; // have_comments() ?>
 
    <?php
        // If comments are closed and there are comments, let's leave a little note, shall we?
        if ( ! comments_open() && '0' != get_comments_number() && post_type_supports( get_post_type(), 'comments' ) ) :
    ?>
        <p class="nocomments"><?php echo esc_html_e( 'Comments are closed.', 'bliccaThemes' ); ?></p>
    <?php endif; ?>

    <?php // comment form ?>
    <div id ="commentrespond" class="comment-respond">
 
                <?php if ( get_option('comment_registration') && !$user_ID ) : ?>
                <p><?php echo esc_html_e("You must be ",'bliccaThemes');?><a href="<?php echo esc_url(get_option('siteurl')); ?>/wp-login.php?redirect_to=<?php echo urlencode(get_permalink()); ?>"><?php echo esc_attr_e("logged in",'bliccaThemes');?></a> <?php echo esc_attr_e("to post a comment.",'bliccaThemes');?></p><div id="cancel-comment-reply">
                <small><?php cancel_comment_reply_link() ?></small></div>

                <?php else : ?>
                <?php comment_form(); ?>
                <?php endif; // if you delete this the sky will fall on your head ?>
	
    </div>