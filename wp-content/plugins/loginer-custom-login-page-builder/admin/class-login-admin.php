<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       https://templatetoaster.com/
 * @since      1.0.0
 *
 * @package    Login
 * @subpackage Login/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Login
 * @subpackage Login/admin
 * @author     TemplateToster <support@templatetoster.com>
 */
class Login_Admin {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

		add_action('admin_init', array($this, 'custom_admin_redirect'));
        add_action('admin_menu', array($this, 'login_setting_options'));

	}

	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Login_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Login_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->plugin_name . '-style', plugin_dir_url( __FILE__ ) . 'css/login-admin.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Login_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Login_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/login-admin.js', array( 'jquery' ), $this->version, false );

	}

	
    public function login_setting_options()
    {
        add_menu_page(
            __('Login Setting Options','login'), // Page Title
            __('Login Settings','login'), // Menu Title
            'administrator', // Capablity
            __FILE__, // menu_slug
            array($this, 'login_setting_callback'), // Callback
            'dashicons-admin-tools' // Menu Icon
        );
        //call register settings function
        add_action('admin_init', array($this, 'register_login_settings'));
    }

    public function register_login_settings()
    {
        //register our settings
        register_setting('setting_options_group', 'restricted_role');
		register_setting('setting_options_group', 'custom_new_registeration_mail');
		
		/** Heading options */
        register_setting('setting_options_group', 'custom_login_heading');
        register_setting('setting_options_group', 'custom_register_heading');
        register_setting('setting_options_group', 'custom_lost_pass_heading');
        register_setting('setting_options_group', 'custom_reset_pass_heading');
		register_setting('setting_options_group', 'custom_account_heading');

		/** Error Message options */
        register_setting('setting_options_group', 'custom_error_already_loggedin');
        register_setting('setting_options_group', 'custom_error_empty_username');
        register_setting('setting_options_group', 'custom_error_empty_password');
        register_setting('setting_options_group', 'custom_error_invalid_username');
		register_setting('setting_options_group', 'custom_error_invalid_email');
        register_setting('setting_options_group', 'custom_error_invalid_combo');
        register_setting('setting_options_group', 'custom_error_incorrect_password');
        register_setting('setting_options_group', 'custom_error_user_exists');
		register_setting('setting_options_group', 'custom_error_email_exists');
        register_setting('setting_options_group', 'custom_error_registeration_closed');
        register_setting('setting_options_group', 'custom_error_expired_key');
        register_setting('setting_options_group', 'custom_error_invalid_key');
		register_setting('setting_options_group', 'custom_error_password_mismatch');

		/** Form Options */
        register_setting('setting_options_group', 'custom_form_background_color');
        register_setting('setting_options_group', 'custom_form_heading_color');
        register_setting('setting_options_group', 'custom_form_heading_font_size');
        register_setting('setting_options_group', 'custom_form_label_color');
        register_setting('setting_options_group', 'custom_form_label_font_size');
		register_setting('setting_options_group', 'custom_form_input_background_color');
		register_setting('setting_options_group', 'custom_form_input_color');
        register_setting('setting_options_group', 'custom_form_input_font_size');
        register_setting('setting_options_group', 'custom_form_paragraph_color');
        register_setting('setting_options_group', 'custom_form_paragraph_font_size');
		register_setting('setting_options_group', 'custom_form_link_color');
        register_setting('setting_options_group', 'custom_form_link_font_size');
		register_setting('setting_options_group', 'custom_form_link_hover_color');
        register_setting('setting_options_group', 'custom_form_link_hover_font_size');
		register_setting('setting_options_group', 'custom_form_button_background_color');
		register_setting('setting_options_group', 'custom_form_button_color');
        register_setting('setting_options_group', 'custom_form_button_font_size');
		register_setting('setting_options_group', 'custom_form_button_hover_background_color');
		register_setting('setting_options_group', 'custom_form_button_hover_color');
        register_setting('setting_options_group', 'custom_form_button_hover_font_size');
    }

    public function login_setting_callback()
    {?>
        <div class="wrap">
            <h1><?php _e('Login Setting Options','login'); ?></h1>
        </div><br>
        <?php
        if (current_user_can('administrator')) {
			global $default_login, 
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
		?>
			<form method="post" action="options.php">
				<div class="custom-options-settings custom-row">
					<div class="custom-options">
						<label class="heading">
							<b><?php _e('Restrict User to wp-admin','login')?></b>
						</label><br>
						<?php 
						settings_fields('setting_options_group');
						do_settings_sections('setting_options_group');
						$restricted_role = get_option('restricted_role') ? get_option('restricted_role') : array();
						// print the full list of roles with the primary one selected.
						foreach (wp_roles()->role_names as $rolekey => $role) {
							if ($rolekey != 'administrator') { ?>
								<label>
								<?php if (in_array($rolekey, $restricted_role)) {?>
									<input type="checkbox" value="<?php echo $rolekey ?>" name="restricted_role[]" checked>
								<?php } 
								else {?>
									<input type="checkbox" value="<?php echo $rolekey ?>" name="restricted_role[]">
								<?php }?>
								<?php echo $role ; ?></label><br>
							<?php }
						} ?>
					</div>
				</div>

				<div class="custom-options-settings custom-row">
					<div class="custom-options">
						<label class="heading">
							<b><?php _e('Send Password with new Registeration','login')?></b>
						</label>
						<input type="checkbox" name="custom_new_registeration_mail" value="yes" <?php echo(get_option('custom_new_registeration_mail') == 'yes') ? 'checked' : ''; ?>>
					</div>
				</div>

				<div class="custom-options-settings custom-row">
					<label class="heading custom-heading-box">
						<b><?php _e('Headings','login')?></b>
					</label>
					<div class="custom-column-4 custom-options">
						<div class="custom-blocks">
							<label class="heading">
								<b><?php _e('Sign in','login')?></b>
							</label>
							<input class="custom-heading-box" type="text" name="custom_login_heading" value="<?php echo(get_option('custom_login_heading')) ? get_option('custom_login_heading') : $default_login; ?>">
						</div>
					</div>
					<div class="custom-column-4 custom-options">
						<div class="custom-blocks">
							<label class="heading">
								<b><?php _e('Register','login')?></b>
							</label>
							<input class="custom-heading-box"  type="text" name="custom_register_heading" value="<?php echo(get_option('custom_register_heading')) ? get_option('custom_register_heading') : $default_register; ?>">
						</div>
					</div>
					<div class="custom-column-4 custom-options">
						<div class="custom-blocks">
							<label class="heading">
								<b><?php _e('Lost Password','login')?></b>
							</label>
							<input class="custom-heading-box"  type="text" name="custom_lost_pass_heading" value="<?php echo(get_option('custom_lost_pass_heading')) ? get_option('custom_lost_pass_heading') : $default_lost_password; ?>">
						</div>
					</div>
					<div class="custom-column-4 custom-options">
						<div class="custom-blocks">
							<label class="heading">
								<b><?php _e('Reset Password','login')?></b>
							</label>
							<input class="custom-heading-box"  type="text" name="custom_reset_pass_heading" value="<?php echo(get_option('custom_reset_pass_heading')) ? get_option('custom_reset_pass_heading') : $default_reset_password; ?>">
						</div>
					</div>
					<div class="custom-column-4 custom-options">
						<div class="custom-blocks">
							<label class="heading">
								<b><?php _e('Account','login')?></b>
							</label>
							<input class="custom-heading-box"  type="text" name="custom_account_heading" value="<?php echo(get_option('custom_account_heading')) ? get_option('custom_account_heading') : $default_account; ?>">
						</div>
					</div>
				</div>

				<div class="custom-options-settings custom-row">
					<label class="heading custom-heading-box">
						<b><?php _e('Error Messages','login')?></b>
					</label>
					<div class="custom-column-3 custom-options">
						<div class="custom-blocks">
							<label class="heading">
								<b><?php _e('Already Loggedin','login')?></b>
							</label>
							<input class="custom-heading-box" type="text" name="custom_error_already_loggedin" value="<?php echo(get_option('custom_error_already_loggedin')) ? get_option('custom_error_already_loggedin') : $default_already_loggedin ?>">
						</div>
					</div>
					<div class="custom-column-3 custom-options">
						<div class="custom-blocks">
							<label class="heading">
								<b><?php _e('Empty Username','login')?></b>
							</label>
							<input class="custom-heading-box" type="text" name="custom_error_empty_username" value="<?php echo(get_option('custom_error_empty_username')) ? get_option('custom_error_empty_username') : $default_empty_username ?>">
						</div>
					</div>
					<div class="custom-column-3 custom-options">
						<div class="custom-blocks">
							<label class="heading">
								<b><?php _e('Empty Password','login')?></b>
							</label>
							<input class="custom-heading-box" type="text" name="custom_error_empty_password" value="<?php echo(get_option('custom_error_empty_password')) ? get_option('custom_error_empty_password') : $default_empty_password ?>">
						</div>
					</div>
					<div class="custom-column-3 custom-options">
						<div class="custom-blocks">
							<label class="heading">
								<b><?php _e('Invalid Username','login')?></b>
							</label>
							<input class="custom-heading-box" type="text" name="custom_error_invalid_username" value="<?php echo(get_option('custom_error_invalid_username')) ? get_option('custom_error_invalid_username') : $default_invalid_username ?>">
						</div>
					</div>
					<div class="custom-column-3 custom-options">
						<div class="custom-blocks">
							<label class="heading">
								<b><?php _e('Invalid Email','login')?></b>
							</label>
							<input class="custom-heading-box" type="text" name="custom_error_invalid_email" value="<?php echo(get_option('custom_error_invalid_email')) ? get_option('custom_error_invalid_email') : $default_invalid_email ?>">
						</div>
					</div>
					<div class="custom-column-3 custom-options">
						<div class="custom-blocks">
							<label class="heading">
								<b><?php _e('No User Registered','login')?></b>
							</label>
							<input class="custom-heading-box" type="text" name="custom_error_invalid_combo" value="<?php echo(get_option('custom_error_invalid_combo')) ? get_option('custom_error_invalid_combo') : $default_invalid_combo ?>">
						</div>
					</div>
					<div class="custom-column-3 custom-options">
						<div class="custom-blocks">
							<label class="heading">
								<b><?php _e('Incorrect Password','login')?></b>
							</label>
							<input class="custom-heading-box" type="text" name="custom_error_incorrect_password" value="<?php echo(get_option('custom_error_incorrect_password')) ? get_option('custom_error_incorrect_password') : $default_incorrect_password ?>">
						</div>
					</div>
					<div class="custom-column-3 custom-options">
						<div class="custom-blocks">
							<label class="heading">
								<b><?php _e('User Already Exists','login')?></b>
							</label>
							<input class="custom-heading-box" type="text" name="custom_error_user_exists" value="<?php echo(get_option('custom_error_user_exists')) ? get_option('custom_error_user_exists') : $default_user_exists ?>">
						</div>
					</div>
					<div class="custom-column-3 custom-options">
						<div class="custom-blocks">
							<label class="heading">
								<b><?php _e('Email Already Exists','login')?></b>
							</label>
							<input class="custom-heading-box" type="text" name="custom_error_email_exists" value="<?php echo(get_option('custom_error_email_exists')) ? get_option('custom_error_email_exists') : $default_email_exists ?>">
						</div>
					</div>
					<div class="custom-column-3 custom-options">
						<div class="custom-blocks">
							<label class="heading">
								<b><?php _e('Registeration Closed','login')?></b>
							</label>
							<input class="custom-heading-box" type="text" name="custom_error_registeration_closed" value="<?php echo(get_option('custom_error_registeration_closed')) ? get_option('custom_error_registeration_closed') : $default_registeration_closed ?>">
						</div>
					</div>
					<div class="custom-column-3 custom-options">
						<div class="custom-blocks">
							<label class="heading">
								<b><?php _e('Expired Password Reset URL','login')?></b>
							</label>
							<input class="custom-heading-box" type="text" name="custom_error_expired_key" value="<?php echo(get_option('custom_error_expired_key')) ? get_option('custom_error_expired_key') : $default_expired_key ?>">
						</div>
					</div>
					<div class="custom-column-3 custom-options">
						<div class="custom-blocks">
							<label class="heading">
								<b><?php _e('Invalid Password Reset URL','login')?></b>
							</label>
							<input class="custom-heading-box" type="text" name="custom_error_invalid_key" value="<?php echo(get_option('custom_error_invalid_key')) ? get_option('custom_error_invalid_key') : $default_invalid_key ?>">
						</div>
					</div>
					<div class="custom-column-3 custom-options">
						<div class="custom-blocks">
							<label class="heading">
								<b><?php _e("Password and Confirm Password doesn't Match",'login')?></b>
							</label>
							<input class="custom-heading-box" type="text" name="custom_error_password_mismatch" value="<?php echo(get_option('custom_error_password_mismatch')) ? get_option('custom_error_password_mismatch') : $default_password_mismatch ?>">
						</div>
					</div>
				</div>

				<div class="custom-options-settings custom-row">
					<label class="heading custom-heading-box">
						<b><?php _e('Form','login')?></b>
					</label>
					<div class="custom-column-4 custom-options">
						<div class="custom-blocks">
							<label class="heading">
								<b><?php _e('Form Background Color','login')?></b>
							</label>
							<input type="color" name="custom_form_background_color" value="<?php echo(get_option('custom_form_background_color')) ? get_option('custom_form_background_color') : "#f7f7f7" ?>">
						</div>
					</div>

					<div class="custom-column-4 custom-options">
						<div class="custom-blocks">
							<label class="heading">
								<b><?php _e('Heading','login')?></b>
							</label>
							<div class="custom-sub-options-settings">
								<label>
									<b><?php _e('Font Color','login')?></b>
								</label>
								<input type="color" name="custom_form_heading_color" value="<?php echo(get_option('custom_form_heading_color')) ? get_option('custom_form_heading_color') : "#000000" ?>">
							</div>
							<div class="custom-sub-options-settings">
								<label>
									<b><?php _e('Font Size','login')?></b>
								</label>
								<select name="custom_form_heading_font_size">
									<?php $selected = get_option('custom_form_heading_font_size') ? get_option('custom_form_heading_font_size') : 30 ; ?>
									<option value="<?php echo $selected; ?>"> <?php echo $selected; ?> </option>
									<?php
									for($i=1; $i<100;$i++) { 
										if ($i != $selected) {?>
										<option value="<?php echo $i; ?>"> <?php echo $i; ?> </option>
									<?php }} ?>
								</select>
							</div>
						</div>
					</div>

					<div class="custom-column-4 custom-options">
						<div class="custom-blocks">
							<label class="heading">
								<b><?php _e('Paragraph & Messages','login')?></b>
							</label>
							<div class="custom-sub-options-settings">
								<label>
									<b><?php _e('Font Color','login')?></b>
								</label>
								<input type="color" name="custom_form_paragraph_color" value="<?php echo(get_option('custom_form_paragraph_color')) ? get_option('custom_form_paragraph_color') : "#000000" ?>">
							</div>
							<div class="custom-sub-options-settings">
								<label>
									<b><?php _e('Font Size','login')?></b>
								</label>
								<select name="custom_form_paragraph_font_size">
									<?php $selected = get_option('custom_form_paragraph_font_size') ? get_option('custom_form_paragraph_font_size') : 12 ; ?>
									<option value="<?php echo $selected; ?>"> <?php echo $selected; ?> </option>
									<?php
									for($i=1; $i<100;$i++) { 
										if ($i != $selected) {?>
										<option value="<?php echo $i; ?>"> <?php echo $i; ?> </option>
									<?php }} ?>
								</select>
							</div>
						</div>
					</div>

					<div class="custom-column-4 custom-options">
						<div class="custom-blocks">
							<label class="heading">
								<b><?php _e('Label','login')?></b>
							</label>
							<div class="custom-sub-options-settings">
								<label>
									<b><?php _e('Font Color','login')?></b>
								</label>
								<input type="color" name="custom_form_label_color" value="<?php echo(get_option('custom_form_label_color')) ? get_option('custom_form_label_color') : "#000000" ?>">
							</div>
							<div class="custom-sub-options-settings">
								<label>
									<b><?php _e('Font Size','login')?></b>
								</label>
								<select name="custom_form_label_font_size">
									<?php $selected = get_option('custom_form_label_font_size') ? get_option('custom_form_label_font_size') : 14 ; ?>
									<option value="<?php echo $selected; ?>"> <?php echo $selected; ?> </option>
									<?php
									for($i=1; $i<100;$i++) { 
										if ($i != $selected) {?>
										<option value="<?php echo $i; ?>"> <?php echo $i; ?> </option>
									<?php }} ?>
								</select>
							</div>
						</div>
					</div>

					<div class="custom-column-4 custom-options">
						<div class="custom-blocks">
							<label class="heading">
								<b><?php _e('Input Box','login')?></b>
							</label>
							<div class="custom-sub-options-settings">
								<label>
									<b><?php _e('Background Color','login')?></b>
								</label>
								<input type="color" name="custom_form_input_background_color" value="<?php echo(get_option('custom_form_input_background_color')) ? get_option('custom_form_input_background_color') : "#f8f8f8" ?>">
							</div>
							<div class="custom-sub-options-settings">
								<label>
									<b><?php _e('Font Color','login')?></b>
								</label>
								<input type="color" name="custom_form_input_color" value="<?php echo(get_option('custom_form_input_color')) ? get_option('custom_form_input_color') : "#000000" ?>">
							</div>
							<div class="custom-sub-options-settings">
								<label>
									<b><?php _e('Font Size','login')?></b>
								</label>
								<select name="custom_form_input_font_size">
									<?php $selected = get_option('custom_form_input_font_size') ? get_option('custom_form_input_font_size') : 14 ; ?>
									<option value="<?php echo $selected; ?>"> <?php echo $selected; ?> </option>
									<?php
									for($i=1; $i<100;$i++) { 
										if ($i != $selected) {?>
										<option value="<?php echo $i; ?>"> <?php echo $i; ?> </option>
									<?php }} ?>
								</select>
							</div>
						</div>
					</div>

					<div class="custom-column-4 custom-options">
						<div class="custom-blocks">
							<label class="heading">
								<b><?php _e('Link','login')?></b>
							</label>
							<div class="custom-sub-options-settings">
								<label class="heading">
									<b><?php _e('Normal','login')?></b>
								</label>
								<div class="custom-sub-options-settings">
									<label>
										<b><?php _e('Normal Font Color','login')?></b>
									</label>
									<input type="color" name="custom_form_link_color" value="<?php echo(get_option('custom_form_link_color')) ? get_option('custom_form_link_color') : "#000000" ?>">
								</div>
								<div class="custom-sub-options-settings">
									<label>
										<b><?php _e('Font Size','login')?></b>
									</label>
									<select name="custom_form_link_font_size">
										<?php $selected = get_option('custom_form_link_font_size') ? get_option('custom_form_link_font_size') : 14 ; ?>
										<option value="<?php echo $selected; ?>"> <?php echo $selected; ?> </option>
										<?php
										for($i=1; $i<100;$i++) { 
											if ($i != $selected) {?>
											<option value="<?php echo $i; ?>"> <?php echo $i; ?> </option>
										<?php }} ?>
									</select>
								</div>
							</div>

							<div class="custom-sub-options-settings">
								<label class="heading">
									<b><?php _e('Hover','login')?></b>
								</label>
								<div class="custom-sub-options-settings">
									<label>
										<b><?php _e('Hover Font Color','login')?></b>
									</label>
									<input type="color" name="custom_form_link_hover_color" value="<?php echo(get_option('custom_form_link_hover_color')) ? get_option('custom_form_link_hover_color') : "#000000" ?>">
								</div>
								<div class="custom-sub-options-settings">
									<label>
										<b><?php _e('Font Size','login')?></b>
									</label>
									<select name="custom_form_link_hover_font_size">
										<?php $selected = get_option('custom_form_link_hover_font_size') ? get_option('custom_form_link_hover_font_size') : 14 ; ?>
										<option value="<?php echo $selected; ?>"> <?php echo $selected; ?> </option>
										<?php
										for($i=1; $i<100;$i++) { 
											if ($i != $selected) {?>
											<option value="<?php echo $i; ?>"> <?php echo $i; ?> </option>
										<?php }} ?>
									</select>
								</div>
							</div>
						</div>
					</div>
					
					<div class="custom-column-4 custom-options">
						<div class="custom-blocks">
							<label class="heading">
								<b><?php _e('Button','login')?></b>
							</label>
							<div class="custom-sub-options-settings">
								<label class="heading">
									<b><?php _e('Normal','login')?></b>
								</label>
								<div class="custom-sub-options-settings">
									<label>
										<b><?php _e('Background Color','login')?></b>
									</label>
									<input type="color" name="custom_form_button_background_color" value="<?php echo(get_option('custom_form_button_background_color')) ? get_option('custom_form_button_background_color') : "#f7f7f7" ?>">
								</div>
								<div class="custom-sub-options-settings">
									<label>
										<b><?php _e('Font Color','login')?></b>
									</label>
									<input type="color" name="custom_form_button_color" value="<?php echo(get_option('custom_form_button_color')) ? get_option('custom_form_button_color') : "#000000" ?>">
								</div>
								<div class="custom-sub-options-settings">
									<label>
										<b><?php _e('Font Size','login')?></b>
									</label>
									<select name="custom_form_button_font_size">
										<?php $selected = get_option('custom_form_button_font_size') ? get_option('custom_form_button_font_size') : 14 ; ?>
										<option value="<?php echo $selected; ?>"> <?php echo $selected; ?> </option>
										<?php
										for($i=1; $i<100;$i++) { 
											if ($i != $selected) {?>
											<option value="<?php echo $i; ?>"> <?php echo $i; ?> </option>
										<?php }} ?>
									</select>
								</div>
							</div>
							<div class="custom-sub-options-settings">
								<label class="heading">
									<b><?php _e('Hover','login')?></b>
								</label>
								<div class="custom-sub-options-settings">
									<label>
										<b><?php _e('Background Color','login')?></b>
									</label>
									<input type="color" name="custom_form_button_hover_background_color" value="<?php echo(get_option('custom_form_button_hover_background_color')) ? get_option('custom_form_button_hover_background_color') : "#f8f8f8" ?>">
								</div>
								<div class="custom-sub-options-settings">
									<label>
										<b><?php _e('Font Color','login')?></b>
									</label>
									<input type="color" name="custom_form_button_hover_color" value="<?php echo(get_option('custom_form_button_hover_color')) ? get_option('custom_form_button_hover_color') : "#000000" ?>">
								</div>
								<div class="custom-sub-options-settings">
									<label>
										<b><?php _e('Font Size','login')?></b>
									</label>
									<select name="custom_form_button_hover_font_size">
										<?php $selected = get_option('custom_form_button_hover_font_size') ? get_option('custom_form_button_hover_font_size') : 14 ; ?>
										<option value="<?php echo $selected; ?>"> <?php echo $selected; ?> </option>
										<?php
										for($i=1; $i<100;$i++) { 
											if ($i != $selected) {?>
											<option value="<?php echo $i; ?>"> <?php echo $i; ?> </option>
										<?php }} ?>
									</select>
								</div>
							</div>
						</div>
					</div>
				</div>

				<?php submit_button();?>
			</form>
        <?php }
	}
	
    public function custom_admin_redirect()
    {
		global $custom_my_account;
        $profileuser = wp_get_current_user();
        $restricted_role = get_option('restricted_role') ? get_option('restricted_role') : array();
        if (is_user_logged_in()) {
            if (in_array($profileuser->roles[0], $restricted_role)) {
                $user_account = get_permalink($custom_my_account);
                $redirect_url = add_query_arg('status', 'restricted', $user_account);
                wp_safe_redirect($redirect_url);
            }
        }
    }
}
