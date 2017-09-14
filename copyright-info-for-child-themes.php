<?php 
/*
Plugin Name: Copyright Info For Child Themes
Plugin URI:  https://github.com/BAProductions
Description: This plugin allow you add copyright info to your child theme insted of you using the parent theme copy info section. just go apprence and an click crfc Theme the add the code aboved add to your footer.php save it then add text box reloade your site and done.
Version:     0.1
Author:      PressThemes/BAProductions/DJANHipHop
Author URI:  https://github.com/BAProductions
License:     GPL2
License URI: https://www.gnu.org/licenses/gpl-2.0.html
Author URI: http://192.168.1.86:82/WP_Portfoilo/
*/
/*{Copyright Info For Child Themes} is free software: you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation, either version 2 of the License, or
any later version.
 
{Copyright Info For Child Themes} is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
GNU General Public License for more details.
 
You should have received a copy of the GNU General Public License
along with {Copyright Info For Child Themes}. If not, see {License URI}.
*/
?>
<?php 
if ( ! defined( 'ABSPATH' ) ) {
	die;
}

defined( 'ABSPATH' ) or die("Hay, you cant access this file you, silly person!");

if ( !function_exists("add_action") ) {
	echo "Hay, you cant access this file you, silly person!";
	die;
}
?>
<?php 
//Make our public function to call the WordPress public function to add to the correct menu.
class crifct
{
	public function __construct() {
			// don't call add_shortcode here
			// actually, I worked with wordpress last year and
			// i think this is a good place to call add_shortcode 
			// (and all other filters) now...
			add_action( 'admin_menu', array($this, 'crifc_theme_add_options'));
			add_action( 'admin_init', array($this, 'crifct_custom_settings'));
			register_activation_hook( __FILE__, array($this, 'crifct_activate') );
	}
	public function crifct_activate() {
		// Activation code here
		$this->crifc_theme_add_options();
		$this->crifct_custom_settings();
		global $wp_rewrite;
		$wp_rewrite->flush_rules();
	}
	public function crifc_theme_add_options() {
		add_theme_page('CRFC Theme', 'CRFC Theme', 'edit_theme_options', 'crifc_theme_options', array($this, 'crifc_theme_options_page'));
	}
	public function crifct_custom_settings() {
		register_setting( 'crifct_settings_group', 'copyright_year', array($this, 'crifct_sanitize_copyright_year_handler'));
		register_setting( 'crifct_settings_group', 'copyright_text', array($this, 'crifct_sanitize_copyright_text_handler'));
		add_settings_section( 'crifct_options', 'Theme Setting', array($this, 'crifct_options'), 'customize_crifct');
		add_settings_field( 'copyright_year', 'Copyright year Start of Blog/Buisness:', array($this, 'crifct_copyright_year'), 'customize_crifct', 'crifct_options');
		add_settings_field( 'copyright_text', 'Copyright Text:',  array($this, 'crifct_copyright_text'), 'customize_crifct', 'crifct_options');
	}
	public function crifct_options() {
		echo 'Customize your copyright date';
	}
	public function crifct_copyright_year() {
		$copyright_year = esc_attr( get_option( 'copyright_year' ) );
		echo '<input type="text" name="copyright_year" value="'.$copyright_year.'" id="ptl" placeholder="Copyright Year" cols="100" rows="10" class="long" style="width:50%" pattern="[-+]?[0-9]*"/>';
	}
	public function crifct_copyright_text() {
		$copyright_text = esc_attr( get_option( 'copyright_text' ) );
		echo '<textarea type="text" name="copyright_text" id="copyright_text" placeholder="Copyright text" cols="100" rows="14" class="long"  style="width:50%">'.$copyright_text.'</textarea>';
	}
	public function crifc_theme_options_page(){
		require_once( plugin_dir_path(__FILE__) . 'inc/copyright_info_for_child_themes_page.php' );
	}
	public function crifct_sanitize_copyright_year_handler( $input ){
		$output = sanitize_text_field( $input );
		$output  = preg_replace('/\D/','',$output );
		return $output;
	}
	public function crifct_sanitize_copyright_text_handler( $input ){
		$allowed_html = array(
			'a' => array(
				'href' => array(),
				'target' => array(),
				'title' => array(),
				'rel' => array(),
			),
			'br' => array(),
		);
		$output = wp_kses( $input, $allowed_html );
		return $output;
	}
}
if (class_exists('crifct')){
	$crifct = new crifct();
	//add_action( 'admin_menu', array($this, 'scec_options_page'));
	//add_action( 'admin_enqueue_scripts', array($this, 'wptuts_add_color_picker'));
	//add_action( 'admin_init', array($this, 'scec_custom_settings'));
	//add_action( 'embed_oembed_html', array($this, 'soundCloud_embed'), 10, 3);
}
?>