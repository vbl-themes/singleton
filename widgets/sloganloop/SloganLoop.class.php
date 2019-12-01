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
		$baseID = str_replace("-", "", self::$widget_id);
		$opts = array(
			"description" => "Displays custom text post types as slogans in a loop.",
			"classname" => "widget_" . $baseID . " %s",
		);
		parent::__construct($baseID, __(self::$widget_name), $opts);
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
		echo sprintf($args["before_widget"], $instance["style"]);

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

	function update($new_instance, $old_instance) {
		$inst = $old_instance;
		$inst["style"] = strip_tags($new_instance["style"]);
		return $inst;
	}

	function form($instance) { ?>
		<p>
			<label
				for="<?php echo $this->get_field_id("style"); ?>">Style:</label>

			<select
				name="<?php echo $this->get_field_name("style"); ?>"
				id="<?php echo $this->get_field_id("style"); ?>">

				<option value="">--- Empty ---</option>
				<option
					value="dark"<?php if ($instance["style"] == "dark") echo "selected" ?>>
					Dark
				</option>
				<option
					value="light"<?php if ($instance["style"] == "light") echo "selected" ?>>
					Light
				</option>
			</select>
		</p>
	<?php }
}
