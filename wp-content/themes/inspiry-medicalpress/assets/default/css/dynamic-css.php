<?php
if ( ! function_exists( 'generate_dynamic_css' ) ) {
	/**
	 * Generate Dynamic CSS for Default Design Variation
	 */
	function generate_dynamic_css() {
		
		global $theme_options;

		$dynamic_css                  = array();
		$dynamic_css_max_width_530px  = array();

		// Styles which should not be dependant on $theme_options['want_to_change_theme_styling']
		$display_slider_plus_sign     = $theme_options['display_slider_plus_sign'];

		if ( '1' != $display_slider_plus_sign ) {

			// Hide home slider plus sign if configured from theme options
			$dynamic_css[] = array(
				'elements' => '.home-slider .slide-content h2:after',
				'property' => 'display',
				'value'    => 'none'
			);
		}

		// Check if the user wants to change the styles
		$want_to_change_theme_styling = $theme_options['want_to_change_theme_styling'];
		
		if ( isset( $want_to_change_theme_styling ) && '1' == $want_to_change_theme_styling ) {

			$header_nav_border_color      = inspiry_get_option( 'header_nav_border_color' );
			$overall_link_color           = inspiry_get_option( 'overall_link_color' );
			$default_btn_bg               = inspiry_get_option( 'default_btn_bg' );
			$default_btn_text_color       = inspiry_get_option( 'default_btn_text_color' );
			$read_more_btn_bg             = inspiry_get_option( 'read_more_btn_bg' );
			$read_more_btn_text_color     = inspiry_get_option( 'read_more_btn_text_color' );
			$appo_form_heading_bg         = inspiry_get_option( 'appo_form_heading_bg_color' );
			$appo_form_bg                 = inspiry_get_option( 'appo_form_bg_color' );
			$appo_calendar_hover          = inspiry_get_option( 'appo_calendar_hover_color' );
			$footer_border_color          = inspiry_get_option( 'footer_border_color' );
			$footer_link_color            = inspiry_get_option( 'footer_link_color' );
			$footer_social_icons_color    = inspiry_get_option( 'footer_social_icons_color' );
			$responsive_menu_bar_bg_color = inspiry_get_option( 'responsive_menu_bar_bg_color' );

			if ( $header_nav_border_color ) {

				// Header Navigation Border Color
				$dynamic_css[] = array(
					'elements' => 'nav.main-menu ul > li ul li',
					'property' => 'border-color',
					'value'    => $header_nav_border_color
				);
			}

			if ( $overall_link_color ) {

				// Over All Link Color
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

				// Default Button Background
				$dynamic_css[] = array(
					'elements' => '.btn, form input[type="submit"], .woocommerce a.added_to_cart, .woocommerce a.button, .woocommerce button.button, .woocommerce input.button, .woocommerce #respond input#submit, .woocommerce #respond input[type="submit"]',
					'property' => 'background-color',
					'value'    => $default_btn_bg['regular']
				);

				$dynamic_css[] = array(
					'elements' => '.btn:hover, form input[type="submit"]:hover, form input[type="submit"]:focus, .woocommerce a.added_to_cart:hover, .woocommerce a.button:hover, .woocommerce button.button:hover, .woocommerce input.button:hover, .woocommerce #respond input#submit:hover, .woocommerce #respond input[type="submit"]:hover',
					'property' => 'background-color',
					'value'    => $default_btn_bg['hover']
				);
			}

			if ( $default_btn_text_color ) {

				// Default Button Text Color
				$dynamic_css[] = array(
					'elements' => '.btn, form input[type="submit"], .woocommerce a.added_to_cart, .woocommerce a.button, .woocommerce button.button, .woocommerce input.button, .woocommerce #respond input#submit, .woocommerce #respond input[type="submit"]',
					'property' => 'color',
					'value'    => $default_btn_text_color['regular']
				);

				$dynamic_css[] = array(
					'elements' => '.btn:hover, form input[type="submit"]:hover, form input[type="submit"]:focus, .woocommerce a.added_to_cart:hover, .woocommerce a.button:hover, .woocommerce button.button:hover, .woocommerce input.button:hover, .woocommerce #respond input#submit:hover, .woocommerce #respond input[type="submit"]:hover',
					'property' => 'color',
					'value'    => $default_btn_text_color['hover']
				);
			}

			if ( $read_more_btn_bg ) {

				// Read More Button Background
				$dynamic_css[] = array(
					'elements' => '#scroll-top, .read-more, .woocommerce ul.products li.product .button, .woocommerce #respond input#submit.alt, .woocommerce a.button.alt, .woocommerce button.button.alt, .woocommerce input.button.alt',
					'property' => 'background-color',
					'value'    => $read_more_btn_bg['regular']
				);

				$dynamic_css[] = array(
					'elements' => '#scroll-top:hover, .read-more:hover, .read-more:focus, .woocommerce ul.products li.product .button:hover, .woocommerce #respond input#submit.alt:hover, .woocommerce a.button.alt:hover, .woocommerce button.button.alt:hover, .woocommerce input.button.alt:hover',
					'property' => 'background-color',
					'value'    => $read_more_btn_bg['hover']
				);

			}

			if ( $read_more_btn_text_color ) {

				// Read More Button Text Color
				$dynamic_css[] = array(
					'elements' => '#scroll-top, .read-more, .woocommerce ul.products li.product .button, .woocommerce #respond input#submit.alt, .woocommerce a.button.alt, .woocommerce button.button.alt, .woocommerce input.button.alt',
					'property' => 'color',
					'value'    => $read_more_btn_text_color['regular']
				);

				$dynamic_css[] = array(
					'elements' => '#scroll-top:hover, .read-more:hover, .read-more:focus, .woocommerce ul.products li.product .button:hover, .woocommerce #respond input#submit.alt:hover, .woocommerce a.button.alt:hover, .woocommerce button.button.alt:hover, .woocommerce input.button.alt:hover',
					'property' => 'color',
					'value'    => $read_more_btn_text_color['hover']
				);

			}

			if ( $appo_form_heading_bg ) {

				// Appointment Form Heading Background Color
				$dynamic_css[] = array(
					'elements' => '.home-slider .make-appoint',
					'property' => 'background-color',
					'value'    => $appo_form_heading_bg['regular']
				);

				$dynamic_css[] = array(
					'elements' => '.home-slider .make-appoint:hover',
					'property' => 'background-color',
					'value'    => $appo_form_heading_bg['hover']
				);
			}

			if ( $appo_form_bg ) {

				// Appointment Form Background Color
				$dynamic_css[] = array(
					'elements' => '.home-slider .appointment-form, .ui-datepicker-header',
					'property' => 'background-color',
					'value'    => $appo_form_bg
				);
			}

			if ( $appo_calendar_hover ) {

				// Appointment Form Calender Hover,Active and Focus Color
				$dynamic_css[] = array(
					'elements' => 'td .ui-state-active, td .ui-state-hover, td .ui-state-highlight, .ui-datepicker-header .ui-state-hover',
					'property' => 'background-color',
					'value'    => $appo_calendar_hover
				);
			}

			if ( $footer_border_color ) {
				// Footer Border Color
				$dynamic_css[] = array(
					'elements' => '#main-footer, .footer-bottom, #main-footer .widget ul, #main-footer .widget ul li',
					'property' => 'border-color',
					'value'    => $footer_border_color
				);
			}

			if ( $footer_link_color ) {
				// Footer Link Color
				$dynamic_css[] = array(
					'elements' => '#main-footer .widget a',
					'property' => 'color',
					'value'    => $footer_link_color['regular']
				);
				$dynamic_css[] = array(
					'elements' => '#main-footer .widget a:hover',
					'property' => 'color',
					'value'    => $footer_link_color['hover']
				);
				$dynamic_css[] = array(
					'elements' => '#main-footer .widget a:active',
					'property' => 'color',
					'value'    => $footer_link_color['active']
				);
			}

			if ( $footer_social_icons_color ) {
				// Footer Social Icons
				$dynamic_css[] = array(
					'elements' => '.footer-bottom .footer-social-nav li .fa, .footer-bottom .footer-social-nav li .fab, .footer-bottom .footer-social-nav li .fal, .footer-bottom .footer-social-nav li .far, .footer-bottom .footer-social-nav li .fas',
					'property' => 'color',
					'value'    => $footer_social_icons_color['regular']
				);
				$dynamic_css[] = array(
					'elements' => '.footer-bottom .footer-social-nav li .fa:hover',
					'property' => 'color',
					'value'    => $footer_social_icons_color['hover']
				);
				$dynamic_css[] = array(
					'elements' => '.footer-bottom .footer-social-nav li .fa:active',
					'property' => 'color',
					'value'    => $footer_social_icons_color['active']
				);

			}

			if ( $responsive_menu_bar_bg_color ) {

				// Responsive menu bar background color
				$dynamic_css_max_width_530px[] = array(
					'elements' => '.mean-container .mean-bar',
					'property' => 'background-color',
					'value'    => $responsive_menu_bar_bg_color
				);
			}

		}

		$prop_count = count( $dynamic_css );

		if ( $prop_count > 0 ) {

			echo "<style type='text/css' id='inspiry-dynamic-css'>\n\n"; // before styles

			// common styles
			foreach ( $dynamic_css as $css_unit ) {
				if ( ! empty( $css_unit['value'] ) ) {
					echo $css_unit['elements'] . "{\n";
					echo $css_unit['property'] . ":" . $css_unit['value'] . ";\n";
					echo "}\n\n";
				}
			}

			/* css for media query for max width 530px */
			if ( count( $dynamic_css_max_width_530px ) > 0 ) {
				echo "@media only screen and (max-width: 530px) {\n";
				foreach ( $dynamic_css_max_width_530px as $css_unit ) {
					if ( ! empty( $css_unit['value'] ) ) {
						echo $css_unit['elements'] . "{\n";
						echo $css_unit['property'] . ":" . $css_unit['value'] . ";\n";
						echo "}\n\n";
					}
				}
				echo "}\n";
			}

			echo '</style>'; // end of styles
		}
	}

	add_action( 'wp_head', 'generate_dynamic_css' );
}