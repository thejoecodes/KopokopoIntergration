<?php
/*
Plugin Name: Kopokopo
Description: Add Kopokopo as a payment gateway to your website. To set up instant payment notifications, do the following: Go to KopoKopo API settings and get your API key. Put this in the API field inside WordPress on the Lipa na MPESA settings page. Set up the "HTTP(S) POST Configuration" on the API page at KopoKopo to be as such API: versionv3, Notification URL: http://example.com/?KOPOKOPO_IPN_LISTENER=1, Username: doesntmatter, Password: doesntmatterputanything, Replace example.com with your own domain name. 
Version: 1.2
Author: Evans Charles Wanguba
Author URI: https://ke.linkedin.com/in/evans-wanguba-07527875
*/
// function to create the DB / Options / Defaults					
function kopokopo_options_install() {

    global $wpdb;

    $transaction_table_name = $wpdb->prefix . "kopokopo_transactions";
    $charset_collate = $wpdb->get_charset_collate();
    $sql = "CREATE TABLE IF NOT EXISTS $transaction_table_name (
		  `id` varchar(3) CHARACTER SET utf8 NOT NULL,
		  `paysys` varchar(255) CHARACTER SET utf8 NOT NULL,
		  `account_number` varchar(255) CHARACTER SET utf8 NULL,
		  `amount` int(11) CHARACTER SET utf8 NOT NULL,
		  `balance` int(11) CHARACTER SET utf8 NULL,
		  `business_number` int(11) CHARACTER SET utf8 NOT NULL,
		  `currency` varchar(255) CHARACTER SET utf8 NOT NULL,
		  `first_name` varchar(255) CHARACTER SET utf8 NOT NULL,
		  `internal_transaction_id` int(11) CHARACTER SET utf8 NOT NULL,
		  `last_name` varchar(255) CHARACTER SET utf8 NOT NULL,
		  `middle_name` varchar(255) CHARACTER SET utf8 NULL,
		  `sender_phone` varchar(255) CHARACTER SET utf8 NOT NULL,
		  `service_name` varchar(255) CHARACTER SET utf8 NOT NULL,
		  `signature` varchar(255) CHARACTER SET utf8 NOT NULL,
		  `transaction_reference` varchar(255) CHARACTER SET utf8 NOT NULL,
		  `transaction_timestamp` varchar(50) CHARACTER SET utf8 NOT NULL,
		  `transaction_type` varchar(255) CHARACTER SET utf8 NOT NULL,
		  `username` varchar(255) CHARACTER SET utf8 NOT NULL,
		  `created_at` timestamp CHARACTER SET utf8 NOT NULL,
		  PRIMARY KEY (`id`)
		) $charset_collate;";
	
	$subscription_table_name = $wpdb->prefix . "kopokopo_subscriptions";
    $charset_sub_collate = $wpdb->get_charset_collate();
    $sql = "CREATE TABLE IF NOT EXISTS $subscription_table_name (
		  `id` int(11) CHARACTER SET utf8 NOT NULL,
		  `user_id` int(10) CHARACTER SET utf8 NOT NULL,
		  `start_at` timestamp CHARACTER SET utf8 NOT NULL,
		  `end_at` timestamp CHARACTER SET utf8 NOT NULL,
		  PRIMARY KEY (`id`)
		) $charset_sub_collate;";

    require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
    dbDelta($sql);
}

// run the install scripts upon plugin activation
register_activation_hook(__FILE__, 'kopokopo_options_install');

//menu items
add_action('admin_menu','kopokopo_payment_modifymenu');
function kopokopo_payment_modifymenu() {
	
	//this is the main item for the menu
	add_menu_page('Kopokopo', //page title
	'Kopokopo', //menu title
	'manage_options', //capabilities
	'kopokopo_transactions_list', //menu slug
	'kopokopo_transactions_list' //function
	);
	
	//this is a submenu
	add_submenu_page('kopokopo_transactions_list', //parent slug
	'Subscriptions', //page title
	'Subscriptions', //menu title
	'manage_options', //capability
	'kopokopo_subscriptions_list', //menu slug
	'kopokopo_subscriptions_list'); //function
}
define('ROOTDIR', plugin_dir_path(__FILE__));
require_once(ROOTDIR . 'transaction-list.php');
require_once(ROOTDIR . 'subscription-list.php');
