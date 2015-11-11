<?php
/**
 *
 *
 */

add_action( 'widgets_init', 'opening_hours_widget' );
function opening_hours_widget() {
	register_widget( 'Opening_Hours' );
}

class Opening_Hours extends WP_Widget {

	// Initialize the widget
	function Opening_Hours() {
		parent::__construct('opening-hours-widget', __('Hours Widget','brewhouse_back_office'), 
			array('description' => __('A widget that shows the opening hours', 'brewhouse_back_office')));  
	}

	// Output of the widget
	function widget( $args, $instance ) { 
		global $brewhouse_widget_date_format;
		
		extract( $args );
		
		$title = apply_filters( 'widget_title', $instance['title'] );
		$mon_open = esc_attr( $instance[ 'mon_open' ] );
		$mon_close = esc_attr( $instance[ 'mon_close' ] );
		$tue_open = esc_attr( $instance[ 'tue_open' ] );
		$tue_close = esc_attr( $instance[ 'tue_close' ] );		
		$wed_open = esc_attr( $instance[ 'wed_open' ] );
		$wed_close = esc_attr( $instance[ 'wed_close' ] );			
		$thu_open = esc_attr( $instance[ 'thu_open' ] );
		$thu_close = esc_attr( $instance[ 'thu_close' ] );
		$fri_open = esc_attr( $instance[ 'fri_open' ] );
		$fri_close = esc_attr( $instance[ 'fri_close' ] );		
		$sat_open = esc_attr( $instance[ 'sat_open' ] );
		$sat_close = esc_attr( $instance[ 'sat_close' ] );		
		$sun_open = esc_attr( $instance[ 'sun_open' ] );
		$sun_close = esc_attr( $instance[ 'sun_close' ] );
		
		
		
		// Opening of widget
		echo $before_widget;
		
		// Open of title tag
		if ( $title ){ 
			echo $before_title . $title . $after_title; 
		}
			
		echo '<ul class="opening-hours-list">';
		
		// monday
		echo '<li><span class="head">' . __('Monday', 'brewhouse_front_end') . '</span>';
		if( !empty($mon_open) && !empty($mon_close) ){
			echo '<span class="time">' . $mon_open . ' - ' . $mon_close . '</span>';
		}else{
			echo '<span class="close">' . __('Closed', 'brewhouse_front_end') . '</span>';
		}
		echo '</li>';
		
		// tuesday
		echo '<li><span class="head">' . __('Tuesday', 'brewhouse_front_end') . '</span>';
		if( !empty($tue_open) && !empty($tue_close) ){
			echo '<span class="time">' . $tue_open . ' - ' . $tue_close . '</span>';
		}else{
			echo '<span class="close">' . __('Closed', 'brewhouse_front_end') . '</span>';
		}
		echo '</li>';
		
		// wednesday
		echo '<li><span class="head">' . __('Wednesday', 'brewhouse_front_end') . '</span>';
		if( !empty($wed_open) && !empty($wed_close) ){
			echo '<span class="time">' . $wed_open . ' - ' . $wed_close . '</span>';
		}else{
			echo '<span class="close">' . __('Closed', 'brewhouse_front_end') . '</span>';
		}
		echo '</li>';		
	
		
		// thursday
		echo '<li><span class="head">' . __('Thursday', 'brewhouse_front_end') . '</span>';
		if( !empty($thu_open) && !empty($thu_close) ){
			echo '<span class="time">' . $thu_open . ' - ' . $thu_close . '</span>';
		}else{
			echo '<span class="close">' . __('Closed', 'brewhouse_front_end') . '</span>';
		}
		echo '</li>';

		// friday
		echo '<li><span class="head">' . __('Friday', 'brewhouse_front_end') . '</span>';
		if( !empty($fri_open) && !empty($fri_close) ){
			echo '<span class="time">' . $fri_open . ' - ' . $fri_close . '</span>';
		}else{
			echo '<span class="close">' . __('Closed', 'brewhouse_front_end') . '</span>';
		}
		echo '</li>';
		
		// saturday
		echo '<li><span class="head">' . __('Saturday', 'brewhouse_front_end') . '</span>';
		if( !empty($sat_open) && !empty($sat_close) ){
			echo '<span class="time">' . $sat_open . ' - ' . $sat_close . '</span>';
		}else{
			echo '<span class="close">' . __('Closed', 'brewhouse_front_end') . '</span>';
		}	
		echo '</li>';
		
		// sunday
		echo '<li><span class="head">' . __('Sunday', 'brewhouse_front_end') . '</span>';
		if( !empty($sun_open) && !empty($sun_close) ){
			echo '<span class="time">' . $sun_open . ' - ' . $sun_close . '</span>';
		}else{
			echo '<span class="close">' . __('Closed', 'brewhouse_front_end') . '</span>';
		}			
		echo '</li>';
		
		echo '</ul>';
		
		// Closing of widget
		echo $after_widget;		
	}

