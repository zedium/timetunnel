<?php
if(!class_exists('TimeTunnelWidget'))
{

require_once 'class.php';

$timeTunnel = new TimeTunnel();

class TimeTunnelWidget extends WP_Widget {


	function __construct() {
		parent::__construct(
			'TimeTunnelWidget', 
			__('TimeTunnel Widget', 'ttw'), 
			array( 'description' => __( 'TimeTunnel Widget', 'ttw' ), ) 
		);
	}


	public function widget( $args, $instance ) {
		
		global $timeTunnel;
		
		
		$title = $instance['title'];
		$postCount = $instance['postCountToDisplay'];
		
		
		
		echo $args['before_widget'];
		if ( ! empty( $title ) )
			echo $args['before_title'] . $title . $args['after_title'];
		
		echo $timeTunnel->getPosts($postCount);
		
		
		echo $args['after_widget'];
	}


	public function form( $instance ) {
		
		extract($instance);
		
		$title = isset($title)? $title : __('New Title','ttw') ;
		$postCountToDisplay = isset($postCountToDisplay)? $postCountToDisplay : 5 ;
		
		?>
		<p>
		<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:' ); ?></label> 
		<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
		</p>
		<p>
		<label for="<?php echo $this->get_field_id( 'postCountToDisplay' ); ?>"><?php _e( 'Posts Count:' ); ?></label> 
		<input class="widefat" id="<?php echo $this->get_field_id( 'postCountToDisplay' ); ?>" name="<?php echo $this->get_field_name( 'postCountToDisplay' ); ?>" type="text" value="<?php echo esc_attr( $postCountToDisplay ); ?>" />
		</p>

		<?php 
	}


	public function update( $new_instance, $old_instance ) {
		$instance = array();
		$instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
		$instance['postCountToDisplay'] = ( ! empty( $new_instance['postCountToDisplay'] ) ) ? strip_tags( $new_instance['postCountToDisplay'] ) : '';
		return $instance;
	}

} 
function register_timetunnel_widget() {
    register_widget( 'TimeTunnelWidget' );
}
add_action( 'widgets_init', 'register_timetunnel_widget' );

}