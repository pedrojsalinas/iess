<?php

/**
 * Fired during plugin activation
 *
 * @link       https://templatetoaster.com/
 * @since      1.0.0
 *
 * @package    Login
 * @subpackage Login/includes
 */

/**
 * Fired during plugin activation.
 *
 * This class defines all code necessary to run during the plugin's activation.
 *
 * @since      1.0.0
 * @package    Login
 * @subpackage Login/includes
 * @author     TemplateToster <support@templatetoster.com>
 */
class Login_Activator {

	/**
	 * Short Description. (use period)
	 *
	 * Long Description.
	 *
	 * @since    1.0.0
	 */
	public static function activate() {
		$custom_pages = array(
            'login' => array(
                'title' => __('Custom Sign In', 'login'),
                'content' => '[custom-login-form]'
            ),
            'account' => array(
                'title' => __('Custom My Account', 'login'),
                'content' => '[custom-account]'
            ),
            'register' => array(
                'title' => __('Custom Register Form', 'login'),
                'content' => '[custom-register-form]'
            ),
            'lost-password' => array(
                'title' => __('Custom Forgot Password', 'login'),
                'content' => '[custom-lost-password-form]'
            ),
            'reset-password' => array(
                'title' => __('Custom Reset Password', 'login'),
                'content' => '[custom-reset-password-form]'
            )
        );
        foreach ($custom_pages as $slug => $page) {
            // Page already exist or not.
            $query = new WP_Query('pagename=' . $slug);
            if (!$query->have_posts()) {
                // Add page using data from the above array.
                $post_id = wp_insert_post(array(
                    'post_content' => $page['content'],
                    'post_name' => $slug,
                    'post_title' => $page['title'],
                    'post_status' => 'publish',
                    'post_type' => 'page',
                    'ping_status' => 'closed',
                    'comment_status' => 'closed'
                ));

                switch($slug){
                    case 'login':
                    update_option('custom_login_page',$post_id);
                    break;
                    case 'account':
                    update_option('custom_my_account',$post_id);
                    break;
                    case 'register':
                    update_option('custom_register_page',$post_id);
                    break;
                    case 'lost-password':
                    update_option('custom_lost_password_page',$post_id);
                    break;
                    case 'reset-password':
                    update_option('custom_reset_password_page',$post_id);
                    break;
                }
            }
        }
	}

}
