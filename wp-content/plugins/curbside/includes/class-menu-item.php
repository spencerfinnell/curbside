<?php

class Curbside_Menu_Item {

	public function __construct( $item ) {
		$this->item = $item;
	}

	public function get_price() {
		$price = $this->item->price;

		if ( ! $price ) {
			return 'free';
		}

		setlocale( LC_MONETARY, 'en_US' );

		return money_format( '%n', $price );
	}

}