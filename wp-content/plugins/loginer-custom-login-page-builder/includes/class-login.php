<?php

/**
 * The file that defines the core plugin class
 *
 * A class definition that includes attributes and functions used across both the
 * public-facing side of the site and the admin area.
 *
 * @link       https://templatetoaster.com/
 * @since      1.0.0
 *
 * @package    Login
 * @subpackage Login/includes
 */

/**
 * The core plugin class.
 *
 * This is used to define internationalization, admin-specific hooks, and
 * public-facing site hooks.
 *
 * Also maintains the unique identifier of this plugin as well as the current
 * version of the plugin.
 *
 * @since      1.0.0
 * @package    Login
 * @subpackage Login/includes
 * @author     TemplateToster <support@templatetoster.com>
 */
class Login {

	/**
	 * The loader that's responsible for maintaining and registering all hooks that power
	 * the plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      Login_Loader    $loader    Maintains and registers all hooks for the plugin.
	 */
	protected $loader;

	/**
	 * The unique identifier of this plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      string    $plugin_name    The string used to uniquely identify this plugin.
	 */
	protected $plugin_name;

	/**
	 * The current version of the plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      string    $version    The current version of the plugin.
	 */
	protected $version;

	/**
	 * Define the core functionality of the plugin.
	 *
	 * Set the plugin name and the plugin version that can be used throughout the plugin.
	 * Load the dependencies, define the locale, and set the hooks for the admin area and
	 * the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function __construct() {
		if ( defined( 'LOGIN_VERSION' ) ) {
			$this->version = LOGIN_VERSION;
		} else {
			$this->version = '1.0.0';
		}
		$this->plugin_name = 'login';

		$this->load_dependencies();
		$this->set_locale();
		$this->define_admin_hooks();
        $this->define_public_hooks();

        /** Global Variables */
        global $custom_login_page, 
        $custom_my_account, 
        $custom_register_page, 
        $custom_lost_password_page, 
        $custom_reset_password_page, 
        $default_login, 
        $default_register, 
        $default_lost_password, 
        $default_reset_password, 
        $default_account,
        $default_already_loggedin,
        $default_empty_username,
        $default_empty_password,
        $default_invalid_username,
        $default_invalid_email,
        $default_invalid_combo,
        $default_incorrect_password,
        $default_user_exists,
        $default_email_exists,
        $default_registeration_closed,
        $default_expired_key,
        $default_invalid_key,
        $default_password_mismatch;

        /** Default Headings */
        $default_login = __('Sign In','login');
        $default_register = __('Registeration');
        $default_lost_password = __('Lost Password');
        $default_reset_password = __('Reset Password');
        $default_account = __('My Account');

        /** Default Error Messages */
        $default_already_loggedin = __('You are Already Logged in.', 'login');
        $default_empty_username = __("Username can't be Empty.", 'login');
        $default_empty_password = __("Password can't be Empty.", 'login');
        $default_invalid_username = __('Invalid Username.', 'login');
        $default_invalid_email = __('Invalid Email.', 'login');
        $default_invalid_combo = __('No user registered with this Email.', 'login');
        $default_incorrect_password = __('Incorrect Password.', 'login');
        $default_user_exists = __('An account exists with this username.', 'login');
        $default_email_exists = __('An account exists with this email address.', 'login');
        $default_registeration_closed = __('Registering new users is currently not allowed.', 'login');
        $default_expired_key = __( 'Password reset Link Expired.', 'login' );
        $default_invalid_key = __( 'Password reset Link is Not Valid.', 'login' );
        $default_password_mismatch = __( "password and confirm password don't match.", 'login' );

        /** Custom Pages */
        $custom_login_page = get_option('custom_login_page') ? get_option('custom_login_page') : '';
        $custom_my_account = get_option('custom_my_account') ? get_option('custom_my_account') : '';
        $custom_register_page = get_option('custom_register_page') ? get_option('custom_register_page') : '';
        $custom_lost_password_page = get_option('custom_lost_password_page') ? get_option('custom_lost_password_page') : '';
        $custom_reset_password_page = get_option('custom_reset_password_page') ? get_option('custom_reset_password_page') : '';
        
        /** Shortcodes */
        add_shortcode('custom-login-form', array( $this, 'custom_login_form' ));
        add_shortcode('custom-account', array( $this, 'custom_account' ));
        add_shortcode('custom-register-form', array( $this, 'custom_registeration_form' ));
        add_shortcode('custom-lost-password-form', array( $this, 'custom_lost_password_form' ) );
        add_shortcode('custom-reset-password-form', array( $this, 'custom_reset_password_form' ) );

