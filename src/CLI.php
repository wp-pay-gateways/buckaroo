<?php
/**
 * CLI
 *
 * @author    Pronamic <info@pronamic.eu>
 * @copyright 2005-2021 Pronamic
 * @license   GPL-3.0-or-later
 * @package   Pronamic\WordPress\Pay\Buckaroo
 */

namespace Pronamic\WordPress\Pay\Gateways\Buckaroo;

/**
 * Title: CLI
 * Description:
 * Copyright: 2005-2021 Pronamic
 * Company: Pronamic
 *
 * @author  Remco Tolsma
 * @version 2.1.0
 * @since   2.1.0
 * @link    https://github.com/woocommerce/woocommerce/blob/3.9.0/includes/class-wc-cli.php
 */
class CLI {
	/**
	 * Construct CLI.
	 */
	public function __construct( $integration ) {
		$this->integration = $integration;

		\WP_CLI::add_command(
			'pronamic-pay buckaroo transaction status',
			function( $args, $assoc_args ) {
				$this->wp_cli_transaction_status( $args, $assoc_args );
			},
			array(
				'shortdesc' => 'This returns the status for the provided transaction',
			)
		);

		\WP_CLI::add_command(
			'pronamic-pay buckaroo transaction refund-info',
			function( $args, $assoc_args ) {
				$this->wp_cli_transaction_refund_info( $args, $assoc_args );
			},
			array(
				'shortdesc' => 'This returns the refund info',
			)
		);
	}

	/**
	 * CLI transaction status.
	 *
	 * @link https://testcheckout.buckaroo.nl/json/Docs/Api/GET-json-Transaction-Status-transactionKey
	 * @param array<string> $args       Arguments.
	 * @param array<string> $assoc_args Associative arguments.
	 * @return void
	 */
	public function wp_cli_transaction_status( $args, $assoc_args ) {
		$gateway = $this->integration->get_gateway( $assoc_args['config_id'] );

		foreach ( $args as $transaction_key ) {
			$result = $gateway->request( 'GET', 'Transaction/Status/' . $transaction_key );

			\WP_CLI::line( \wp_json_encode( $result, \JSON_PRETTY_PRINT ) );
		}
	}

	/**
	 * CLI transaction refund info.
	 *
	 * @link https://testcheckout.buckaroo.nl/json/Docs/Api/GET-json-Transaction-Status-transactionKey
	 * @param array<string> $args       Arguments.
	 * @param array<string> $assoc_args Associative arguments.
	 * @return void
	 */
	public function wp_cli_transaction_refund_info( $args, $assoc_args ) {
		$gateway = $this->integration->get_gateway( $assoc_args['config_id'] );

		foreach ( $args as $transaction_key ) {
			$result = $gateway->request( 'GET', 'Transaction/RefundInfo/' . $transaction_key );

			\WP_CLI::line( \wp_json_encode( $result, \JSON_PRETTY_PRINT ) );
		}
	}
}
