<?php
/**
 * Social icons widget class
 *
 * @since 1.0.0
 */

// Block direct requests
if ( !defined('ABSPATH') )
	die('-1');
	
	
add_action( 'widgets_init', function(){
     register_widget( 'GoogleAds_Widget_Universal' );
});	
/**
 * Adds GoogleAds_Widget widget.
 */
class GoogleAds_Widget_Universal extends WP_Widget {
	/**
	 * Register widget with WordPress.
	 */
	function __construct() {
		parent::__construct(
			'GoogleAds_Widget_Universal', // Base ID
			__('Google Ads', 'gau'), // Name
			array( 'description' => __( 'Add responsive Google Ad. Insert your pub-id in plugin settings', 'gau' ), ) // Args
		);
	}
	/**
	 * Front-end display of widget.
	 *
	 * @see WP_Widget::widget()
	 *
	 * @param array $args     Widget arguments.
	 * @param array $instance Saved values from database.
	 */
    
	public function widget( $args, $instance ) {
		$data_ad_format = ( isset( $instance['data_ad_format'] ) ) ? $instance['data_ad_format'] : '';
		$data_ad_slot = ( isset( $instance['data_ad_slot'] ) ) ? $instance['data_ad_slot'] : '';
        $dir = plugin_dir_path( __FILE__ );
        include_once( $dir . 'google_ads_widget_include.php' );
?>
		<div class="advertisment">
		<ins class="adsbygoogle" style="display: block;" data-ad-client="ca-pub-<?php echo $gau_puboption = get_option('gau_pub');?>" data_ad_slot="<?php echo $data_ad_slot;?>" data-ad-format="<?php echo $data_ad_format;?>"></ins><script>
// <![CDATA[
(adsbygoogle = window.adsbygoogle || []).push({});
// ]]></script>
</div>
<?php
	}
	/**
	 * Back-end widget form.
	 *
	 * @see WP_Widget::form()
	 *
	 * @param array $instance Previously saved values from database.
	 */
	public function form( $instance ) {
		
		$data_ad_format = ( isset( $instance['data_ad_format'] ) ) ? $instance['data_ad_format'] : '';
		$data_ad_slot = ( isset( $instance['data_ad_slot'] ) ) ? $instance['data_ad_slot'] : '';
		
		?>
		<div class="widget_input">
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'data-ad-slot (optional):' ); ?></label> 
			<input class="widefat" id="<?php echo $this->get_field_id( 'data_ad_slot' ); ?>" name="<?php echo $this->get_field_name( 'data_ad_slot' ); ?>" type="text" value="<?php echo esc_attr( $data_ad_slot ); ?>">
		</p>
		</div>
		<div class="widget_input">
			<label for="<?php echo $this->get_field_id( 'data_ad_format' ); ?>"><?php _e( 'Ad format:' ); ?></label> 	
<select class="data_ad_format" name="<?php echo $this->get_field_name( 'data_ad_format' ); ?>" id="<?php echo $this->get_field_id( 'data_ad_format' ); ?>">
<?php if(esc_attr( $data_ad_format ) == "auto"){ ?>                    
  <option value="auto" selected>Auto</option>
  <option value="rectangle">Rectangle</option>
  <option value="horizontal">Horizontal</option>
  <option value="vertical">Vertical</option>
<?php }else if(esc_attr( $data_ad_format ) == "rectangle"){ ?>     
  <option value="auto">Auto</option>
  <option value="rectangle" selected>Rectangle</option>
  <option value="horizontal">Horizontal</option>
  <option value="vertical">Vertical</option>
<?php }else if(esc_attr( $data_ad_format ) == "horizontal"){ ?>  
  <option value="auto">Auto</option>
  <option value="rectangle">Rectangle</option>
  <option value="horizontal" selected>Horizontal</option>
  <option value="vertical">Vertical</option>
<?php }else if(esc_attr( $data_ad_format ) == "vertical"){ ?>  
  <option value="auto">Auto</option>
  <option value="rectangle">Rectangle</option>
  <option value="horizontal">Horizontal</option>
  <option value="vertical" selected>Vertical</option>
<?php }else{ ?>  
  <option value="auto">Auto</option>
  <option value="rectangle">Rectangle</option>
  <option value="horizontal">Horizontal</option>
  <option value="vertical">Vertical</option>
    <?php }?>
</select>
					<br/><br/>		
				</div>
		<?php 
	}
	/**
	 * Sanitize widget form values as they are saved.
	 *
	 * @see WP_Widget::update()
	 *
	 * @param array $new_instance Values just sent to be saved.
	 * @param array $old_instance Previously saved values from database.
	 *
	 * @return array Updated safe values to be saved.
	 */
	public function update( $new_instance, $old_instance ) {
		$instance = array();
		$instance['data_ad_slot'] = ( ! empty( $new_instance['data_ad_slot'] ) ) ? strip_tags( $new_instance['data_ad_slot'] ) : '';
		$instance['data_ad_format'] = ( ! empty( $new_instance['data_ad_format'] ) ) ? strip_tags( $new_instance['data_ad_format'] ) : '';
		return $instance;
	}
} // class GoogleAds_Widget