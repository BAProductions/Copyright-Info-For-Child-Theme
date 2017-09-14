<div class="wrap">
  <h1><?php echo esc_html(get_admin_page_title())?></h1>
  <?php settings_errors(); ?>
  <form method="post" action="options.php" id="crfct_form">
  <table class="form-table">
    <tr>
      <th class="label"><label for="copyright_code">Copyright Footer Demo:</label></th>
      <td align="left" scope="row">&copy 2010- <?php echo date("Y") ?>, PressTheme. and power by <a href="http://themeforest.net/user/WPExplorer?ref=WPExplorer" target="_blank" title="WPExplorer" rel="nofollow">WPExplorer Themes</a> modded by PressTheme </td>
    </tr>
    <tr>
      <th class="label"><label for="copyright_code">Updated Copyright Footer Code:</label></th>
      <td align="left" scope="row"><textarea cols="100" rows="19" class="long" id="copyright_code" style="width:50%; overflow:hidden; resize:none; padding:2px 4px;" onfocus="this.select();" onmouseup="return false;">
<?php echo htmlentities("<?php ") ?> &#13;
    if (function_exists('pressttheme_crfct_copyright_info')) {
    	//Copyright date
        echo pressttheme_crfct_copyright_info();
    } else {
        //Copyright Symbol
        echo "&copy ";
        //Copyright Year
        echo stripslashes(get_option("copyright_year"));
        //Copyright Dash
        echo "-";
        //Current Year
        echo date("Y");
        //Copyright Comma
        echo ", ";
        //Copyright Text
        echo stripslashes(get_option("copyright_text"));
    }
<?php echo '?>' ?>
</textarea></td>
    </tr>
    <?php 
        settings_fields( 'CopyrightInfoForChildTheme_settings_group' ); // This will output the nonce, action, and option_page fields for a settings page.
        do_settings_sections( 'customize_CopyrightInfoForChildTheme' ); // This prints out the actual sections containing the settings fields for the page in parameter 
        ?>
    <?php submit_button("Update"); ?>
  </table>
  </form>
</div>
