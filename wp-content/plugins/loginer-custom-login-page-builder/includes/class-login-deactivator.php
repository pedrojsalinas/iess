<?php

/**
 * Fired during plugin deactivation
 *
 * @link       https://templatetoaster.com/
 * @since      1.0.0
 *
 * @package    Login
 * @subpackage Login/includes
 */

/**
 * Fired during plugin deactivation.
 *
 * This class defines all code necessary to run during the plugin's deactivation.
 *
 * @since      1.0.0
 * @package    Login
 * @subpackage Login/includes
 * @author     TemplateToster <support@templatetoster.com>
 */
class Login_Deactivator {

	/**
	 * Short Description. (use period)
	 *
	 * Long Description.
	 *
	 * @since    1.0.0
	 */
	public static function deactivate() {
		if(get_option('custom_login_page')){
            wp_delete_post(get_option('custom_login_page'), true);
            delete_option('custom_login_page');
        }
        if(get_option('custom_my_account')){
            wp_delete_post(get_option('custom_my_account'), true);
            delete_option('custom_my_account');
        }
        if(get_option('custom_register_page')){
            wp_delete_post(get_option('custom_register_page'), true);
            delete_option('custom_register_page');
        }
        if(get_option('custom_lost_password_page')){
            wp_delete_post(get_option('custom_lost_password_page'), true);
            delete_option('custom_lost_password_page');
        }
        if(get_option('custom_reset_password_page')){
            wp_delete_post(get_option('custom_reset_password_page'), true);
            delete_option('custom_reset_password_page');
        }
	}

}
