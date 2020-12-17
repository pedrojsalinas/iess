<?php
global $theme_options, $post;

if ( isset( $theme_options['display_doctor_department'] ) && '1' == $theme_options['display_doctor_department'] ) : ?>
    <div class="doctor-departments"><?php
	the_terms( $post->ID, 'department', ' ', ', ', ' ' ); ?>
    </div><?php
endif;
?>