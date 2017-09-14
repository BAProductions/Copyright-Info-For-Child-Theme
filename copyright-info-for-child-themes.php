<?php 
/*
Plugin Name: Copyright Info For Child Theme
Plugin URI:  https://github.com/BAProductions/Copyright-Info-For-Child-Themes
Description: this plugin is used to add copyright info to a child theme whaen the maain has pore copyright info system to begin width. This is not a subtute for your themes copyright info system but if your has the main themes has a pore copyright info system then this is the way to go not ideal but is the onely way I found you can do it with adding files to the child theme and causing an error.
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
class CopyrightInfoForChildTheme
{
	public function CopyrightInfoForChildTheme_init() {
		add_action( 'admin_menu', array($this, 'crifc_theme_add_options'));
		add_action( 'admin_init', array($this, 'CopyrightInfoForChildTheme_custom_settings'));
	}
	public function CopyrightInfoForChildTheme_activate() {
		// Activation code here
		$this->crifc_theme_add_options();
		$this->CopyrightInfoForChildTheme_custom_settings();
		flush_rewrite_rules();
	}
	public function CopyrightInfoForChildTheme_activate() {
		// Activation code here
		$this->crifc_theme_add_options();
		$this->CopyrightInfoForChildTheme_custom_settings();
		flush_rewrite_rules();
	}
	public function crifc_theme_add_options() {
		add_theme_page('CRFC Theme', 'CRFC Theme', 'edit_theme_options', 'crifc_theme_options', array($this, 'crifc_theme_options_page'));
	}
	public function CopyrightInfoForChildTheme_custom_settings() {
		register_setting( 'CopyrightInfoForChildTheme_settings_group', 'copyright_year', array($this, 'CopyrightInfoForChildTheme_sanitize_copyright_year_handler'));
		register_setting( 'CopyrightInfoForChildTheme_settings_group', 'copyright_text', array($this, 'CopyrightInfoForChildTheme_sanitize_copyright_text_handler'));
		add_settings_section( 'CopyrightInfoForChildTheme_options', 'Theme Setting', array($this, 'CopyrightInfoForChildTheme_options'), 'customize_CopyrightInfoForChildTheme');
		add_settings_field( 'copyright_year', 'Copyright year Start of Blog/Buisness:', array($this, 'CopyrightInfoForChildTheme_copyright_year'), 'customize_CopyrightInfoForChildTheme', 'CopyrightInfoForChildTheme_options');
		add_settings_field( 'copyright_text', 'Copyright Text:',  array($this, 'CopyrightInfoForChildTheme_copyright_text'), 'customize_CopyrightInfoForChildTheme', 'CopyrightInfoForChildTheme_options');
	}
	public function CopyrightInfoForChildTheme_options() {
		echo 'Customize your copyright date';
	}
	public function CopyrightInfoForChildTheme_copyright_year() {
		$copyright_year = esc_attr( get_option( 'copyright_year' ) );
		echo '<input type="text" name="copyright_year" value="'.$copyright_year.'" id="ptl" placeholder="Copyright Year" cols="100" rows="10" class="long" style="width:50%" pattern="[-+]?[0-9]*"/>';
	}
	public function CopyrightInfoForChildTheme_copyright_text() {
		$copyright_text = esc_attr( get_option( 'copyright_text' ) );
		echo '<textarea type="text" name="copyright_text" id="copyright_text" placeholder="Copyright text" cols="100" rows="14" class="long"  style="width:50%">'.$copyright_text.'</textarea>';
	}
	public function crifc_theme_options_page(){
		require_once( plugin_dir_path(__FILE__) . 'inc/copyright_info_for_child_themes_page.php' );
	}
	public function CopyrightInfoForChildTheme_sanitize_copyright_year_handler( $input ){
		$output = sanitize_text_field( $input );
		$output  = preg_replace('/\D/','',$output );
		return $output;
	}
	public function CopyrightInfoForChildTheme_sanitize_copyright_text_handler( $input ){
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
if (class_exists('CopyrightInfoForChildTheme')){
	$CopyrightInfoForChildTheme = new CopyrightInfoForChildTheme();	
	$CopyrightInfoForChildTheme->CopyrightInfoForChildTheme_init();
}
register_activation_hook( __FILE__, array($CopyrightInfoForChildTheme, 'CopyrightInfoForChildTheme_activate') );
register_deactivation_hook( __FILE__, array($CopyrightInfoForChildTheme, 'CopyrightInfoForChildTheme_activate') );
?>