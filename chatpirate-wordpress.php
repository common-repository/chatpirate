<?php
/**
 * Plugin Name: ChatPirate
 * Plugin URI: https://chatpirate.com/integrations/wordpress
 * Description: The simplest live chat software for Wordpress. Chat with your visitors in real-time, collect leads, and increase your sales! Yarrrgh!
 * Version: 2.0.1
 * Author: ChatPirate
 * Author URI: https://chatpirate.com
 */

if ( !defined( 'ABSPATH' ) ) {
    exit;
}

$errors = array();

global $wp_version;
if (version_compare($wp_version, "3", "<")) {
    $errors[] = "Requires <strong>WordPress 3</strong> or newer <br>";
}

if (in_array( 'chatpirate-woocommerce/chatpirate-woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins')))){
    $errors[] = '<strong>ChatPirate-WooCommerce</strong> plugin is enabled.<br>Please turn off ChatPirate-WooCommerce plugin.';
}

if(!empty($errors))
{
    if (is_admin()) {
        require_once(plugin_dir_path(__FILE__) . '/classes/admin-chatpirate.class.php');
        $admin = new admin_chatpirate($errors);
    }
}
else
{
    if (is_admin()) {
        require_once(plugin_dir_path(__FILE__) . '/config/settings.inc.php');
        require_once(plugin_dir_path(__FILE__) . '/classes/admin-chatpirate.class.php');
        $admin = new admin_chatpirate();
    } else {
        require_once(plugin_dir_path(__FILE__) . '/classes/front-chatpirate.class.php');
        $front = new front_chatpirate();
    }
}
