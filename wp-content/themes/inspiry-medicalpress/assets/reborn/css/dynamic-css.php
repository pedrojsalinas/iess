<?php
if ( ! function_exists( 'generate_dynamic_css' ) ) {
	/**
	 * Generate Dynamic CSS for Reborn Design Variation
	 */
	function generate_dynamic_css() {

		$dynamic_css              = array();
        $overall_theme_color_one  = inspiry_get_option('overall_theme_color_one');
        $overall_theme_color_two  = inspiry_get_option('overall_theme_color_two');
        $overall_link_color       = inspiry_get_option('overall_link_color');
        $default_btn_bg           = inspiry_get_option('default_btn_bg');
        $default_btn_text_color   = inspiry_get_option('default_btn_text_color');
        $read_more_btn_bg         = inspiry_get_option('read_more_btn_bg');
        $read_more_btn_text_color = inspiry_get_option('read_more_btn_text_color');
        $appo_form_bg             = inspiry_get_option('appo_form_bg_color');
        $appo_calendar_hover      = inspiry_get_option('appo_calendar_hover_color');
        $footer_link_color        = inspiry_get_option('footer_link_color');

		if ( $overall_theme_color_one ) {

			$dynamic_css[] = array(
				'elements' => '.woocommerce nav.woocommerce-pagination ul a, .woocommerce nav.woocommerce-pagination ul span, .woocommerce nav.woocommerce-pagination ul li a, .woocommerce nav.woocommerce-pagination ul li span, .gallery-single .next-prev-posts a:hover, .gallery-single #carousel .flex-direction-nav a:hover, .overlay, .tagcloud a:hover, .flex-direction-nav a:hover, .contact-page-social-media-list a, .toggle-main .toggle.current .toggle-title, .accordion-main .accordion.current .accordion-title',
				'property' => 'background-color',
				'value'    => $overall_theme_color_one
			);
			$dynamic_css[] = array(
				'elements' => '.testimonials-carousel-item, .filters > li.active a, .tagcloud a:hover, .flex-direction-nav a:hover',
				'property' => 'border-color',
				'value'    => $overall_theme_color_one
			);
			$dynamic_css[] = array(
				'elements' => '.home-features-item:hover, .entry-content .tabs-nav li.active, .sidebar .tab-head.active, .filters > li.active a:after',
				'property' => 'border-top-color',
				'value'    => $overall_theme_color_one
			);
			$dynamic_css[] = array(
				'elements' => '.woocommerce table.shop_table td a:hover, .doctor-grid .doctor-departments a:hover',
				'property' => 'color',
				'value'    => $overall_theme_color_one
			);
		}

		if ( $overall_theme_color_two ) {

			$dynamic_css[] = array(
				'elements' => '.select2-container--default .select2-results__option[data-selected=true], .select2-container--default .select2-results__option--highlighted[aria-selected], .woocommerce nav.woocommerce-pagination ul a:hover, .woocommerce nav.woocommerce-pagination ul a.current, .woocommerce nav.woocommerce-pagination ul span:hover, .woocommerce nav.woocommerce-pagination ul span.current, .woocommerce nav.woocommerce-pagination ul li a:hover, .woocommerce nav.woocommerce-pagination ul li a.current, .woocommerce nav.woocommerce-pagination ul li span:hover, .woocommerce nav.woocommerce-pagination ul li span.current, .woocommerce span.onsale, .woocommerce ul.products li.product span.onsale, .woocommerce-page ul.products li.product span.onsale, .owl-theme .owl-dots .owl-dot.active span, .owl-theme .owl-dots .owl-dot:hover span, .gallery-single .next-prev-posts a, .announcement, .flex-direction-nav a, .toggle-main .toggle-title, .accordion-main .accordion-title, .tagcloud a',
				'property' => 'background-color',
				'value'    => $overall_theme_color_two
			);
			$dynamic_css[] = array(
				'elements' => '.home-features-item, .flex-direction-nav a, .woocommerce-info, .tagcloud a',
				'property' => 'border-color',
				'value'    => $overall_theme_color_two
			);
			$dynamic_css[] = array(
				'elements' => '.entry-footer .fa',
				'property' => 'color',
				'value'    => $overall_theme_color_two
			);
		}

		if ( $overall_link_color ) {

			//Over All Link Color
			$dynamic_css[] = array(
				'elements' => 'a',
				'property' => 'color',
				'value'    => $overall_link_color['regular']
			);
			$dynamic_css[] = array(
				'elements' => 'a:hover, a:focus',
				'property' => 'color',
				'value'    => $overall_link_color['hover']
			);
		}

		if ( $default_btn_bg ) {

			//Default Button Background
			$dynamic_css[] = array(
				'elements' => '.btn:active, input[type="submit"]:active, .read-more:active, .btn-primary, .pagination span, .pagination a, .page-links span, .page-links a, form input[type="submit"], .woocommerce a.added_to_cart, .woocommerce a.button, .woocommerce button.button, .woocommerce input.button, .woocommerce #respond input#submit, .woocommerce #respond input[type="submit"]',
				'property' => 'background-color',
				'value'    => $default_btn_bg['regular']
			);
			$dynamic_css[] = array(
				'elements' => '.scroll-top:hover, .btn:active:hover, input[type="submit"]:active:hover, .read-more:active:hover, .btn-outline-primary:hover, .btn-primary:hover, .pagination span:hover, .pagination span.current, .pagination a:hover, .pagination a.current, .page-links span:hover, .page-links span.current, .page-links a:hover, .page-links a.current, form input[type="submit"]:hover, form input[type="submit"]:focus, .woocommerce a.added_to_cart:hover, .woocommerce a.button:hover, .woocommerce button.button:hover, .woocommerce input.button:hover, .woocommerce #respond input#submit:hover, .woocommerce #respond input[type="submit"]:hover',
				'property' => 'background-color',
				'value'    => $default_btn_bg['hover']
			);
		}

		if ( $default_btn_text_color ) {

			//Default Button Text Color
			$dynamic_css[] = array(
				'elements' => '.btn:active, input[type="submit"]:active, .read-more:active, .btn-primary, .pagination span, .pagination a, .page-links span, .page-links a, form input[type="submit"], .woocommerce a.added_to_cart, .woocommerce a.button, .woocommerce button.button, .woocommerce input.button, .woocommerce #respond input#submit, .woocommerce #respond input[type="submit"]',
				'property' => 'color',
				'value'    => $default_btn_text_color['regular']
			);
			$dynamic_css[] = array(
				'elements' => '.scroll-top:hover, .btn:active:hover, input[type="submit"]:active:hover, .read-more:active:hover, .btn-outline-primary:hover, .btn-primary:hover, .pagination span:hover, .pagination span.current, .pagination a:hover, .pagination a.current, .page-links span:hover, .page-links span.current, .page-links a:hover, .page-links a.current, form input[type="submit"]:hover, form input[type="submit"]:focus, .woocommerce a.added_to_cart:hover, .woocommerce a.button:hover, .woocommerce button.button:hover, .woocommerce input.button:hover, .woocommerce #respond input#submit:hover, .woocommerce #respond input[type="submit"]:hover',
				'property' => 'color',
				'value'    => $default_btn_text_color['hover']
			);
		}

		if ( $read_more_btn_bg ) {

			// Read More Button Background
			$dynamic_css[] = array(
				'elements' => '.read-more, .woocommerce ul.products li.product .button, .woocommerce #respond input#submit.alt, .woocommerce a.button.alt, .woocommerce button.button.alt, .woocommerce input.button.alt',
				'property' => 'background-color',
				'value'    => $read_more_btn_bg['regular']
			);
			$dynamic_css[] = array(
				'elements' => '.read-more:hover, .read-more:focus, .woocommerce ul.products li.product .button:hover, .woocommerce #respond input#submit.alt:hover, .woocommerce a.button.alt:hover, .woocommerce button.button.alt:hover, .woocommerce input.button.alt:hover',
				'property' => 'background-color',
				'value'    => $read_more_btn_bg['hover']
			);
		}

		if ( $read_more_btn_text_color ) {

			// Read More Button Text Color
			$dynamic_css[] = array(
				'elements' => '.read-more, .woocommerce ul.products li.product .button, .woocommerce #respond input#submit.alt, .woocommerce a.button.alt, .woocommerce button.button.alt, .woocommerce input.button.alt',
				'property' => 'color',
				'value'    => $read_more_btn_text_color['regular']
			);
			$dynamic_css[] = array(
				'elements' => '.read-more:hover, .read-more:focus, .woocommerce ul.products li.product .button:hover, .woocommerce #respond input#submit.alt:hover, .woocommerce a.button.alt:hover, .woocommerce button.button.alt:hover, .woocommerce input.button.alt:hover',
				'property' => 'color',
				'value'    => $read_more_btn_text_color['hover']
			);
		}

		if ( $appo_form_bg ) {

			//Appointment Form Background Color
			$dynamic_css[] = array(
				'elements' => '.home-slider .appointment-form, .ui-datepicker-header',
				'property' => 'background-color',
				'value'    => $appo_form_bg
			);
		}

		if ( $appo_calendar_hover ) {

			//Appointment Form Calender Hover,Active and Focus Color
			$dynamic_css[] = array(
				'elements' => 'td .ui-state-active, td .ui-state-hover, td .ui-state-highlight, .ui-datepicker-header .ui-state-hover',
				'property' => 'background-color',
				'value'    => $appo_calendar_hover
			);
		}

		if ( $footer_link_color ) {

			//Footer
			$dynamic_css[] = array(
				'elements' => '.site-footer a',
				'property' => 'color',
				'value'    => $footer_link_color['regular']
			);
			$dynamic_css[] = array(
				'elements' => '.site-footer a:hover',
				'property' => 'color',
				'value'    => $footer_link_color['hover']
			);
			$dynamic_css[] = array(
				'elements' => '.site-footer a:active',
				'property' => 'color',
				'value'    => $footer_link_color['active']
			);
		}

        $prop_count = count( $dynamic_css );

        if ( $prop_count > 0 ) {

            echo "<style type='text/css' id='inspiry-dynamic-css'>\n\n";

            foreach ( $dynamic_css as $css_unit ) {
                if ( ! empty( $css_unit['value'] ) ) {
                    echo $css_unit['elements'] . "{\n";
                    echo $css_unit['property'] . ":" . $css_unit['value'] . ";\n";
                    echo "}\n\n";
                }
            }

            $header_search_form_text_color = inspiry_get_option('header_text_color');
            if( $header_search_form_text_color  ): ?>
            .header-search-form-container input:-moz-placeholder {
                color: <?php echo $header_search_form_text_color; ?>;
            }

            .header-search-form-container input::-moz-placeholder {
                color: <?php echo $header_search_form_text_color; ?>;
            }

            .header-search-form-container input:-ms-input-placeholder {
                color: <?php echo $header_search_form_text_color; ?>;
            }

            .header-search-form-container input::-webkit-input-placeholder {
                color: <?php echo $header_search_form_text_color; ?>;
            }
            <?php
            endif;

	        $main_menu_item_hover_bg_color = inspiry_get_option('main_menu_item_hover_bg_color');
	        if( $main_menu_item_hover_bg_color  ): ?>
            @media (max-width: 991px){
                .site-header-bottom {
                    background-color: <?php echo $main_menu_item_hover_bg_color; ?>
                }
            }
	        <?php
	        endif;

	        $footer_cta_gradient_color_one = inspiry_get_option('footer_cta_gradient_color_one');
	        $footer_cta_gradient_color_two = inspiry_get_option('footer_cta_gradient_color_two');
	        if( $header_search_form_text_color &&  $footer_cta_gradient_color_two ): ?>
            .call-to-action {
                background-image: -webkit-linear-gradient(left, <?php echo $footer_cta_gradient_color_one; ?> 0%, <?php echo $footer_cta_gradient_color_two; ?> 100%);
                background-image: linear-gradient(to right, <?php echo $footer_cta_gradient_color_one; ?> 0%, <?php echo $footer_cta_gradient_color_two; ?> 100%);
            }
            <?php
            endif;

            echo '</style>';
        }

	}

	add_action( 'wp_head', 'generate_dynamic_css' );
}