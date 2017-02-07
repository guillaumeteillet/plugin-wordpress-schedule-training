<?php
/*
Plugin Name: Schedule Training
Plugin URI: http://sg.palo-it.com
Description: Homemade plugin for the Palo-IT Agile Training (Palo-IT Singapore)
Version: 1.0
Author: Guillaume Teillet
Author URI: http://www.guillaumeteillet.com
License: GPL2
*/

include_once plugin_dir_path( __FILE__ ).'/core/ST_table_widget.php';
include_once plugin_dir_path( __FILE__ ).'/core/ST_details_widget.php';
include_once plugin_dir_path( __FILE__ ).'/core/ST_register_widget.php';
include_once plugin_dir_path( __FILE__ ).'/admin/ST_admin.php';

function scheduletraining_widget() {
	register_widget('scheduletraining_widget_paloit');
  register_widget('scheduletraining_details_widget_paloit');
  register_widget('scheduletraining_register_widget_paloit');
}

function sheduletraining_create_db() {

  global $wpdb;
  $version = get_option( 'schedule_training_version', '1.0' );
	$charset_collate = $wpdb->get_charset_collate();
	$table_name = $wpdb->prefix . 'schedule_training';

	$sql = "CREATE TABLE $table_name (
		id mediumint(9) NOT NULL AUTO_INCREMENT,
    name text,
    category text,
    pricing text,
    time_event text,
    lunch text,
		date_event_start text,
		date_event_end text,
		date_event_display text,
		timestamp_event_start text,
		timestamp_event_end text,
		instructors text,
		description text,
		readmore text,
		img_certif text,
		img_instructor text,
		link_register text,
		trainersprofile text,
		icon_area text,
		UNIQUE KEY id (id)
	) $charset_collate;";

	require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
	dbDelta( $sql );
}

register_activation_hook( __FILE__, 'sheduletraining_create_db' );
add_action('admin_menu', 'menu_admin_pages');
wp_register_style( 'schedule-table.css', plugin_dir_url( __FILE__ ) . 'css/schedule-table.css', array(), 0);
wp_enqueue_style( 'schedule-table.css');
add_shortcode('schedule-table', array('scheduletraining_widget_paloit', 'widget'));
add_shortcode('schedule-details', array('scheduletraining_details_widget_paloit', 'widget'));
add_shortcode('schedule-register', array('scheduletraining_register_widget_paloit', 'widget'));
add_action('widgets_init', 'scheduletraining_widget');
add_filter('widget_text','do_shortcode');
