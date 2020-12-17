<?php
global $theme_options;

$contact_methods = array();

if ( inspiry_get_option( 'display_call_to_action' ) && '1' == inspiry_get_option( 'display_call_to_action' ) ) {



    if ( inspiry_get_option( 'CTA_number_title' ) || inspiry_get_option( 'CTA_number' ) ) {
        $contact_methods[] = array(
            'image'   => inspiry_get_option('CTA_number_icon')['url'],
            'title'   => inspiry_get_option( 'CTA_number_title' ),
            'content' => inspiry_get_option( 'CTA_number' ),
            'url'     => '',
        );
    }


    if ( inspiry_get_option( 'CTA_appointment_title' ) || inspiry_get_option( 'CTA_appointment' ) ) {
        $contact_methods[] = array(
            'image'   => inspiry_get_option( 'CTA_appointment_icon')['url'],
            'title'   => inspiry_get_option( 'CTA_appointment_title' ),
            'content' => inspiry_get_option( 'CTA_appointment' ),
            'url'     => inspiry_get_option( 'CTA_appointment_page_url' ),
        );
    }
}

if ( ! empty( $contact_methods ) ) :
    $count = 1;
    $total_items = count( $contact_methods );
    $col_class   = 'col';

    if ( 4 == $total_items ) {
        $col_class .= ' col-xl-3';
    } elseif ( 3 == $total_items ) {
        $col_class .= ' col-lg-4';
    }
    ?>
    <div align="center" class="call-to-action home-quotes">
        <div class="container">
            <div class="row align-items-center">
                <?php
                foreach ( $contact_methods as $contact_method ) :
                    $contact_method_image = $contact_method['image'];
                    $contact_method_title = $contact_method['title'];
                    $contact_method_content = $contact_method['content'];
                    $contact_method_url = $contact_method['url'];
                    if ( ! empty( $contact_method_title ) || ! empty( $contact_method_content ) ) : ?>
                        <div class="<?php echo esc_attr( $col_class ); ?>">
                            <?php if ($count == 1 ): ?>
                                <div class="call-to-action-item call-to-action-contact-<?php echo $count; ?>" style="border-right: 1px solid;">
                            <?php else: ?>
                                <div class="call-to-action-item call-to-action-contact-<?php echo $count; ?>">
                            <?php endif ?>
                                <?php
                                if ( ! empty( $contact_method_image ) ) : ?>
                                    <div class="call-to-action-icon">
                                        <img src="<?php echo $contact_method_image; ?>" alt="<?php echo $contact_method_title; ?>">
                                    </div>
                                <?php endif; ?>
                                <div class="call-to-action-action">
                                    <?php
                                    if ( ! empty( $contact_method_title ) ) {
                                        if ($count == 1){
                                            echo '<h2 class="call-to-action-title" style="font-size: 3.5rem;">' . esc_html( $contact_method_title ) . '</h2>';    
                                        }else{
                                            echo '<h4 class="call-to-action-title" style="text-align: center;padding: 0% 25%;font-size: 16px">' . esc_html( $contact_method_title ) . '</h4>';
                                        }
                                        
                                    }
                                   if ( ! empty( $contact_method_url ) ) {
                                        echo '<p class="call-to-action-content"><a  class="btn btn-info" onclick=abrir_ventana("'.$contact_method_url.'")>' . esc_html( $contact_method_content ) . '</a></p>';
                                    } elseif ( ! empty( $contact_method_content ) ) {
                                        echo '<p class="call-to-action-content">' . esc_html( $contact_method_content ) . '</p>';
                                    }
                                    ?>
                                </div>
                            </div>
                        </div>
                        <?php
                    endif;

                    if ( $count % 4 == 0 && $count < $total_items ) {
                        echo '</div><div class="row align-items-center">';
                    }

                    $count++;
                endforeach; ?>
            </div>
        </div>
    </div><!-- .call-to-action -->
<?php endif; ?>
<script language="JavaScript">
function abrir_ventana (pagina) {
var opciones="toolbar=yes,scrollbars=yes,resizable=yes,top=500,left=500";
window.open(pagina,"",opciones);
}
</script>