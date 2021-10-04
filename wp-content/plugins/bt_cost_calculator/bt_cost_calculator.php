<?php

/**
 * Plugin Name: Cost Calculator
 * Description: Cost Calculator by BoldThemes
 * Version: 2.3.2
 * Author: BoldThemes
 * Author URI: http://codecanyon.net/user/boldthemes
 */

 if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

require_once( 'bold-builder-light/bold-builder-light.php' );

class BT_CC_Root {
	static $builder;
}

// BB Light
BT_CC_Root::$builder = new BTBB_Light(
	array(
		'slug' => 'bt-cost-calculator',
		'single_name' => esc_html__( 'Cost Calculator', 'bt-cost-calculator' ),
		'plural_name' => esc_html__( 'Cost Calculators', 'bt-cost-calculator' ),
		'icon' => 'dashicons-plus-alt',
		'home_url' => '//codecanyon.net/item/cost-calculator-wordpress-plugin/12778927',
		'doc_url' => '//documentation.bold-themes.com/cost-calculator',
		'support_url' => '//boldthemes.ticksy.com',
		'changelog_url' => '//codecanyon.net/item/cost-calculator-wordpress-plugin/12778927',
		'shortcode' => 'bt_cc',
		'product_id' => '12778927',
		'plugin_file_path' => __FILE__
	)
);

/***/

function bt_cc_enqueue() {
	wp_enqueue_script( 'bt_cc_dd', plugins_url( 'jquery.dd.js', __FILE__ ), array( 'jquery' ) );
	wp_enqueue_script( 'bt_cc_main', plugins_url( 'cc.main.js', __FILE__  ), array( 'jquery' ) );
	$js = '';
	$js .= 'window.bt_cc_translate = [];';
	$js .= 'window.bt_cc_translate[\'prev\'] = \'' . esc_html__( 'Prev', 'bt-cost-calculator' ) . '\';';
	$js .= 'window.bt_cc_translate[\'next\'] = \'' . esc_html__( 'Next', 'bt-cost-calculator' ) . '\';';
	$js .= 'window.bt_cc_translate[\'su\'] = \'' . esc_html__( 'Su', 'bt-cost-calculator' ) . '\';';
	$js .= 'window.bt_cc_translate[\'mo\'] = \'' . esc_html__( 'Mo', 'bt-cost-calculator' ) . '\';';
	$js .= 'window.bt_cc_translate[\'tu\'] = \'' . esc_html__( 'Tu', 'bt-cost-calculator' ) . '\';';
	$js .= 'window.bt_cc_translate[\'we\'] = \'' . esc_html__( 'We', 'bt-cost-calculator' ) . '\';';
	$js .= 'window.bt_cc_translate[\'th\'] = \'' . esc_html__( 'Th', 'bt-cost-calculator' ) . '\';';
	$js .= 'window.bt_cc_translate[\'fr\'] = \'' . esc_html__( 'Fr', 'bt-cost-calculator' ) . '\';';
	$js .= 'window.bt_cc_translate[\'sa\'] = \'' . esc_html__( 'Sa', 'bt-cost-calculator' ) . '\';';
	
	$js .= 'window.bt_cc_translate[\'january\'] = \'' . esc_html__( 'January', 'bt-cost-calculator' ) . '\';';
	$js .= 'window.bt_cc_translate[\'february\'] = \'' . esc_html__( 'February', 'bt-cost-calculator' ) . '\';';
	$js .= 'window.bt_cc_translate[\'march\'] = \'' . esc_html__( 'March', 'bt-cost-calculator' ) . '\';';
	$js .= 'window.bt_cc_translate[\'april\'] = \'' . esc_html__( 'April', 'bt-cost-calculator' ) . '\';';
	$js .= 'window.bt_cc_translate[\'may\'] = \'' . esc_html__( 'May', 'bt-cost-calculator' ) . '\';';
	$js .= 'window.bt_cc_translate[\'june\'] = \'' . esc_html__( 'June', 'bt-cost-calculator' ) . '\';';
	$js .= 'window.bt_cc_translate[\'july\'] = \'' . esc_html__( 'July', 'bt-cost-calculator' ) . '\';';
	$js .= 'window.bt_cc_translate[\'august\'] = \'' . esc_html__( 'August', 'bt-cost-calculator' ) . '\';';
	$js .= 'window.bt_cc_translate[\'september\'] = \'' . esc_html__( 'September', 'bt-cost-calculator' ) . '\';';
	$js .= 'window.bt_cc_translate[\'october\'] = \'' . esc_html__( 'October', 'bt-cost-calculator' ) . '\';';
	$js .= 'window.bt_cc_translate[\'november\'] = \'' . esc_html__( 'November', 'bt-cost-calculator' ) . '\';';
	$js .= 'window.bt_cc_translate[\'december\'] = \'' . esc_html__( 'December', 'bt-cost-calculator' ) . '\';';
	
	wp_add_inline_script( 'bt_cc_main', $js );
	wp_enqueue_style( 'bt_cc_style', plugins_url( 'style.min.css', __FILE__ ) );

	
}
add_action( 'wp_enqueue_scripts', 'bt_cc_enqueue' );

function bt_cc_admin_enqueue() {
	wp_enqueue_script( 'bt_cc_custom_fields', plugins_url( 'bt_cc_custom_fields.js', __FILE__  ), array( 'jquery' ) );
	wp_enqueue_style( 'bt_cc_admin_style', plugins_url( 'admin_style.css', __FILE__ ), [], filemtime( plugin_dir_path( __FILE__ ) . 'admin_style.css' ) );
}
add_action( 'admin_enqueue_scripts', 'bt_cc_admin_enqueue', 20 ); // after BB

global $bt_recaptcha;
$bt_recaptcha = false;

function bt_enqueue_recaptcha() {
	global $bt_recaptcha;
	if ( ! $bt_recaptcha ) {
		?>
		<script>
			var BTCaptchaCallback = function() {
				jQuery( '.g-rec' ).each(function() {
					var widget_id = grecaptcha.render( jQuery( this ).attr( 'id' ), { 'sitekey' : jQuery( this ).data( 'sk' ) } );
					jQuery( this ).data( 'widget_id', widget_id );
				});
			};
		</script>
		<?php
		echo '<script src="https://www.google.com/recaptcha/api.js?onload=BTCaptchaCallback&render=explicit" async defer></script>';
		$bt_recaptcha = true;
	}
}

/**
 * Load plugin textdomain.
 *
 * @since 1.0.0
 */
function bt_cc_load_textdomain() {
  load_plugin_textdomain( 'bt-cost-calculator', false, dirname( plugin_basename( __FILE__ ) ) . '/languages' ); 
}
add_action( 'plugins_loaded', 'bt_cc_load_textdomain' );

// [bt_cost_calculator]
class bt_cost_calculator {
	
	public static $date_text;
	public static $time_text;

	static function init() {
		add_shortcode( 'bt_cost_calculator', array( __CLASS__, 'handle_shortcode' ) );
		add_action( 'wp_ajax_bt_cc', array( __CLASS__, 'bt_cc_callback' ) );
		add_action( 'wp_ajax_nopriv_bt_cc', array( __CLASS__, 'bt_cc_callback' ) );

		//add_action( 'bt_bb_light_dialog_header', array( __CLASS__, 'bt_cc_light_dialog_header' ) );
	}
	
	static function bt_cc_light_dialog_header() {
	   echo '<div class="bt_bb_dialog_header_links" style="padding: 1em;font-size: 1.1em;">' .  __( 'For detailed explaination on how to use Cost Calculator WordPress Plugin Items go to <a target="_blank" href="http://documentation.bold-themes.com/cost-calculator/cost-calculator-items/">plugin items documentation</a>', 'bt-cost-calculator' ) . '</div>';
	}
	
	static function bt_cc_callback() {
		check_ajax_referer( 'bt_cc_nonce', 'bt_cc_nonce' );
		$recaptcha_response = sanitize_text_field( $_POST['recaptcha_response'] );
		$recaptcha_secret = sanitize_text_field( $_POST['recaptcha_secret'] );
		$admin_email = sanitize_email( $_POST['admin_email'] );
		$email_client = sanitize_text_field( $_POST['email_client'] );
		$url_confirmation = esc_url_raw( $_POST['url_confirmation'] );
		$currency = sanitize_text_field( $_POST['currency'] );
		$currency_after = sanitize_text_field( $_POST['currency_after'] );
		$currency_space = sanitize_text_field( $_POST['currency_space'] );
		$email_confirmation = sanitize_text_field( $_POST['email_confirmation'] );
		$subject = sanitize_text_field( urldecode( $_POST['subject'] ) );
		$email_header = wp_kses_post( $_POST['email_header'] );
		$email_footer = wp_kses_post( $_POST['email_footer'] );
		$quote = wp_kses_post( urldecode( $_POST['quote'] ) );
		$total = sanitize_text_field( $_POST['total'] );
		$total_text = sanitize_text_field( $_POST['total_text'] );
		$name = sanitize_text_field( $_POST['name'] );
		$email = sanitize_email( strip_tags( $_POST['email'] ) );
		$phone = sanitize_text_field( $_POST['phone'] );
		$address = sanitize_text_field( $_POST['address'] );
		$date = sanitize_text_field( isset($_POST['date'])?$_POST['date']:'' );
		$time = sanitize_text_field( isset($_POST['time'])?$_POST['time']:'' );
		$date_text = sanitize_text_field( isset($_POST['date_text'])?$_POST['date_text']:'' );
		$time_text = sanitize_text_field( isset($_POST['time_text'])?$_POST['time_text']:'' );
		$message = sanitize_textarea_field( $_POST['message'] );

		$email_gdpr = sanitize_text_field( $_POST['email_gdpr'] );
		$email_gdpr_text = sanitize_text_field( $_POST['email_gdpr_text'] );
		$email_gdpr_not_text = sanitize_text_field( $_POST['email_gdpr_not_text'] );
		
		if ( $recaptcha_response == '' && $recaptcha_secret != '' ) {
			die();
		}
		
		if ( $recaptcha_response != '' && $recaptcha_secret != '' ) {
			$recaptcha_post = wp_remote_post( 'https://www.google.com/recaptcha/api/siteverify', array( 'body' => array( 'secret' => $recaptcha_secret, 'response' => $recaptcha_response ) ) );
			if ( is_wp_error( $recaptcha_post ) ) {
				echo 'recaptcha post error';
				die();
			} else {
				$json = json_decode( $recaptcha_post['body'] );
				if ( $json->success != 1 ) {
					echo 'recaptcha response false';
					die();
				}
			}
		}
		
		$total_curr = $total;
		
		// ADMIN EMAIL CONTENT
		
		$message_to_admin = '<html><body>' . "\r\n";
		
			$message_to_admin .= '<table style="width:100%" cellspacing="0">' . "\r\n";
			if ( $quote != '' ) $message_to_admin .= $quote;
			
			if ( $currency != '' ) {
				if ( $currency_after == 'yes' ) {
					if ( $currency_space == 'yes' ) {
						$total_curr = $total . ' ' . $currency;
					} else {
						$total_curr = $total . $currency;
					}
				} else {
					if ( $currency_space == 'yes' ) {
						$total_curr = $currency . ' ' . $total;
					} else {
						$total_curr = $currency . $total;
					}
				}
			}
			
			$message_to_admin .= '<tr><td style="font-weight:bold;border-top:1px solid #888;padding:.5em;">' . $total_text . '</td><td style="text-align:right;font-weight:bold;border-top:1px solid #888;padding:.5em;">' . $total_curr . '</td></tr>' . "\r\n";
			
			$message_to_admin .= '</table>' . "\r\n";
			
			$message_to_admin .= '<br>' . "\r\n";
		
			if ( $name != '' ) $message_to_admin .= '<div style="padding:.5em;"><b>' . esc_html__( 'Name', 'bt-cost-calculator' ) . '</b>: ' . stripslashes( $name ) . '</div>' . "\r\n";
			if ( $email != '' ) $message_to_admin .= '<div style="padding:.5em;"><b>' . esc_html__( 'Email', 'bt-cost-calculator' ) . '</b>: <a href="mailto:' . $email . '">' . $email . '</a></div>' . "\r\n";
			if ( $phone != '' ) $message_to_admin .= '<div style="padding:.5em;"><b>' . esc_html__( 'Phone', 'bt-cost-calculator' ) . '</b>: ' . $phone . '</div>' . "\r\n";
			if ( $address != '' ) $message_to_admin .= '<div style="padding:.5em;"><b>' . esc_html__( 'Address', 'bt-cost-calculator' ) . '</b>: ' . stripslashes( $address ) . '</div>' . "\r\n";
			if ( $date != '' ) $message_to_admin .= '<div style="padding:.5em;"><b>' . $date_text . '</b>: ' . $date . '</div>' . "\r\n";
			if ( $time != '' ) $message_to_admin .= '<div style="padding:.5em;"><b>' . $time_text . '</b>: ' . $time . '</div>' . "\r\n";
			if ( $message != '' ) $message_to_admin .= '<div style="padding:.5em;"><b>' . esc_html__( 'Message', 'bt-cost-calculator' ) . '</b>: ' . stripslashes( $message ) . '</div>' . "\r\n";
		
		$message_to_admin .= '</body></html>';
		
		// CLIENT EMAIL CONTENT
		
		$message_to_client = '<html><body>' . "\r\n";
		
			if ( $email_header != '' ) {
				$message_to_client .= base64_decode( $email_header );
			}
		
			$message_to_client .= '<table style="width:100%" cellspacing="0">' . "\r\n";
			if ( $quote != '' ) $message_to_client .= $quote;
			
			if ( $currency != '' ) {
				if ( $currency_after == 'yes' ) {
					if ( $currency_space == 'yes' ) {
						$total_curr = $total . ' ' . $currency;
					} else {
						$total_curr = $total . $currency;
					}
				} else {
					if ( $currency_space == 'yes' ) {
						$total_curr = $currency . ' ' . $total;
					} else {
						$total_curr = $currency . $total;
					}
				}
			}
			
			$message_to_client .= '<tr><td style="font-weight:bold;border-top:1px solid #888;padding:.5em;">' . $total_text . '</td><td style="text-align:right;font-weight:bold;border-top:1px solid #888;padding:.5em;">' . $total_curr . '</td></tr>' . "\r\n";
			
			$message_to_client .= '</table>' . "\r\n";
			
			$message_to_client .= '<br>' . "\r\n";
		
			if ( $name != '' ) $message_to_client .= '<div style="padding:.5em;"><b>' . esc_html__( 'Name', 'bt-cost-calculator' ) . '</b>: ' . stripslashes( $name ) . '</div>' . "\r\n";
			if ( $email != '' ) $message_to_client .= '<div style="padding:.5em;"><b>' . esc_html__( 'Email', 'bt-cost-calculator' ) . '</b>: <a href="mailto:' . $email . '">' . $email . '</a></div>' . "\r\n";
			if ( $phone != '' ) $message_to_client .= '<div style="padding:.5em;"><b>' . esc_html__( 'Phone', 'bt-cost-calculator' ) . '</b>: ' . $phone . '</div>' . "\r\n";
			if ( $address != '' ) $message_to_client .= '<div style="padding:.5em;"><b>' . esc_html__( 'Address', 'bt-cost-calculator' ) . '</b>: ' . stripslashes( $address ) . '</div>' . "\r\n";
			if ( $date != '' ) $message_to_client .= '<div style="padding:.5em;"><b>' . $date_text . '</b>: ' . $date . '</div>' . "\r\n";
			if ( $time != '' ) $message_to_client .= '<div style="padding:.5em;"><b>' . $time_text . '</b>: ' . $time . '</div>' . "\r\n";
			if ( $message != '' ) $message_to_client .= '<div style="padding:.5em;"><b>' . esc_html__( 'Message', 'bt-cost-calculator' ) . '</b>: ' . stripslashes( $message ) . '</div>' . "\r\n";
			
			if ( $email_footer != '' ) {
				$message_to_client .= base64_decode( $email_footer );
			}
		
		$message_to_client .= '</body></html>';

		//$message_to_admin = quoted_printable_encode( $message_to_admin );
		
		// SUBJECT
	
		$s = $subject;
		if ( $name != '' ) $s = $s . ' / ' . $name;
		
		try{
			$r = true;
			if ( $email_client == 'yes' && $email != '' &&  $email_confirmation == 'yes' ) {
				$headers = "From: " . $admin_email . "\r\n";
				$headers .= "MIME-Version: 1.0\r\n";
				$headers .= "Content-Type: text/html; charset=UTF-8\r\n";
				//$headers .= "Content-Transfer-Encoding: quoted-printable";
				$r = wp_mail( $email, $s, $message_to_client, $headers );
			}
			$headers = '';
			//if ( $email != '' ) $headers = "From: " . $email . "\r\n"; // todo: email validation
			$headers .= "Reply-to: " . $email . "\r\n";
			$headers .= "MIME-Version: 1.0\r\n";
			$headers .= "Content-Type: text/html; charset=UTF-8\r\n";
			//$headers .= "Content-Transfer-Encoding: quoted-printable";
			$r1 = wp_mail( $admin_email, $s, $message_to_admin, $headers );

			$fields = array();
			$fields[ 'bt_cc_log_content-type' ] = 'text/html';

			do_action( 'bt_cc_log_insert', $s, $message_to_admin, $fields );

			if ( $r && $r1 ) echo 'ok';
		} catch ( Exception $e ) {
			echo $e->getMessage();
		}
		
		die();
	}

