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

class ThemeSetup {

	function __invoke() {
		$this->enablePostThumbnails();
		$this->enableCustomLogo();
		$this->enableLinkAnchors();
		$this->registerMenus();
	}

	function enablePostThumbnails() {
		add_theme_support("post-thumbnails");
	}

	function enableCustomLogo() {
		add_theme_support("custom-logo", array(
			"height" => "50",
			"flex-width" => true,
		));
	}

	function enableLinkAnchors() {
		new LinkAnchor();
	}

	function registerMenus() {
		register_nav_menu("main-menu", "Main Menu");
		register_nav_menu("hero-icons", "Hero Icons");
	}
}
