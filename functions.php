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

try {
	spl_autoload_register(function ($class) {
		@include_once dirname(__FILE__) . "/extensions/" . $class . ".class.php";
	});
	spl_autoload_register(function ($class) {
		@include_once dirname(__FILE__) . "/widgets/" . strtolower($class) . "/" . $class . ".class.php";
	});
} catch (Exception $ex) {
	die($ex->getMessage());
}

function path2url($loc, $file) {
	return get_theme_root_uri() . str_replace(get_theme_root(), '', dirname($loc) . "/" . $file);
}


add_action("after_setup_theme", new ThemeSetup);
add_action('widgets_init', new Sidebar);
add_action("widgets_init", new HeroLoop);
add_action("widgets_init", new SloganLoop);
add_action("widgets_init", new Pagebox);

