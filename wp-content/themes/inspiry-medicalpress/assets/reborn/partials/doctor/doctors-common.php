<?php
global $theme_options;

get_header(); ?>

    <div class="doctors-page">

        <div class="filters-wrapper">
            <div class="container">
				<?php inspiry_filters( 'department', __( 'Áreas', 'framework' ) ); ?>
            </div>
        </div><!-- .filter-wrapper -->

        <div class="container">

	        <?php get_template_part( INSPIRY_PARTIALS . '/common/page-content' ); ?>

            <div id="isotope-container" class="isotope-container row">
				<?php
				$classes = 'isotope-item col-sm-6';

				if ( is_page_template( 'templates/doctors-four-col.php' ) ) {

					$classes .= ' col-lg-3';

				} else if ( is_page_template( 'templates/doctors-three-col.php' ) ) {

					$classes .= ' col-lg-4';

				}

				$doctor_args = array(
					'post_type'      => 'doctor',
					'posts_per_page' => - 1,
				);

				$inspiry_sort_doctors = apply_filters( 'inspiry_sort_doctors', $doctor_args );

				// The Query
				$doctor_query = new WP_Query( $inspiry_sort_doctors );

				// The Loop
				if ( $doctor_query->have_posts() ) :

					while ( $doctor_query->have_posts() ) :

						$doctor_query->the_post();

						/* Department terms slug needed to be used as classes in html for isotope functionality */
						$term_slug = '';
						$terms     = get_the_terms( $post->ID, 'department' );

						if ( ! empty( $terms ) ) {

							foreach ( $terms as $term ) {
								$term_slug .= ' ' . $term->slug;
							}
						}
						?>
                        <div class="<?php echo esc_attr( $classes . $term_slug ); ?>">
                            <article class="doctor-common doctor-grid doctor-grid-one hentry">
								<?php
								if(
									isset( $theme_options['display_doctors_hover_effect'] ) &&
									'1' == $theme_options['display_doctors_hover_effect']
								) {
									$image_id       = get_post_thumbnail_id();
									$full_image_url = wp_get_attachment_url( $image_id );
									?>
									<figure class="overlay-effect">
										<?php inspiry_standard_thumbnail( 'doctor-grid-thumb' ); ?>
										<a class="overlay" href="<?php the_permalink(); ?>"><i class="top"></i> <i class="bottom"></i></a>
									</figure>
									<?php
								} else {
									inspiry_standard_thumbnail( 'doctor-grid-thumb' );
								}
								?>
                                <div class="entry-content">
                                    <h3 class="entry-title">
                                        <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                                    </h3>
									<?php get_template_part( INSPIRY_PARTIALS . '/doctor/doctors-department' ); ?>
                                </div>
                            </article>
                        </div>
						<?php
					endwhile;
				else :
					nothing_found( __( 'No doctor found !', 'framework' ) );
				endif;

				/* Restore original Post Data */
				wp_reset_postdata();
				?>
            </div><!-- .isotope-container -->
        </div><!-- .container -->
    </div>

<?php get_footer(); ?>