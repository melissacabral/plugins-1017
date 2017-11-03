<?php

/**
 * Plugin Name: Bitchin Announcement Bar
 * Description: put a banner up top that advertises sexy shit
 * License: GPLv3
 * Author : eh
 * Version: 1.0
 */

 //Output HTML
 add_action('wp_head','bitchin_ab_html');
 function bitchin_ab_html(){
     //Get the set options for the plugin
     $values = get_option('bitchin_bar');
     ?>
     <div id="bitchin_announcement">
        <p>
            <?php echo $values['text']; ?>
        </p>
        <a href="<?php echo $values['url']; ?>">
            <?php echo $values['link_text']; ?>
        </a>
     </div>
     <?php
 }

//ENQUEUE ASSETS
add_action('wp_enqueue_scripts','bitchin_ab_style');
function bitchin_ab_style(){
    //get file path
    $bitchin_css_url = plugins_url('bitchin-announcementbar-style.css',__FILE__);

    //tell wordpress to output stylesheet link tag
    wp_enqueue_style('bitchin_style',$bitchin_css_url);

    //js
	$bitchin_js_url = plugins_url('bitchin-announcementbar-script.js',__FILE__);
	if (wp_script_is( 'jquery', 'enqueued' )) {
	return;
	} else {
	wp_enqueue_script( 'jquery' );
	}
	wp_enqueue_script('fucker',$bitchin_js_url);
}

//  @TODO: ADD FUNCTIONALITY TO CUSTOMIZE

//Add settings interface
//add_options_page( $page_title, $menu_title, $capability, $menu_slug, $function);
add_action('admin_menu','bitchin_admin');
function bitchin_admin(){
    add_options_page('Bitchin Announcement Bar Settings','Announcement Bar','manage_options','bitchin-announcementbar','bitchin_admin_worked');
}
//callback function is to embed form for customizing the announcementbar
function bitchin_admin_worked(){
    include( plugin_dir_path(__FILE__) ).'bitchin-ab-form.php';
}

//Whitelist group of settings so wordpress allows the announcementbar to save its settings
add_action('admin_init','bitchin_ab_setting');
function bitchin_ab_setting(){
    //register_setting( string $option_group, string $option_name, array $args = array() )
    register_setting('bitchin_ab_group','bitchin_bar','bitchin_ab_cleaner');
}

//SANITIZE USER INPUT
// @param - raw input of user to sanitize
function bitchin_ab_cleaner($dirty){
    //KSES = strips evil scripts/ sanitizes user input. Built in wp function
    $clean['text'] = wp_kses($dirty['text']);
    $clean['link_text'] = wp_kses($dirty['link_text']);
    $clean['url'] = wp_kses($dirty['url']);

    return $clean;
}
