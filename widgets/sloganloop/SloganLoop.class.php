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

class SloganLoop extends WP_Widget {

	static $widget_name = "Slogan Loop";
	static $widget_id = "slogan-loop";

	function __construct() {
		$opts = array(
			"description" => "Displays custom text post types as slogans in a loop."
		);
		parent::__construct(false, __(self::$widget_name), $opts);
	}

	function __invoke() {
		$this->createPostType();
		$this->enqueueStylesScripts();
		register_widget($this);
	}

	function createPostType() {
		register_post_type("slogan", array(
			"labels" => array("name" => __("Slogans"), "singular_name" => __("Slogan")),
			"public" => true,
			"has_archive" => false,
			"rewrite" => array("slug" => "slogans"),
			"supports" => array("editor", "thumbnail", "title", "page-attributes")
		));
	}

	function enqueueStylesScripts() {
		wp_enqueue_style(self::$widget_id, path2url(__FILE__, "SloganLoop.css"));
		wp_enqueue_script(self::$widget_id, path2url(__FILE__, "SloganLoop.js"));
	}

	function widget($args, $instance) {
		echo $args["before_widget"];

		$posts = get_posts(array("post_type" => "slogan", "orderby" => "menu_order", "order" => "ASC")); ?>

		<a onClick="changeText(this.nextElementSibling, true)"
		   onload="console.log('loading');">&#x29CF;</a>

		<article>
			<?php foreach ($posts as $post): ?>
				<p class="<?php echo $post->ID == $posts[0]->ID ? "" : "hidden"; ?>">
					<?php echo get_the_content(null, false, $post) ?>
				</p>
			<?php endforeach; ?>
		</article>

		<a onClick="changeText(this.previousElementSibling, false)">&#x29D0;</a>

		<?php echo $args["after_widget"];
	}
}
