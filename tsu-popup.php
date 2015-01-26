<?php 
/*
Plugin Name: Tsu Popup
Plugin URI: http://tsu.co/tipstolearn
Description: Add your own tsu ( Social Network ) popup in any website.
Author: Freelancing Care
Author URI: http://tsu.co/tipstolearn
License: GPL2
License URI: http://www.gnu.org/licenses/gpl-2.0.html
Version: 1.0
*/

/* Adding Latest jQuery from Wordpress */
function rt_facebook_like_box_wp_latest_jquery() {
	wp_enqueue_script('jquery');
}
add_action('init', 'rt_facebook_like_box_wp_latest_jquery');


/* Adding Settings API */
require_once dirname( __FILE__ ) . '/class.settings-api.php';


/* WordPress settings API  */
if ( !class_exists('TSU_Settings_API_file' ) ):
class TSU_Settings_API_file {

    private $settings_api;

    function __construct() {
        $this->settings_api = new TSU_Settings_API;

        add_action( 'admin_init', array($this, 'admin_init') );
        add_action( 'admin_menu', array($this, 'admin_menu') );
    }

    function admin_init() {

        //set the settings
        $this->settings_api->set_sections( $this->get_settings_sections() );
        $this->settings_api->set_fields( $this->get_settings_fields() );

        //initialize settings
        $this->settings_api->admin_init();
    }

    function admin_menu() {
        add_menu_page( 'Tsu Pop Up', 'Tsu Pop Up', 'delete_posts', 'tsu_popup', array($this, 'plugin_page'), plugins_url('/images/icon.jpg', __FILE__),
        100 );
		
		
    }
	
	
    function get_settings_sections() {
        $sections = array(
            array(
                'id' => 'tsu_content_settings',
                'title' => __( 'Content Settings', 'freelancingcare' )
            ),
            array(
                'id' => 'tsu_display_settings',
                'title' => __( 'Display Settings', 'freelancingcare' )
            ),
            array(
                'id' => 'tsu_control_settings',
                'title' => __( 'Control Settings', 'freelancingcare' )
            )
        );
        return $sections;
    }

