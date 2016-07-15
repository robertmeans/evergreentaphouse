<?php
/*
Base on http://daverupert.com/2010/05/dribbble-wordpress-plugin/
*/

function bliccaThemes_dribble() { 
	include_once(ABSPATH . WPINC . '/feed.php');
 
  	$options = get_option("widget_bliccaThemes_dribble");
	$playerName = $options['playerName'];
	$widgetTitle = $options['widgetTitle'];

	if(function_exists('fetch_feed')):
		$rss = fetch_feed("http://dribbble.com/players/$playerName/shots.rss");
		add_filter( 'wp_feed_cache_transient_lifetime', create_function( '$a', 'return 1800;' ) );
		if (!is_wp_error( $rss ) ) : 
			$items = $rss->get_items(0, $rss->get_item_quantity($options['maxItems'])); 
		endif;
	endif;

	if (!empty($items)): ?>
	<!-- Custom Dribbble Widget Title -->
	<h6><?php if(!empty($widgetTitle)) : echo $widgetTitle; else : echo 'Dribbbles'; endif; ?></h6>

	<div class="dribbbles">
  <div class="dribbbles-slides">
	<?php	
	foreach ( $items as $item ):
	$title = $item->get_title();
	$link = $item->get_permalink();
	$date = $item->get_date('F d, Y');
	$description = $item->get_description();

	preg_match("/src=\"(http.*(jpg|jpeg|gif|png))/", $description, $image_url);
	$image = $image_url[1];

		
?>

	<div class="group"> 
		<a href="<?php echo esc_url($link); ?>" class="dribbble-link"><img src="<?php echo esc_url($image); ?>" alt="<?php echo esc_attr($title);?>"/></a>  
 	</div>
<?php endforeach;?>
</div>    
</div>
<?php endif;
}

function bliccaThemes_dribble_head() {
  $options = get_option("widget_bliccaThemes_dribble");
	$dir = WP_PLUGIN_URL.'/'.str_replace(basename( __FILE__),"",plugin_basename(__FILE__));
?>

<?php
}

function bliccaThemes_dribble_control() {
  $options = get_option("widget_bliccaThemes_dribble");
  if (!is_array( $options )) {
	$options = array(
	'playerName'=> 'Your Dribbble Name',
  	'widgetTitle'=> 'DRIBBBLE WIDGET',
	'maxItems' => '5'
    );
  }
  
  if ( isset($_POST['bliccaThemes_dribble-Submit']) && $_POST['bliccaThemes_dribble-Submit']) {
  	//player name
    $options['playerName'] = htmlspecialchars($_POST['bliccaThemes_dribble-WidgetPlayerName']);
    
    //widget Title
    $options['widgetTitle'] = htmlspecialchars($_POST['bliccaThemes_dribble-WidgetTitle']);
    
    //maximum number of shots
    $options['maxItems'] = htmlspecialchars($_POST['bliccaThemes_dribble-WidgetMaxItems']);
       
    //updateoption
    update_option("widget_bliccaThemes_dribble", $options);
  }
?>

<style type="text/css">
	.labbbel { width: 90px; display:inline-block; }
	.quiet { color:#CCC;}
</style>

<p>
    <label class="labbbel" for="bliccaThemes_dribble-WidgetPlayerName">Dribbble Name: </label>
    <input type="text" id="bliccaThemes_dribble-WidgetPlayerName" name="bliccaThemes_dribble-WidgetPlayerName" value="<?php echo esc_attr($options['playerName']);?>" />
</p>
<p>
	<label class="labbbel" for="bliccaThemes_dribble-WidgetTitle">Widget Title</label>
    <input type="text" id="bliccaThemes_dribble-WidgetTitle" name="bliccaThemes_dribble-WidgetTitle" value="<?php echo esc_attr($options['widgetTitle']); ?>">
    <em class="quiet">Default: Dribbble Shots</em>
</p>
<p>
	<label class="labbbel" for="bliccaThemes_dribble-WidgetMaxItems">No. of Shots: </label>
    <select id="bliccaThemes_dribble-WidgetMaxItems" name="bliccaThemes_dribble-WidgetMaxItems">
    	<option value="1" <?php if($options['maxItems'] == 1) echo "selected";?>>1</option>
    	<option value="2" <?php if($options['maxItems'] == 2) echo "selected";?>>2</option>
    	<option value="3" <?php if($options['maxItems'] == 3) echo "selected";?>>3</option>
    	<option value="4" <?php if($options['maxItems'] == 4) echo "selected";?>>4</option>
    	<option value="5" <?php if($options['maxItems'] == 5) echo "selected";?>>5</option>
    	<option value="6" <?php if($options['maxItems'] == 6) echo "selected";?>>6</option>
    	<option value="7" <?php if($options['maxItems'] == 7) echo "selected";?>>7</option>
    	<option value="8" <?php if($options['maxItems'] == 8) echo "selected";?>>8</option>
    	<option value="9" <?php if($options['maxItems'] == 9) echo "selected";?>>9</option>
    	<option value="10" <?php if($options['maxItems'] == 10) echo "selected";?>>10</option>
    </select>
</p>

    <input type="hidden" id="bliccaThemes_dribble-Submit" name="bliccaThemes_dribble-Submit" value="1" />

<?php
}

function widget_bliccaThemes_dribble($args) {
	extract($args);
	echo $before_widget;
	bliccaThemes_dribble();
	echo $after_widget;
}
  
function bliccaThemes_dribble_init() {
	$options = get_option("widget_bliccaThemes_dribble");
	wp_register_sidebar_widget( 'bliccaThemes_dribble', 'Dribble', 'widget_bliccaThemes_dribble' ,array('description' => 'Pull in your latest Dribbble shots'));
	wp_register_widget_control( 'bliccaThemes_dribble', 'bliccaThemes_dribble', 'bliccaThemes_dribble_control');
	add_action( 'wp_dribbble', 'bliccaThemes_dribble' );
}

add_action("init", "bliccaThemes_dribble_init");