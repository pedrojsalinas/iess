<div class="home-section home-inline">
    <div class="container">
		<?php
		global $theme_options;

		if ( ( ! empty( $theme_options['home_inline_title'] ) ) || ( ! empty( $theme_options['home_inline_description'] ) ) ) :
			?>
            <header class="home-section-header animated fadeInUp">
				<?php
				if ( ! empty( $theme_options['home_inline_title'] ) ) :
					echo '<h3 class="home-section-title">' . $theme_options['home_inline_title'] . '</h3>';
				endif;

				if ( ! empty( $theme_options['home_inline_description'] ) ) :
					echo '<p class="home-section-description">' . $theme_options['home_inline_description'] . '</p>';
				endif;
				?>
            </header>
			<?php
		endif;
		$inline_variation_2 = $theme_options['inline_variation_2'];
		$inline_variation_2_title = array_filter( $inline_variation_2[0] );
		$has_inline         = ! empty( $inline_variation_2 ) && ! empty( $inline_variation_2_title );
		if ( $has_inline ) : ?>
        <div class="container">
            <div class="row">
				<?php foreach ( $inline_variation_2 as $inline ) : ?>
                    <div class="col-md-4">
                        <div class="home-inline-item">
                            <div class="home-inline-item-image">
								<?php
								if ( ! empty( $inline['url'] ) ) {
									echo '<a target="_blank" href="' . $inline['url'] . '">';
									echo '<img src="' . $inline['image'] . '" alt="' . $inline['title'] . '"/>';
									echo '</a>';
								} else {
									echo '<img src="' . $inline['image'] . '" alt="' . $inline['title'] . '"/>';
								}
								?>
                            </div>
                            <div class="home-inline-item-content">
                                <h3 class="home-inline-item-title">
									<?php
									if ( ! empty( $inline['url'] ) ) {
										echo '<a target="_blank" href="' . $inline['url'] . '">';
										echo $inline['title'];
										echo '</a>';
									} else {
										echo $inline['title'];
									}
									?>
                                </h3>
                                <p class="home-inline-item-description"><?php echo $inline['description']; ?></p>
                            </div>
                        </div>
                    </div>
				<?php endforeach; ?>
            </div>
        	</div>
    	
    	<?php
    	endif;


	

		

		/* Restore original Post Data */
		wp_reset_postdata();
		?>
    </div>
	<?php
	if ( '1' == $theme_options['display_show_all_inline_button'] ) : ?>
        <div class="text-center btn-wrapper">
            <a class="btn btn-primary" href="<?php echo esc_url( $theme_options['show_all_services_button_link'] ); ?>"></a>
        </div>
	<?php endif; ?>
</div>