    /**
     * Returns all the settings fields
     *
     * @return array settings fields
     */
    function get_settings_fields() {
        $settings_fields = array(
            'tsu_display_settings' => array(   
			array(
                    'name' => 'tsu_background_color',
                    'label' => __( 'Background Color', 'freelancingcare' ),
                    'desc' => __( 'Example : #FFFFFF', 'freelancingcare' ),
                    'type' => 'color',
                    'default' => '#ffffff',
                 
                ),				
				array(
                    'name' => 'tsu_title_color',
                    'label' => __( 'Title Color', 'freelancingcare' ),
                    'desc' => __( 'Example : #FFFFFF', 'freelancingcare' ),
                    'type' => 'color',
                    'default' => '#ffffff',
                 
                ),
				array(
                    'name' => 'tsu_title_background',
                    'label' => __( 'Title Background Color', 'freelancingcare' ),
                    'desc' => __( 'Example : #07C5AC', 'freelancingcare' ),
                    'type' => 'color',
                    'default' => '#07C5AC',
                 
                ), 					
				array(
                    'name' => 'tsu_text_color',
                    'label' => __( 'Text Color', 'freelancingcare' ),
                    'desc' => __( 'Example : #666666', 'freelancingcare' ),
                    'type' => 'color',
                    'default' => '#666666',
                 
                ),					
				array(
                    'name' => 'tsu_link_color',
                    'label' => __( 'Link Color', 'freelancingcare' ),
                    'desc' => __( 'Example : #07C5AC', 'freelancingcare' ),
                    'type' => 'color',
                    'default' => '#07C5AC',
                 
                ),		
			
				array(
                    'name' => 'tsu_popup_width',
                    'label' => __( 'Pop Up Area Width', 'freelancingcare' ),
                    'desc' => __( 'Example : 210', 'freelancingcare' ),
                    'type' => 'text',
                    'default' => '210',
                 
                ), 
			
		
),           'tsu_control_settings' => array(   
			array(
                    'name' => 'tsu_show_title',
                    'label' => __( 'Show Title', 'freelancingcare' ),
                    'desc' => __( '', 'freelancingcare' ),
                    'type' => 'select',
                    'default' => '1',
                    'options' => array(
                        '1' => 'Yes',
                        '0' => 'No'
                    )
                ), 
			array(
                    'name' => 'tsu_show_logo',
                    'label' => __( 'Show Logo', 'freelancingcare' ),
                    'desc' => __( '', 'freelancingcare' ),
                    'type' => 'select',
                    'default' => '1',
                    'options' => array(
                        '1' => 'Yes',
                        '0' => 'No'
                    )
                ), 
			array(
                    'name' => 'tsu_show_desc',
                    'label' => __( 'Show Description', 'freelancingcare' ),
                    'desc' => __( '', 'freelancingcare' ),
                    'type' => 'select',
                    'default' => '1',
                    'options' => array(
                        '1' => 'Yes',
                        '0' => 'No'
                    )
                ), 			
				array(
                    'name' => 'tsu_show_develop',
                    'label' => __( 'Show Footer', 'freelancingcare' ),
                    'desc' => __( '', 'freelancingcare' ),
                    'type' => 'select',
                    'default' => '1',
                    'options' => array(
                        '1' => 'Yes',
                        '0' => 'No'
                    )
                )			
),
			
			'tsu_content_settings' => array(
				
                array(
                    'name' => 'tsu_username',
                    'label' => __( 'Tsu Username', 'freelancingcare' ),
                    'desc' => __( 'Type your Username ex: tipstolearn', 'freelancingcare' ),
					'default' => 'tipstolearn',
                    'type' => 'text'
					
                ),                
				array(
                    'name' => 'tsu_display_name',
                    'label' => __( 'Tsu Display Name', 'freelancingcare' ),
                    'desc' => __( 'Type your Full Name ex: tipstolearn', 'freelancingcare' ),
					'default' => 'Freelancing Care',
                    'type' => 'text'
					
                ),              
              
				array(
                    'name' => 'tsu_title',
                    'label' => __( 'Tsu Popup Title', 'freelancingcare' ),
                    'desc' => __( 'Type your Full Name ex: tipstolearn', 'freelancingcare' ),
					'default' => 'Follow me on Tsu',
                    'type' => 'text'
					
                ),
				array(
                    'name' => 'tsu_desc',
                    'label' => __( 'Tsu Popup Description', 'freelancingcare' ),
                    'desc' => __( 'Type your Full Name ex: tipstolearn', 'freelancingcare' ),
					'default' => 'Get latest updates and news from there.',
                    'type' => 'text'
					
                ),	array(
                    'name' => 'tsu_logo',
                    'label' => __( 'Tsu Logo', 'freelancingcare' ),
                    'desc' => __( 'Upload your logo image', 'freelancingcare' ),
					'default' => ' ',
                    'type' => 'file'
					
                ),	array(
                    'name' => 'tsu_close_icon',
                    'label' => __( 'Close Icon', 'freelancingcare' ),
                    'desc' => __( 'Upload your Icon', 'freelancingcare' ),
					'default' => ' ',
                    'type' => 'file'
					
                )

	
				
            ),			
			 	
        );

        return $settings_fields;
    }

