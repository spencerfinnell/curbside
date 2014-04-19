<?php

class Curbside_Menu_Item {

	public static function init() {
		$name = 'Menu Item';

		return new Curbside_Post_Type( $name );
	}

}