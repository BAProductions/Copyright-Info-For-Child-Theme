<?php 
if (!defined('WP_UNINSTALL_PLUGIN')) {
    die;
}
class CopyrightInfoForChildThemes_uninstaller
{
	public function __construct() {
			// don't call add_shortcode here
			// actually, I worked with wordpress last year and
			// i think this is a good place to call add_shortcode 
			// (and all other filters) now...
	}
	public function CopyrightInfoForChildThemes_uninstall(){
		$options = array( 'copyright_year', 'copyright_text' );
		foreach($options as $option_name){
			unregister_setting('', $option_name, '');
			delete_option($option_name);
		}
	}
}
if (class_exists('CopyrightInfoForChildThemes_uninstaller')){
	$CopyrightInfoForChildThemes_uninstaller = new CopyrightInfoForChildThemes_uninstaller();
	$CopyrightInfoForChildThemes_uninstaller->CopyrightInfoForChildThemes_uninstall();
}