    function plugin_page() {
        echo '<div style="background-color:#fff; display: block;float: left;height: auto;width: 80%;">';
?>	
<?php
        $this->settings_api->show_navigation();
        $this->settings_api->show_forms();
		
		?>
		<a href="https://www.paypal.com/cgi-bin/webscr?cmd=_s-xclick&hosted_button_id=C7SFB5ARNKS26"><img src=" <?php echo plugins_url( 'images/advert.jpg', __FILE__ ) ;  ?>" alt="" /></a>
        </div>
		
		<div style="background-color:#fff; display: block;float: left;height: auto;width: 20%;">
		<hr style="border: medium none;height: 75px;"/>
		</br>
 <a style="background: none repeat scroll 0 0 #3F803C;color: #fff;display: block;float: left;font-size: 19px;padding: 10px 0px;text-align: center;text-decoration: none;width: 100%;   margin-bottom: 10px;"
    href="http://designingmarket.com/">Marketplace</a>
	
 <a style="background: none repeat scroll 0 0 #47B9EF;color: #fff;display: block;float: left;font-size: 19px;padding: 10px 0px;text-align: center;text-decoration: none;width: 100%;   margin-bottom: 10px;"
    href="http://tipstolearn.com/">Learning Tips</a>
	
 <a style="background: none repeat scroll 0 0 #07C5AC;color: #fff;display: block;float: left;font-size: 19px;padding: 10px 0px;text-align: center;text-decoration: none;width: 100%;   margin-bottom: 10px;"
    href="http://tsu.co/tipstolearn">Follow Me</a>
        
     		<form style="display: block;float: left;margin-bottom: 0;margin-left: 30px;margin-right: auto;padding-bottom: 30px;
padding-top: 20px;width: auto;" action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_top">
<input type="hidden" name="cmd" value="_s-xclick">
<input type="hidden" name="hosted_button_id" value="C7SFB5ARNKS26">
<input type="image" src="https://www.paypalobjects.com/en_US/i/btn/btn_donateCC_LG.gif" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!">
<img alt="" border="0" src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif" width="1" height="1">
</form>
      </div>
    <?php }

    /**
     * Get all the pages
     *
     * @return array page names with key value pairs
     */
    function get_pages() {
        $pages = get_pages();
        $pages_options = array();
        if ( $pages ) {
            foreach ($pages as $page) {
                $pages_options[$page->ID] = $page->post_title;
            }
        }

        return $pages_options;
    }

}
endif;

$settings = new TSU_Settings_API_file();

/* Get the value of a settings field */

$section=tsu_content_settings;
$section=tsu_display_settings;
$section=tsu_control_settings;
$option=tsu_background_color; //
$option=tsu_title_color;
$option=tsu_text_color;
$option=tsu_link_color;
$option=tsu_title_background;
$option=tsu_popup_width;
$option=tsu_show_title;
$option=tsu_show_logo;
$option=tsu_show_desc;
$option=tsu_show_develop;
$option=tsu_username;
$option=tsu_display_name;
$option=tsu_title;
$option=tsu_desc;
$option=tsu_logo;
$option=tsu_close_icon;

function tsu_option( $option, $section ) {
    $options = get_option( $section );
 
    if ( isset( $options[$option] ) ) {
        return $options[$option];
    }
 
    return $options;
}



function tsu_styles() {
?>
<style type="text/css">

.tsu_popup_block {
  bottom: 0;
  display: block;
  position: fixed;
  right: 0;
  width: <?php echo tsu_option( 'tsu_popup_width', 'tsu_display_settings' ); ?>px;
  z-index: 999;
}
.tsu_popup_contaier {
  background-color: <?php echo tsu_option( 'tsu_background_color', 'tsu_display_settings' ); ?>;
  display: block;
  float: left;
}
.tsu_popup_logo {
  width: 100%;
}
.tsu_popup_content_left {
  display: block;
  float: left;
  width: 25%;
}
.tsu_popup_content_right {
  display: block;
  float: left;
  padding: 0 15px;
  width: 75%;
}
.tsu_popup_title > h1 {
  background-color: <?php echo tsu_option( 'tsu_title_background', 'tsu_display_settings' ); ?>;
  color: <?php echo tsu_option( 'tsu_title_color', 'tsu_display_settings' ); ?>;
  font-size: 17px;
  font-weight: bold;
  margin: 0 0 10px;
  padding: 5px;
  text-align: center;
  word-wrap: break-word;
}
.tsu_popup_content_right > h3 {
  font-size: <?php echo tsu_option( 'tsu_text_color', 'tsu_display_settings' ); ?>px;
  font-weight: bold;
  margin: 0;
  padding: 0;font-size: 20px;
  text-align: left;
  word-wrap: break-word;
  line-height: 22px;
}
.tsu_popup_content_right > h3 > a {
  color: <?php echo tsu_option( 'tsu_link_color', 'tsu_display_settings' ); ?>;
  text-align: left;
  text-decoration: none;
}
.tsu_popup_content_bottom > p {
  color: <?php echo tsu_option( 'tsu_text_color', 'tsu_display_settings' ); ?>;
  font-size: 14px;
  line-height: 19px;
  margin: 0;
  padding: 0 0 10px;
  text-align: left;
}
.tsu_popup_content_bottom {
  display: block;
  float: left;
  padding: 10px 10px 0;
  width: 100%;
}
.tsu_popup_content small {
  background-color: <?php echo tsu_option( 'tsu_title_background', 'tsu_display_settings' ); ?>;
  color: <?php echo tsu_option( 'tsu_title_color', 'tsu_display_settings' ); ?>;
  float: left;
  font-size: 12px;
  padding: 2px 10px;
  text-align: left;
  width: 100%;
}#tsu_close_icon > img {
  width: 18px;
}.tsu_close_icon {
left: 0;
margin: -16px 0 0 -16px;
position: absolute;
z-index: 1000;}
/* Show Hide Control */
<?php if ( 1 == tsu_option( 'tsu_show_title', 'tsu_control_settings' ) ) { ?>
    <?php } else { ?>
       .tsu_popup_title > h1 {
  display: none;}
      .tsu_popup_contaier {
  padding-top: 10px;
} 
<?php } ?>
<?php if ( 1 == tsu_option( 'tsu_show_logo', 'tsu_control_settings' ) ) { ?>
    <?php } else { ?>
      .tsu_popup_content_left {
  display: none;
}.tsu_popup_content_right {
  width: 100%;
}
<?php } ?>
<?php if ( 1 == tsu_option( 'tsu_show_desc', 'tsu_control_settings' ) ) { ?>
    <?php } else { ?>
   .tsu_popup_content_bottom > p {
  display: none;
}
<?php } ?>
<?php if ( 1 == tsu_option( 'tsu_show_develop', 'tsu_control_settings' ) ) { ?>
    <?php } else { ?>
.tsu_popup_content small {
  display: none;
}
<?php } ?>

