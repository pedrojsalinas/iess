<?php 
if ($attributes['show_title']){ 
    global $default_reset_password; 
    $heading = get_option('custom_reset_pass_heading') ? get_option('custom_reset_pass_heading') : $default_reset_password;
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
    resetpasswordform();
}
else if (is_user_logged_in()) {
    echo $this->already_login();
}
else{
    resetpasswordform();
}

function resetpasswordform(){
    // Pass the redirect parameter to the WordPress login functionality: by default,
    // use redirect only if a valid redirect url parameter passed.
    ob_start(); ?>
    <form method="post" action="<?php echo site_url( 'wp-login.php?action=resetpass' ); ?>">
        <input type="hidden" id="user_login" name="rp_login" value="<?php echo esc_attr( $_REQUEST['login'] ); ?>" autocomplete="off" />
        <input type="hidden" name="rp_key" value="<?php echo esc_attr( $_REQUEST['key'] ); ?>" />
        <div class="form-row">
            <label><?php _e( 'New password', 'login' ) ?></label>
            <input type="password" name="pass1" id="pass1" autocomplete="off" />
        </div>
        <div class="form-row">
            <label><?php _e( 'Repeat new password', 'login' ) ?></label>
            <input type="password" name="pass2" id="pass2" autocomplete="off" />
        </div>
        <div class="form-row">
            <p><?php echo wp_get_password_hint(); ?></p>
        </div>
        <div class="form-row">
            <input type="submit" name="submit" id="resetpass-button" class="button" value="<?php _e( 'Reset Password', 'login' ); ?>" /> 
        </div>
    </form>
    <?php 
    $html = ob_get_contents();
    return $html;
} ?>