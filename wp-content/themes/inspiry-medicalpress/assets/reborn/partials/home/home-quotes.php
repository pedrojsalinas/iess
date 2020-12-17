<div class="home-section home-quotes">
    <div class="container">
		<?php
		global $theme_options;
		if ( ( ! empty( $theme_options['home_quotes_title'] ) ) || ( ! empty( $theme_options['home_quotes_description'] ) ) ) :
			?>
            <header class="home-section-header animated fadeInUp">
				<?php
				if ( ! empty( $theme_options['home_quotes_title'] ) ) :
					echo '<h3 class="home-section-title">' . $theme_options['home_quotes_title'] . '</h3>';
				endif;

				if ( ! empty( $theme_options['home_quotes_description'] ) ) :
					echo '<p class="home-section-description">' . $theme_options['home_quotes_description'] . '</p>';
				endif;
				?>
            </header>
			<?php
		endif; ?>
	</div>
</div>
<?php
get_template_part( INSPIRY_PARTIALS . '/footer/quotes-call-to-action' ); ?>