        /** Actions */
        add_action('login_form_login', array( $this, 'custom_login_redirect' ));
        add_action('login_form_register', array( $this, 'custom_registeration_redirect' ));
        add_action('login_form_register', array( $this, 'custom_registeration' ));
        add_action('login_form_lostpassword', array( $this, 'custom_lost_password_redirect' ) );
        add_action('login_form_lostpassword', array( $this, 'custom_lost_password' ) );
        add_action('login_form_rp', array( $this, 'custom_reset_password_redirect' ) );
        add_action('login_form_resetpass', array( $this, 'custom_reset_password_redirect' ) );
        add_action('login_form_rp', array( $this, 'custom_reset_password' ) );
        add_action('login_form_resetpass', array( $this, 'custom_reset_password' ) );
        add_action('wp_logout', array( $this, 'custom_logout_redirect' ));

        /** Filter */
        add_filter('page_template', array( $this, 'custom_pages_template' ), 30);
        add_filter('authenticate', array( $this, 'custom_authentication' ), 101, 3);
        add_filter('login_redirect', array( $this, 'custom_login_success_redirect' ), 10, 3);
        add_filter('woocommerce_login_redirect', array( $this, 'custom_login_success_redirect' ), 10, 3);
        add_filter( 'woocommerce_registration_redirect', array( $this, 'custom_registeration_redirect' ));
        add_filter( 'wp_new_user_notification_email', array( $this, 'custom_user_notification_email' ), 10, 4 );
	}

	/**
	 * Load the required dependencies for this plugin.
	 *
	 * Include the following files that make up the plugin:
	 *
	 * - Login_Loader. Orchestrates the hooks of the plugin.
	 * - Login_i18n. Defines internationalization functionality.
	 * - Login_Admin. Defines all hooks for the admin area.
	 * - Login_Public. Defines all hooks for the public side of the site.
	 *
	 * Create an instance of the loader which will be used to register the hooks
	 * with WordPress.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function load_dependencies() {

		/**
		 * The class responsible for orchestrating the actions and filters of the
		 * core plugin.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-login-loader.php';

		/**
		 * The class responsible for defining internationalization functionality
		 * of the plugin.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-login-i18n.php';

		/**
		 * The class responsible for defining all actions that occur in the admin area.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/class-login-admin.php';

		/**
		 * The class responsible for defining all actions that occur in the public-facing
		 * side of the site.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'public/class-login-public.php';

		$this->loader = new Login_Loader();

	}

	/**
	 * Define the locale for this plugin for internationalization.
	 *
	 * Uses the Login_i18n class in order to set the domain and to register the hook
	 * with WordPress.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function set_locale() {

		$plugin_i18n = new Login_i18n();

		$this->loader->add_action( 'plugins_loaded', $plugin_i18n, 'load_plugin_textdomain' );

	}

	/**
	 * Register all of the hooks related to the admin area functionality
	 * of the plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function define_admin_hooks() {

		$plugin_admin = new Login_Admin( $this->get_plugin_name(), $this->get_version() );

		$this->loader->add_action( 'admin_enqueue_scripts', $plugin_admin, 'enqueue_styles' );
		$this->loader->add_action( 'admin_enqueue_scripts', $plugin_admin, 'enqueue_scripts' );

	}

	/**
	 * Register all of the hooks related to the public-facing functionality
	 * of the plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function define_public_hooks() {

		$plugin_public = new Login_Public( $this->get_plugin_name(), $this->get_version() );

		$this->loader->add_action( 'wp_enqueue_scripts', $plugin_public, 'enqueue_styles' );
		$this->loader->add_action( 'wp_enqueue_scripts', $plugin_public, 'enqueue_scripts' );

	}

	/**
	 * Run the loader to execute all of the hooks with WordPress.
	 *
	 * @since    1.0.0
	 */
	public function run() {
		$this->loader->run();
	}

	/**
	 * The name of the plugin used to uniquely identify it within the context of
	 * WordPress and to define internationalization functionality.
	 *
	 * @since     1.0.0
	 * @return    string    The name of the plugin.
	 */
	public function get_plugin_name() {
		return $this->plugin_name;
	}

	/**
	 * The reference to the class that orchestrates the hooks with the plugin.
	 *
	 * @since     1.0.0
	 * @return    Login_Loader    Orchestrates the hooks of the plugin.
	 */
	public function get_loader() {
		return $this->loader;
	}

	/**
	 * Retrieve the version number of the plugin.
	 *
	 * @since     1.0.0
	 * @return    string    The version number of the plugin.
	 */
	public function get_version() {
		return $this->version;
	}

	/** Function to return error message for the given error code. */
    private function get_error_message($error_code)
    {
        global $default_already_loggedin,
        $default_empty_username,
        $default_empty_password,
        $default_invalid_username,
        $default_invalid_email,
        $default_invalid_combo,
        $default_incorrect_password,
        $default_user_exists,
        $default_email_exists,
        $default_registeration_closed,
        $default_expired_key,
        $default_invalid_key,
        $default_password_mismatch;

        switch ($error_code) {

            case 'already_loggedin':
                return get_option('custom_error_already_loggedin') ? get_option('custom_error_already_loggedin') : $default_already_loggedin ;
                
            case 'empty_username':
                return get_option('custom_error_empty_username') ? get_option('custom_error_empty_username') : $default_empty_username ;
            
            case 'empty_password':
                return get_option('custom_error_empty_password') ? get_option('custom_error_empty_password') : $default_empty_password ;
            
            case 'invalid_username':
                return get_option('custom_error_invalid_username') ? get_option('custom_error_invalid_username') : $default_invalid_username ;
            
            case 'invalid_email':
                return get_option('custom_error_invalid_email') ? get_option('custom_error_invalid_email') : $default_invalid_email ;
            
            case 'invalid_combo':
                return get_option('custom_error_invalid_combo') ? get_option('custom_error_invalid_combo') : $default_invalid_combo ;

            case 'incorrect_password':
                return get_option('custom_error_incorrect_password') ? get_option('custom_error_incorrect_password') : $default_incorrect_password ;
            
            case 'user_exists':
                return get_option('custom_error_user_exists') ? get_option('custom_error_user_exists') : $default_user_exists ;
            
            case 'email_exists':
                return get_option('custom_error_email_exists') ? get_option('custom_error_email_exists') : $default_email_exists ;
            
            case 'closed':
                return get_option('custom_error_registeration_closed') ? get_option('custom_error_registeration_closed') : $default_registeration_closed ;

            case 'expired_key':
                return get_option('custom_error_expired_key') ? get_option('custom_error_expired_key') : $default_expired_key ;
                
            case 'expired_key':
                return get_option('custom_error_invalid_key') ? get_option('custom_error_invalid_key') : $default_invalid_key ;
            
            case 'password_mismatch':
                return get_option('custom_error_password_mismatch') ? get_option('custom_error_password_mismatch') : $default_password_mismatch ;
        
            default:
                break;
        }
        return _e('An unknown error occurred. Please try again later.', 'login');
    }
    
    public function already_login()
    {
        ob_start(); ?>
        <div class="alert alert-danger"> 
            <p>
                <?php echo $this->get_error_message( 'already_loggedin' ) ?>
            </p>
        </div>
        <form>
            <a class="button " href="<?php echo wp_logout_url(); ?>">
                <?php _e('Logout', 'login');?>
            </a>
            <a class="button" href="<?php echo admin_url(); ?>">
                <?php _e('Admin', 'login');?>
            </a>
        <form>
        <?php
        $html = ob_get_contents();
        ob_end_clean();
        
        return $html;
    }

    function custom_user_notification_email( $user_email, $user, $blogname ) {
        global $custom_login_page;
        if (get_option('custom_new_registeration_mail') == 'yes') {
            $message = sprintf(__( "Welcome to %s! Here's your log in credentials:" ), $blogname ) . "\r\n";
            $message .= get_permalink($custom_login_page). "\r\n";
            $message .= sprintf(__( 'Username: %s' ), $user->user_login ) . "\r\n";
            $message .= sprintf(__( 'Password: %s' ), $_POST['pass1'] ) . "\r\n\r\n";
            $message .= sprintf(__( 'If you have any problems, please contact at %s.'), get_option( 'admin_email' ) ) . "\r\n";
            $user_email['message'] = $message;
        }
        
        return $user_email;
    }

    /** Function to load Custom Pages Template */
    function custom_pages_template($page_template)
    {
        if (is_page($this->login_page) || is_page($this->my_account) || is_page($this->register_page) || is_page($this->lost_password_page) || is_page($this->reset_password_page)) {
            $page_template = plugin_dir_path(dirname(__FILE__)) . 'templates/custom_pages.php';
        }
        return $page_template;
    }
    
    /** Function to Load Page HTML */
    private function get_custom_page_html($template_name, $attributes = null)
    {
        if (!$attributes) {
            $attributes = array();
        }
        
        ob_start();
        
        /* do_action('personalize_login_before_' . $template_name); */
        
        require plugin_dir_path(dirname(__FILE__)) . 'templates/' . $template_name . '.php';
        
        /* do_action('personalize_login_after_' . $template_name); */
        
        $html = ob_get_contents();
        ob_end_clean();
        
        return $html;
    }

    /** Function to redirect user to the custom login page instead of wp-login. */
    public function custom_login_redirect()
    {
        global $custom_login_page;
        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            $redirect_to = isset($_REQUEST['redirect_to']) ? $_REQUEST['redirect_to'] : null;
            
            if (is_user_logged_in()) {
                $this->custom_logged_in_user_redirect($redirect_to);
                exit;
            }
            
            // Redirect user to the login page.
            $redirect_url = get_permalink($custom_login_page);
            if (!empty($redirect_to)) {
                $redirect_url = add_query_arg('redirect_to', urlencode($redirect_to), $redirect_url);
            }
            
            wp_safe_redirect($redirect_url);
            exit;
        }
    }

    /** Shortcode for Login form. */
    public function custom_login_form($attributes, $content = null)
    {
        // Parse shortcode attributes
        $default_attributes = array(
            'show_title' => true,
            'redirect' => ''
        );
        if (isset($_REQUEST['redirect_to'])) {
            $attributes['redirect'] = $_REQUEST['redirect_to'];
        }
        $attributes = shortcode_atts($default_attributes, $attributes);
        ?>
        <div class="custom-form">
            <?php
            // Load page html from external template
            return $this->get_custom_page_html('custom_login_form', $attributes);
            ?>
        </div>
        <?php
    }
    
    /** Shortcode for account . */
    public function custom_account($attributes, $content = null)
    {
        // Parse shortcode attributes
        $default_attributes = array(
            'show_title' => true
        );
        $attributes = shortcode_atts($default_attributes, $attributes);
        ?>
        <div class="custom-form">
            <?php
            // Load page html from external template
            if(is_user_logged_in()){
                // Load page html from external template
                return $this->get_custom_page_html('custom_account_page', $attributes);
            }
            else{
                // Load page html from external template
                return $this->get_custom_page_html('custom_login_form', $attributes);
            }
            ?>
        </div>
        <?php
    }
    
    /** Function to redirect user to custom registration page */
    public function custom_registeration_redirect()
    {
        global $custom_register_page;
        if ('GET' == $_SERVER['REQUEST_METHOD']) {
            if (is_user_logged_in()) {
                $this->custom_logged_in_user_redirect();
            } else {
                wp_safe_redirect(get_permalink($custom_register_page));
            }
            exit;
        }
    }
    
    /** Shortcode for user registration . */
    public function custom_registeration_form($attributes, $content = null)
    {
        // Parse shortcode attributes
        $default_attributes = array(
            'show_title' => true
        );
        $attributes = shortcode_atts($default_attributes, $attributes);
        ?>
        <div class="custom-form">
            <?php
            return $this->get_custom_page_html('custom_register_form', $attributes);
            ?>
        </div>
        <?php
    }

    /** Function to handle user input and pass for user validation and registration */
    public function custom_registeration()
    {
        global $custom_login_page, $custom_register_page;
        if ('POST' == $_SERVER['REQUEST_METHOD']) {
            $register_url = get_permalink($custom_register_page);
            
            if (!get_option('users_can_register')) {
                // Registration closed, display error
                $redirect_url = add_query_arg('errors', 'closed', $register_url);
            } else {
                $user_email = $_POST['user_email'];
                $user_password = $_POST['pass1'];
                $user_confirm_password = $_POST['pass2'];
                $user_login = sanitize_text_field($_POST['user_login']);
                $result = $this->register_user($user_login, $user_email, $user_password, $user_confirm_password);
                
                if (is_wp_error($result)) {
                    // Parse errors into a string and append as parameter to redirect
                    $errors       = join(',', $result->get_error_codes());
                    $redirect_url = add_query_arg('errors', $errors, $register_url);
                } else {
                    // Success, redirect to login page.
                    $login_url    = get_permalink($custom_login_page);
                    $redirect_url = add_query_arg('registered', $user_email, $login_url);
                }
            }
            
            wp_safe_redirect($redirect_url);
            exit;
        }
    }

    /** Function to handle user registeration and send mail */
    private function register_user($username, $email, $password, $confirm_Password)
    {
        global $custom_login_page, $custom_register_page;
        $errors = new WP_Error();
        
        // Email address is used as both username and email. It is also the only
        // parameter we need to validate
        if (!is_email($email)) {
            $errors->add('invalid_email', $this->get_error_message('invalid_email'));
            return $errors;
        }
        
        if (username_exists($username)) {
            $errors->add('user_exists', $this->get_error_message('user_exists'));
            return $errors;
        }
        if (email_exists($email)) {
            $errors->add('email_exists', $this->get_error_message('email_exists'));
            return $errors;
        }
 
        if ( empty($password ) ) {
            // Password is empty
            $redirect_url = get_permalink($custom_register_page );
            $redirect_url = add_query_arg( 'errors', 'empty_password', $redirect_url );

            wp_safe_redirect( $redirect_url );
            exit;
        }
        else if ( $password != $confirm_Password ) {
            // Passwords don't match
            $redirect_url = get_permalink($custom_register_page );
            $redirect_url = add_query_arg( 'errors', 'password_mismatch', $redirect_url );
            wp_safe_redirect( $redirect_url );
            exit;
        }
        
        $user_data = array(
            'user_login' => $username,
            'user_email' => $email
        );
        
        $user_id = wp_insert_user($user_data);
        wp_set_password($password,$user_id);
        wp_new_user_notification($user_id);
        
        return $user_id;
    }
    
    /** Function to redirect user to custom lost password form  */
    public function custom_lost_password_redirect() {
        global $custom_lost_password_page;
        if ( 'GET' == $_SERVER['REQUEST_METHOD'] ) {
            if ( is_user_logged_in() ) {
                $this->custom_logged_in_user_redirect();
                exit;
            }
     
            wp_safe_redirect( get_permalink($custom_lost_password_page ) );
            exit;
        }
    }

    /** Shortcode for lost password*/
    public function custom_lost_password_form( $attributes, $content = null ) {
        // Parse shortcode attributes
        $default_attributes = array( 'show_title' => true );
        $attributes = shortcode_atts( $default_attributes, $attributes );
        ?>
        <div class="custom-form">
            <?php
            return $this->get_custom_page_html( 'custom_lost_password_form', $attributes );
            ?>
        </div>
        <?php
    }
    
    /** Function to handle user input for lost password */
    public function custom_lost_password() {
        global $custom_login_page, $custom_lost_password_page;
        if ( 'POST' == $_SERVER['REQUEST_METHOD'] ) {
            $errors = retrieve_password();
            if ( is_wp_error( $errors ) ) {
                // Errors found
                $redirect_url = get_permalink($custom_lost_password_page );
                $redirect_url = add_query_arg( 'errors', join( ',', $errors->get_error_codes() ), $redirect_url );
            } else {
                // Email sent
                $redirect_url = get_permalink($custom_login_page );
                $redirect_url = add_query_arg( 'lostpassword', 'success', $redirect_url );
            }
     
            wp_safe_redirect( $redirect_url );
            exit;
        }
    }
    
    /** Function to redirect user to custom reset password form  */
    public function custom_reset_password_redirect() {
        global $custom_login_page, $custom_reset_password_page;
        if ( 'GET' == $_SERVER['REQUEST_METHOD'] ) {
            // Verify key / login combo
            $user = check_password_reset_key( $_REQUEST['key'], $_REQUEST['login'] );
            if ( ! $user || is_wp_error( $user ) ) {
                if ( $user && $user->get_error_code() === 'expired_key' ) {
                    $login_url    = get_permalink($custom_login_page);
                    $redirect_url = add_query_arg('errors', 'expired_key', $login_url); 
                    wp_safe_redirect($redirect_url);
                } else {
                    $login_url    = get_permalink($custom_login_page);
                    $redirect_url = add_query_arg('errors', 'invalid_key', $login_url); 
                    wp_safe_redirect($redirect_url);
                }
                exit;
            }
     
            $redirect_url = get_permalink($custom_reset_password_page );
            $redirect_url = add_query_arg( 'login', esc_attr( $_REQUEST['login'] ), $redirect_url );
            $redirect_url = add_query_arg( 'key', esc_attr( $_REQUEST['key'] ), $redirect_url );
     
            wp_safe_redirect( $redirect_url );
            exit;
        }
    }

    /** Shortcode for reset password*/
    public function custom_reset_password_form( $attributes, $content = null ) {
        // Parse shortcode attributes
        $default_attributes = array( 'show_title' => true );
        $attributes = shortcode_atts( $default_attributes, $attributes );
        ?>
        <div class="custom-form">
            <?php
            return $this->get_custom_page_html( 'custom_reset_password_form', $attributes );
            ?>
        </div>
        <?php
    }

    /** Function to handle user input for reset password */
    public function custom_reset_password() {
        global $custom_login_page, $custom_reset_password_page;
        if ( 'POST' == $_SERVER['REQUEST_METHOD'] ) {
            $rp_key = $_REQUEST['rp_key'];
            $rp_login = $_REQUEST['rp_login'];
            $login_url = get_permalink($custom_login_page);
            $user = check_password_reset_key( $rp_key, $rp_login );
            if ( ! $user || is_wp_error( $user ) ) {
                $reset_url = get_permalink($custom_reset_password_page);
                if ( $user && $user->get_error_code() === 'expired_key' ) {
                    $redirect_url = add_query_arg('errors', 'expired_key', $login_url);
                    wp_safe_redirect($redirect_url);
                } else {
                    $redirect_url = add_query_arg('errors', 'invalid_key', $login_url);
                    wp_safe_redirect($redirect_url);
                }
                exit;
            }
     
            if ( isset( $_POST['pass1'] ) ) {
                if ( $_POST['pass1'] != $_POST['pass2'] ) {
                    // Passwords don't match
                    $redirect_url = get_permalink($custom_reset_password_page );
     
                    $redirect_url = add_query_arg( 'login', $rp_login, $redirect_url );
                    $redirect_url = add_query_arg( 'key', $rp_key, $redirect_url );
                    $redirect_url = add_query_arg( 'errors', 'password_mismatch', $redirect_url );
     
                    wp_safe_redirect( $redirect_url );
                    exit;
                }
     
                if ( empty( $_POST['pass1'] ) ) {
                    // Password is empty
                    $redirect_url = get_permalink($custom_reset_password_page );
     
                    $redirect_url = add_query_arg( 'key', $rp_key, $redirect_url );
                    $redirect_url = add_query_arg( 'login', $rp_login, $redirect_url );
                    $redirect_url = add_query_arg( 'errors', 'empty_password', $redirect_url );
     
                    wp_safe_redirect( $redirect_url );
                    exit;
                }
     
                // Parameter checks OK, reset password
                reset_password( $user, $_POST['pass1'] );
                $redirect_url = add_query_arg('password', 'changed', $login_url);
                wp_safe_redirect($redirect_url);
            } else {
                echo 'Invalid request.';
            }
     
            exit;
        }
    }
    
    /** Function to authenticate user and redirect if there were any errors. */
    public function custom_authentication($user, $username, $password)
    {
        global $custom_login_page;
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (is_wp_error($user)) {
                $error_codes = join(',', $user->get_error_codes());
                
                $login_url = get_permalink($custom_login_page);
                $redirect_url = add_query_arg('errors', $error_codes, $login_url);
                
                wp_safe_redirect($redirect_url);
                exit;
            }
        }
        return $user;
    }
                
    /** Function to redirects user to the page depending user is an admin or not. */
    private function custom_logged_in_user_redirect($redirect_to = null)
    {
        global $custom_my_account;
        if ($redirect_to) {
            wp_safe_redirect($redirect_to);
        }
        else {
            wp_safe_redirect(get_permalink($custom_my_account));
        }
    }
    
    /** Function to get URL to which the user should be redirected after login. */
    public function custom_login_success_redirect($redirect_to, $requested_redirect_to, $user)
    {
        global $custom_my_account;
        $redirect_url = home_url();
        
        if (!isset($user->ID)) {
            return $redirect_url;
        }
        
        if (user_can($user, 'manage_options')) {
            // Use the redirect_to parameter if one is set, otherwise redirect to admin dashboard.
            if ($requested_redirect_to == '') {
                //$redirect_url = admin_url();
                $redirect_url = get_permalink($custom_my_account);
            } else {
                $redirect_url = $requested_redirect_to;
            }
        } else {
            // Non-admin users always go to their account page after login
            $redirect_url = get_permalink($custom_my_account);
        }
        
        return wp_validate_redirect($redirect_url);
    }
    
    /** Function to redirect user to custom login page after logged out. */
    public function custom_logout_redirect()
    {
        global $custom_login_page;
        $login_url = get_permalink($custom_login_page);
        $redirect_url = add_query_arg('logged_out', 'success', $login_url);
        wp_safe_redirect($redirect_url);
        exit;
    }
        
}
