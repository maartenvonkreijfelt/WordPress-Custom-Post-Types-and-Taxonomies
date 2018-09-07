<?php
/**
 * Plugin Name: Custom Post Types and Taxonomies
 * Plugin URI: http://yoursite.com
 * Description: A simple plugin that adds custom post types and taxonomies
 * Version: 0.1
 * Author: Maarten von Kreijfelt
 * Author URI: http://yoursite.com
 * License: GPL2
 */

/*  Copyright YEAR  YOUR_NAME  (email : your@email.com)

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License, version 2, as
    published by the Free Software Foundation.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/


function my_custom_posttypes() {

	//Testimonials post type
	$labels = array(
		'name'               => 'Testimonials',
		'singular_name'      => 'Testimonial',
		'menu_name'          => 'Testimonials',
		'name_admin_bar'     => 'Testimonial',
		'add_new'            => 'Add New',
		'add_new_item'       => 'Add New Testimonial',
		'new_item'           => 'New Testimonial',
		'edit_item'          => 'Edit Testimonial',
		'view_item'          => 'View Testimonial',
		'all_items'          => 'All Testimonials',
		'search_items'       => 'Search Testimonials',
		'parent_item_colon'  => 'Parent Testimonials:',
		'not_found'          => 'No testimonials found.',
		'not_found_in_trash' => 'No testimonials found in Trash.',
	);

	$args = array(
		'labels'             => $labels,
		'public'             => true,
		'publicly_queryable' => true,
		'show_ui'            => true,
		'show_in_menu'       => true,
		'menu_icon'          => 'dashicons-welcome-write-blog',
		'query_var'          => true,
		'rewrite'            => array( 'slug' => 'testimonials' ),
		'capability_type'    => 'post',
		'has_archive'        => true,
		'hierarchical'       => false,
		'menu_position'      => 5,
		'supports'           => array( 'title', 'editor', 'thumbnail' ),
		'show_in_rest'		 => true
	);


	register_post_type( 'testimonials', $args );



	//Reviews post types
	$labels = array(
		'name'               => 'Reviews',
		'singular_name'      => 'Review',
		'menu_name'          => 'Reviews',
		'name_admin_bar'     => 'Review',
		'add_new'            => 'Add New',
		'add_new_item'       => 'Add New Review',
		'new_item'           => 'New Review',
		'edit_item'          => 'Edit Review',
		'view_item'          => 'View Review',
		'all_items'          => 'All Reviews',
		'search_items'       => 'Search Reviews',
		'parent_item_colon'  => 'Parent Reviews:',
		'not_found'          => 'No Reviews found.',
		'not_found_in_trash' => 'No Reviews found in Trash.',
	);

	$args = array(
		'labels'             => $labels,
		'public'             => true,
		'publicly_queryable' => true,
		'show_ui'            => true,
		'show_in_menu'       => true,
		'menu_icon'          => 'dashicons-star-half',
		'query_var'          => true,
		'rewrite'            => array( 'slug' => 'reviews' ),
		'capability_type'    => 'post',
		'has_archive'        => true,
		'hierarchical'       => false,
		'menu_position'      => 5,
		'supports'           => array( 'title', 'editor', 'thumbnail', 'author','excerpt','comments'),
		'taxonomies'         => array('category', 'post_tag'),
		'show_in_rest'		 => true
	);


	register_post_type( 'reviews', $args );


}
add_action( 'init', 'my_custom_posttypes' );



// Flush rewrite rules to add "review" as a permalink slug
function my_rewrite_flush() {
	my_custom_posttypes();
	flush_rewrite_rules();
}
register_activation_hook( __FILE__, 'my_rewrite_flush' );






// Custom Taxonomies
function my_custom_taxonomies() {
	register_taxonomy(
		'Type of Product/Service',
		'review',
		array(
			'label' => __( 'Type of Product/Service' ),
			'rewrite' => array( 'slug' => 'product-type' ),
			'hierarchical' => true,
		)
	);

	register_taxonomy(
		'Price Range',
		'review',
		array(
			'label' => __( 'Price Range' ),
			'rewrite' => array( 'slug' => 'price' ),
			'hierarchical' => true,
		)
	);

	register_taxonomy(
		'Mood',
		'review',
		array(
			'label' => __( 'Mood' ),
			'rewrite' => array( 'slug' => 'mood' ),
			'hierarchical' => false,
		)
	);
}

add_action( 'init', 'my_custom_taxonomies' );