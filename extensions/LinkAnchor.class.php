<?php
/**
 * Copyright 2019 by Baltnet Communications (https://www.baltnet.ee)
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 *        http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 */

class LinkAnchor {

	function __construct() {
		add_filter("nav_menu_link_attributes", array($this, "setAnchor"), 10, 3);
	}

	public function setAnchor($attributes, $item, $args) {
		$attributes["href"] = "#" . trim(str_replace(get_site_url(), "", $attributes["href"]), "/");
		return $attributes;
	}
}
