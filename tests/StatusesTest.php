<?php

/**
 * Title: Buckaroo statuses constants tests
 * Description:
 * Copyright: Copyright (c) 2005 - 2015
 * Company: Pronamic
 * @author Remco Tolsma
 * @version 1.0.0
 * @see https://www.mollie.nl/support/documentatie/betaaldiensten/ideal/en/
 */
class Pronamic_WP_Pay_Gateways_Buckaroo_StatusesTest extends WP_UnitTestCase {
	/**
	 * Test transform.
	 *
	 * @dataProvider statusMatrixProvider
	 */
	public function testTransform( $buckarooStatus, $expected ) {
		$status = Pronamic_WP_Pay_Gateways_Buckaroo_Statuses::transform( $buckarooStatus );

		$this->assertEquals( $expected, $status );
	}

	public function statusMatrixProvider() {
		return array(
			// Success
			array( Pronamic_WP_Pay_Gateways_Buckaroo_Statuses::PAYMENT_SUCCESS, Pronamic_WP_Pay_Statuses::SUCCESS ),
			// Failure
			array( Pronamic_WP_Pay_Gateways_Buckaroo_Statuses::PAYMENT_FAILURE, Pronamic_WP_Pay_Statuses::FAILURE ),
			array( Pronamic_WP_Pay_Gateways_Buckaroo_Statuses::VALIDATION_FAILURE, Pronamic_WP_Pay_Statuses::FAILURE ),
			array( Pronamic_WP_Pay_Gateways_Buckaroo_Statuses::TECHNICAL_ERROR, Pronamic_WP_Pay_Statuses::FAILURE ),
			array( Pronamic_WP_Pay_Gateways_Buckaroo_Statuses::PAYMENT_REJECTED, Pronamic_WP_Pay_Statuses::FAILURE ),
			// Open
			array( Pronamic_WP_Pay_Gateways_Buckaroo_Statuses::WAITING_FOR_USER_INPUT, Pronamic_WP_Pay_Statuses::OPEN ),
			array( Pronamic_WP_Pay_Gateways_Buckaroo_Statuses::WAITING_FOR_PROCESSOR, Pronamic_WP_Pay_Statuses::OPEN ),
			array( Pronamic_WP_Pay_Gateways_Buckaroo_Statuses::WAITING_ON_CONSUMER_ACTION, Pronamic_WP_Pay_Statuses::OPEN ),
			array( Pronamic_WP_Pay_Gateways_Buckaroo_Statuses::PAYMENT_ON_HOLD, Pronamic_WP_Pay_Statuses::OPEN ),
			// Cancelled
			array( Pronamic_WP_Pay_Gateways_Buckaroo_Statuses::CANCELLED_BY_CONSUMER, Pronamic_WP_Pay_Statuses::CANCELLED ),
			array( Pronamic_WP_Pay_Gateways_Buckaroo_Statuses::CANCELLED_BY_MERCHANT, Pronamic_WP_Pay_Statuses::CANCELLED ),
			// Other
			array( 'not existing status', null ),
		);
	}
}
