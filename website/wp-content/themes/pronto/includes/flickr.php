<?php

/*
Based on https://github.com/wp-plugins/flickr-wp-widget/blob/master/bilobaflickr.php (Maik Balleyer)   
*/

add_action("init", "bliccaThemes_flickr_init");

function bliccaThemes_flickr_init() {
	wp_register_widget_control('bliccaThemes_flickr', 'bliccaThemes_flickr', 'bliccaThemes_flickr_control', 200, 200);
	wp_register_sidebar_widget('bliccaThemes_flickr', 'Flickr', 'bliccaThemes_flickr_widget');	
}

function bliccaThemes_flickr_control() {
	
	//Get all options from the bliccaThemes_flickr plugin
	$aryOptions = bliccaThemes_flickr_getPluginOptions();
	
	//Load/save options for the bliccaThemes_flickr plugin 
	if(array_key_exists('bliccaThemes_flickr_submit', $_POST)) {
		$aryPostOptions['title'] = strip_tags(stripslashes($_POST["bliccaThemes_flickr_title"]));
		$aryPostOptions['items'] = strip_tags(stripslashes($_POST["bliccaThemes_flickr_items"]));
		$aryPostOptions['rss'] = strip_tags(stripslashes($_POST["bliccaThemes_flickr_rss"]));
		$aryPostOptions['size'] = strip_tags(stripslashes($_POST["bliccaThemes_flickr_size"]));
		
		update_option('bliccaThemes_flickr_widget', $aryPostOptions);
		$aryOptions = $aryPostOptions;
	}

	$strTitle = esc_html($aryOptions['title']);
	$intItems = esc_html($aryOptions['items']);
	$strdef = esc_html($aryOptions['rss']);
  	$strRss = 'http://api.flickr.com/services/feeds/photos_public.gne?id=' . esc_html($aryOptions['rss']) . '&format=rss_200';
  	$intSize = esc_html($aryOptions['size']);
	
  //Set default value (since 2.1 implemented)
  if($intSize == '' or $intSize == NULL) {
  	$intSize = 1;
  }
  
	//HTML Output  
	bliccaThemes_flickr_getPluginOptionsWww($strTitle, $intItems, $strdef, $intSize);
}

function bliccaThemes_flickr_widget($args) {
	extract($args);
	
	//Get all options from the bliccaThemes_flickr plugin
	$aryOptions = bliccaThemes_flickr_getPluginOptions();
	
	//Set variables for procedure
	$strTitle = esc_attr($aryOptions['title']);
	$intItems = esc_attr($aryOptions['items']);
	$strFlickrRss = 'http://api.flickr.com/services/feeds/photos_public.gne?id=' . esc_attr($aryOptions['rss']) . '&format=rss_200';
	$intSize = esc_attr($aryOptions['size']);
	
	//Get all photos from the rss feed
	$aryPhotos = bliccaThemes_flickr_getFlickrPhotosRss($strFlickrRss, $intItems, $intSize);
	
	//HTML Output
	echo $before_widget;
	echo $before_title . $strTitle . $after_title;
	bliccaThemes_flickr_getWidgetWww($aryPhotos, $intSize);
	echo $after_widget;
}

function bliccaThemes_flickr_getFlickrPhotosRss($strFlickrRss, $intItems, $intSize) {
	$aryPhotos = array();
	
	if( file_exists(ABSPATH . WPINC . '/feed.php') ) {
		include_once( ABSPATH . WPINC . '/feed.php' );
	} else {
		require_once(ABSPATH . WPINC . '/rss.php');
	}	
	
	$aryRss = fetch_feed($strFlickrRss);
	$maxitems = $aryRss->get_item_quantity( $intItems );

	
		$aryItems = $aryRss->get_items( 0, $maxitems );
		$intCounter = 0;
		
			foreach ( $aryItems as $strPhoto ) : 
			if ($enclosure = $strPhoto->get_enclosure()) {
				$strPhotoUrl = $enclosure->get_thumbnail();
			}
			
			$strPhotoUrlBig = str_replace( "_s.jpg", "_c.jpg", $strPhotoUrl);
			
			switch($intSize) {
				case 0:
					$strPhotoUrl = str_replace( "_m.jpg", "_t.jpg", $strPhotoUrl);
					break;
				case 1:
					//Do nothing
				break;
		    case 2:
		       $strPhotoUrl = str_replace( "_s.jpg", "_q.jpg", $strPhotoUrl);
		    break;
						default:
							//Do nothing
			}      

      $aryPhotos[$intCounter]['url'] = $strPhotoUrl;
      $aryPhotos[$intCounter]['url_big'] = $strPhotoUrlBig;
      $aryPhotos[$intCounter]['alt'] = $strPhoto->get_title();
      $aryPhotos[$intCounter]['title'] = $strPhoto->get_title();
      

      
      $intCounter++;
		endforeach;
	
	
	return $aryPhotos;
}

