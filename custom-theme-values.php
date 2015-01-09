<?php
/*
Plugin Name: My Custom Theme Values
Plugin URI: http://www.junaidiqbal.net
Version: 1.0
Description: This plugin will provide user to use the custom dynamic values anywhere on the site by editing code OR by simply using short code that you can see the details on the plug-in setting page.
Author: Junaid Iqbal
Author UI: http://www.junaidiqbal.net
*/

// create custom plugin settings menu
add_action('admin_menu', 'jun_create_menu');

function jun_create_menu() {

	//create new top-level menu
	add_menu_page('Junaid Plugin Settings', 'Theme Settings', 'administrator', __FILE__, 'jun_settings_page',plugins_url('/images/icon.png', __FILE__));

	//call register settings function
	add_action( 'admin_init', 'register_mysettings' );
}


function register_mysettings() {
	//register our settings
	register_setting( 'jun-settings-group', 'my_value' );
}

function jun_get_option_shortcode( $theme_option ) {
	preg_match_all('/\(([^)]*)\)/', $theme_option['key'], $matches);
	$val2 = $matches[1][0];
  	$val = get_option( "my_value" );
	$val = $val[$val2];
	return $val;

}
add_shortcode( 'get-my-values', 'jun_get_option_shortcode' );

// work for adding short ccde button on tinymce editor //
add_action('init', 'add_button_to_admin_editor');
function add_button_to_admin_editor() {
   if ( current_user_can('edit_posts') &&  current_user_can('edit_pages') )
   {
     add_filter('mce_external_plugins', 'add_plugin_js');
     add_filter('mce_buttons', 'register_plugin_button');
   }
}
function register_plugin_button($buttons) {
   array_push($buttons, "custom_value");
   return $buttons;
}
function add_plugin_js($plugin_array) {
   $plugin_array['custom_value'] = plugins_url().'/my-custom-theme-values/js/editor_sc.js';
   return $plugin_array;
}
// work for adding short ccde button on tinymce editor //

function jun_settings_page() {
?>
<div class="wrap">
<h2>My Theme Custom Values</h2>

<form method="post" action="options.php">
    <?php settings_fields( 'jun-settings-group' ); ?>
    <?php do_settings_sections( 'jun-settings-group' );
	$options = get_option('my_value');
	//print_r($options);
	 ?>
    <table class="form-table">
    <thead id="tocopy">
    <?php for($r=0; $r<count($options); $r++){?>
        <tr valign="top">
        <th scope="row">My value <span>1</span></th>
        <td><input type="text" name="my_value[]" value="<?php echo $options[$r]; ?>" />
        <small>Use echo get_option( 'my_value' )[<span>0</span>]; in code to render value in frontend OR Use short code [get-my-values key="my_value(<span>0</span>)"] in posts and pages to render values.</small>
        <aside></aside>
        </td>
        </tr>
    <?php if($r==0)break;} ?>    
    </thead>    
        
        <tbody>
        <?php for($r=1; $r<count($options); $r++){?>
        <tr valign="top">
        <th scope="row">My value <span><?=$r+1?></span></th>
        <td><input type="text" name="my_value[]" value="<?php echo $options[$r]; ?>" />
        <small>Use echo get_option( 'my_value' )[<span><?=$r?></span>]; in code to render value in frontend OR Use short code [get-my-values key="my_value(<span><?=$r?></span>)"] in posts and pages to render values.</small>
        <aside><a class="removeList" href="javascript:void(0)" onclick="rem(this)">Remove Value</a></aside>
        </td>
        </tr>
    <?php } ?>    
        </tbody>

    </table>
    <a href="javascript:void(0)" class="addMore">Add More Options</a>
    <?php submit_button(); ?>

</form>
</div>
<script>
var count = <?=count($options)?>;
	jQuery('.addMore').click(function() {
		count 	= count + 1;
		$clone  = jQuery('thead#tocopy').clone();

		
		$clone.find('span').each(function() {
			jQuery(this).html(count-1);
		});
		
		$clone.find('input').each(function() {
			jQuery(this).attr('value', '');
		});
		
		$clone.find('aside').each(function() {
			jQuery(this).html('<a class="removeList" href="javascript:void(0)" onclick="rem(this)">Remove Value</a>');
		});
		
		jQuery(".form-table").find('tbody').append(''+$clone.html()+'');		
		
		
	});
function rem(str){
		jQuery(str).parent().parent().parent().remove();
		count 	= count - 1;
}
</script>
<?php } ?>