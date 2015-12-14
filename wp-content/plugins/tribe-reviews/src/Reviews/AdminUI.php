<?php
/**
 * Created by PhpStorm.
 * User: daniel
 * Date: 10/28/15
 * Time: 1:20 AM
 */

namespace Reviews;


class AdminUI {

	public function __construct() {

		add_filter( 'wpseo_metabox_prio', function () {
			return 'low';
		} );

	}
}