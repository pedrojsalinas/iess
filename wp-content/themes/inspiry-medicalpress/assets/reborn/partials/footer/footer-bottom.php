<div class="site-footer-bottom">
    <div class="container">
                       <?php
                    if ( is_active_sidebar( 'footer-letter' ) ): ?>
                        <div class=" site-info">
                             <?php dynamic_sidebar( 'footer-letter' ); ?>
                        </div>
        
                    <?php
                    endif;
                
                

              
                
                ?>
        
            

            <div class="col-md-5 site-footer-bottom-right-col">
                <?php if ( isset( $theme_options['display_footer_social_icons'] ) && '1' == $theme_options['display_footer_social_icons'] ) : ?>
                    <div class="footer-social-nav-wrapper">
                        <?php if ( inspiry_get_option( 'footer_social_nav_title' ) ) : ?>
                            <h4 class="footer-social-nav-title"><?php echo inspiry_get_option( 'footer_social_nav_title' ); ?></h4>
                        <?php endif; ?>
                        <?php inspiry_social_nav( 'footer-social-nav', 'display_footer_social_icons'); ?>
                    </div><!-- .footer-social-nav-wrapper -->
                <?php endif; ?>
            </div>
    </div>
</div>
    



