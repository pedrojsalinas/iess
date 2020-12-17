<div class="home-section home-blog">
  <style media="screen">
    .mg-radius{
      width: 70px!important;
      height: 70px!important;
      border-radius: 50%!important;
    }
    .thumb-size-min figure{
      width: 90px!important;
      float: left!important;
    }
    .entry-title{
      float: initial!important;
    }
    .mg-sixe{
      height: 280px!important;
      width: auto!important;
    }

  </style>
    <div class="container">
		<?php
		global $theme_options;

		if ( ! empty( $theme_options['home_news_title'] ) || ! empty( $theme_options['home_news_description'] ) ) : ?>
            <header class="home-section-header animated fadeInUp" style="margin-bottom: 60px;">
				<?php
				if ( ! empty( $theme_options['home_news_title'] ) ) :
					echo '<h2 class="home-section-title">' . $theme_options['home_news_title'] . '</h2>';
				endif;

				if ( ! empty( $theme_options['home_news_description'] ) ) :
					echo '<p class="home-section-description">' . $theme_options['home_news_description'] . '</p>';
				endif;

				if ( ! empty ('1' == $theme_options['display_show_all_noticias_button'] )) :
					echo '<div class="text-center btn-wrapper"><a class="btn btn-primary" href=' . esc_url( $theme_options['show_all_noticias_button_link'] ) . '>' . esc_html( $theme_options['show_content'] ) . '</a></div>';
				endif;
				?>
            </header>
			<?php
		endif;

		$posts_per_page = isset( $theme_options['home_news_per_page'] ) ? intval( $theme_options['home_news_per_page'] ) : 5;

		$home_blog_args = array(
			'post_type'           => 'post',
			'posts_per_page'      => $posts_per_page,
			'ignore_sticky_posts' => 1,
			'tax_query'           => array(
				array(
					'taxonomy' => 'post_format',
					'field'    => 'slug',
					'terms'    => array( 'post-format-quote', 'post-format-link', 'post-format-audio' ),
					'operator' => 'NOT IN'
				)
			),
			'meta_query'          => array(
				array(
					'key'     => '_thumbnail_id',
					'compare' => 'EXISTS'
				)
			)
		);

		// Filter Posts Based on User Selection in Theme Options
		$inspiry_filter_args = apply_filters( 'inspiry_filter_news', $home_blog_args );

		// The Query
		$home_blog_query = new WP_Query( $inspiry_filter_args );
		$found_posts     = $home_blog_query->post_count;
		$column_class    = 'col-md-6';

		if ( 3 == $found_posts ) {
			$column_class .= ' col-lg-4';
		} elseif ( 4 == $found_posts ) {
			$column_class .= ' col-lg-3';
		}

		// The Loop
		if ( $home_blog_query->have_posts() ) :
			$counter = 1;
			?>
            <div class="row" style="background: #fff;padding: 30px 10px;">
				<?php
				while ( $home_blog_query->have_posts() ) : $home_blog_query->the_post();
					if ( 3 >= $found_posts ) : ?>
                        <div class="<?php echo esc_attr( $column_class ); ?> col-large-post" >
                            <article <?php post_class( 'clearfix' ); ?>>
								<?php inspiry_standard_thumbnail( 'common-grid-thumb' ); ?>
                                <div class="entry-content-wrapper">
                                    <h4 class="entry-title text-truncate">
                                        <a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a>
                                    </h4>
                                    <p><?php inspiry_excerpt( 26, '' ); ?></p>
                                </div>
                            </article><!-- .hentry -->
                        </div>
					<?php else : ?>
						<?php if ( 1 == $counter ) : ?>
                            <div class="<?php //echo esc_attr( $column_class ); ?>col-lg-6 col-large-post" style="text-align:center">
                                <article <?php //post_class( 'clearfix' ); ?>>
                                    <h4 class="entry-title" style="color:#242524;font-size:1.1em; width:422px;margin: auto;">
                                            <a href="<?php the_permalink(); ?>" rel="bookmark"><b><?php the_title(); ?></b></a>
                                        </h4>
									<?php inspiry_standard_thumbnail( 'common-grid-thumb mg-sixe' ); ?>
                                    
                                </article><!-- .hentry -->
                            </div>
						<?php
						else :
							if ( 2 == $counter ) {
								echo '<div class="col-lg-6 col-small-post"><div class="row">';
							}
							?>
                            <div class="<?php //echo esc_attr( $column_class ); ?> col-md-12">
                                <article class="thumb-size-min">
                                    <div class="entry-content-wrapper">
                                      <?php inspiry_standard_thumbnail( 'common-grid-thumb mg-radius' ); ?>
                                        <h4 class="entry-title" style="color:#242524;font-size:0.9em;">
                                            <a href="<?php the_permalink(); ?>" rel="bookmark"><b><?php the_title(); ?></b></a>
                                        </h4>
                                        <p style="color:#242524;font-size:0.85em;"><?php inspiry_excerpt( 17, '' ); ?></p>
                                    </div>
                                </article><!-- .hentry -->
                            </div>
							<?php
							if ( 4 == $counter ) {
								echo '</div></div>';
							}
						endif;
					endif;
					$counter ++;
				endwhile;
				?>
            </div>
			<?php
			wp_reset_postdata();
		else :
			nothing_found( __( 'No post found !', 'framework' ) );
		endif;
		?>
    </div>
</div>
