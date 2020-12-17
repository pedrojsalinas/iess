<?php 
if ($attributes['show_title']){ 
    global $default_register; 
    $heading = get_option('custom_register_heading') ? get_option('custom_register_heading') : $default_register;
?>
    <h2><?php echo $heading;?></h2>
<?php }
if(isset($_GET['errors'])){ ?>
    <div class="alert alert-danger"> 
    <?php
    if ( isset($_REQUEST['errors']) ) {
        // Retrieve possible errors from request parameters
        $error_codes = $_REQUEST['errors'] ? explode( ',', $_REQUEST['errors'] ) : [];
        
        foreach ( $error_codes as $error_code ) { ?>
            <p>
                <?php echo $this->get_error_message( $error_code ) ?>
            </p>
        <?php 
        }
    }
    ?>
    </div> 
    <?php 
    registerform();
}
else if (is_user_logged_in()) {
    echo $this->already_login();
}
elseif (!get_option('users_can_register')) {
    echo _e('Registering new users is currently not allowed.', 'login');
}
else{
    registerform();
}

function registerform(){
    // Pass the redirect parameter to the WordPress login functionality: by default,
    // use redirect only if a valid redirect url parameter passed.
    ob_start(); ?>
    <form method="post" action="<?php echo wp_registration_url(); ?>">
        <div class="form-row">
            <label><?php _e( 'Username', 'login' ); ?></label>
            <input type="text" name="user_login" id="user_login">
        </div>
        <div class="form-row">
            <label><?php _e( 'Email', 'login' ); ?> <strong>*</strong></label>
            <input type="email" name="user_email" id="user_email">
        </div>
        <?php 
        $registerWithPass = get_option('custom_new_registeration_mail');
        if($registerWithPass == 'yes')
        { ?>
            <div class="form-row">
                <label><?php _e( 'Password', 'login' ) ?></label>
                <input type="password" name="pass1" id="pass1" autocomplete="off" />
            </div>
            <div class="form-row">
                <label><?php _e( 'Confirm password', 'login' ) ?></label>
                <input type="password" name="pass2" id="pass2" autocomplete="off" />
            </div>
        <?php } ?>
        <p><?php _e( 'Registration confirmation will be send by email.', 'login' ); ?></p>
        <div class="form-row">
            <input type="submit" name="submit" class="button" value="<?php _e("Register",'login'); ?>"/>
        </div>
    </form>
    <?php 
    $html = ob_get_contents();
    return $html;
} ?>