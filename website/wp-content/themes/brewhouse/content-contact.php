<?php
/**
 * The template used for displaying page content in page.php
 *
 * @package brewhouse
 */
?>

<?php 

if(isset($_POST['submitted'])) {

        if(trim($_POST['contactName']) === '') {
               $nameError = 'Please enter your name.';
               $hasError = true;
        } else {

               $name = trim($_POST['contactName']);
        }

        if(trim($_POST['email']) === '')  {
               $emailError = 'Please enter your email address.';
               $hasError = true;
        } else if (!preg_match("/^[[:alnum:]][a-z0-9_.-]*@[a-z0-9.-]+\.[a-z]{2,4}$/i", trim($_POST['email']))) {
               $emailError = 'You entered an invalid email address.';
               $hasError = true;
        } else {
               $email = trim($_POST['email']);
        }

        if(trim($_POST['comments']) === '') {
               $commentError = 'Please enter a message.';
               $hasError = true;
        } else {
               if(function_exists('stripslashes')) {
                      $comments = stripslashes(trim($_POST['comments']));
               } else {
                       $comments = trim($_POST['comments']);
               }
        }

        if(!isset($hasError)) {
               $emailTo = get_option('tz_email');
               if (!isset($emailTo) || ($emailTo == '') ){
                       $emailTo = get_option('admin_email');
               }
               $subject = 'New Contact Submission From '.$name;
               $body = "Name: $name \n\nEmail: $email \n\nComments: $comments";
               $headers = 'From: '.$name.' <'.$emailTo.'>' . "\r\n" . 'Reply-To: ' . $email;

               wp_mail($emailTo, $subject, $body, $headers);
               $emailSent = true;
        }
} ?>  


<?php if (has_post_thumbnail( $post->ID ) ): 
	$image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'single-post-thumbnail' );
	$image = $image[0];  ?>
    
     <header class="entry-header">
		<div id="scene">
            
            <img class="<?php if( get_theme_mod( 'disable_tipsy' ) == '') { ?>
        	<?php echo ( 'layer' ); ?>
			<?php } // end tipsy background if ?> page-header" data-depth="0.10" src="<?php echo $image; ?>" alt='<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>'>
            
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

	<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

		<div class="grid grid-pad">
			<div class="entry-content col-1-1"> 
    			<h2 class="underline"><span><?php the_title(); ?></span></h2>
 
				<?php the_content(); ?>
 
             	<?php if(isset($emailSent) && $emailSent == true) { ?>
             	<div><p>Thanks, your email was sent successfully.</p></div>
				<?php } else { ?>
                
						<?php if(isset($hasError) || isset($captchaError)) { ?> 
						<p>Sorry, an error occured.<p>
						<?php } ?>

						<form action="<?php the_permalink(); ?>" id="contactForm" method="post">
  						<ul class="contact-form">
						<li class="contact-name">
						 <input type="text" name="contactName" id="contactName" placeholder="Your Name" value="<?php if(isset($_POST['contactName'])) echo $_POST['contactName'];?>" />
							<?php if($nameError != '') { ?>
							<span><?php echo $nameError;?></span> 
							<?php } ?>
					 	</li>

						<li class="contact-email">
						<input type="text" name="email" id="email" placeholder="Your Email" value="<?php if(isset($_POST['email']))  echo $_POST['email'];?>" />
							<?php if($emailError != '') { ?>
							<span><?php echo $emailError;?></span>
							<?php } ?>
						</li>

 						<li class="contact-comments">
						<textarea name="comments" id="commentsText" placeholder="Your Message" rows="12" cols="30"><?php if(isset($_POST['comments'])) { if(function_exists('stripslashes')) { echo stripslashes($_POST['comments']); } else { echo $_POST['comments']; } } ?></textarea>
							<?php if($commentError != '') { ?>
							<span><?php echo $commentError;?></span> 
							<?php } ?>
						</li>

						<li>
						<input type="submit" class="contact-submit" value="Send Message"></input>
						</li>
						</ul>
						<input type="hidden" name="submitted" id="submitted" value="true" />
						</form>

                        <?php } ?> 

       
     	</div>
    	</div>     
  </article><!-- #post-## -->  