	static function handle_shortcode( $atts, $content ) {
		extract( shortcode_atts( array(
			'admin_email'        => '',
			'cf7_id'        	 => '',
			'subject'            => '',
			'email_client'       => '',
			'email_confirmation' => '',
			'email_header'       => '',
			'email_footer'       => '',
			'url_confirmation'	 => '',
			'date_format'        => 'mm/dd/yy',
			'time_start'         => '',
			'time_end'           => '',
			'time_format'        => '24',
			'currency'           => '',
			'currency_after'     => '',
			'currency_space'     => 'yes',
			'hide_total'         => '',
			'm_name'             => '',
			'm_email'            => '',
			'm_phone'            => '',
			'm_address'          => '',
			'm_date'             => '',
			'm_time'             => '',
			'm_message'          => '',
			'show_next'			 => '',
			'next_text'			 => esc_html__( 'Next', 'bt-cost-calculator' ),
			'no_next'            => '',
			'accent_color'       => '',
			'show_booking'       => '',
			'date_text'          => esc_html__( 'Preferred Service Date', 'bt-cost-calculator' ),
			'time_text'          => esc_html__( 'Preferred Service Time', 'bt-cost-calculator' ),
			'total_text'         => esc_html__( 'Total', 'bt-cost-calculator' ),
			'total_format'       => 'currency_1',
			'total_decimals'     => '2',
			'rec_site_key'       => '',
			'rec_secret_key'     => '',
			'paypal_email'       => '',
			'paypal_cart_name'   => '',
			'paypal_currency'    => '',
			'email_gdpr'        => '',
			'email_gdpr_text'   => '',
			'email_gdpr_not_text' => '',
			'el_class'           => '',
			'el_style'           => ''
		), $atts, 'bt_cost_calculator' ) );

		
		
		
		bt_cost_calculator::$date_text = $date_text;
		bt_cost_calculator::$time_text = $time_text;
		
		wp_enqueue_script( 'jquery-ui' );
		wp_enqueue_script( 'jquery-ui-datepicker' );
		
		wp_enqueue_script( 'jquery-ui-slider' );
		
		wp_enqueue_script( 'bt_touch-punch_js', plugins_url( 'jquery.ui.touch-punch.min.js', __FILE__ ), array( 'jquery-ui-slider' ) );

		$css_class = uniqid( 'c' );
		
		if ( $accent_color != '' )  { $el_class .= ' btQuoteBookingWithColor'; } 
		else { $el_class .= ' btQuoteBookingWithoutColor'; }
		
		$proxy = new Cost_Proxy( array(
			'accent_color' => $accent_color,
			'css_class' => $css_class,
		) );
		add_action( 'wp_footer', array( $proxy, 'js_init' ), 20 );
		
		$style_attr = '';
		if ( $el_style != '' ) {
			$style_attr = 'style="' . $el_style . '"';
		}
		
		if ( $next_text == '' ) $next_text = esc_html__( 'Next', 'bt-cost-calculator' );
		
		if ( $m_name != '' ) $m_name = ' ' . 'btContactField' . $m_name;
		if ( $m_email != '' ) $m_email = ' ' . 'btContactField' . $m_email;
		if ( $m_phone != '' ) $m_phone = ' ' . 'btContactField' . $m_phone;
		if ( $m_address != '' ) $m_address = ' ' . 'btContactField' . $m_address;
		if ( $m_message != '' ) $m_message = ' ' . 'btContactField' . $m_message;
		if ( $m_date != '' ) $m_date = ' ' . 'btContactField' . $m_date;
		if ( $m_time != '' ) $m_time = ' ' . 'btContactField' . $m_time;

		$total_next_wrapper_style = '';	

		$output = '<div class="btQuoteBooking ' . $el_class . ' ' . $css_class . '" ' . $style_attr . ' data-admin_email="' .  $admin_email. '" data-cf7_id="' .  $cf7_id. '" data-email_client="' . $email_client . '" data-email_gdpr="' . $email_gdpr . '" data-email_gdpr_text="' . $email_gdpr_text . '" data-email_gdpr_not_text="' . $email_gdpr_not_text . '" data-currency="' . $currency . '" data-currency_after="' . $currency_after . '" data-currency_space="' . $currency_space . '" data-url_confirmation="' . $url_confirmation . '" data-url_ajax="' . admin_url( 'admin-ajax.php' ) . '" data-subject="' . $subject . '" data-email_header="' . $email_header . '" data-email_footer="' . $email_footer . '" data-date_text="' . $date_text . '" data-time_text="' . $time_text . '" data-message_please_wait="' . esc_html__( 'Please wait...', 'bt-cost-calculator' ) . '" data-message_success="'. esc_html__( 'Thank you, we will contact you soon!', 'bt-cost-calculator' ) .'" data-message_error="' . esc_html__( 'Error! Please try again later.', 'bt-cost-calculator' ) . '" data-message_mandatory="' .  esc_html__( 'Please fill out all required fields.', 'bt-cost-calculator' ) . '" data-rec_secret_key="' . $rec_secret_key . '" data-total_text="' . $total_text . '" data-total_format="' . $total_format . '" data-total_decimals="' . $total_decimals . '" data-date_format="' . $date_format . '" data-bt_cc_nonce="' . wp_create_nonce( 'bt_cc_nonce' ) . '" data-hide_total="' . $hide_total . '"><div class="btQuoteBookingWrap">';

			if ( $no_next == 'yes' ) {
				$output .= '<div class="btQuoteBookingForm">';
			} else {
				$output .= '<div class="btQuoteBookingForm btActive">';
			}
			
				$output .= wptexturize( do_shortcode( $content ) );
				$output .= '<div class="btTotalNextWrapper"' . $total_next_wrapper_style . '>';
					
					if ( $hide_total != 'yes' ) {
						if ( $currency_after == 'yes' ) {
							if ( $currency_space == 'yes' ) {
								$currency = '&nbsp;' . $currency;
							}
							$output .= '<div class="btQuoteTotal currencyAfter"><span class="btQuoteTotalText">' . $total_text . '</span><span class="btQuoteTotalCalc"></span><span class="btQuoteTotalCurrency">' . $currency . '</span></div>';
						} else {
							if ( $currency_space == 'yes' ) {
								$currency = $currency . '&nbsp;';
							}
							$output .= '<div class="btQuoteTotal"><span class="btQuoteTotalText">' . $total_text . '</span><span class="btQuoteTotalCurrency">' . $currency . '</span><span class="btQuoteTotalCalc"></span></div>';
						}
					}
					
					if ( $paypal_email == '' ) {
						if ( $show_next != '' ) {
							$output .= '<div class="boldBtn btnAccent btnSmall btnIco"><button type="submit" class="btContactNext">' . $next_text . '</button></div>';
						}
					} else {
						$output .= '<div class="btPayPalButton" style="background-image:url(' . plugin_dir_url( __FILE__ ) . 'paypal.png);"></div><form class="btPayPalForm" action="https://www.paypal.com/cgi-bin/webscr" method="post">
						<input type="hidden" name="cmd" value="_cart">
						<input type="hidden" name="upload" value="1">
						<input type="hidden" name="business" value="' . $paypal_email . '">
						<input type="hidden" name="item_name" value="' . $paypal_cart_name . '">
						<input type="hidden" name="currency_code" value="' . $paypal_currency . '">
						<input type="image" src="' . plugin_dir_url( __FILE__ ) . 'paypal.png" name="submit" alt="PayPal">
						</form>';
					}
				$output .= '</div>';
			$output .= '</div>';
			
			if ( $paypal_email == '' && $show_next != '' ) {
			
				if ( $cf7_id == '' || ! shortcode_exists( 'contact-form-7' ) ) {
					
					if ( $no_next == 'yes' ) {
						$output .= '<div class="btTotalQuoteContactGroup btActive">';
					} else {
						$output .= '<div class="btTotalQuoteContactGroup">';
					}

						$output .= '<div class="btQuoteContact"><form action="#">';
							$output .= '<div class="btQuoteItem' . $m_name . '"><input type="text" class="btContactName btContactField" placeholder="' . esc_html__( 'Name', 'bt-cost-calculator' ) . '" autocomplete="name"></div>';
							$output .= '<div class="btQuoteItem' . $m_email . '"><input type="email" class="btContactEmail btContactField" placeholder="' . esc_html__( 'Email', 'bt-cost-calculator' ) . '" autocomplete="email"></div>';
							$output .= '<div class="btQuoteItem' . $m_phone . '"><input type="text" class="btContactPhone btContactField" placeholder="' . esc_html__( 'Phone', 'bt-cost-calculator' ) . '" autocomplete="tel"></div>';
							$output .= '<div class="btQuoteItem' . $m_address . '"><input type="text" class="btContactAddress btContactField" placeholder="' . esc_html__( 'Address', 'bt-cost-calculator' ) . '"></div>';
							
							if ( $show_booking != '' ) {
								$output .= '<div class="btQuoteItem' . $m_date . '"><input type="text" class="btContactDate btContactField" placeholder="' . $date_text . '"></div>';
								$output .= '<div class="btQuoteItem' . $m_time . '">';
									$output .= '<div class="btContactTime btContactField btDropDown"></div>';
									if ( $time_start == '' ) $time_start = 0;
									if ( $time_end == '' ) $time_end = 23;
									$proxy = new CostTime_Proxy( $time_start, $time_end, $time_format, $time_text, $css_class );
									add_action( 'wp_footer', array( $proxy, 'js_init' ), 20 );
								$output .= '</div>';
							}
							
							$output .= '<div class="btQuoteItem' . $m_message . ' btQuoteItemFullWidth"><textarea class="btContactMessage btContactField" placeholder="' . esc_html__( 'Message', 'bt-cost-calculator' ) . '"></textarea></div>';
							
							if ( $email_client == 'yes' && $email_confirmation == 'yes' ) {
								$id = uniqid();
								$output .= '<div class="bt_cc_email_confirmation_container"><input id="' . $id . '" class="bt_cc_email_confirmation" type="checkbox" value="yes"><label for="' . $id . '">' . esc_html__( 'Email me quote!', 'bt-cost-calculator' ) . '</label></div>';
							}	
							
							if ( $email_gdpr == 'yes' && $email_gdpr_text != '' ) {
								$id = uniqid();
								$output .= '<div class="bt_cc_email_confirmation_container bt_cc_gdpr_confirmation_container"><input id="' . $id . '" class="bt_cc_email_gdpr" type="checkbox" value="yes"><label for="' . $id . '">' . $email_gdpr_text . '</label></div>';
							}	
							
							if ( $rec_site_key != '' && $rec_secret_key != '' ) {
								$id = uniqid();
								$output .= '<div id=' . $id . ' class="g-rec" data-sk="' . $rec_site_key . '"></div>';
								add_action( 'wp_footer', 'bt_enqueue_recaptcha' );
							}
							
							$output .= '<div class="boldBtn btnAccent btnSmall btnIco"><button type="submit" class="btContactSubmit">' . esc_html__( 'Submit', 'bt-cost-calculator' ) . '</button></div>';
							
							$output .= '<div class="btSubmitMessage"></div>';
							
						$output .= '</form></div><!-- btQuoteContact -->';
					
					$output .= '</div>';
					
				} else {
					// CF 7 support 
					if ( $no_next == 'yes' ) {
						$output .= '<div class="btTotalQuoteContactGroup btActive">';
					} else {
						$output .= '<div class="btTotalQuoteContactGroup">';
					}
					$output .= '<div class="btQuoteContact btQuoteContactForm7">';
					$output .= do_shortcode('[contact-form-7 id="' . $cf7_id . '"]');
					$output .= '</div></div>';	
				} 
				
			}
			
		$output .= '</div>';
		$output .= '</div>';
		
		return $output;
	}
}

class Cost_Proxy {
	function __construct( $arr ) {
		$this->accent_color = $arr['accent_color'];
		$this->css_class = $arr['css_class'];
	}	

	public function js_init() { ?>
		<script>
		
			var bt_cc_accent_<?php echo $this->css_class; ?>_init_finished = false;
			
			document.addEventListener('readystatechange', function() {
				if ( ! bt_cc_accent_<?php echo $this->css_class; ?>_init_finished && typeof(jQuery) !== 'undefined' && ( document.readyState === 'interactive' || document.readyState === 'complete' ) ) {
					var css_class = '<?php echo $this->css_class; ?>';
					var c = jQuery( '.' + css_class );
					setTimeout( function(){ c.css( 'opacity', '1' ); }, 200 );
					var accent_color = '<?php echo $this->accent_color; ?>';
					
					if ( accent_color != '' ) {
						jQuery( 'head' ).append( '<style>.btQuoteBooking.' + css_class + ' .btContactNext { color: ' + accent_color + ' !important; border: ' + accent_color + ' 2px solid !important; }.btQuoteBooking.' + css_class + '  input[type="text"]:hover, .btQuoteBooking.' + css_class + '  input[type="email"]:hover, .btQuoteBooking.' + css_class + '  input[type="password"]:hover, .btQuoteBooking.' + css_class + '  input[type="url"]:hover, .btQuoteBooking.' + css_class + '  input[type="tel"]:hover, .btQuoteBooking.' + css_class + '  input[type="number"]:hover, .btQuoteBooking.' + css_class + '  input[type="date"]:hover, .btQuoteBooking.' + css_class + '  textarea:hover, .btQuoteBooking.' + css_class + '  .fancy-select .trigger:hover {	box-shadow: 0 0 0 ' + accent_color + ' inset, 0 1px 5px rgba(0,0,0,0.2) !important;}.btQuoteBooking.' + css_class + ' .dd.ddcommon.borderRadius:hover .ddTitleText {	box-shadow: 0 0 0 ' + accent_color + ' inset, 0 1px 5px rgba(0,0,0,0.2) !important;}.btQuoteBooking.' + css_class + '  input[type="text"]:focus, .btQuoteBooking.' + css_class + '  input[type="email"]:focus, .btQuoteBooking.' + css_class + '  input[type="url"]:focus, .btQuoteBooking.' + css_class + '  input[type="tel"]:focus, .btQuoteBooking.' + css_class + '  input[type="number"]:focus, .btQuoteBooking.' + css_class + '  input[type="date"]:focus, .btQuoteBooking.' + css_class + '  textarea:focus, .btQuoteBooking.' + css_class + '  .fancy-select .trigger.open {	box-shadow: 5px 0 0 ' + accent_color + ' inset, 0 2px 10px rgba(0,0,0,0.2) !important;}.btQuoteBooking.' + css_class + ' .dd.ddcommon.borderRadiusTp .ddTitleText, .btQuoteBooking.' + css_class + ' .dd.ddcommon.borderRadiusBtm .ddTitleText {	box-shadow: 5px 0 0 ' + accent_color + ' inset, 0 2px 10px rgba(0,0,0,0.2) !important;}.btQuoteBooking.' + css_class + '  .ui-slider .ui-slider-handle {	background: ' + accent_color + ' !important;}.btQuoteBooking.' + css_class + ' .btQuoteBookingForm .btQuoteTotal {	background: ' + accent_color + ' !important;}.btQuoteBooking.' + css_class + '  .btContactFieldMandatory input:hover, .btQuoteBooking.' + css_class + '  .btContactFieldMandatory textarea:hover {	box-shadow: 0 0 0 1px #AAA inset, 0 0 0 ' + accent_color + ' inset, 0 1px 5px rgba(0,0,0,0.2) !important;}.btQuoteBooking.' + css_class + ' .btContactFieldMandatory .dd.ddcommon.borderRadius:hover .ddTitleText {	box-shadow: 0 0 0 1px #AAA inset, 0 0 0 ' + accent_color + ' inset, 0 1px 5px rgba(0,0,0,0.2) !important;}.btQuoteBooking.' + css_class + '  .btContactFieldMandatory input:focus, .btQuoteBooking.' + css_class + '  .btContactFieldMandatory textarea:focus {	box-shadow: 0 0 0 1px #AAA inset, 5px 0 0 ' + accent_color + ' inset, 0 1px 5px rgba(0,0,0,0.2) !important;}.btQuoteBooking.' + css_class + ' .btContactFieldMandatory .dd.ddcommon.borderRadiusTp .ddTitleText {	box-shadow: 0 0 0 1px #AAA inset, 5px 0 0 ' + accent_color + ' inset, 0 1px 5px rgba(0,0,0,0.2) !important;}.btQuoteBooking.' + css_class + '  .btContactFieldMandatory.btContactFieldError input, .btQuoteBooking.' + css_class + '  .btContactFieldMandatory.btContactFieldError textarea {	border: 1px solid ' + accent_color + ' !important;	box-shadow: 0 0 0 1px ' + accent_color + ' inset !important;}.btQuoteBooking.' + css_class + ' .btContactFieldMandatory.btContactFieldError .dd.ddcommon.borderRadius .ddTitleText {	border: 1px solid ' + accent_color + ' !important;	box-shadow: 0 0 0 1px ' + accent_color + ' inset !important;}.btQuoteBooking.' + css_class + '  .btContactFieldMandatory.btContactFieldError input:hover, .btQuoteBooking.' + css_class + '  .btContactFieldMandatory.btContactFieldError textarea:hover {	box-shadow: 0 0 0 1px ' + accent_color + ' inset, 0 0 0 ' + accent_color + ' inset, 0 1px 5px rgba(0,0,0,0.2) !important;}.btQuoteBooking.' + css_class + ' .btContactFieldMandatory.btContactFieldError .dd.ddcommon.borderRadius:hover .ddTitleText {	box-shadow: 0 0 0 1px ' + accent_color + ' inset, 0 0 0 ' + accent_color + ' inset, 0 1px 5px rgba(0,0,0,0.2) !important;}.btQuoteBooking.' + css_class + '  .btContactFieldMandatory.btContactFieldError input:focus, .btQuoteBooking.' + css_class + '  .btContactFieldMandatory.btContactFieldError textarea:focus {	box-shadow: 0 0 0 1px ' + accent_color + ' inset, 5px 0 0 ' + accent_color + ' inset, 0 1px 5px rgba(0,0,0,0.2) !important;}.btQuoteBooking.' + css_class + ' .btContactFieldMandatory.btContactFieldError .dd.ddcommon.borderRadiusTp .ddTitleText {	box-shadow: 0 0 0 1px ' + accent_color + ' inset, 5px 0 0 ' + accent_color + ' inset, 0 1px 5px rgba(0,0,0,0.2) !important;}.btQuoteBooking.' + css_class + ' .btSubmitMessage {	color: ' + accent_color + ' !important;}.btDatePicker .ui-datepicker-header {	background-color: ' + accent_color + ' !important;}.btQuoteBooking.' + css_class + ' .btContactSubmit {	background-color: ' + accent_color + ' !important;}.btQuoteBooking.' + css_class + ' .btQuoteSwitch.on .btQuoteSwitchInner{background: ' + accent_color + ' !important;}</style>' );
					}
					bt_cc_accent_<?php echo $this->css_class; ?>_init_finished = true;
				}
			}, false);
			
		</script>
		
	<?php }
}

