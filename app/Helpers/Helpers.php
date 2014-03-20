<?php

/* Copyright (c) 2014, JDCofficial
 * All rights reserved.
 *
 * License information you can find in LICENSE.md
 */

namespace App\Helpers;

/**
 * Description of Helpers
 *
 * @author JDC
 */
class Helpers {
	
	public function loader($helper) {
        if (method_exists($this, $helper)) {
            return callback($this, $helper);
        }
	}
	
	public function field($text) {
		if (!$text)
			return "-";
		return $text;
	}
}
