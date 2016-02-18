<?php

/**
 * Title: Buckaroo integration
 * Description:
 * Copyright: Copyright (c) 2005 - 2016
 * Company: Pronamic
 *
 * @author Reüel van der Steege
 * @version 1.2.2
 * @since 1.0.0
 */
class Pronamic_WP_Pay_Gateways_Buckaroo_Integration extends Pronamic_WP_Pay_Gateways_AbstractIntegration {
	public function __construct() {
		$this->id       = 'buckaroo';
		$this->name     = 'Buckaroo - HTML';
		$this->url      = 'https://payment.buckaroo.nl/';
		$this->provider = 'buckaroo';

		// Actions
		$function = array( 'Pronamic_WP_Pay_Gateways_Buckaroo_Listener', 'listen' );

		if ( ! has_action( 'wp_loaded', $function ) ) {
			add_action( 'wp_loaded', $function );
		}
	}

	public function get_config_factory_class() {
		return 'Pronamic_WP_Pay_Gateways_Buckaroo_ConfigFactory';
	}

	public function get_config_class() {
		return 'Pronamic_WP_Pay_Gateways_Buckaroo_Config';
	}

	public function get_settings_class() {
		return 'Pronamic_WP_Pay_Gateways_Buckaroo_Settings';
	}

	public function get_gateway_class() {
		return 'Pronamic_WP_Pay_Gateways_Buckaroo_Gateway';
	}

	/**
	 * Get required settings for this integration.
	 *
	 * @see https://github.com/wp-premium/gravityforms/blob/1.9.16/includes/fields/class-gf-field-multiselect.php#L21-L42
	 * @since 1.2.2
	 * @return array
	 */
	public function get_settings() {
		$settings = parent::get_settings();

		$settings[] = 'buckaroo';

		return $settings;
	}
}