class CostTime_Proxy {
	function __construct( $time_start, $time_end, $time_format, $title, $css_class ) {
		$this->time_start = $time_start;
		$this->time_end = $time_end;
		$this->time_format = $time_format;
		$this->title = $title;
		$this->css_class = $css_class;
	}	

	public function js_init() { ?>
		<script>
			var bt_cc_<?php echo $this->css_class; ?>_init_finished = false;
			
			document.addEventListener('readystatechange', function() { 
				if ( ! bt_cc_<?php echo $this->css_class; ?>_init_finished && typeof(jQuery) !== 'undefined' && ( document.readyState === 'interactive' || document.readyState === 'complete' ) ) {
					var css_class = '<?php echo $this->css_class; ?>';
					var c = jQuery( '.' + css_class );
					
					var bt_time_ddData = [
					<?php
						echo '{ text:\'' . $this->title . '\', value:\'\' },';
						for ( $i = intval( $this->time_start ); $i <= intval( $this->time_end ); $i++ ) {
							if ( $this->time_format == '24' ) {
								if ( $i < 10 ) $i = '0' . $i;
								echo '{ text: \'' . $i . ':00\', value: \'' . $i . ':00\' },';
							} else {
								if ( $i == 0 ) {
									echo '{ text: \'12:00 AM\', value: \'12:00 AM\' },';
								} else if ( $i < 12 ) {
									if ( $i < 10 ) $i = '0' . $i;
									echo '{ text: \'' . $i . ':00 AM\', value: \'' . $i . ':00 AM\' },';									
								} else if ( $i == 12 ) {
									echo '{ text: \'12:00PM\', value: \'12:00 PM\' },';
								} else {
									$t = $i - 12;
									if ( $t < 10 ) $t = '0' . $t;
									echo '{ text: \'' . $t . ':00 PM\', value: \'' . $t . ':00 PM\' },';									
								}

							}
						}
					?>
					];
					
					c.find( '.btContactTime' ).msDropDown({
						byJson:{data:bt_time_ddData},
						on:{change:function( data, ui ) {
							var val = data.value;
						}}
					});
					bt_cc_<?php echo $this->css_class; ?>_init_finished = true;
				}
			}, false);
		</script>
	<?php }
}

class CostDD_Proxy {
	function __construct( $dd_id, $items_arr, $title, $img_height, $initial_index ) {
		$this->dd_id = $dd_id;
		$this->items_arr = $items_arr;
		$this->title = $title;
		$this->img_height = $img_height;
		
		$this->vrednost = "";
		if ( $initial_index > 0 ){

			$items_arr2 =	$items_arr[$initial_index-1];
			$vrednost_arr = explode( ';', $items_arr2 );
			$this->vrednost = $vrednost_arr[1];
		}		
		
		if ( $initial_index > count($this->items_arr) ){
			$initial_index = count($this->items_arr);
		}
		$this->initial_index = $initial_index > 0 ? $initial_index : 0;
	}	

	public function js_init() { ?>
		<script>
		
			var bt_cc_<?php echo $this->dd_id; ?>_init_finished = false;
			
			document.addEventListener('readystatechange', function() { 
				if ( ! bt_cc_<?php echo $this->dd_id; ?>_init_finished && typeof(jQuery) !== 'undefined' && ( document.readyState === 'interactive' || document.readyState === 'complete' ) ) {
					var img_height = '<?php echo $this->img_height; ?>';
					if ( img_height != '' ) {
						jQuery( 'head' ).append( '<style>.ddImage img {height:' + img_height + 'px !important;}</style>' );
					}			
				
					var ddData = [<?php
						echo '{ text:\'' . $this->title . '\', value:\'\' }';             
						foreach ( $this->items_arr as $item ) {
							if ( trim( $item ) != '' ) {
								$arr = explode( ';', $item );
								if ( ! isset( $arr[1] ) ) {
									$arr[1] = '';
								}
								if ( ! isset( $arr[2] ) ) {
									$arr[2] = '';
								}
								if ( ! isset( $arr[3] ) ) {
									$arr[3] = '';
								}
								echo ',{ text: \'' . $arr[0] . '\', value: \'' . floatval( $arr[1] ) . '\', description: \'' . sanitize_text_field( $arr[2] ) . '\', image: \'' . $arr[3] . '\' }';							
							}
						}
					?>];
					
					var oDropdown = jQuery( '#<?php echo $this->dd_id; ?>' ).msDropDown({
						byJson:{ data:ddData },
						on:{change:function( data, ui ) {
							var val = data.value;
							ui.data( 'value', val );
							bt_cc_eval_conditions( val, jQuery( ui ).closest( '.btQuoteSelect' ).data( 'condition' ) );
							bt_quote_total( jQuery( ui ).closest( '.btQuoteBooking' ) );
							bt_paypal_items( jQuery( ui ).closest( '.btQuoteBooking' ) );
						}}
					}).data('dd');
					if ( oDropdown ) {
						bt_cc_init_dropdown( oDropdown, '#<?php echo $this->dd_id; ?>', <?php echo $this->initial_index; ?> );
					}					
					bt_cc_<?php echo $this->dd_id; ?>_init_finished = true;
				}
			}, false);
		
		</script>
	<?php }
}

// [bt_cc_item]
class bt_cc_item {
	static function init() {
		add_shortcode( 'bt_cc_item', array( __CLASS__, 'handle_shortcode' ) );
	}

	static function handle_shortcode( $atts, $content ) {
		extract( shortcode_atts( array(
			'name'					=> '',
			'description'			=> '',
			'type'					=> 'text',
			'value'					=> '',           
			'initial_value'			=> '',
			'images'				=> '',
			'img_height'			=> '',
			'condition'				=> '',
			'item_el_id'			=> '',
			'item_el_class'         => '',
			'item_el_style'         => ''
		), $atts, 'bt_cc_item' ) );
		
		$name = sanitize_text_field( $name );
		$description = sanitize_text_field( $description );
		$type = sanitize_text_field( $type );
		$initial_value = sanitize_text_field( $initial_value );
		$images = sanitize_text_field( $images );
		$img_height = sanitize_text_field( $img_height );
		// $condition = sanitize_text_field( $condition );
		$item_el_id = sanitize_text_field( $item_el_id );
		$item_el_class = sanitize_text_field( $item_el_class );
		$item_el_style = sanitize_text_field( $item_el_style ); 

		$value = str_replace( "'", "\'", $value );		
   
		$item_id_attr = '';
		if ( $item_el_id == '' ) {
			$item_el_id = uniqid( 'btQuoteItem' );
		} else {
			$item_el_id = $item_el_id;
		}
		$item_id_attr = 'id="' . $item_el_id . '"';

		$item_class = array();
		if ( $item_el_class != '' ) {
			$item_class[] = $item_el_class;
		}
		
		$item_style_attr = '';
		if ( $item_el_style != '' ) {
			$item_style_attr = 'style="' . $item_el_style . '"';
		}

		$images = explode( ',', $images );
		
		if ( $condition != '' ) {
			$condition = preg_replace( '/$\R?^/m', "#bt_cc_nl#", $condition );	
			/*$condition = str_replace( '%3E', "&gt;", $condition );
			$condition = str_replace( '%3C', "&lt;", $condition );			
			$condition = sanitize_text_field( $condition );*/
			$condition = str_replace( '#gt#', "&gt;", $condition );
			$condition = str_replace( '#lt#', "&lt;", $condition );
			$condition = strip_tags( $condition );/**/
		}

		if ( $type == 'text' ) {
			$price = round( floatval( $value ), 2 );
			$input = '<input type="text" class="btQuoteText btQuoteElement" data-condition="' . $condition . '" data-price="' . $price . '" value="' . $initial_value . '" data-initial-value="' . $initial_value  . '"/>';
			
		} else if ( $type == 'select' ) {
			
			$items_arr = preg_split( '/$\R?^/m', $value );
			
			$i = 0;
			foreach ( $items_arr as $item ) {
				if ( isset( $images[ $i ] ) ) {
					$items_arr[ $i ] = sanitize_text_field( $items_arr[ $i ] . ';' . wp_get_attachment_thumb_url( $images[ $i ] ) );
				}  
				$i++;
			}

			$dd_id = uniqid() . "W" . rand(100,999);
			
			//$input = '<div id="' . $dd_id . '" class="btQuoteSelect btContactField btDropDown" data-value="'.$initial_value.'"></div>';
			$input = '<div id="' . $dd_id . '" class="btQuoteSelect btContactField btDropDown btQuoteElement" data-condition="' . $condition . '" data-initial-value="' . $initial_value  . '"></div>';
			
			$proxy = new CostDD_Proxy( $dd_id, $items_arr, esc_html__( 'Select...', 'bt-cost-calculator' ), $img_height, $initial_value );
			add_action( 'wp_footer', array( $proxy, 'js_init' ), 20 );			
			
		} else if ( $type == 'slider' ) {    
		
			$arr = explode( ';', $value );
			$price = round( floatval( $arr[3] ), 2 );
			$offset = isset( $arr[4] ) ? round( floatval( $arr[4] ), 2 ) : 0;

			if ( $initial_value > $arr[1] ){
				$initial_value =  $arr[1];
			}

			if ( $initial_value < $arr[0] ){
				$initial_value =  $arr[0];
			}
				
			$input = '<div class="btQuoteSlider btQuoteElement" data-value="' . $initial_value . '"  data-initial-value="' . $initial_value  . '" data-min="' . $arr[0] . '" data-max="' . $arr[1] . '" data-step="' . $arr[2] . '" data-price="' . $price . '" data-offset="' . $offset . '" data-condition="' . $condition . '"></div><span class="btQuoteSliderValue">' . $initial_value . '</span>';
			
		} else if ( $type == 'switch' ) {
		
			$arr = explode( ';', $value );
			if ( ! is_array( $arr ) || count( $arr ) < 2 ) {
				$arr = array( 0, 1 );
			}

			$class_on = '';
			if ( $initial_value ==  $arr[1] ){
				$class_on = ' on';
			}

			$input = '<div class="btQuoteSwitch btQuoteElement' . $class_on . '" data-off="' . $arr[0] . '" data-on="' . $arr[1] . '" data-condition="' . $condition . '" data-initial-value="' . $initial_value  . '"><div class="btQuoteSwitchInner"></div></div>';
			
		}
		
		$output = '<div class="btQuoteItem ' . implode( ' ', $item_class ) . '" ' . $item_id_attr . ' ' . $item_style_attr . '><label>' . $name . '</label>
		<div class="btQuoteItemInput">' . $input;
		if ( $description != '' ) $output .= '<div class="btQuoteItemDescription">' . $description . '</div>';
		$output .= '</div></div>';

		return $output;
	}
}

// [bt_cc_multiply]
class bt_cc_multiply {
	static function init() {
		add_shortcode( 'bt_cc_multiply', array( __CLASS__, 'handle_shortcode' ) );
	}

	static function handle_shortcode( $atts, $content ) {
		extract( shortcode_atts( array(

		), $atts, 'bt_cc_multiply' ) );
		
		$output = '<div class="btQuoteMBlock">' . wptexturize( do_shortcode( $content ) ) . '</div>';

		return $output;
	}
}

// [bt_cc_group]
class bt_cc_group {
	static function init() {
		add_shortcode( 'bt_cc_group', array( __CLASS__, 'handle_shortcode' ) );
	}

	static function handle_shortcode( $atts, $content ) {
		extract( shortcode_atts( array(
			'eval'         			=> '',
			'paypal_label' 			=> '',
			'item_el_id'			=> '',
			'item_el_class'         => '',
			'item_el_style'         => ''
		), $atts, 'bt_cc_group' ) );
		
		$item_el_id = sanitize_text_field( $item_el_id );
		$item_el_class = sanitize_text_field( $item_el_class );
		$item_el_style = sanitize_text_field( $item_el_style ); 
		
		$item_id_attr = '';
		if ( $item_el_id == '' ) {
			$item_el_id = uniqid( 'btQuoteItem' );
		} else {
			$item_el_id = $item_el_id;
		}
		$item_id_attr = 'id="' . $item_el_id . '"';

		$item_class = array();
		if ( $item_el_class != '' ) {
			$item_class[] = $item_el_class;
		}
		
		$item_style_attr = '';
		if ( $item_el_style != '' ) {
			$item_style_attr = 'style="' . $item_el_style . '"';
		}
		
		/*$eval = sanitize_text_field( $eval );*/
		$eval = preg_replace( '/$\R?^/m', "", $eval );
		$eval = str_replace( '#lt#', "&lt;", $eval );
		$eval = str_replace( '#gt#', "&gt;", $eval );
		$eval = strip_tags($eval);
		
		$output = '<div class="btQuoteGBlock ' . implode( ' ', $item_class ) . '" data-eval="' . $eval . '" data-paypal_label="' . $paypal_label . '" ' . $item_id_attr . ' ' . $item_style_attr . '>' . wptexturize( do_shortcode( $content ) ) . '</div>';

		return $output;
	}
}

// [bt_cc_text]
class bt_cc_text {
	static function init() {
		add_shortcode( 'bt_cc_text', array( __CLASS__, 'handle_shortcode' ) );

		
	}

	static function handle_shortcode( $atts, $content ) {
		extract( shortcode_atts( array(
			'name'					=> '',
			'description'			=> '',
			'value'					=> '',
			'initial_value'			=> '',
			'condition'				=> '',
			'item_el_id'			=> '',
			'item_el_class' 		=> '',
			'item_el_style' 		=> ''
		), $atts, 'bt_cc_text' ) );
 		
		$name = sanitize_text_field( $name );
		$description = sanitize_text_field( $description );
		$type = sanitize_text_field( 'text' );
		$value = sanitize_text_field( $value );
		$initial_value = sanitize_text_field( $initial_value );
		// $condition = sanitize_text_field( $condition );
		$item_el_id = sanitize_text_field( $item_el_id );
		$item_el_class = sanitize_text_field( $item_el_class );
		$item_el_style = sanitize_text_field( $item_el_style );
		
		if ( $condition != '' ) $condition = preg_replace( '/$\R?^/m', "#bt_cc_nl#", $condition );
                
		$output = wptexturize( do_shortcode( '[bt_cc_item '
				. 'name="' . $name . '" '
				. 'description="' . $description . '" '
				. 'type="' . $type . '" '
				. 'value="' . $value . '" '
				. 'initial_value="' . $initial_value . '" '
				. 'condition="' . $condition . '" '
				. 'item_el_id="' . $item_el_id . '" '
				. 'item_el_class="' . $item_el_class . '" '
				. 'item_el_style="' . $item_el_style . '" '
				. ']' ) );
		
		return $output;
	}
}

// [bt_cc_select]
class bt_cc_select {
	static function init() {
		add_shortcode( 'bt_cc_select', array( __CLASS__, 'handle_shortcode' ) );
	}

	static function handle_shortcode( $atts, $content ) {
		extract( shortcode_atts( array(
			'name'					=> '',
			'description'			=> '',
			'value'					=> '',
			'initial_value'			=> '',
			'images'				=> '',
			'img_height'			=> '',
			'condition'				=> '',
			'item_el_id'			=> '',
			'item_el_class' 		=> '',
			'item_el_style' 		=> ''
		), $atts, 'bt_cc_select' ) );
		
		$name = sanitize_text_field( $name );
		$description = sanitize_text_field( $description );
		$type = sanitize_text_field( 'select' );
		$initial_value = sanitize_text_field( $initial_value );
		$images = sanitize_text_field( $images );
		$img_height = sanitize_text_field( $img_height );
		// $condition = sanitize_text_field( $condition );
		$item_el_id = sanitize_text_field( $item_el_id );
		$item_el_class = sanitize_text_field( $item_el_class );
		$item_el_style = sanitize_text_field( $item_el_style );
		
		if ( $condition != '' ) $condition = preg_replace( '/$\R?^/m', "#bt_cc_nl#", $condition );
                
		 $output = wptexturize( do_shortcode( '[bt_cc_item '
				. 'name="' . $name . '" '
				. 'description="' . $description . '" '
				. 'type="' . $type . '" '
				. 'value="' . $value . '" '
				. 'initial_value="' . $initial_value . '" '
				. 'images="' . $images . '" '
				. 'img_height="' . $img_height . '" '
				. 'condition="' . $condition . '" '
				. 'item_el_id="' . $item_el_id . '" '
				. 'item_el_class="' . $item_el_class . '" '
				. 'item_el_style="' . $item_el_style . '" '
				. ']' ) );
                
		return $output;
	}
}


// [bt_cc_slider]
class bt_cc_slider {
	static function init() {
		add_shortcode( 'bt_cc_slider', array( __CLASS__, 'handle_shortcode' ) );
	}

	static function handle_shortcode( $atts, $content ) {
		extract( shortcode_atts( array(
			'name'					=> '',
			'description'			=> '',
			'value_min'				=> '',
			'value_max'				=> '',
			'value_step'			=> '',
			'value_unit'			=> '',
			'value_offset'			=> '',
			'initial_value'			=> '',
			'condition'				=> '',
			'item_el_id'			=> '',
			'item_el_class' 		=> '',
			'item_el_style' 		=> ''
		), $atts, 'bt_cc_slider' ) );
		
		$name = sanitize_text_field( $name );
		$description = sanitize_text_field( $description );
		$type = sanitize_text_field( 'slider' );                
		$value_min = sanitize_text_field( $value_min );
		$value_max = sanitize_text_field( $value_max );
		$value_step = sanitize_text_field( $value_step );
		$value_unit = sanitize_text_field( $value_unit );
		$value_offset = sanitize_text_field( $value_offset );                
		$initial_value = sanitize_text_field( $initial_value );
		// $condition = sanitize_text_field( $condition );
		
		$item_el_id = sanitize_text_field( $item_el_id );
		$item_el_class = sanitize_text_field( $item_el_class );
		$item_el_style = sanitize_text_field( $item_el_style );
                
		$value = $value_min . ";" . $value_max . ";" . $value_step . ";" . $value_unit . ";" . $value_offset ;
		
		if ( $condition != '' ) $condition = preg_replace( '/$\R?^/m', "#bt_cc_nl#", $condition );
		
		$output = wptexturize( do_shortcode( '[bt_cc_item '
				. 'name="' . $name . '" '
				. 'description="' . $description . '" '
				. 'type="' . $type . '" '
				. 'value="' . $value . '" '
				. 'initial_value="' . $initial_value . '" '
				. 'condition="' . $condition . '" '
				. 'item_el_id="' . $item_el_id . '" '
				. 'item_el_class="' . $item_el_class . '" '
				. 'item_el_style="' . $item_el_style . '" '
				. ']' ) );

		return $output;
	}
}


