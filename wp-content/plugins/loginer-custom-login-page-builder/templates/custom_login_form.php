<?php 
if(!isset($attributes['redirect'])){
    $attributes['redirect'] = '';
}

if ($attributes['show_title']){ 
    global $default_login; 
    $heading = get_option('custom_login_heading') ? get_option('custom_login_heading') : $default_login;
?>
    <h2><?php echo $heading;?></h2>
<?php }

if(isset( $_REQUEST['errors'])){ ?>
    <div class="alert alert-danger"> 
            <?php
            // Retrieve possible errors from request parameters
            $error_codes = $_REQUEST['errors'] ? explode( ',', $_REQUEST['errors'] ) : [];
            
            foreach ( $error_codes as $error_code ) { ?>
                <p>
                    <?php echo $this->get_error_message( $error_code ) ?>
                </p>
            <?php 
            }
        ?>
    </div>
<?php }

if (is_user_logged_in()) {
    echo $this->already_login();
}
else if(isset($_GET['logged_out']) || isset($_GET['registered']) || isset($_GET['lostpassword'])){ ?>
    <div class="alert alert-success"> 
    <?php
    
    // Show Logout msg request parameters
    if ( isset( $_REQUEST['logged_out'] )) { ?>
        <p>
            <?php _e( 'You have signed out ', 'login' ); ?>
        </p>
    <?php }

    // show register success msg
    else if(isset( $_REQUEST['registered'] )){ ?>
        <p>
            <?php _e( 'You have successfully registered with <strong>'.$_REQUEST['registered'].'</strong>
            check email for credentials', 'login' ); ?>
        </p>
    <?php }
    else if(isset( $_REQUEST['reset_password'] )){ ?>
        <p>
            <?php _e( 'You have successfully registered with <strong>'.$_REQUEST['registered'].'</strong>
            check email for credentials', 'login' ); ?>
        </p>
    <?php
    }

    // show lost password success msg
    else if(isset( $_REQUEST['lostpassword'] ) && $_REQUEST['lostpassword'] == 'success'){ ?>
        <p>
            <?php _e( 'Password reset link send successfully to Email', 'login' ); ?>
        </p>
    <?php
        }
    ?>
    </div> 
    <?php loginform($attributes);
}
else{
    loginform($attributes);
}

function loginform($attributes){
    global $custom_register_page, $custom_lost_password_page;
    // Pass the redirect parameter to the WordPress login functionality: by default,
    // use redirect only if a valid redirect url parameter passed.
    ob_start();
    /* wp_login_form(
        array(
        'label_username' => __('Email', 'login' ),
        'label_log_in' => __('Sign In', 'login' ),
        'redirect' => $attributes['redirect']
        )
    );  */
    ?>
    <form method="post" action="<?php echo wp_login_url(); ?>">
        <div class="form-row">
            <label><?php _e( 'Email', 'login' ); ?></label>
            <input type="text" name="log" id="user_login">
        </div>
        <div class="form-row">
            <label><?php _e( 'Password', 'login' ); ?></label>
            <input type="password" name="pwd" id="user_pass">
        </div>
        <div class="form-row">
            <input type="submit" class="button" value="<?php _e( 'Sign In', 'login' ); ?>">
        </div>
        <a class="float-left custom-link" href="<?php echo get_permalink($custom_register_page); ?>">
            <?php _e('Register Now', 'login');?>
        </a>
        <a class="float-right custom-link" href="<?php echo get_permalink($custom_lost_password_page); ?>">
            <?php _e('Forgot your password?', 'login');?>
        </a>
    </form>
    <?php 
    $html = ob_get_contents();
    return $html;
} ?>