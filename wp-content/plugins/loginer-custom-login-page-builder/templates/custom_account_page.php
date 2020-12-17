<?php 
if (is_user_logged_in()) {
    if ($attributes['show_title']){ 
        global $default_account; 
        $heading = get_option('custom_account_heading') ? get_option('custom_account_heading') : $default_account;
    ?>
        <h2><?php echo $heading;?></h2>
    <?php }
    if ( isset( $_REQUEST['status'] )) { ?>
        <div class="alert alert-danger"> 
            <p>
                <?php _e( 'Panel was resricted by admin', 'login' ); ?>
            </p>
        </div>
    <?php }?>
    <div class="account">
        <form>
            <?php $profileuser = wp_get_current_user(); ?>
            <div class="form-row">
                <label><?php _e( 'UserName : ', 'login' ); ?></label>
                <p><?php echo $profileuser->user_login; ?></p>
            </div>
            <div class="form-row">
                <label><?php _e( 'First Name : ', 'login' ); ?></label>
                <p><?php echo $profileuser->first_name; ?></p>
            </div>
            <div class="form-row">
                <label><?php _e( 'Last Name : ', 'login' ); ?></label>
                <p><?php echo $profileuser->last_name; ?></p>
            </div>
            <div class="form-row">
                <label><?php _e( 'Nick Name : ', 'login' ); ?></label>
                <p><?php echo $profileuser->nickname; ?></p>
            </div>
            <div class="form-row">
                <label><?php _e( 'Display Name : ', 'login' ); ?></label>
                <p><?php echo $profileuser->display_name; ?></p>
            </div>
            <div class="form-row">
                <label><?php _e( 'Website : ', 'login' ); ?></label>
                <a class="websiteUrl" href="<?php echo $profileuser->user_url; ?>" target="_blank"><?php echo $profileuser->user_url; ?></a>
            </div>
            <div class="form-row">
                <label><?php _e( 'Email : ', 'login' ); ?></label>
                <p><?php echo $profileuser->user_email; ?></p>
            </div>
            <div class="form-row">
                <label><?php _e( 'User ID : ', 'login' ); ?></label>
                <p><?php echo $profileuser->ID; ?></p>
            </div>
            <a class="button" href="<?php echo wp_logout_url(); ?>">
                <?php _e('Logout', 'login');?>
            </a>
            <a class="button" href="<?php echo admin_url(); ?>">
                <?php _e('Admin', 'login');?>
            </a>
        </form>
    </div>
    <?php
} ?>