// [bt_cc_switch]
class bt_cc_switch {
	static function init() {
		add_shortcode( 'bt_cc_switch', array( __CLASS__, 'handle_shortcode' ) );
	}

	static function handle_shortcode( $atts, $content ) {
		extract( shortcode_atts( array(
			'name'					=> '',
			'description'			=> '',
			'value_off'				=> '',
			'value_on'				=> '',
			'initial_value'			=> '',
			'condition'				=> '',
			'item_el_id'			=> '',
			'item_el_class' 		=> '',
			'item_el_style' 		=> ''
		), $atts, 'bt_cc_switch' ) );
		
		$name = sanitize_text_field( $name );
		$description = sanitize_text_field( $description );
		$type = sanitize_text_field( 'switch' );
		$value_off = sanitize_text_field( $value_off );
		$value_on = sanitize_text_field( $value_on );
		$initial_value = sanitize_text_field( $initial_value );
		// $condition = sanitize_text_field( $condition );
		$item_el_id = sanitize_text_field( $item_el_id );
		$item_el_class = sanitize_text_field( $item_el_class );
		$item_el_style = sanitize_text_field( $item_el_style );
                
		$value = $value_off . ";" . $value_on;
		
		if ( $condition != '' ) $condition = preg_replace( '/$\R?^/m', "#bt_cc_nl#", $condition );
		
		$output = wptexturize( do_shortcode( '[bt_cc_item '
				. 'name="' . $name . '" '
				. 'description="' . $description . '" '
				. 'type="' . $type . '" '
				. 'value="' . $value . '" '
				. 'initial_value="' . $initial_value . '" '
				. 'condition="' . $condition . '" '
				. 'item_el_id="' . $item_el_id . '" '
				. 'item_el_class="' . $item_el_class . '" '
				. 'item_el_style="' . $item_el_style . '" '
				. ']' ) );

		return $output;
	}
}

// [bt_cc_raw_html]
class bt_cc_raw_html {
	static function init() {
		add_shortcode( 'bt_cc_raw_html', array( __CLASS__, 'handle_shortcode' ) );
	}

	static function handle_shortcode( $atts, $content ) {
		extract( shortcode_atts( array(
			'raw_html' => '',
		), $atts, 'bt_cc_raw_html' ) );
                
		$output = base64_decode( $raw_html );
		
		return do_shortcode( $output );
	}
}

// [bt_cc_subtotal]
class bt_cc_subtotal {
	static function init() {
		add_shortcode( 'bt_cc_subtotal', array( __CLASS__, 'handle_shortcode' ) );
	}

	static function handle_shortcode( $atts, $content ) {
		extract( shortcode_atts( array(
			'id'    => '',
			'label' => '',
		), $atts, 'bt_cc_subtotal' ) );
		
		return '<div id="btSubtotalId' . $id . '" class="btQuoteSubtotal" data-label="' . $label . '"><span class="btQuoteSubtotalText">' . $label . '</span><span class="btQuoteSubtotalCalc"></span></div>';
	}
}

// [bt_cc_separator]
class bt_cc_separator {
	static function init() {
		add_shortcode( 'bt_cc_separator', array( __CLASS__, 'handle_shortcode' ) );
	}

	static function handle_shortcode( $atts, $content ) {
		extract( shortcode_atts( array(
			'top_spacing'    => '',
			'bottom_spacing' => '',
			'border_style'   => '',
			'item_el_id'	 => '',
			'item_el_class'  => '',
			'item_el_style'  => ''
		), $atts, 'bt_cc_separator' ) );

		$class = array( 'bt_cc_separator' );

		$item_id_attr = '';
		if ( $item_el_id == '' ) {
			$item_el_id = uniqid( 'bt_cc_separator' );
		} else {
			$item_el_id = $item_el_id;
		}
		$item_id_attr = 'id="' . $item_el_id . '"';

		if ( $item_el_class != '' ) {
			$class[] = $item_el_class;
		}
		
		$item_style_attr = '';
		if ( $item_el_style != '' ) {
			$item_style_attr = 'style="' . $item_el_style . '"';
		}
		
		if ( $top_spacing != '' ) {
			$class[] = 'bt_cc_top_spacing' . '_' . $top_spacing;
		}
		
		if ( $bottom_spacing != '' ) {
			$class[] = 'bt_cc_bottom_spacing' . '_' . $bottom_spacing;
		}
		
		if ( $border_style != '' ) {
			$class[] = 'bt_cc_border_style' . '_' . $border_style;
		}

		$output = '<div class="' . implode( ' ', $class ) . '" ' . $item_id_attr . ' ' . $item_style_attr . '></div>';
		
		return $output;
	}
}

bt_cost_calculator::init();
bt_cc_item::init();
bt_cc_multiply::init();
bt_cc_group::init();
bt_cc_text::init();
bt_cc_select::init();
bt_cc_slider::init();
bt_cc_switch::init();

bt_cc_raw_html::init();
bt_cc_subtotal::init();
bt_cc_separator::init();

/*
 * * * * * * * * * *
 * RC / VC MAPPING *
 * * * * * * * * * *
 */

