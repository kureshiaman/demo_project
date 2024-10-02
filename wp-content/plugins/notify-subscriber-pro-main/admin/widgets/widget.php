<?php
if ( ! class_exists( 'Notify_Subscribers_Widget' ) ) {
	
	class Notify_Subscribers_Widget extends WP_Widget {
		
		/**
		 * Widget __construct
		 */
		public function __construct() {
			parent::__construct( false, __( 'Notify Subscribers', 'notify-subscribers' ), array( 'description' => __( 'Displays Notify Subscriber', 'notify-subscribers' ) ) );
		}

		/**
		 * Widget form function to create widget.
		 */
		public function form( $fields ) {
			if ( ! is_array( $fields ) ) {
				$fields = array();
			}
			$fields = array_merge( array( 'title' => '', 'text' => '' ), $fields ); ?>
			<p>
				<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php echo sprintf( __( '%s', 'notify-subscribers' ), 'Title:' );?></label>
				<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $fields['title'] ); ?>">
			</p>
			<p>
				<label for="<?php echo $this->get_field_id( 'text' ); ?>"><?php echo sprintf( __( '%s', 'notify-subscribers' ), 'Description:' );?></label>
				<textarea class="widefat" id="<?php echo $this->get_field_id( 'text' ); ?>" name="<?php echo $this->get_field_name( 'text' ); ?>" rows="10"><?php echo esc_attr( $fields['text'] ); ?></textarea>
			</p>
			<?php 
		}

		/**
		 * Add widget
		 */
		public function widget( $argument, $fields ) {
			extract( $argument );
			$title = apply_filters( 'widget_title', $fields['title'] );
			$description = apply_filters( 'description', $fields['text'] );
			echo $before_widget;
			if ( ! empty( $title ) ) {
				echo $before_title . $title . $after_title;
			}
			if( ! empty( $description ) ) {
					echo '<p>' . $description . '</p>';
			}
			if ( function_exists( 'notify_subscribers_form' ) ) {
				echo notify_subscribers_form();
			}
			echo $after_widget;
		}
	}
}
