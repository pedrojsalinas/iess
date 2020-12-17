<?php 
if ($attributes['show_title']){ 
    global $default_lost_password; 
    $heading = get_option('custom_lost_pass_heading') ? get_option('custom_lost_pass_heading') : $default_lost_password;
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
    lostpasswordform();
}
else if (is_user_logged_in()) {
    echo $this->already_login();
}
else{
    lostpasswordform();
}

function lostpasswordform(){
    // Pass the redirect parameter to the WordPress login functionality: by default,
    // use redirect only if a valid redirect url parameter passed.
    ob_start(); ?>
    <form method="post" action="<?php echo wp_lostpassword_url(); ?>">
        <div class="form-row">
            <label><?php _e( 'Email', 'login' ); ?></label>
            <input type="text" name="user_login" id="user_login">
        </div>
        <div class="form-row">
            <input type="submit" name="submit" class="button" value="Reset Password"/>
        </div>
    </form>
    <?php 
    $html = ob_get_contents();
    return $html;
} ?>