function bt_quote_map_sc() {

	$time_array = array();
	$time_array[ '' ] = '';
	for ( $i = 0; $i <= 23; $i++ ) {
		if ( $i < 10 ) $i = '0' . $i;
		$time_array[ $i . ':00' ] =  $i . ':00';
	}
	
	$args = array('post_type' => 'wpcf7_contact_form', 'posts_per_page' => -1, 'post_status' => 'publish');
	$forms_data = array();
	$all_plugins = apply_filters('active_plugins', get_option('active_plugins'));
	if ( stripos( implode( $all_plugins ), 'wp-contact-form-7.php' ) ) {
		if ( $data = get_posts( $args ) ) {
			$forms_data[ esc_html__( 'No CF7 form (use default form with settings below)', 'bt-cost-calculator' ) ] = '';
			foreach( $data as $key ){
				$forms_data[ $key -> post_title ] = $key -> ID;
			}
		} else {
			$forms_data[ esc_html__( 'No contact form found', 'bt-cost-calculator' ) ] = '';
		}
	} else {
		$forms_data[ esc_html__( 'Contact Form 7 not installed', 'bt-cost-calculator' ) ] = '';
	}
	
	$bt_quote_params = array(
		array( 'param_name' => 'separator', 'type' => 'bt_cc_custom_label_text', 'value' => array( ), 'heading' => __( 'For detailed explaination on how to use Cost Calculator go to <a target="_blank" href="http://documentation.bold-themes.com/cost-calculator/using-cost-calculator/">plugin documentation</a>.', 'bt-cost-calculator' ) ),

		array( 'param_name' => 'accent_color', 'type' => 'colorpicker', 'heading' => esc_html__( 'Accent Color', 'bt-cost-calculator' ) ),
		array( 'param_name' => 'total_text', 'type' => 'textfield', 'heading' => esc_html__( 'Label for Total', 'bt-cost-calculator' ), 'value' => esc_html__( 'Total', 'bt-cost-calculator' ) ),
		array( 'param_name' => 'total_format', 'type' => 'dropdown', 'heading' => esc_html__( 'Number Format for Total & Subtotal(s)', 'bt-cost-calculator' ),
			'value' => array(
				esc_html__( '1,000.00 (currency)' ) => 'currency_1',
				esc_html__( '1.000,00 (currency)' ) => 'currency_2',
				esc_html__( '1 000,00 (currency)' ) => 'currency_3',
				esc_html__( '1000.12 (decimal)' )   => 'decimal_1',
				esc_html__( '1000,12 (decimal)' )   => 'decimal_2',
				esc_html__( '1000 (rounded)' )      => 'rounded',
		) ),
		array( 'param_name' => 'total_decimals', 'type' => 'dropdown', 'default' => '2', 'heading' => esc_html__( 'Decimal Places for Total & Subtotal(s)', 'bt-cost-calculator' ),
			'value' => array(
				'1' => '1',
				'2' => '2',
				'3' => '3',
				'4' => '4',
				'5' => '5',
		) ),
		array( 'param_name' => 'currency', 'type' => 'textfield', 'heading' => esc_html__( 'Currency Symbol', 'bt-cost-calculator' ) ),
		array( 'param_name' => 'currency_after', 'type' => 'checkbox', 'value' => array( esc_html__( 'Yes', 'bt-cost-calculator' ) => 'yes' ), 'heading' => esc_html__( 'Currency Symbol Is Placed After Total/Subtotal', 'bt-cost-calculator' ) ),
		array( 'param_name' => 'currency_space', 'type' => 'checkbox', 'value' => array( esc_html__( 'Yes', 'bt-cost-calculator' ) => 'yes' ), 'default' => 'yes', 'heading' => esc_html__( 'Space Between Currency and Total/Subtotal', 'bt-cost-calculator' ) ),
		array( 'param_name' => 'hide_total', 'type' => 'checkbox', 'value' => array( esc_html__( 'Yes', 'bt-cost-calculator' ) => 'yes' ), 'heading' => esc_html__( 'Hide Total & Subtotal(s)', 'bt-cost-calculator' ) ),

		array( 'param_name' => 'show_next', 'type' => 'checkbox', 'value' => array( esc_html__( 'Yes', 'bt-cost-calculator' ) => 'yes' ), 'heading' => esc_html__( 'Enable Contact Form', 'bt-cost-calculator' ), 'group' => esc_html__( 'Contact Form', 'bt-cost-calculator' ) ),
		array( 'param_name' => 'next_text', 'type' => 'textfield', 'heading' => esc_html__( 'Button Label', 'bt-cost-calculator' ), 'group' => esc_html__( 'Contact Form', 'bt-cost-calculator' ), 'description' => esc_html__( 'Clicking on button will show contact form to user. Default label is "NEXT".', 'bt-cost-calculator' ) ),
		array( 'param_name' => 'no_next', 'type' => 'checkbox', 'value' => array( esc_html__( 'Yes', 'bt-cost-calculator' ) => 'yes' ), 'heading' => esc_html__( 'Contact Form Is Always Visible (Remove Button)', 'bt-cost-calculator' ), 'group' => esc_html__( 'Contact Form', 'bt-cost-calculator' ) ),
		array( 'param_name' => 'cf7_id', 'type' => 'dropdown', 'value' => $forms_data, 'heading' => esc_html__( 'Choose Contact Form', 'bt-cost-calculator' ), 'preview' => true, 'group' => esc_html__( 'Contact Form', 'bt-cost-calculator' ), 'description' => __( 'Select Contact Form 7 or Cost Calculator contact form. For CF7 make sure to add required shortcodes to the contact form! Read more in our <a href="http://documentation.bold-themes.com/cost-calculator/using-cost-calculator/#contact-form-7" target="_blank">documentation</a>.', 'bt-cost-calculator' ) ),
		array( 'param_name' => 'url_confirmation', 'type' => 'textfield', 'heading' => esc_html__( 'Optional Redirection URL', 'bt-cost-calculator' ), 'description' => esc_html__( 'User will be redirected to this URL after submit.', 'bt-cost-calculator' ), 'preview' => true, 'group' => esc_html__( 'Contact Form', 'bt-cost-calculator' ) ),

		array( 'param_name' => 'show_booking', 'type' => 'checkbox', 'value' => array( esc_html__( 'Yes', 'bt-cost-calculator' ) => 'yes' ), 'heading' => esc_html__( 'Show Date/Time Inputs', 'bt-cost-calculator' ), 'group' => esc_html__( 'Contact Form', 'bt-cost-calculator' ) ),
		array( 'param_name' => 'date_text', 'type' => 'textfield', 'heading' => esc_html__( 'Place Holder - Date Picker', 'bt-cost-calculator' ), 'value' => esc_html__( 'Preferred Service Date', 'bt-cost-calculator' ), 'group' => esc_html__( 'Contact Form', 'bt-cost-calculator' ) ),
		array( 'param_name' => 'date_format', 'type' => 'textfield', 'default' => 'mm/dd/yy', 'heading' => esc_html__( 'Date Input Format', 'bt-cost-calculator' ), 'description' => esc_html__( 'Date format: ', 'bt-cost-calculator' ) . '<a href="https://api.jqueryui.com/datepicker/#utility-formatDate">https://api.jqueryui.com/datepicker/#utility-formatDate</a>.', 'group' => esc_html__( 'Contact Form', 'bt-cost-calculator' ) ),
		array( 'param_name' => 'time_text', 'type' => 'textfield', 'heading' => esc_html__( 'Place Holder - Time Picker', 'bt-cost-calculator' ), 'value' => esc_html__( 'Preferred Service Time', 'bt-cost-calculator' ), 'group' => esc_html__( 'Contact Form', 'bt-cost-calculator' ) ),

		array( 'param_name' => 'time_start', 'type' => 'dropdown', 'heading' => esc_html__( 'Time Picker - Start Time', 'bt-cost-calculator' ), 'value' => $time_array, 'group' => esc_html__( 'Contact Form', 'bt-cost-calculator' )),
		array( 'param_name' => 'time_end', 'type' => 'dropdown', 'heading' => esc_html__( 'Time Picker - End Time', 'bt-cost-calculator' ), 'value' => $time_array, 'group' => esc_html__( 'Contact Form', 'bt-cost-calculator' )),	
		array( 'param_name' => 'time_format', 'type' => 'dropdown', 'default' => '24', 'heading' => esc_html__( 'Time Picker - Time Format', 'bt-cost-calculator' ), 'group' => esc_html__( 'Contact Form', 'bt-cost-calculator' ),
			'value' => array(
				esc_html__( '24-hour clock', 'bt-cost-calculator' ) 			=> '24',
				esc_html__( '12-hour (AM/PM) clock', 'bt-cost-calculator' ) 	=> '12'
		) ),

		array( 'param_name' => 'separator', 'type' => 'bt_cc_custom_label', 'value' => array( ), 'heading' => __( 'Fields Mandatory for Users', 'bt-cost-calculator' ), 'group' => esc_html__( 'Contact Form', 'bt-cost-calculator' ) ),
		
		array( 'param_name' => 'm_name', 'type' => 'checkbox', 'value' => array( esc_html__( 'Name', 'bt-cost-calculator' ) => 'Mandatory' ), 'heading' => esc_html__( '', 'bt-cost-calculator' ), 'group' => esc_html__( 'Contact Form', 'bt-cost-calculator' ) ),
		array( 'param_name' => 'm_email', 'type' => 'checkbox', 'value' => array( esc_html__( 'Email', 'bt-cost-calculator' ) => 'Mandatory' ), 'heading' => esc_html__( '', 'bt-cost-calculator' ), 'group' => esc_html__( 'Contact Form', 'bt-cost-calculator' ) ),
		array( 'param_name' => 'm_phone', 'type' => 'checkbox', 'value' => array( esc_html__( 'Phone', 'bt-cost-calculator' ) => 'Mandatory' ), 'heading' => esc_html__( '', 'bt-cost-calculator' ), 'group' => esc_html__( 'Contact Form', 'bt-cost-calculator' ) ),
		array( 'param_name' => 'm_address', 'type' => 'checkbox', 'value' => array( esc_html__( 'Address', 'bt-cost-calculator' ) => 'Mandatory' ), 'heading' => esc_html__( '', 'bt-cost-calculator' ), 'group' => esc_html__( 'Contact Form', 'bt-cost-calculator' ) ),
		array( 'param_name' => 'm_message', 'type' => 'checkbox', 'value' => array( esc_html__( 'Message', 'bt-cost-calculator' ) => 'Mandatory' ), 'heading' => esc_html__( '', 'bt-cost-calculator' ), 'group' => esc_html__( 'Contact Form', 'bt-cost-calculator' ) ),
		array( 'param_name' => 'm_date', 'type' => 'checkbox', 'value' => array( esc_html__( 'Date', 'bt-cost-calculator' ) => 'Mandatory' ), 'heading' => esc_html__( '', 'bt-cost-calculator' ), 'group' => esc_html__( 'Contact Form', 'bt-cost-calculator' ) ),
		array( 'param_name' => 'm_time', 'type' => 'checkbox', 'value' => array( esc_html__( 'Time', 'bt-cost-calculator' ) => 'Mandatory' ), 'heading' => esc_html__( '', 'bt-cost-calculator' ), 'group' => esc_html__( 'Contact Form', 'bt-cost-calculator' ) ),

		array( 'param_name' => 'admin_email', 'type' => 'textfield', 'heading' => esc_html__( 'Admin Email', 'bt-cost-calculator' ), 'preview' => true, 'group' => esc_html__( 'Email', 'bt-cost-calculator' ) ),
		array( 'param_name' => 'subject', 'type' => 'textfield', 'heading' => esc_html__( 'Email Subject', 'bt-cost-calculator' ), 'group' => esc_html__( 'Email', 'bt-cost-calculator' ) ),
		array( 'param_name' => 'email_client', 'type' => 'checkbox', 'value' => array( esc_html__( 'Yes', 'bt-cost-calculator' ) => 'yes' ), 'heading' => esc_html__( 'Send Email to Client', 'bt-cost-calculator' ), 'group' => esc_html__( 'Email', 'bt-cost-calculator' ) ),
		array( 'param_name' => 'email_confirmation', 'type' => 'checkbox', 'value' => array( 'Show confirmation checkbox for sending email to client' => 'yes' ), 'heading' => esc_html__( 'Client Email Confirmation', 'bt-cost-calculator' ), 'group' => esc_html__( 'Email', 'bt-cost-calculator' ) ),
		array( 'param_name' => 'email_gdpr', 'type' => 'checkbox', 'value' => array( esc_html__( 'Yes', 'bt-cost-calculator' ) => 'yes' ), 'heading' => esc_html__( 'Add GDPR Checkbox', 'bt-cost-calculator' ), 'group' => esc_html__( 'Email', 'bt-cost-calculator' ) ),
		array( 'param_name' => 'email_gdpr_text', 'type' => 'textarea', 'heading' => esc_html__( 'GDPR Checkbox Description', 'bt-cost-calculator' ), 'description' => 'Enter GDPR checkbox description.', 'group' => esc_html__( 'Email', 'bt-cost-calculator' ) ),
		array( 'param_name' => 'email_gdpr_not_text', 'type' => 'textfield', 'heading' => esc_html__( 'GDPR Checkbox Warning', 'bt-cost-calculator' ), 'description' => 'Enter GDPR checkbox warning text.', 'group' => esc_html__( 'Email', 'bt-cost-calculator' ) ),
		array( 'param_name' => 'email_header', 'type' => 'textarea_object', 'heading' => esc_html__( 'Client Email Header', 'bt-cost-calculator' ), 'description' => 'Enter HTML for client email header.', 'group' => esc_html__( 'Email', 'bt-cost-calculator' ) ),
		array( 'param_name' => 'email_footer', 'type' => 'textarea_object', 'heading' => esc_html__( 'Client Email Footer', 'bt-cost-calculator' ), 'description' => 'Enter HTML for client email footer.', 'group' => esc_html__( 'Email', 'bt-cost-calculator' ) ),
	
		array( 'param_name' => 'rec_site_key', 'type' => 'textfield', 'heading' => esc_html__( 'reCAPTCHA Site Key', 'bt-cost-calculator' ), 'group' => esc_html__( 'reCAPTCHA', 'bt-cost-calculator' ) ),
		array( 'param_name' => 'rec_secret_key', 'type' => 'textfield', 'heading' => esc_html__( 'reCAPTCHA Secret Key', 'bt-cost-calculator' ), 'group' => esc_html__( 'reCAPTCHA', 'bt-cost-calculator' ) ),
		
		array( 'param_name' => 'paypal_email', 'type' => 'textfield', 'heading' => esc_html__( 'Your PayPal Account Email Address', 'bt-cost-calculator' ), 'group' => esc_html__( 'PayPal', 'bt-cost-calculator' ) ),
		array( 'param_name' => 'paypal_cart_name', 'type' => 'textfield', 'heading' => esc_html__( 'Shopping Cart Name', 'bt-cost-calculator' ), 'group' => esc_html__( 'PayPal', 'bt-cost-calculator' ) ),
		array( 'param_name' => 'paypal_currency', 'type' => 'textfield', 'heading' => esc_html__( 'Currency Code (USD, EUR, GBP, CAD, JPY)', 'bt-cost-calculator' ), 'group' => esc_html__( 'PayPal', 'bt-cost-calculator' ) ),
		
		array( 'param_name' => 'el_class', 'type' => 'textfield', 'heading' => esc_html__( 'Extra Class Name(s)', 'bt-cost-calculator' ), 'group' => esc_html__( 'Design', 'bt-cost-calculator' ) ),
		array( 'param_name' => 'el_style', 'type' => 'textfield', 'heading' => esc_html__( 'Inline Style', 'bt-cost-calculator' ), 'group' => esc_html__( 'Design', 'bt-cost-calculator' ) )
	);
	
	$bt_cc_item_params = array(	
		array( 'param_name' => 'name', 'type' => 'textfield', 'heading' => esc_html__( 'Name', 'bt-cost-calculator' ), 'holder' => 'div' ),	
		array( 'param_name' => 'description', 'type' => 'textfield', 'heading' => esc_html__( 'Description', 'bt-cost-calculator' ), 'holder' => 'div' ),
		array( 'param_name' => 'type', 'type' => 'dropdown', 'heading' => esc_html__( 'Input Type', 'bt-cost-calculator' ), 'holder' => 'div',
			'value' => array(
				esc_html__( 'Text', 'bt-cost-calculator' ) => 'text',
				esc_html__( 'Select', 'bt-cost-calculator' ) => 'select',
				esc_html__( 'Slider', 'bt-cost-calculator' ) => 'slider',
				esc_html__( 'Switch', 'bt-cost-calculator' ) => 'switch'
		) ),
		array( 'param_name' => 'value', 'type' => 'textarea', 'heading' => esc_html__( 'Value', 'bt-cost-calculator' ), 'description' => esc_html__( 'Unit_value for Text / name;value;description separated by new line for Select / min;max;step;unit_value;offset_value for Slider / value_off;value_on for Switch', 'bt-cost-calculator' ) ),
		array( 'param_name' => 'initial_value', 'type' => 'textfield', 'heading' => esc_html__( 'Initial value or select list index', 'bt-cost-calculator' ), 'description' => esc_html__( 'Value for Text / index for Select ( index 0 for Select... item in list ) / value between min and max values for Slider / off or on value for Switch', 'bt-cost-calculator' ) , 'preview' => true),
		array( 'param_name' => 'images', 'type' => 'attach_images', 'heading' => esc_html__( 'Images for Select input type', 'bt-cost-calculator' ) ),
		array( 'param_name' => 'img_height', 'type' => 'textfield', 'heading' => esc_html__( 'Images Height in px', 'bt-cost-calculator' ) ),
		array( 'param_name' => 'condition', 'type' => 'textarea', 'heading' => esc_html__( 'Change Event Condition', 'bt-cost-calculator' ), 'description' => esc_html__( 'Clause operator (e.g. ==0 or >0);target element id;action (e.g. fadeTo(\'slow\',0.2));lock target (lock/unlock) separated by new line', 'bt-cost-calculator' ) ),
		array( 'param_name' => 'item_el_id', 'type' => 'textfield', 'heading' => esc_html__( 'Custom ID Attribute', 'bt-cost-calculator' ), 'group' => esc_html__( 'Design', 'bt-cost-calculator' ), 'preview' => true ),
		array( 'param_name' => 'item_el_class', 'type' => 'textfield', 'heading' => esc_html__( 'Extra Class Name(s)', 'bt-cost-calculator' ), 'group' => esc_html__( 'Design', 'bt-cost-calculator' ), 'preview' => true ),
		array( 'param_name' => 'item_el_style', 'type' => 'textfield', 'heading' => esc_html__( 'Inline Style', 'bt-cost-calculator' ), 'group' => esc_html__( 'Design', 'bt-cost-calculator' ), 'preview' => true )
	);	
	
	$bt_cc_multiply_params = array();

	$bt_cc_group_params = array(
		array( 'param_name' => 'separator', 'type' => 'bt_cc_custom_label_text', 'value' => array( ), 'heading' => __( 'For detailed explaination on how to use Cost Calculator Group go to <a target="_blank" href="http://documentation.bold-themes.com/cost-calculator/cost-calculator-group/">plugin documentation</a>.', 'bt-cost-calculator' ) ),

		array( 'param_name' => 'eval', 'type' => 'textarea', 'heading' => esc_html__( 'Pseudo-JS Code', 'bt-cost-calculator' ), 'description' => __( 'For detailed explaination on how to use it go to <a target="_blank" href="http://documentation.bold-themes.com/cost-calculator/cost-calculator-group/">documentation</a>.', 'bt-cost-calculator' ) ),
		array( 'param_name' => 'paypal_label', 'type' => 'textfield', 'heading' => esc_html__( 'PayPal Label', 'bt-cost-calculator' ), 'description' => esc_html__( 'If label is not entered, this group will not be included in PayPal payment.', 'bt-cost-calculator' ) ),
		array( 'param_name' => 'item_el_id', 'type' => 'textfield', 'heading' => esc_html__( 'Custom ID Attribute', 'bt-cost-calculator' ), 'group' => esc_html__( 'Design', 'bt-cost-calculator' ), 'preview' => true ),
		array( 'param_name' => 'item_el_class', 'type' => 'textfield', 'heading' => esc_html__( 'Extra Class Name(s)', 'bt-cost-calculator' ), 'group' => esc_html__( 'Design', 'bt-cost-calculator' ), 'preview' => true ),
		array( 'param_name' => 'item_el_style', 'type' => 'textfield', 'heading' => esc_html__( 'Inline Style', 'bt-cost-calculator' ), 'group' => esc_html__( 'Design', 'bt-cost-calculator' ), 'preview' => true )
	);
        
    $bt_cc_text_params = array(
		array( 'param_name' => 'separator', 'type' => 'bt_cc_custom_label_text', 'value' => array( '' ), 'heading' => __( 'For detailed explaination on how to use Cost Calculator WordPress Plugin Items go to <a target="_blank" href="http://documentation.bold-themes.com/cost-calculator/cost-calculator-items/">plugin items documentation</a>', 'bt-cost-calculator' ) ),
		
		array( 'param_name' => 'name', 'type' => 'textfield', 'heading' => esc_html__( 'Label', 'bt-cost-calculator' ), 'holder' => 'div', 'description' => esc_html__( 'Label for the Input field - visible to users - displayed on the left side of the element.', 'bt-cost-calculator' ) ),	
		array( 'param_name' => 'description', 'type' => 'textfield', 'heading' => esc_html__( 'Description', 'bt-cost-calculator' ), 'holder' => 'div', 'description' => esc_html__( 'Description - visible to users - displayed bottom right of the element.', 'bt-cost-calculator' ) ),
        array( 'param_name' => 'value', 'type' => 'textfield', 'heading' => esc_html__( 'Unit Value *required', 'bt-cost-calculator' ), 'description' => esc_html__( 'The number from Input Field will by multiplied by this value. Unit value is not visible to users.', 'bt-cost-calculator' ) ),
		array( 'param_name' => 'initial_value', 'type' => 'textfield', 'heading' => esc_html__( 'Example Value', 'bt-cost-calculator' ), 'description' => esc_html__( 'It is an option visible to users initially and can be changed. Not a fixed value.', 'bt-cost-calculator' ) , 'preview' => true),
		array( 'param_name' => 'condition', 'type' => 'textarea', 'heading' =>__( 'Conditional Settings', 'bt-cost-calculator' ), 'description' => __( 'For detailed explaination on how to use it go to <a target="_blank" href="http://documentation.bold-themes.com/cost-calculator/cost-calculator-conditions/">documentation</a>.', 'bt-cost-calculator' ) ),
		array( 'param_name' => 'item_el_id', 'type' => 'textfield', 'heading' => esc_html__( 'Custom ID Attribute', 'bt-cost-calculator' ), 'group' => esc_html__( 'Design', 'bt-cost-calculator' ), 'preview' => true ),
		array( 'param_name' => 'item_el_class', 'type' => 'textfield', 'heading' => esc_html__( 'Extra Class Name(s)', 'bt-cost-calculator' ), 'group' => esc_html__( 'Design', 'bt-cost-calculator' ), 'preview' => true ),
		array( 'param_name' => 'item_el_style', 'type' => 'textfield', 'heading' => esc_html__( 'Inline Style', 'bt-cost-calculator' ), 'group' => esc_html__( 'Design', 'bt-cost-calculator' ), 'preview' => true )
	);
        
    $bt_cc_select_params = array(	
		array( 'param_name' => 'separator', 'type' => 'bt_cc_custom_label_text', 'value' => array( ), 'heading' => __( 'For detailed explaination on how to use Cost Calculator Select List go to <a target="_blank" href="http://documentation.bold-themes.com/cost-calculator/cost-calculator-items/#select">plugin documentation</a>.', 'bt-cost-calculator' ) ),

		array( 'param_name' => 'name', 'type' => 'textfield', 'heading' => esc_html__( 'Label', 'bt-cost-calculator' ), 'holder' => 'div', 'description' => esc_html__( 'Label for select list - visible to users - displayed on the left side of the element.', 'bt-cost-calculator' ) ),	
		array( 'param_name' => 'description', 'type' => 'textfield', 'heading' => esc_html__( 'Description', 'bt-cost-calculator' ), 'holder' => 'div', 'description' => esc_html__( 'Description - visible to users - displayed bottom right of the element.', 'bt-cost-calculator' ) ),
		array( 'param_name' => 'value', 'type' => 'textarea', 'heading' => esc_html__( 'List Of Dropdown Options *required', 'bt-cost-calculator' ), 'description' => __( 'List of options visible to users as dropdown list. For detailed explaination go to <a target="_blank" href="http://documentation.bold-themes.com/cost-calculator/cost-calculator-items/#select">List Of Dropdown Options documentaion</a>.', 'bt-cost-calculator' ) ),
		array( 'param_name' => 'initial_value', 'type' => 'textfield', 'heading' => esc_html__( 'Example Value', 'bt-cost-calculator' ), 'description' => esc_html__( 'To show one of the select list options as initial write the ordinal number of the item (eg. 1 for the first item, 2 for the second item...).', 'bt-cost-calculator' ) , 'preview' => true),
		array( 'param_name' => 'images', 'type' => 'attach_images', 'heading' => esc_html__( 'Images for Dropdown Options', 'bt-cost-calculator' ), 'description' => esc_html__( 'Dropdown options can have an image. Images are assigned to options in order by which they are selected from media library.', 'bt-cost-calculator' ) ),
		array( 'param_name' => 'img_height', 'type' => 'textfield', 'heading' => esc_html__( 'Images Height in px', 'bt-cost-calculator' ) ),
		array( 'param_name' => 'condition', 'type' => 'textarea', 'heading' => esc_html__( 'Conditional Settings', 'bt-cost-calculator' ), 'description' => __( 'For detailed explaination on how to use it go to <a target="_blank" href="http://documentation.bold-themes.com/cost-calculator/cost-calculator-conditions/">documentation</a>.', 'bt-cost-calculator' ) ),
		array( 'param_name' => 'item_el_id', 'type' => 'textfield', 'heading' => esc_html__( 'Custom ID Attribute', 'bt-cost-calculator' ), 'group' => esc_html__( 'Design', 'bt-cost-calculator' ), 'preview' => true ),
		array( 'param_name' => 'item_el_class', 'type' => 'textfield', 'heading' => esc_html__( 'Extra Class Name(s)', 'bt-cost-calculator' ), 'group' => esc_html__( 'Design', 'bt-cost-calculator' ), 'preview' => true ),
		array( 'param_name' => 'item_el_style', 'type' => 'textfield', 'heading' => esc_html__( 'Inline Style', 'bt-cost-calculator' ), 'group' => esc_html__( 'Design', 'bt-cost-calculator' ), 'preview' => true )
	);	
        
    $bt_cc_slider_params = array(	
		array( 'param_name' => 'separator', 'type' => 'bt_cc_custom_label_text', 'value' => array( ), 'heading' => __( 'For detailed explaination on how to use Cost Calculator Slider Bar go to <a target="_blank" href="http://documentation.bold-themes.com/cost-calculator/cost-calculator-items/#slider">plugin documentation</a>.', 'bt-cost-calculator' ) ),

		array( 'param_name' => 'name', 'type' => 'textfield', 'heading' => esc_html__( 'Label', 'bt-cost-calculator' ), 'holder' => 'div', 'description' => esc_html__( 'Label for slider bar - visible to users - displayed on the left side of the element.', 'bt-cost-calculator' ) ),	
		array( 'param_name' => 'description', 'type' => 'textfield', 'heading' => esc_html__( 'Description', 'bt-cost-calculator' ), 'holder' => 'div', 'description' => esc_html__( 'Description - visible to users - displayed bottom right of the element.', 'bt-cost-calculator' ) ),
		array( 'param_name' => 'value_min', 'type' => 'textfield', 'heading' => esc_html__( 'Min Value *required', 'bt-cost-calculator' ), 'description' => esc_html__( 'The lower or minimum limit for slider bar.', 'bt-cost-calculator' ) ),
		array( 'param_name' => 'value_max', 'type' => 'textfield', 'heading' => esc_html__( 'Max Value *required', 'bt-cost-calculator' ), 'description' => esc_html__( 'The upper or maximum limit for slider bar.', 'bt-cost-calculator' ) ),
		array( 'param_name' => 'value_step', 'type' => 'textfield', 'heading' => esc_html__( 'Slider Handle Moves By *required', 'bt-cost-calculator' ), 'description' => esc_html__( 'Defines how much the quantity will increase each time handle is moved.', 'bt-cost-calculator' ) ),
		array( 'param_name' => 'value_unit', 'type' => 'textfield', 'heading' => esc_html__( 'Unit Value *required', 'bt-cost-calculator' ), 'description' => esc_html__( 'The number selected with slider handle will by multiplied by this value. Unit value is not visible to users.', 'bt-cost-calculator' ) ),
		array( 'param_name' => 'value_offset', 'type' => 'textfield', 'heading' => esc_html__( 'Offset', 'bt-cost-calculator' ), 'description' => esc_html__( 'Slider has price offset property which allows you to introduce fixed cost regardless of the volume. This is not visible to users.', 'bt-cost-calculator' ) ),
		array( 'param_name' => 'initial_value', 'type' => 'textfield', 'heading' => esc_html__( 'Example Value', 'bt-cost-calculator' ), 'description' => esc_html__( 'It is an option visible to users initially and can be changed. Not a fixed value.', 'bt-cost-calculator' ) , 'preview' => true),
		array( 'param_name' => 'condition', 'type' => 'textarea', 'heading' => esc_html__( 'Conditional Settings', 'bt-cost-calculator' ), 'description' => __( 'For detailed explaination on how to use it go to <a target="_blank" href="http://documentation.bold-themes.com/cost-calculator/cost-calculator-conditions/">documentation</a>.', 'bt-cost-calculator' ) ),
		array( 'param_name' => 'item_el_id', 'type' => 'textfield', 'heading' => esc_html__( 'Custom ID Attribute', 'bt-cost-calculator' ), 'group' => esc_html__( 'Design', 'bt-cost-calculator' ), 'preview' => true ),
		array( 'param_name' => 'item_el_class', 'type' => 'textfield', 'heading' => esc_html__( 'Extra Class Name(s)', 'bt-cost-calculator' ), 'group' => esc_html__( 'Design', 'bt-cost-calculator' ), 'preview' => true ),
		array( 'param_name' => 'item_el_style', 'type' => 'textfield', 'heading' => esc_html__( 'Inline Style', 'bt-cost-calculator' ), 'group' => esc_html__( 'Design', 'bt-cost-calculator' ), 'preview' => true )
	);
        
    $bt_cc_switch_params = array(	
		array( 'param_name' => 'separator', 'type' => 'bt_cc_custom_label_text', 'value' => array( ), 'heading' => __( 'For detailed explaination on how to use Cost Calculator Switch Toggle go to <a target="_blank" href="http://documentation.bold-themes.com/cost-calculator/cost-calculator-items/#switch">plugin documentation</a>.', 'bt-cost-calculator' ) ),

		array( 'param_name' => 'name', 'type' => 'textfield', 'heading' => esc_html__( 'Label', 'bt-cost-calculator' ), 'holder' => 'div', 'description' => esc_html__( 'Label for switch toggle - visible to users - displayed on the left side of the element', 'bt-cost-calculator' ) ),	
		array( 'param_name' => 'description', 'type' => 'textfield', 'heading' => esc_html__( 'Description', 'bt-cost-calculator' ), 'holder' => 'div', 'description' => esc_html__( 'Description - visible to users - displayed bottom right of the element', 'bt-cost-calculator' ) ),
		array( 'param_name' => 'value_off', 'type' => 'textfield', 'heading' => esc_html__( 'Value Off *required', 'bt-cost-calculator' ), 'description' => esc_html__( 'Value to be calculated if switch toggle is OFF (value can be 0 or above)', 'bt-cost-calculator' ) ),
		array( 'param_name' => 'value_on', 'type' => 'textfield', 'heading' => esc_html__( 'Value On *required', 'bt-cost-calculator' ), 'description' => esc_html__( 'Value to be calculated if switch toggle is ON', 'bt-cost-calculator' ) ),
		array( 'param_name' => 'initial_value', 'type' => 'textfield', 'heading' => esc_html__( 'Suggested Option', 'bt-cost-calculator' ), 'description' => esc_html__( 'Enter ON or Off value in this field, depending on which option you want to be initial to users.', 'bt-cost-calculator' ) , 'preview' => true),
		array( 'param_name' => 'condition', 'type' => 'textarea', 'heading' => esc_html__( 'Conditional Settings', 'bt-cost-calculator' ), 'description' => __( 'For detailed explaination on how to use it go to <a target="_blank" href="http://documentation.bold-themes.com/cost-calculator/cost-calculator-conditions/">documentation</a>.', 'bt-cost-calculator' ) ),
		array( 'param_name' => 'item_el_id', 'type' => 'textfield', 'heading' => esc_html__( 'Custom ID Attribute', 'bt-cost-calculator' ), 'group' => esc_html__( 'Design', 'bt-cost-calculator' ), 'preview' => true ),
		array( 'param_name' => 'item_el_class', 'type' => 'textfield', 'heading' => esc_html__( 'Extra Class Name(s)', 'bt-cost-calculator' ), 'group' => esc_html__( 'Design', 'bt-cost-calculator' ), 'preview' => true ),
		array( 'param_name' => 'item_el_style', 'type' => 'textfield', 'heading' => esc_html__( 'Inline Style', 'bt-cost-calculator' ), 'group' => esc_html__( 'Design', 'bt-cost-calculator' ), 'preview' => true )
	);

	if ( function_exists( 'bt_rc_map' ) ) {

		bt_rc_map( 'bt_cost_calculator', array( 'name' => esc_html__( 'Cost Calculator', 'bt-cost-calculator' ), 'description' => esc_html__( 'Cost calculator container', 'bt-cost-calculator' ), 'container' => 'vertical', 'icon' => 'bt_bb_icon_bt_bb_cost_calculator', 'accept' => array( 'bt_cc_item' => true, 'bt_cc_multiply' => true, 'bt_cc_group' => true, 'bt_hr' => true, 'bt_header' => true, 'bt_text' => true, 'bt_bb_separator' => true, 'bt_bb_headline' => true, 'bt_bb_text' => true, 'bt_bb_raw_content' => true, 'bt_cc_text' => true, 'bt_cc_select' => true, 'bt_cc_slider' => true, 'bt_cc_switch' => true), 'toggle' => true,
			'params' => $bt_quote_params
		));
		
		bt_rc_map( 'bt_cc_item', array( 'name' => esc_html__( 'Cost Calculator Item (Deprecated)', 'bt-cost-calculator' ), 'description' => esc_html__( 'Single cost calculator element (all in one)', 'bt-cost-calculator' ), 'icon' => 'bt_bb_icon_bt_bb_cost_calculator_item', 'as_child' => array( 'only' => 'bt_cost_calculator,bt_cc_multiply,bt_cc_group' ),
			'params' => $bt_cc_item_params
		));
		
		bt_rc_map( 'bt_cc_multiply', array( 'name' => esc_html__( 'Cost Calculator Multiply', 'bt-cost-calculator' ), 'description' => esc_html__( 'Container for elements that need to be multiplied', 'bt-cost-calculator' ), 'icon' => 'bt_bb_icon_bt_bb_cost_calculator_multiply', 'container' => 'vertical', 'accept' => array( 'bt_cc_item' => true, 'bt_cc_text' => true, 'bt_cc_select' => true, 'bt_cc_slider' => true, 'bt_cc_switch' => true ), 'show_settings_on_create' => false, 'as_child' => array( 'only' => 'bt_cost_calculator' ),
			'params' => $bt_cc_multiply_params
		));
		
		bt_rc_map( 'bt_cc_group', array( 'name' => esc_html__( 'Cost Calculator Group', 'bt-cost-calculator' ), 'description' => esc_html__( 'Container for defining calculation logic between elements', 'bt-cost-calculator' ), 'container' => 'vertical', 'icon' => 'bt_bb_icon_bt_bb_cost_calculator_group', 'accept' => array( 'bt_cc_item' => true, 'bt_hr' => true, 'bt_header' => true, 'bt_text' => true, 'bt_bb_separator' => true, 'bt_bb_headline' => true, 'bt_bb_text' => true , 'bt_cc_text' => true, 'bt_cc_select' => true, 'bt_cc_slider' => true, 'bt_cc_switch' => true, 'bt_bb_raw_content' => true ), 'show_settings_on_create' => true, 'as_child' => array( 'only' => 'bt_cost_calculator' ),
			'params' => $bt_cc_group_params
		));
                
		bt_rc_map( 'bt_cc_text', array( 'name' => esc_html__( 'Cost Calculator Number Input Field', 'bt-cost-calculator' ), 'description' => esc_html__( 'Numerical Input field for users', 'bt-cost-calculator' ), 'icon' => 'bt_bb_icon_bt_bb_cost_calculator_text', 'show_settings_on_create' => true, 'as_child' => array( 'only' => 'bt_cost_calculator,bt_cc_multiply,bt_cc_group' ),
			'params' => $bt_cc_text_params
		));

		bt_rc_map( 'bt_cc_select', array( 'name' => esc_html__( 'Cost Calculator Select List', 'bt-cost-calculator' ), 'description' => esc_html__( 'Dropdown list of options to select from', 'bt-cost-calculator' ), 'icon' => 'bt_bb_icon_bt_bb_cost_calculator_select', 'show_settings_on_create' => true, 'as_child' => array( 'only' => 'bt_cost_calculator,bt_cc_multiply,bt_cc_group' ),
			'params' => $bt_cc_select_params
		));

		bt_rc_map( 'bt_cc_slider', array( 'name' => esc_html__( 'Cost Calculator Slider Bar', 'bt-cost-calculator' ), 'description' => esc_html__( 'Cost calculator slider', 'bt-cost-calculator' ), 'icon' => 'bt_bb_icon_bt_bb_cost_calculator_slider', 'show_settings_on_create' => true, 'as_child' => array( 'only' => 'bt_cost_calculator,bt_cc_multiply,bt_cc_group' ),
			'params' => $bt_cc_slider_params
		));

		bt_rc_map( 'bt_cc_switch', array( 'name' => esc_html__( 'Cost Calculator Switch Toggle', 'bt-cost-calculator' ), 'description' => esc_html__( 'Cost calculator switch checkbox', 'bt-cost-calculator' ), 'icon' => 'bt_bb_icon_bt_bb_cost_calculator_switch', 'show_settings_on_create' => true, 'as_child' => array( 'only' => 'bt_cost_calculator,bt_cc_multiply,bt_cc_group' ),
			'params' => $bt_cc_switch_params
		));

	}
	
	if ( function_exists( 'vc_map' ) ) {
		
		if ( class_exists( 'WPBakeryShortCodesContainer' ) ) {
			class WPBakeryShortCode_bt_cost_calculator extends WPBakeryShortCodesContainer {
			}
		}
		
		if ( class_exists( 'WPBakeryShortCodesContainer' ) ) {
			class WPBakeryShortCode_bt_cc_multiply extends WPBakeryShortCodesContainer {
			}
		}
		
		if ( class_exists( 'WPBakeryShortCodesContainer' ) ) {
			class WPBakeryShortCode_bt_cc_group extends WPBakeryShortCodesContainer {
			}
		}
	
		$data = array();
		$data['name']              = esc_html__( 'Cost Calculator', 'bt-cost-calculator' );
		$data['base']              = 'bt_cost_calculator';
		$data['as_parent']         = array( 'except' => 'vc_row,vc_column,vc_row_inner,vc_column_inner,bt_cost_calculator' );
		$data['content_element']   = true;
		$data['js_view']           = 'VcColumnView';
		$data['category']          = 'Content';
		$data['icon']              = 'bt_quote_icon';
		$data['admin_enqueue_css'] = array( plugins_url( 'vc_style.css', __FILE__ ) );
		$data['admin_enqueue_js']  = array( plugins_url( 'vc_js.js', __FILE__ ) );
		$data['description']       = esc_html__( 'Cost calculator container', 'bt-cost-calculator' );

		$data['params'] = $bt_quote_params;

		vc_map( $data );
		
		$data = array();
		$data['name']              = esc_html__( 'Cost Calculator Multiply', 'bt-cost-calculator' );
		$data['base']              = 'bt_cc_multiply';
		$data['as_parent']         = array( 'except' => 'vc_row,vc_column' );
		$data['as_child']          = array( 'only' => 'bt_cost_calculator' );
		$data['content_element']   = true;
		$data['js_view']           = 'VcColumnView';
		$data['category']          = 'Content';
		$data['icon']              = 'bt_quote_icon_multiply';
		$data['admin_enqueue_css'] = array( plugins_url( 'vc_style.css', __FILE__ ) );
		$data['description']       = esc_html__( 'Container for elements that need to be multiplied', 'bt-cost-calculator' );

		$data['params'] = $bt_cc_multiply_params;
		
		vc_map( $data );		
		
		$data = array();
		$data['name']              = esc_html__( 'Cost Calculator Group', 'bt-cost-calculator' );
		$data['base']              = 'bt_cc_group';
		$data['as_parent']         = array( 'except' => 'vc_row,vc_column' );
		$data['as_child']          = array( 'only' => 'bt_cost_calculator' );
		$data['content_element']   = true;
		$data['js_view']           = 'VcColumnView';
		$data['category']          = 'Content';
		$data['icon']              = 'bt_quote_icon_group';
		$data['admin_enqueue_css'] = array( plugins_url( 'vc_style.css', __FILE__ ) );
		$data['description']       = esc_html__( 'Container for defining calculation logic between elements', 'bt-cost-calculator' );

		$data['params'] = $bt_cc_group_params;
		
		vc_map( $data );
				
		$data = array();
		$data['name']              = esc_html__( 'Cost Calculator Item (Deprecated)', 'bt-cost-calculator' );
		$data['base']              = 'bt_cc_item';
		$data['content_element']   = true;
		$data['js_view']           = 'BTCCItem';
		$data['category']          = 'Content';
		$data['as_child']          = array( 'only' => 'bt_cost_calculator,bt_cc_multiply,bt_cc_group' );
		$data['icon']              = 'bt_quote_icon_item';
		$data['admin_enqueue_css'] = array( plugins_url( 'vc_style.css', __FILE__ ) );
		$data['description']       = esc_html__( 'Cost calculator item', 'bt-cost-calculator' );

		$data['params'] = $bt_cc_item_params;
		
		vc_map( $data );

		$data = array();
		$data['name']              = esc_html__( 'Cost Calculator Number Input Field', 'bt-cost-calculator' );
		$data['base']              = 'bt_cc_text';
		$data['content_element']   = true;
		$data['js_view']           = 'BTCCItem';
		$data['category']          = 'Content';
		$data['as_child']          = array( 'only' => 'bt_cost_calculator,bt_cc_multiply,bt_cc_group' );
		$data['icon']              = 'bt_quote_icon_item';
		$data['admin_enqueue_css'] = array( plugins_url( 'vc_style.css', __FILE__ ) );
		$data['description']       = esc_html__( 'Numerical Input field for users', 'bt-cost-calculator' );

		$data['params'] = $bt_cc_text_params;
		
		vc_map( $data );

		$data = array();
		$data['name']              = esc_html__( 'Cost Calculator Select List', 'bt-cost-calculator' );
		$data['base']              = 'bt_cc_select';
		$data['content_element']   = true;
		$data['js_view']           = 'BTCCItem';
		$data['category']          = 'Content';
		$data['as_child']          = array( 'only' => 'bt_cost_calculator,bt_cc_multiply,bt_cc_group' );
		$data['icon']              = 'bt_quote_icon_item';
		$data['admin_enqueue_css'] = array( plugins_url( 'vc_style.css', __FILE__ ) );
		$data['description']       = esc_html__( 'Dropdown list of options to select from', 'bt-cost-calculator' );

		$data['params'] = $bt_cc_select_params;
		
		vc_map( $data );

		$data = array();
		$data['name']              = esc_html__( 'Cost Calculator Slider Bar', 'bt-cost-calculator' );
		$data['base']              = 'bt_cc_slider';
		$data['content_element']   = true;
		$data['js_view']           = 'BTCCItem';
		$data['category']          = 'Content';
		$data['as_child']          = array( 'only' => 'bt_cost_calculator,bt_cc_multiply,bt_cc_group' );
		$data['icon']              = 'bt_quote_icon_item';
		$data['admin_enqueue_css'] = array( plugins_url( 'vc_style.css', __FILE__ ) );
		$data['description']       = esc_html__( 'Cost calculator slider control', 'bt-cost-calculator' );

		$data['params'] = $bt_cc_slider_params;
		
		vc_map( $data );

		$data = array();
		$data['name']              = esc_html__( 'Cost Calculator Switch Toggle', 'bt-cost-calculator' );
		$data['base']              = 'bt_cc_switch';
		$data['content_element']   = true;
		$data['js_view']           = 'BTCCItem';
		$data['category']          = 'Content';
		$data['as_child']          = array( 'only' => 'bt_cost_calculator,bt_cc_multiply,bt_cc_group' );
		$data['icon']              = 'bt_quote_icon_item';
		$data['admin_enqueue_css'] = array( plugins_url( 'vc_style.css', __FILE__ ) );
		$data['description']       = esc_html__( 'Cost calculator switch control', 'bt-cost-calculator' );

		$data['params'] = $bt_cc_switch_params;
		
		vc_map( $data );
		
	}

	/*$micro_builder = new BT_Micro_Builder( array( 'post_type' => 'cost-calculator', 'root_id' => 'bt_cost_calculator_builder' ) );*/

	BT_CC_Root::$builder->map( 'bt_cost_calculator', array( 'name' => esc_html__( 'Cost Calculator', 'bt-cost-calculator' ), 'description' => esc_html__( 'Cost calculator container', 'bt-cost-calculator' ), 'container' => 'vertical', 'accept' => array( 'bt_cc_item' => true, 'bt_cc_multiply' => true, 'bt_cc_group' => true, 'bt_hr' => true, 'bt_header' => true, 'bt_text' => true, 'bt_bb_separator' => true, 'bt_bb_headline' => true, 'bt_bb_text' => true , 'bt_cc_text' => true, 'bt_cc_select' => true, 'bt_cc_slider' => true, 'bt_cc_switch' => true, 'bt_cc_raw_html' => true, 'bt_cc_separator' => true), 'toggle' => true, 'root' => true,
		'params' => $bt_quote_params
	));
		
	BT_CC_Root::$builder->map( 'bt_cc_multiply', array( 'name' => esc_html__( 'Cost Calculator Multiply', 'bt-cost-calculator' ), 'description' => esc_html__( 'Container for elements that need to be multiplied', 'bt-cost-calculator' ), 'container' => 'vertical', 'icon' => 'bt_bb_icon_bt_cc_multiply', 'accept' => array( 'bt_cc_item' => true, 'bt_cc_text' => true, 'bt_cc_select' => true, 'bt_cc_slider' => true, 'bt_cc_switch' => true, 'bt_cc_raw_html' => true, 'bt_cc_separator' => true ), 'show_settings_on_create' => false,
		'params' => $bt_cc_multiply_params
	));
	
	$bt_cc_group_params = array(
		array( 'param_name' => 'separator', 'type' => 'bt_cc_custom_label_text', 'value' => array( ), 'heading' => __( 'For detailed explaination on how to use Cost Calculator Group go to <a target="_blank" href="http://documentation.bold-themes.com/cost-calculator/cost-calculator-group/">plugin documentation</a>.', 'bt-cost-calculator' ) ),

		array( 'param_name' => 'eval', 'type' => 'textarea_object', 'heading' => esc_html__( 'Pseudo-JS Code', 'bt-cost-calculator' ), 'description' => __( 'For detailed explaination on how to use it go to <a target="_blank" href="http://documentation.bold-themes.com/cost-calculator/cost-calculator-group/">documentation</a>.', 'bt-cost-calculator' ) ),
		array( 'param_name' => 'paypal_label', 'type' => 'textfield', 'heading' => esc_html__( 'PayPal Label', 'bt-cost-calculator' ), 'description' => esc_html__( 'If label is not entered, this group will not be included in PayPal payment.', 'bt-cost-calculator' ), 'preview' => true ),
		array( 'param_name' => 'item_el_id', 'type' => 'textfield', 'heading' => esc_html__( 'Custom ID Attribute', 'bt-cost-calculator' ), 'group' => esc_html__( 'Design', 'bt-cost-calculator' ), 'preview' => true ),
		array( 'param_name' => 'item_el_class', 'type' => 'textfield', 'heading' => esc_html__( 'Extra Class Name(s)', 'bt-cost-calculator' ), 'group' => esc_html__( 'Design', 'bt-cost-calculator' ), 'preview' => true ),
		array( 'param_name' => 'item_el_style', 'type' => 'textfield', 'heading' => esc_html__( 'Inline Style', 'bt-cost-calculator' ), 'group' => esc_html__( 'Design', 'bt-cost-calculator' ), 'preview' => true )
	);
	BT_CC_Root::$builder->map( 'bt_cc_group', array( 'name' => esc_html__( 'Cost Calculator Group', 'bt-cost-calculator' ), 'description' => esc_html__( 'Container for defining calculation logic between elements', 'bt-cost-calculator' ), 'container' => 'vertical', 'icon' => 'bt_bb_icon_bt_cc_group', 'accept' => array( 'bt_cost_calculator' => false, 'bt_cc_multiply' => false, 'bt_cc_group' => false, 'bt_row' => false, 'bt_row_inner' => false, 'bt_column' => false, 'bt_column_inner' => false ), 'accept_all' => true, 'show_settings_on_create' => true,
		'params' => $bt_cc_group_params
	));

    $bt_cc_text_params = array(
		array( 'param_name' => 'separator', 'type' => 'bt_cc_custom_label_text', 'value' => array( ), 'heading' => __( 'For detailed explaination on how to use Cost Calculator Number Input Field go to <a target="_blank" href="http://documentation.bold-themes.com/cost-calculator/cost-calculator-items/#text">plugin documentation</a>.', 'bt-cost-calculator' ) ),

		array( 
			'param_name' => 'name', 
			'type' => 'textfield', 
			'heading' => esc_html__( 'Label', 'bt-cost-calculator' ), 
			'holder' => 'div', 
			'description' => esc_html__( 'Label for the Input field - visible to users - displayed on the left side of the element.', 'bt-cost-calculator' )
		),
		array( 'param_name' => 'description', 'type' => 'textfield', 'heading' => esc_html__( 'Description', 'bt-cost-calculator' ), 'holder' => 'div', 'description' => esc_html__( 'Description - visible to users - displayed bottom right of the element.', 'bt-cost-calculator' ) ),
        array( 'param_name' => 'value', 'type' => 'textfield', 'heading' => esc_html__( 'Unit Value *required', 'bt-cost-calculator' ), 'description' => esc_html__( 'The number from Input Field will by multiplied by this value. Unit value is not visible to users.', 'bt-cost-calculator' ) ),
		array( 'param_name' => 'initial_value', 'type' => 'textfield', 'heading' => esc_html__( 'Example Value', 'bt-cost-calculator' ), 'description' => esc_html__( 'It is an option visible to users initially and can be changed. Not a fixed value.', 'bt-cost-calculator' ) , 'preview' => true),
		array( 
		'param_name' => 'condition', 
		'type' => 'textarea_object', 
		'heading' => esc_html__( 'Conditional Settings', 'bt-cost-calculator' ), 
		'description' =>
			__( 'For detailed explaination on how to use it go to <a target="_blank" href="http://documentation.bold-themes.com/cost-calculator/cost-calculator-conditions/">documentation</a>.', 'bt-cost-calculator' )
		),
		array( 'param_name' => 'item_el_id', 'type' => 'textfield', 'heading' => esc_html__( 'Custom ID Attribute', 'bt-cost-calculator' ), 'group' => esc_html__( 'Design', 'bt-cost-calculator' ), 'preview' => true ),
		array( 'param_name' => 'item_el_class', 'type' => 'textfield', 'heading' => esc_html__( 'Extra Class Name(s)', 'bt-cost-calculator' ), 'group' => esc_html__( 'Design', 'bt-cost-calculator' ), 'preview' => true ),
		array( 'param_name' => 'item_el_style', 'type' => 'textfield', 'heading' => esc_html__( 'Inline Style', 'bt-cost-calculator' ), 'group' => esc_html__( 'Design', 'bt-cost-calculator' ), 'preview' => true )
	);
	BT_CC_Root::$builder->map( 'bt_cc_text', array( 'name' => esc_html__( 'Cost Calculator Number Input Field', 'bt-cost-calculator' ), 'description' => esc_html__( 'Numerical Input field for users', 'bt-cost-calculator' ), 'icon' => 'bt_bb_icon_bt_cc_text', 'show_settings_on_create' => true,
		'params' => $bt_cc_text_params
	));

    $bt_cc_select_params = array(	
		array( 'param_name' => 'separator', 'type' => 'bt_cc_custom_label_text', 'value' => array( ), 'heading' => __( 'For detailed explaination on how to use Cost Calculator Select List go to <a target="_blank" href="http://documentation.bold-themes.com/cost-calculator/cost-calculator-items/#select">plugin documentation</a>.', 'bt-cost-calculator' ) ),

		array( 'param_name' => 'name', 'type' => 'textfield', 'heading' => esc_html__( 'Label', 'bt-cost-calculator' ), 'holder' => 'div', 'description' => esc_html__( 'Label for select list - visible to users - displayed on the left side of the element.', 'bt-cost-calculator' ) ),
		array( 'param_name' => 'description', 'type' => 'textfield', 'heading' => esc_html__( 'Description', 'bt-cost-calculator' ), 'holder' => 'div', 'description' => esc_html__( 'Description - visible to users - displayed bottom right of the element.', 'bt-cost-calculator' ) ),
		array( 'param_name' => 'value', 'type' => 'textarea', 'heading' => esc_html__( 'List of Dropdown Options *required', 'bt-cost-calculator' ), 'description' => __( 'List of options visible to users as dropdown list. For detailed explaination go to <a target="_blank" href="http://documentation.bold-themes.com/cost-calculator/cost-calculator-items/#select">List Of Dropdown Options documentaion</a>.', 'bt-cost-calculator' ) ),
		array( 'param_name' => 'initial_value', 'type' => 'textfield', 'heading' => esc_html__( 'Example Value', 'bt-cost-calculator' ), 'description' => esc_html__( 'To show one of the select list options as initial write the ordinal number of the item (eg. 1 for the first item, 2 for the second item...).', 'bt-cost-calculator' ) , 'preview' => true),
		array( 'param_name' => 'images', 'type' => 'attach_images', 'heading' => esc_html__( 'Images for Dropdown Options', 'bt-cost-calculator' ), 'description' => esc_html__( 'Dropdown options can have an image. Images are assigned to options in order by which they are selected from media library.', 'bt-cost-calculator' ) ),
		array( 'param_name' => 'img_height', 'type' => 'textfield', 'heading' => esc_html__( 'Images Height in px', 'bt-cost-calculator' ) ),
		array( 'param_name' => 'condition', 'type' => 'textarea_object', 'heading' => esc_html__( 'Conditional Settings', 'bt-cost-calculator' ), 'description' => __( 'For detailed explaination on how to use it go to <a target="_blank" href="http://documentation.bold-themes.com/cost-calculator/cost-calculator-conditions/">documentation</a>.', 'bt-cost-calculator' ) ),
		array( 'param_name' => 'item_el_id', 'type' => 'textfield', 'heading' => esc_html__( 'Custom ID Attribute', 'bt-cost-calculator' ), 'group' => esc_html__( 'Design', 'bt-cost-calculator' ), 'preview' => true ),
		array( 'param_name' => 'item_el_class', 'type' => 'textfield', 'heading' => esc_html__( 'Extra Class Name(s)', 'bt-cost-calculator' ), 'group' => esc_html__( 'Design', 'bt-cost-calculator' ), 'preview' => true ),
		array( 'param_name' => 'item_el_style', 'type' => 'textfield', 'heading' => esc_html__( 'Inline Style', 'bt-cost-calculator' ), 'group' => esc_html__( 'Design', 'bt-cost-calculator' ), 'preview' => true )
	);
	BT_CC_Root::$builder->map( 'bt_cc_select', array( 'name' => esc_html__( 'Cost Calculator Select List', 'bt-cost-calculator' ), 'description' => esc_html__( 'Dropdown list of options to select from', 'bt-cost-calculator' ), 'icon' => 'bt_bb_icon_bt_cc_select', 'show_settings_on_create' => true,
		'params' => $bt_cc_select_params
	));

    $bt_cc_slider_params = array(
		array( 'param_name' => 'separator', 'type' => 'bt_cc_custom_label_text', 'value' => array( ), 'heading' => __( 'For detailed explaination on how to use Cost Calculator Slider Bar go to <a target="_blank" href="http://documentation.bold-themes.com/cost-calculator/cost-calculator-items/#slider">plugin documentation</a>.', 'bt-cost-calculator' ) ),

		array( 'param_name' => 'name', 'type' => 'textfield', 'heading' => esc_html__( 'Label', 'bt-cost-calculator' ), 'holder' => 'div', 'description' => esc_html__( 'Label for slider bar - visible to users - displayed on the left side of the element.', 'bt-cost-calculator' ) ),
		array( 'param_name' => 'description', 'type' => 'textfield', 'heading' => esc_html__( 'Description', 'bt-cost-calculator' ), 'holder' => 'div', 'description' => esc_html__( 'Description - visible to users - displayed bottom right of the element.', 'bt-cost-calculator' ) ),
		array( 'param_name' => 'value_min', 'type' => 'textfield', 'heading' => esc_html__( 'Min Value *required', 'bt-cost-calculator' ), 'description' => esc_html__( 'The lower or minimum limit for slider bar.', 'bt-cost-calculator' ), 'preview' => true ),
		array( 'param_name' => 'value_max', 'type' => 'textfield', 'heading' => esc_html__( 'Max Value *required', 'bt-cost-calculator' ), 'description' => esc_html__( 'The upper or maximum limit for slider bar.', 'bt-cost-calculator' ), 'preview' => true ),
		array( 'param_name' => 'value_step', 'type' => 'textfield', 'heading' => esc_html__( 'Slider Handle Moves By *required', 'bt-cost-calculator' ), 'description' => esc_html__( 'Defines how much the quantity will increase each time handle is moved.', 'bt-cost-calculator' ), 'preview' => true ),
		array( 'param_name' => 'value_unit', 'type' => 'textfield', 'heading' => esc_html__( 'Unit Value *required', 'bt-cost-calculator' ), 'description' => esc_html__( 'The number selected with slider handle will by multiplied by this value. Unit value is not visible to users.', 'bt-cost-calculator' ), 'preview' => true ),
		array( 'param_name' => 'value_offset', 'type' => 'textfield', 'heading' => esc_html__( 'Offset', 'bt-cost-calculator' ), 'description' => esc_html__( 'Slider has price offset property which allows you to introduce fixed cost regardless of the volume. This is not visible to users.', 'bt-cost-calculator' ), 'preview' => true ),
		array( 'param_name' => 'initial_value', 'type' => 'textfield', 'heading' => esc_html__( 'Example Value', 'bt-cost-calculator' ), 'description' => esc_html__( 'It is an option visible to users initially and can be changed. Not a fixed value.', 'bt-cost-calculator' ) , 'preview' => true),
		array( 'param_name' => 'condition', 'type' => 'textarea_object', 'heading' => esc_html__( 'Conditional Settings', 'bt-cost-calculator' ), 'description' => __( 'For detailed explaination on how to use it go to <a target="_blank" href="http://documentation.bold-themes.com/cost-calculator/cost-calculator-conditions/">documentation</a>.', 'bt-cost-calculator' ) ),
		array( 'param_name' => 'item_el_id', 'type' => 'textfield', 'heading' => esc_html__( 'Custom ID Attribute', 'bt-cost-calculator' ), 'group' => esc_html__( 'Design', 'bt-cost-calculator' ), 'preview' => true ),
		array( 'param_name' => 'item_el_class', 'type' => 'textfield', 'heading' => esc_html__( 'Extra Class Name(s)', 'bt-cost-calculator' ), 'group' => esc_html__( 'Design', 'bt-cost-calculator' ), 'preview' => true ),
		array( 'param_name' => 'item_el_style', 'type' => 'textfield', 'heading' => esc_html__( 'Inline Style', 'bt-cost-calculator' ), 'group' => esc_html__( 'Design', 'bt-cost-calculator' ), 'preview' => true )
	);
	BT_CC_Root::$builder->map( 'bt_cc_slider', array( 'name' => esc_html__( 'Cost Calculator Slider Bar', 'bt-cost-calculator' ), 'description' => esc_html__( 'Cost calculator slider', 'bt-cost-calculator' ), 'icon' => 'bt_bb_icon_bt_cc_slider', 'show_settings_on_create' => true,
		'params' => $bt_cc_slider_params
	));

    $bt_cc_switch_params = array(
		array( 'param_name' => 'separator', 'type' => 'bt_cc_custom_label_text', 'value' => array( ), 'heading' => __( 'For detailed explaination on how to use Cost Calculator Switch Toggle go to <a target="_blank" href="http://documentation.bold-themes.com/cost-calculator/cost-calculator-items/#switch">plugin documentation</a>.', 'bt-cost-calculator' ) ),

		array( 'param_name' => 'name', 'type' => 'textfield', 'heading' => esc_html__( 'Label', 'bt-cost-calculator' ), 'holder' => 'div', 'description' => esc_html__( 'Label for switch toggle - visible to users - displayed on the left side of the element.', 'bt-cost-calculator' ) ),
		array( 'param_name' => 'description', 'type' => 'textfield', 'heading' => esc_html__( 'Description', 'bt-cost-calculator' ), 'holder' => 'div', 'description' => esc_html__( 'Description - visible to users - displayed bottom right of the element.', 'bt-cost-calculator' ) ),
		array( 'param_name' => 'value_off', 'type' => 'textfield', 'heading' => esc_html__( 'Value Off *required', 'bt-cost-calculator' ), 'description' => esc_html__( 'Value to be calculated if switch toggle is OFF (value can be 0 or above).', 'bt-cost-calculator' ), 'preview' => true ),
		array( 'param_name' => 'value_on', 'type' => 'textfield', 'heading' => esc_html__( 'Value On *required', 'bt-cost-calculator' ), 'description' => esc_html__( 'Value to be calculated if switch toggle is ON.', 'bt-cost-calculator' ), 'preview' => true ),
		array( 'param_name' => 'initial_value', 'type' => 'textfield', 'heading' => esc_html__( 'Suggested Option', 'bt-cost-calculator' ), 'description' => esc_html__( 'Enter ON or Off value in this field, depending on which option you want to be initial to users.', 'bt-cost-calculator' ) , 'preview' => true),
		array( 'param_name' => 'condition', 'type' => 'textarea_object', 'heading' => esc_html__( 'Conditional Settings', 'bt-cost-calculator' ), 'description' => __( 'For detailed explaination on how to use it go to <a target="_blank" href="http://documentation.bold-themes.com/cost-calculator/cost-calculator-conditions/">documentation</a>.', 'bt-cost-calculator' ) ),
		array( 'param_name' => 'item_el_id', 'type' => 'textfield', 'heading' => esc_html__( 'Custom ID Attribute', 'bt-cost-calculator' ), 'group' => esc_html__( 'Design', 'bt-cost-calculator' ), 'preview' => true ),
		array( 'param_name' => 'item_el_class', 'type' => 'textfield', 'heading' => esc_html__( 'Extra Class Name(s)', 'bt-cost-calculator' ), 'group' => esc_html__( 'Design', 'bt-cost-calculator' ), 'preview' => true ),
		array( 'param_name' => 'item_el_style', 'type' => 'textfield', 'heading' => esc_html__( 'Inline Style', 'bt-cost-calculator' ), 'group' => esc_html__( 'Design', 'bt-cost-calculator' ), 'preview' => true )
	);
	BT_CC_Root::$builder->map( 'bt_cc_switch', array( 'name' => esc_html__( 'Cost Calculator Switch Toggle', 'bt-cost-calculator' ), 'description' => esc_html__( 'Cost calculator switch checkbox', 'bt-cost-calculator' ), 'icon' => 'bt_bb_icon_bt_cc_switch', 'show_settings_on_create' => true,
		'params' => $bt_cc_switch_params
	));
	
	// raw html
    $bt_cc_raw_html_params = array(	
		array( 'param_name' => 'raw_html', 'type' => 'textarea_object', 'heading' => esc_html__( 'HTML', 'bt-cost-calculator' ) ),
	);
	BT_CC_Root::$builder->map( 'bt_cc_raw_html', array( 'name' => esc_html__( 'Cost Calculator Raw HTML', 'bt-cost-calculator' ), 'description' => esc_html__( 'Cost calculator raw HTML', 'bt-cost-calculator' ), 'icon' => 'bt_bb_icon_bt_cc_raw_html', 'show_settings_on_create' => true,
		'params' => $bt_cc_raw_html_params
	));
	
	// subtotal
    $bt_cc_subtotal_params = array(
		array( 'param_name' => 'id', 'type' => 'textfield', 'heading' => esc_html__( 'ID', 'bt-cost-calculator' ), 'description' => esc_html__( 'Use function setSubtotal( \'id\', v ) in Group Pseudo-JS code to set subtotal value (id is this field value, v is Pseudo-JS variable).', 'bt-cost-calculator' ), 'preview' => true ),
		array( 'param_name' => 'label', 'type' => 'textfield', 'heading' => esc_html__( 'Label', 'bt-cost-calculator' ), 'preview' => true ),
	);
	BT_CC_Root::$builder->map( 'bt_cc_subtotal', array( 'name' => esc_html__( 'Subtotal', 'bt-cost-calculator' ), 'description' => esc_html__( 'Subtotal set by setSubtotal function', 'bt-cost-calculator' ), 'icon' => 'bt_bb_icon_bt_cc_subtotal', 'show_settings_on_create' => true,
		'params' => $bt_cc_subtotal_params
	));

	// separator
    $bt_cc_separator_params = array(	
		array( 'param_name' => 'top_spacing', 'type' => 'dropdown', 'heading' => esc_html__( 'Top Spacing', 'bt-cost-calculator' ), 'preview' => true,
			'value' => array(
				esc_html__( 'No spacing', 'bt-cost-calculator' ) => '',
				esc_html__( 'Extra small', 'bt-cost-calculator' ) => 'extra_small',
				esc_html__( 'Small', 'bt-cost-calculator' ) => 'small',		
				esc_html__( 'Normal', 'bt-cost-calculator' ) => 'normal',
				esc_html__( 'Medium', 'bt-cost-calculator' ) => 'medium',
				esc_html__( 'Large', 'bt-cost-calculator' ) => 'large',
				esc_html__( 'Extra large', 'bt-cost-calculator' ) => 'extra_large'
			)
		),
		array( 'param_name' => 'bottom_spacing', 'type' => 'dropdown', 'heading' => esc_html__( 'Bottom Spacing', 'bt-cost-calculator' ), 'preview' => true,
			'value' => array(
				esc_html__( 'No spacing', 'bt-cost-calculator' ) => '',
				esc_html__( 'Extra small', 'bt-cost-calculator' ) => 'extra_small',
				esc_html__( 'Small', 'bt-cost-calculator' ) => 'small',		
				esc_html__( 'Normal', 'bt-cost-calculator' ) => 'normal',
				esc_html__( 'Medium', 'bt-cost-calculator' ) => 'medium',
				esc_html__( 'Large', 'bt-cost-calculator' ) => 'large',
				esc_html__( 'Extra large', 'bt-cost-calculator' ) => 'extra_large'
			)
		),				
		array( 'param_name' => 'border_style', 'type' => 'dropdown', 'heading' => esc_html__( 'Border Style', 'bt-cost-calculator' ), 'preview' => true,
			'value' => array(
				esc_html__( 'None', 'bt-cost-calculator' ) => 'none',
				esc_html__( 'Solid', 'bt-cost-calculator' ) => 'solid',
				esc_html__( 'Dotted', 'bt-cost-calculator' ) => 'dotted',
				esc_html__( 'Dashed', 'bt-cost-calculator' ) => 'dashed'
			)
		),
		array( 'param_name' => 'item_el_id', 'type' => 'textfield', 'heading' => esc_html__( 'Custom ID Attribute', 'bt-cost-calculator' ), 'group' => esc_html__( 'Design', 'bt-cost-calculator' ), 'preview' => true ),
		array( 'param_name' => 'item_el_class', 'type' => 'textfield', 'heading' => esc_html__( 'Extra Class Name(s)', 'bt-cost-calculator' ), 'group' => esc_html__( 'Design', 'bt-cost-calculator' ), 'preview' => true ),
		array( 'param_name' => 'item_el_style', 'type' => 'textfield', 'heading' => esc_html__( 'Inline Style', 'bt-cost-calculator' ), 'group' => esc_html__( 'Design', 'bt-cost-calculator' ), 'preview' => true )
	);
	BT_CC_Root::$builder->map( 'bt_cc_separator', array( 'name' => esc_html__( 'Cost Calculator Separator', 'bt-cost-calculator' ), 'description' => esc_html__( 'Cost calculator separator', 'bt-cost-calculator' ), 'icon' => 'bt_bb_icon_bt_cc_separator', 'show_settings_on_create' => true,
		'params' => $bt_cc_separator_params
	));

}
add_action( 'plugins_loaded', 'bt_quote_map_sc' );