	// Widget Form
	function form( $instance ) {
		if ( $instance ) {
			$title = esc_attr( $instance[ 'title' ] );
			$mon_open = esc_attr( $instance[ 'mon_open' ] );
			$mon_close = esc_attr( $instance[ 'mon_close' ] );
			$tue_open = esc_attr( $instance[ 'tue_open' ] );
			$tue_close = esc_attr( $instance[ 'tue_close' ] );		
			$wed_open = esc_attr( $instance[ 'wed_open' ] );
			$wed_close = esc_attr( $instance[ 'wed_close' ] );			
			$thu_open = esc_attr( $instance[ 'thu_open' ] );
			$thu_close = esc_attr( $instance[ 'thu_close' ] );
			$fri_open = esc_attr( $instance[ 'fri_open' ] );
			$fri_close = esc_attr( $instance[ 'fri_close' ] );		
			$sat_open = esc_attr( $instance[ 'sat_open' ] );
			$sat_close = esc_attr( $instance[ 'sat_close' ] );		
			$sun_open = esc_attr( $instance[ 'sun_open' ] );
			$sun_close = esc_attr( $instance[ 'sun_close' ] );				
		} else {
			$title = '';
			$mon_open = '';
			$mon_close = '';
			$tue_open = '';
			$tue_close = '';
			$wed_open = '';
			$wed_close = '';
			$thu_open = '';
			$thu_close = '';
			$fri_open = '';
			$fri_close = '';
			$sat_open = '';
			$sat_close = '';
			$sun_open = '';
			$sun_close = '';		
		}
		?>

		<!-- Text Input -->
		<p>
			<label for="<?php echo $this->get_field_id('title'); ?>"><?php _e( 'Title :', 'brewhouse_back_office' ); ?></label> 
			<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" />
		</p>		
		
		<!-- Monday -->
		<p>
			<label class="day-title"><?php _e( 'MON : ', 'brewhouse_back_office' ); ?></label>
			<label for="<?php echo $this->get_field_id('mon_open'); ?>"><?php _e( 'open', 'brewhouse_back_office' ); ?></label> 
			<input class="opening-hours" id="<?php echo $this->get_field_id('mon_open'); ?>" name="<?php echo $this->get_field_name('mon_open'); ?>" type="text" value="<?php echo $mon_open; ?>" />
			<label for="<?php echo $this->get_field_id('mon_close'); ?>"><?php _e( 'close', 'brewhouse_back_office' ); ?></label> 
			<input class="opening-hours" id="<?php echo $this->get_field_id('mon_close'); ?>" name="<?php echo $this->get_field_name('mon_close'); ?>" type="text" value="<?php echo $mon_close; ?>" />
		</p>		

		<!-- Tuesday -->
		<p>
			<label class="day-title"><?php _e( 'TUE : ', 'brewhouse_back_office' ); ?></label>
			<label for="<?php echo $this->get_field_id('tue_open'); ?>"><?php _e( 'open', 'brewhouse_back_office' ); ?></label> 
			<input class="opening-hours" id="<?php echo $this->get_field_id('tue_open'); ?>" name="<?php echo $this->get_field_name('tue_open'); ?>" type="text" value="<?php echo $tue_open; ?>" />
			<label for="<?php echo $this->get_field_id('tue_close'); ?>"><?php _e( 'close', 'brewhouse_back_office' ); ?></label> 
			<input class="opening-hours" id="<?php echo $this->get_field_id('tue_close'); ?>" name="<?php echo $this->get_field_name('tue_close'); ?>" type="text" value="<?php echo $tue_close; ?>" />
		</p>		
		
		<!-- Wednesday -->
		<p>
			<label class="day-title"><?php _e( 'WED : ', 'brewhouse_back_office' ); ?></label>
			<label for="<?php echo $this->get_field_id('wed_open'); ?>"><?php _e( 'open', 'brewhouse_back_office' ); ?></label> 
			<input class="opening-hours" id="<?php echo $this->get_field_id('wed_open'); ?>" name="<?php echo $this->get_field_name('wed_open'); ?>" type="text" value="<?php echo $wed_open; ?>" />
			<label for="<?php echo $this->get_field_id('wed_close'); ?>"><?php _e( 'close', 'brewhouse_back_office' ); ?></label> 
			<input class="opening-hours" id="<?php echo $this->get_field_id('wed_close'); ?>" name="<?php echo $this->get_field_name('wed_close'); ?>" type="text" value="<?php echo $wed_close; ?>" />
		</p>			

		<!-- Thursday -->
		<p>
			<label class="day-title"><?php _e( 'THU : ', 'brewhouse_back_office' ); ?></label>
			<label for="<?php echo $this->get_field_id('thu_open'); ?>"><?php _e( 'open', 'brewhouse_back_office' ); ?></label> 
			<input class="opening-hours" id="<?php echo $this->get_field_id('thu_open'); ?>" name="<?php echo $this->get_field_name('thu_open'); ?>" type="text" value="<?php echo $thu_open; ?>" />
			<label for="<?php echo $this->get_field_id('thu_close'); ?>"><?php _e( 'close', 'brewhouse_back_office' ); ?></label> 
			<input class="opening-hours" id="<?php echo $this->get_field_id('thu_close'); ?>" name="<?php echo $this->get_field_name('thu_close'); ?>" type="text" value="<?php echo $thu_close; ?>" />
		</p>	

		<!-- Friday -->
		<p>
			<label class="day-title"><?php _e( 'FRI : ', 'brewhouse_back_office' ); ?></label>
			<label for="<?php echo $this->get_field_id('fri_open'); ?>"><?php _e( 'open', 'brewhouse_back_office' ); ?></label> 
			<input class="opening-hours" id="<?php echo $this->get_field_id('fri_open'); ?>" name="<?php echo $this->get_field_name('fri_open'); ?>" type="text" value="<?php echo $fri_open; ?>" />
			<label for="<?php echo $this->get_field_id('fri_close'); ?>"><?php _e( 'close', 'brewhouse_back_office' ); ?></label> 
			<input class="opening-hours" id="<?php echo $this->get_field_id('fri_close'); ?>" name="<?php echo $this->get_field_name('fri_close'); ?>" type="text" value="<?php echo $fri_close; ?>" />
		</p>		

		<!-- Saturday -->
		<p>
			<label class="day-title"><?php _e( 'SAT : ', 'brewhouse_back_office' ); ?></label>
			<label for="<?php echo $this->get_field_id('sat_open'); ?>"><?php _e( 'open', 'brewhouse_back_office' ); ?></label> 
			<input class="opening-hours" id="<?php echo $this->get_field_id('sat_open'); ?>" name="<?php echo $this->get_field_name('sat_open'); ?>" type="text" value="<?php echo $sat_open; ?>" />
			<label for="<?php echo $this->get_field_id('sun_close'); ?>"><?php _e( 'close', 'brewhouse_back_office' ); ?></label> 
			<input class="opening-hours" id="<?php echo $this->get_field_id('sat_close'); ?>" name="<?php echo $this->get_field_name('sat_close'); ?>" type="text" value="<?php echo $sat_close; ?>" /> 
		</p>	

		<!-- Sunday -->
		<p>
			<label class="day-title"><?php _e( 'SUN : ', 'brewhouse_back_office' ); ?></label>
			<label for="<?php echo $this->get_field_id('sun_open'); ?>"><?php _e( 'open', 'brewhouse_back_office' ); ?></label> 
			<input class="opening-hours" id="<?php echo $this->get_field_id('sun_open'); ?>" name="<?php echo $this->get_field_name('sun_open'); ?>" type="text" value="<?php echo $sun_open; ?>" />
			<label for="<?php echo $this->get_field_id('sun_close'); ?>"><?php _e( 'close', 'brewhouse_back_office' ); ?></label> 
			<input class="opening-hours" id="<?php echo $this->get_field_id('sun_close'); ?>" name="<?php echo $this->get_field_name('sun_close'); ?>" type="text" value="<?php echo $sun_close; ?>" /> 
		</p>			
		
	<?php
	}
	
	// Update the widget
	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['mon_open'] = strip_tags( $new_instance['mon_open'] );
		$instance['mon_close'] = strip_tags( $new_instance['mon_close'] );
		$instance['tue_open'] = strip_tags( $new_instance['tue_open'] );
		$instance['tue_close'] = strip_tags( $new_instance['tue_close'] );		
		$instance['wed_open'] = strip_tags( $new_instance['wed_open'] );
		$instance['wed_close'] = strip_tags( $new_instance['wed_close'] );
		$instance['thu_open'] = strip_tags( $new_instance['thu_open'] );
		$instance['thu_close'] = strip_tags( $new_instance['thu_close'] );		
		$instance['fri_open'] = strip_tags( $new_instance['fri_open'] );
		$instance['fri_close'] = strip_tags( $new_instance['fri_close'] );	
		$instance['sat_open'] = strip_tags( $new_instance['sat_open'] );
		$instance['sat_close'] = strip_tags( $new_instance['sat_close'] );	
		$instance['sun_open'] = strip_tags( $new_instance['sun_open'] );
		$instance['sun_close'] = strip_tags( $new_instance['sun_close'] );			
		return $instance;
	}	
}

?>