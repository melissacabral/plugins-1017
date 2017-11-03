<?php
/*
Plugin Name: Bitchin Portfolio Post Type
Description: Adds support for portfolio pieces
Author: Melissa Cabral
Plugin URI: http://wordpress.melissacabral.com
Author URI: http://melissacabral.com
Version: 0.1
License: GPLv3
*/

//register all post types and taxonomies here:
function bitchin_cpt(){
	register_post_type( 'portfolio_piece', array(
		'public' 		=> true,
		'has_archive' 	=> true,
		'menu_position'	=> 5, //below posts
		'menu_icon'		=> 'dashicons-images-alt2',
		'rewrite'		=> array(
			'slug'			=> 'portfolio', //mysite.com/portfolio
		),
		'supports'		=> array( 'title', 'editor', 'thumbnail', 
								'custom-fields', 'revisions', 'excerpt' ), 
		'labels'		=> array(
			'name' 			=> 'Portfolio Pieces',
			'singular_name'	=> 'Portfolio Piece',
			'not_found'		=> 'No Portfolio Pieces Found',
			'add_new_item'	=> 'Add New Portfolio Piece',
		),
	) );

	//add the taxonomy "portfolio_category"
	register_taxonomy( 'portfolio_category', 'portfolio_piece', array(
		'labels' 			=> array(
			'name' 				=> 'Portfolio Categories',
			'singular_name' 	=> 'Portfolio Category',
		),
		'hierarchical' 		=> true, //make it behave like categories, not tags
		'show_admin_column' => true, //better ui in the admin list of posts
		'sort'				=> true, //remember the order that terms are added
	) );

	//add the taxonomy "skill"
	register_taxonomy( 'skill', 'portfolio_piece', array(
		'labels' 			=> array(
			'name' 				=> 'Skills',
			'singular_name' 	=> 'Skill',
			'add_new_item' 		=> 'Add New Skill',
			'search_items'		=> 'Search Skills',
			'not_found'			=> 'No Skills Found',
		),
		'hierarchical' 		=> false, //make it behave like tags
		'show_admin_column' => true, //better ui in the admin list of posts
		'sort'				=> true, //remember the order that terms are added
	) );

}
add_action('init', 'bitchin_cpt');


/**
 * Flush the permalinks when this plugin activates - prevent 404 errors
 */
function bitchin_flush(){
	bitchin_cpt(); //register post types first
	flush_rewrite_rules(); //flush the permalinks
}
register_activation_hook( __FILE__ , 'bitchin_flush' );
