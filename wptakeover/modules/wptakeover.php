<?php
class Wptakeover
{
	function scope(){
		$scope = array(
			'wp-content/uploads/' => array(
				'name' 		=> 'DirListing',
				'regex' 	=> '/Index of/m',
				'exploit' 	=> 'Dirlisting',
			), 
			'wp-content/uploads/wc-logs/' => array(
				'name' 		=> 'DirListing',
				'regex' 	=> '/Index of/m',
				'exploit' 	=> 'Dirlisting',
			), 
			'wp-content/plugins/woocommerce/readme.txt' => array(
				'name' 		=> 'WooCommerce',
				'regex' 	=> '/WooCommerce/m',
				'exploit' 	=> 'WooCommerce',
			), 
			'wp-content/uploads/mc4wp-debug.log' => array(
				'name' 		=> 'Mc4wp debug',
				'regex' 	=> '/API error/m',
				'exploit' 	=> 'Mc4wp',
			), 
			'wp-content/uploads/wp-lister/wplister.log' => array(
				'name' 		=> 'Wplister debug',
				'regex' 	=> '/gmail/m',
				'exploit' 	=> 'Debug',
			), 
			'wp-content/debug.log' => array(
				'name' 		=> 'WP debug',
				'regex' 	=> '/gmail/m',
				'exploit' 	=> 'Debug',
			), 
			'wp-content/uploads/affwp-debug.log' => array(
				'name' 		=> 'Affwp debug',
				'regex' 	=> '/verification/m',
				'exploit' 	=> 'Debug',
			), 
			'wp-content/plugins/woocommerce-plugin/lib/todopago.log' => array(
				'name' 		=> 'Woocommerce debug',
				'regex' 	=> '/gmail/m',
				'exploit' 	=> 'Debug',
			), 
			'wp-content/plugins/wp-cart-for-digital-products/subscription_handle_debug.log' => array(
				'name' 		=> 'WpCart debug',
				'regex' 	=> '/gmail/m',
				'exploit' 	=> 'Debug',
			), 
			'wp-content/uploads/dump.sql' => array(
				'name' 		=> 'Dump debug',
				'regex' 	=> '/gmail/m',
				'exploit' 	=> 'Debug',
			), 
			'wp-content/uploads/webhook2.log' => array(
				'name' 		=> 'Webhook2 debug',
				'regex' 	=> '/gmail/m',
				'exploit' 	=> 'Debug',
			), 
			'var/log/MailChimp.log' => array(
				'name' 		=> 'MailChimp debug',
				'regex' 	=> '/gmail/m',
				'exploit' 	=> 'Debug',
			), 
			'wp-content/uploads/yikes-log/yikes-easy-mailchimp-error-log.txt' => array(
				'name' 		=> 'Milchimp error debug',
				'regex' 	=> '/gmail/m',
				'exploit' 	=> 'Debug',
			), 
			'wp-content/uploads/woocommerce-order-export.csv.txt' => array(
				'name' 		=> 'Wocommerce export',
				'regex' 	=> '/gmail/m',
				'exploit' 	=> 'Debug',
			), 
		);
		return $scope;
	}
	function stuck($msg){
        echo $msg;
        $answer =  rtrim( fgets( STDIN ));
        return $answer;
    }
} 