function bliccaThemes_flickr_getPluginOptions() {
	$aryOptions = array();
	
	//Get all options from the bliccaThemes_flickr plugin
	$aryOptions = get_option('bliccaThemes_flickr_widget');
	
	//Set default values if something went wrong
	if($aryOptions == false) {
		$aryOptions['title'] = 'bliccaThemes_flickr';
		$aryOptions['items'] = 4;
		$aryOptions['rss'] = '52617155@N08';		

		$aryOptions['size'] = '1';
	}	
	
	return $aryOptions;
}

function bliccaThemes_flickr_getPluginOptionsWww($strTitle, $intItems, $strdef, $intSize) {
	
	//Output html code for option box
	?>
	<p class="bliccaThemes_flickr_text">
		Import photos from flickr to this widget.
	</p>	
	<p class="bliccaThemes_flickr_input">
		<label for="bliccaThemes_flickr_title">
			<?php __('Title:', 'bliccaThemes'); ?>
		</label>
		<input size="15" id="bliccaThemes_flickr_title" name="bliccaThemes_flickr_title" type="text" value="<?php echo esc_attr($strTitle); ?>">
	</p>
	<p class="bliccaThemes_flickr_input">
		<label for="bliccaThemes_flickr_items">
			<?php __('Amount of photos:', 'bliccaThemes'); ?>
		</label>
		<input size="5" id="bliccaThemes_flickr_items" name="bliccaThemes_flickr_items" type="text" value="<?php echo esc_attr($intItems); ?>">
	</p>
	<p class="bliccaThemes_flickr_input">
		<label for="bliccaThemes_flickr_size">
			<?php esc_attr_e('Size of photos:', 'bliccaThemes'); ?>
		</label>
		<?php
		//Set size to drop-down box
		switch($intSize) {
			case 0:
				$strSelThumb = ' selected="selected"';
				$strSelSmall = $strSelSquare = ' ';					
				break;
			case 1:
				$strSelThumb = $strSelSquare = ' ';
				$strSelSmall = ' selected="selected"';				
				break;
			case 2:
				$strSelThumb = $strSelSmall = ' ';
				$strSelSquare = ' selected="selected"';				
				break;				
			default:
				$strSelThumb = $strSelSmall = ' ';
				$strSelSquare = ' selected="selected"';	
		}
		?>
		<select size="1" class="widefat" id="bliccaThemes_flickr_size" name="bliccaThemes_flickr_size">
			<option value="0" <?php echo esc_attr($strSelThumb); ?>>Thumbnail (100x67)</option>
			<option value="1" <?php echo esc_attr($strSelSmall); ?>>Small (240x160)</option>
      		<option value="2" <?php echo esc_attr($strSelSquare); ?>>Large Square</option>
		</select>
	</p>
	<p class="bliccaThemes_flickr_input">
		<label for="bliccaThemes_flickr_rss">
			<?php __('FLICKR ID:', 'bliccaThemes'); ?>
		</label>
		<input size="25" id="bliccaThemes_flickr_rss" name="bliccaThemes_flickr_rss" type="text" value="<?php echo esc_attr($strdef); ?>">
	</p>
	
	<p class="bliccaThemes_flickr_text">
		You can find the <strong>FLICKR ID</strong> http://idgettr.com/  
	</p>
	<input type="hidden" id="bliccaThemes_flickr_submit" name="bliccaThemes_flickr_submit" value="1">
	
	<?php
}

function bliccaThemes_flickr_getWidgetWww($aryPhotos, $intSize) {
	echo '<div class="bliccaThemes_flickr_item_box">';
	foreach($aryPhotos as $aryPhoto) {

		
		switch($intSize) {
			case "0":
				echo '<div class="bliccaThemes_flickr_item_thumb">';
				break;
			case "1":
				echo '<div class="bliccaThemes_flickr_item_small">';
				break;
			default:
				echo '<div class="bliccaThemes_flickr_item_small">';
		}		
		$strImage = '<img alt="' . esc_attr($aryPhoto['alt']) . '" title="' . esc_attr($aryPhoto['alt']) . '" src="' . esc_url($aryPhoto['url']) . '" />';

			echo '<a class="prettyPhoto" data-rel="prettyPhoto" title="' . esc_attr($aryPhoto['alt']) . '" href="'.esc_url($aryPhoto['url_big']) .'">';
			echo $strImage;
			echo '</a>';

		echo '</div>';		
	}
	
	echo '</div>';
}