</style>
<div class="tsu_popup_block" id="tsu_block">

<div class="tsu_close_icon">
<span id="tsu_close_icon" style="cursor:pointer">
<img  src=" <?php echo plugins_url( 'images/6.png' , __FILE__ ) ;  ?>" > 
</span>
</div>
<div class="tsu_popup_contaier">
	<div class="tsu_popup_inner">
		<div class="tsu_popup_title">
			<h1><?php echo tsu_option( 'tsu_title', 'tsu_content_settings' ); ?></h1>
		</div>
		<div class="tsu_popup_content">
			<div class="tsu_popup_content_left">
				<a class="tsu_image_link" href="http://tsu.co/<?php echo tsu_option( 'tsu_username', 'tsu_content_settings' ); ?>">
				<?php $tsu_logo_url = tsu_option( 'tsu_logo', 'tsu_content_settings' )?>
				<?php if($tsu_logo_url!=""){?>
						<img src="<?php echo tsu_option( 'tsu_logo', 'tsu_content_settings' ); ?>" alt="" class="tsu_popup_logo" />
    <?php } else { ?>
<img src="<?php echo plugins_url( 'images/logo.jpg' , __FILE__ ) ;  ?>" alt="" class="tsu_popup_logo" />
<?php } ?>
		</a>
			</div>
			<div class="tsu_popup_content_right">
				<h3><a href="http://tsu.co/<?php echo tsu_option( 'tsu_username', 'tsu_content_settings' ); ?>"><?php echo tsu_option( 'tsu_display_name', 'tsu_content_settings' ); ?></a></h3>
			</div>
			<div style="clear:both"></div>
			<div class="tsu_popup_content_bottom">
			<p><?php echo tsu_option( 'tsu_desc', 'tsu_content_settings' ); ?></p>
			</div>
			<div style="clear:both"></div>
			<small>Developed by : Freelancing Care</small>
		</div>
	</div>
</div>


</div>
<?php

}
add_action ('wp_enqueue_scripts', 'tsu_styles');



function tsu_scripts() {
?>
<script type="text/javascript">
jQuery(document).ready(function () {
jQuery('#tsu_block').slideDown(5000);
jQuery('#tsu_close_icon').click(function(){
jQuery(this).fadeOut();
jQuery('#tsu_block').slideUp(1500);
});
});
</script>

<?php
}
add_action ('wp_footer', 'tsu_scripts')


?>