if ( ! class_exists( 'BT_Cost_Calculator_Log' ) ) {
	class BT_Cost_Calculator_Log {

		static $instance = false;
		const POST_TYPE				= 'bt_cc_log';
		const POST_STATUS			= 'bt_cc_log';
		const POST_STATUS_UNREAD	= 'bt_cc_log_unread';
		const PLUGIN_PREFIX			= 'bt_cc_log_';
		
		private function __construct() {

			add_action( 'admin_menu', array( $this, 'create_menu_items' ), 20 );
			add_action( 'admin_init', array( $this, 'initer' ) );
			add_action( 'init', array( $this, 'register_CPT' ) );
			add_action( 'bt_cc_log_insert', array( $this, 'create_log' ), 10, 3 );

			add_action( 'wpcf7_before_send_mail', array( $this, 'action_wpcf7_before_send_mail' )); 
		}

		public static function get_instance() {
			if ( ! self::$instance )
				self::$instance = new self;
			return self::$instance;
		}

		public function bt_get_current_post_type() {
			global $post, $typenow, $current_screen;
			if ( $post && $post->post_type ) {
				return $post->post_type;
			} else if ( $typenow ) {
				return $typenow;
			} else if ( $current_screen && $current_screen->post_type ) {
				return $current_screen->post_type;
			} else if ( isset( $_REQUEST['post_type'] ) ) {
				return sanitize_key($_REQUEST['post_type']);
			}
			return null;
		}

		public function register_CPT() {
			// register the post type
			register_post_type(self::POST_TYPE, array(
				'labels' => array (
					'name'					=> __('Cost Calculator Logs', 'bt-cost-calculator'),
					'singular_name'			=> __('Cost Calculator Log', 'bt-cost-calculator'),
					'menu_name'				=> __('Log Cost Calculator submissions', 'bt-cost-calculator'),
					'search_items'			=> __('Search Cost Calculator Log', 'bt-cost-calculator'),
					'not_found'				=> __('No Cost Calculator logs found', 'bt-cost-calculator'),
				),
				'description'				=> __('Keep records of Cost Calculator submissions', 'bt-cost-calculator'),
				'exclude_from_search'		=> true,
				'publicly_queryable'		=> false,
				'public'					=> false,
				'show_ui'					=> true,
				'show_in_admin_bar'			=> false,
				'show_in_menu'				=> false,
				'menu_position'				=> 75,
				'hierarchical'				=> false,
				'has_archive'				=> false,
				'supports'					=> array(),
				'rewrite'					=> false,
				'query_var'					=> false,
				'can_export'				=> false,
				'capabilities'				=> array (
					'create_posts'			=> 'do_not_allow',
					'edit_post'				=> 'activate_plugins',
					'edit_posts'			=> 'activate_plugins',
					'edit_others_posts'		=> 'activate_plugins',
					'delete_post'			=> 'activate_plugins',
					'delete_posts'			=> 'activate_plugins',
					'read_post'				=> 'activate_plugins',
					'read_private_posts'	=> 'do_not_allow',
					'publish_posts'			=> 'do_not_allow',
				),
				'map_meta_cap'				=> false,
			));
		}

		public function create_menu_items() {

			$count_posts = wp_count_posts( self::POST_TYPE );

			if ( isset( $count_posts->bt_cc_log_unread ) ) { 
				$unread_log_count = $count_posts->bt_cc_log_unread;
			} else {
				$unread_log_count = 0;
			}

			if (  $unread_log_count > 0 ) {
				$log_menu_title = sprintf( '%s <span class="awaiting-mod">%d</span>', $log_menu_title = __( 'CC Log', 'bt-cost-calculator'), $unread_log_count );
			} else {
				$log_menu_title = __( 'CC Log', 'bt-cost-calculator');
			}

			add_submenu_page(
				'bt-cost-calculator',
				__( 'Cost Calculator Logs', 'bt-cost-calculator'),
				$log_menu_title,
				'manage_options',
				'edit.php?post_type=' . self::POST_TYPE
			);
		}

		public function initer() {
	
			add_action( 'admin_action_bt-cc-log-view', array( $this, 'view_log') );
	
			if ( self::bt_get_current_post_type() === self::POST_TYPE ) {

				add_filter( 'display_post_states', '__return_false' );
				add_filter( 'bulk_actions-edit-' . self::POST_TYPE, array( $this, 'admin_bulk_actions_edit' ) );
				add_filter( 'handle_bulk_actions-edit-' . self::POST_TYPE, array( $this, 'admin_bulk_actions_handle' ), 10, 3 );
				add_filter( 'bulk_post_updated_messages', array( $this, 'admin_bulk_post_updated_messages' ), 10, 2 );
				add_filter( 'parse_query', array( $this, 'admin_post_order' ) );
				//add_filter( 'posts_search', array( $this, 'admin_posts_search' ), 10, 2 ) ;
				add_action( 'manage_edit-' . self::POST_TYPE . '_sortable_columns', array($this, 'adminSortableColumns') );
				add_filter( 'manage_' . self::POST_TYPE . '_posts_columns', array( $this, 'admin_manage_columns' ), 100 );
				add_action( 'manage_' . self::POST_TYPE . '_posts_custom_column', array( $this, 'admin_manage_custom_column' ), 10, 2 );
				add_filter( 'post_date_column_status', '__return_empty_string' );
				add_filter( 'post_row_actions', array( $this, 'post_row_actions' ), 10, 2 );
				add_filter( 'gettext', array( $this, 'removePublished' ), 10, 3 );
				add_action( 'admin_print_footer_scripts', array( $this, 'adminPrintFooterScripts' ) );
	
				add_filter('views_edit-' . self::POST_TYPE, array($this, 'adminViewsEdit'));
			}
		}

		public function action_wpcf7_before_send_mail( $cf7 ) { 

			$wpcf = WPCF7_ContactForm :: get_current();
			$submission = WPCF7_Submission :: get_instance() ;

			$posted_data = $submission->get_posted_data() ;

			if ( array_key_exists ( 'bt-cc-data', $posted_data ) ) {
				$mail = $wpcf->prop('mail');
				$mail_body = $mail['body'];
				$mail_subject = $mail['subject'];

				foreach ( $posted_data as $key => $value ){
					$value_to_replace = $value;
					if( is_array($value) ) {
						$value_to_replace = $value[0];
					}
					$mail_body = str_replace( '[' . $key . ']', $value_to_replace, $mail_body);
					$mail_subject = str_replace( '[' . $key . ']', $value_to_replace, $mail_subject);
				}

				$fields = array();
				
				if ( $mail['use_html'] ) {
					$fields[ self::PLUGIN_PREFIX . 'content-type' ] = 'text/html';
				} else {
					$fields[ self::PLUGIN_PREFIX . 'content-type' ] = 'text/plain';
				}
				
				$this->create_log( $mail_subject, $mail_body, $fields );
			}
			
    		return $wpcf; 
		} 

		public function view_log() {
			global $wpdb;
	
			$post_id = empty( $_GET['post_id'] ) ? 0 : absint( $_GET['post_id'] );
			$post = $post_id ? get_post( $post_id ) : false;
	
			if ( ! $post ) {
				return;
			}
	
			$post_type = get_post_type_object( $post->post_type );
	
			if ( $post->post_type !== self::POST_TYPE ) {
				wp_die( __( 'This post is not a CC log.', 'bt-cost-calculator' ) );
			}
	
			if ( ! current_user_can( $post_type->cap->edit_posts ) ) {
				wp_die( sprintf('<h1>%s</h1><p>%s</p>',
					__( 'Cheatin&#8217; uh?', 'bt-cost-calculator' ),
					__( 'You are not allowed to view CC log.', 'bt-cost-calculator' ) ),
					403 );
			}

			$sql = "
				select ID
				from {$wpdb->posts}
				where ID < {$post->ID} and post_type = '" . self::POST_TYPE . "'
				order by ID desc limit 1
			";

			$previous = $wpdb->get_var( $sql );
			$previous = $previous ? $this->get_log_view_URL( $previous ) : false;
			$sql = "
				select ID
				from {$wpdb->posts}
				where ID > {$post->ID} and post_type = '" . self::POST_TYPE . "'
				order by ID asc limit 1
			";
			$next = $wpdb->get_var( $sql );
			$next = $next ? $this->get_log_view_URL( $next ) : false;
	
			$current = $this->get_log_view_URL( $post->ID );
			$list = admin_url( 'edit.php?post_type=' . self::POST_TYPE );
	
	
			require_once( ABSPATH . 'wp-admin/admin-header.php' );
			require_once( __DIR__ . '/templates/log-detail.php' );
			require_once( ABSPATH . 'wp-admin/admin-footer.php' );

			wp_update_post( array(
				'ID'			=> $post_id,
				'post_status'   => self::POST_STATUS,
			));
		}

		public function adminViewsEdit( $views ) {
			unset($views['publish']);
			unset($views['draft']);
			unset($views['mine']);

			return $views;
		}

		public function admin_bulk_actions_edit( $actions ) {
			unset( $actions['edit'] );
			$actions['post_read'] = __( 'Mark as read', 'bt-cost-calculator');
			$actions['post_unread'] = __( 'Mark as unread', 'bt-cost-calculator');
			return $actions;
		}

		public function admin_bulk_actions_handle( $redirect_to, $doaction, $post_ids ) {
			if ( $doaction !== 'post_read' && $doaction !== 'post_unread' ) {
				return $redirect_to;
			}

			if ( $doaction == 'post_read' ) {
				$statustoset = self::POST_STATUS;
			} else if ( $doaction == 'post_unread' ) {
				$statustoset = self::POST_STATUS_UNREAD;
			}
			
			foreach ( $post_ids as $post_id ) {
				wp_update_post( array(
					'ID'			=> $post_id,
					'post_status'   => $statustoset,
				));
			}

			//mozemo da implementiramo notifikaciju: https://make.wordpress.org/core/2016/10/04/custom-bulk-actions/
  
			$redirect_to = add_query_arg( 'bulk_marked_posts', count( $post_ids ), $redirect_to );
			return $redirect_to;
		}

		public function admin_bulk_post_updated_messages( $messages, $bulk_counts ) {
			$messages[ self::POST_TYPE ] = array(
				'deleted' => __( '%s Cost Calculator log permanently deleted.', '%s Cost Calculator logs permanently deleted.', $bulk_counts['deleted'], 'bt-cost-calculator' ),
			);
			return $messages;
		}

		public function create_log( $title, $content, $fields ) {

			remove_all_filters( 'pre_post_content' );
			remove_all_filters( 'content_save_pre' );
			//remove_all_filters( 'sanitize_' . self::POST_TYPE . '_meta__direktt_wp_email_log_log_altbody' );
	
			// allow plugins to add back some filtering
			do_action( 'bt_cc_log_pre_insert' );
	
			// create post for message
			$post_id = wp_insert_post( array(
				'post_type'			=> self::POST_TYPE,
				'post_content'		=> $content,
				'post_title'		=> $title,
				'post_status'		=> self::POST_STATUS_UNREAD,
				'comment_status'	=> 'closed',
				'ping_status'		=> 'closed',
			) );
	
			// add field values
			if ( $post_id ) {
				foreach ( $fields as $name => $value ) {
					if ( strlen($value) > 0 ) {
						add_post_meta( $post_id, $name, $value );
					}
				}
			}

			return $post_id;
		}

		public function admin_post_order( $query ) {
			// only for admin queries for this post type, with no specified order
			if ( $query->is_admin && $query->get( 'post_type' ) === self::POST_TYPE ) {

				if ( empty( $query->query_vars['orderby'] ) ) {
					$query->set( 'orderby',  'ID' );
					$query->set( 'order',    'DESC' );
				}
				
				// make sure it picks up posts with the custom post status
				if ( $query->get( 'post_status' ) != 'trash') {
					$query->set( 'post_status', 'any' );
				}
			}
			return $query;
		}

		/**
		* add custom columns to sort by
		* @param array $columns
		* @return array
		*/
		public function adminSortableColumns( $columns ) {
			$columns['_bt_cc_title']	= 'title';

			return $columns;
		}

		public function admin_manage_columns( $posts_columns ) {
			$new_columns = array();
	
			// bring across bulk action checkbox column
			if ( isset( $posts_columns['cb'] ) ) {
				$new_columns['cb'] = $posts_columns['cb'];
			}
	
			$new_columns['_bt_cc_title']		= __( 'Subject', 'bt-cost-calculator' );
	
			// bring across date column
			if (isset($posts_columns['date'])) {
				$new_columns['date'] = $posts_columns['date'];
			}
	
			return $new_columns;
		}

		public function admin_manage_custom_column( $column_name, $post_id ) {
			switch ( $column_name ) {
				case '_bt_cc_title':
					$post = get_post($post_id);
					if ( $post ) {
						$view_link = $this->get_log_view_URL($post_id);

						if ( $post->post_status == self::POST_STATUS_UNREAD ) {
							printf('<strong><a class="row-title" href="%s">%s</a></strong>', esc_url( $view_link ), esc_html( $post->post_title ) );
						} else {
							printf('<a class="row-title" style="font-weight:400" href="%s">%s</a>', esc_url( $view_link ), esc_html( $post->post_title ) );
						}
	
						// show log excerpt if viewing in excerpt mode
						global $mode;
						if ('excerpt' === $mode) {
							echo '<p>', wp_trim_words( $post->post_content ), '</p>';
						}
					}
					break;
			}
		}

		protected function get_log_view_URL( $post_id ) {
			return add_query_arg( array( 'action' => 'bt-cc-log-view', 'post_id' => $post_id ), admin_url( 'admin.php' ) );
		}

		public function post_row_actions( $actions, $post ) {
			$actions = array();
	
			// add View link
			$label = __( 'View', 'View Cost Calculator log', 'bt-cost-calculator' );
			$actions['view'] = sprintf( '<a href="%s" title="%s">%s</a>', esc_url( $this->get_log_view_URL( $post->ID ) ), esc_attr( $label ), esc_html( $label ) );
	
			// add Delete link
			$label = _x( 'Delete', 'Delete Cost Calculator log', 'bt-cost-calculator' );
			$actions['delete'] = sprintf( '<a href="%s" title="%s" class="submitdelete">%s</a>', esc_url( get_delete_post_link ( $post->ID, '', true ) ), esc_attr( $label ), esc_html( $label ) );
	
			return $actions;
		}

		/**
		* don't list logs as Published
		* @param string $translation
		* @param string $text
		* @param string $domain
		* @return string
		*/
		public function removePublished( $translation, $text, $domain ) {
			if ($domain === 'default' && $text === 'Published') {
				$translation = '';
			}

			return $translation;
		}

		public function adminPrintFooterScripts() {
			?>
			<script>
			jQuery("select[name='action'],select[name='action2']").find("option[value='trash']").each(function() {
				this.value = 'delete';
				jQuery(this).text("<?php echo esc_attr_x('Delete', 'bulk delete email logs', 'bt-cost-calculator'); ?>");
			});
			jQuery("a.add-new-h2").remove();
			</script>
			<?php
		}

	}
}

$bt_cost_calculator_log = BT_Cost_Calculator_Log::get_instance();

