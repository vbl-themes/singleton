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

class Sidebar {

	private static $beforeWidget = '<section class="widget %2$s">';
	private static $afterWidget = '</section>';
	private static $beforeTitle = '<p class="widget-title">';
	private static $afterTitle = '</p>';

	function __invoke() {
		$this->register("Main", "index", "Main content area.");
	}

	private function register($name, $id, $description) {
		register_sidebar(array(
			"name" => __($name),
			"id" => $id,
			"description" => __($description),
			"before_widget" => self::$beforeWidget,
			"after_widget" => self::$afterWidget,
			"before_title" => self::$beforeTitle,
			"after_title" => self::$afterTitle
		));
	}
}
