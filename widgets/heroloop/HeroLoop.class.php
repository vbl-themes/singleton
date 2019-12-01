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

class HeroLoop extends WP_Widget {

	static $widget_name = "Hero Loop";
	static $widget_id = "hero-loop";

	function __construct() {
		$opts = array(
			"description" => "Displays custom image post types as a hero loop."
		);
		parent::__construct(false, __(self::$widget_name), $opts);
	}

	function __invoke() {
		$this->createPostType();
		$this->enqueueStylesScripts();
		register_widget($this);
	}

	function createPostType() {
		register_post_type("image", array(
			"labels" => array("name" => __("Images"), "singular_name" => __("Image")),
			"public" => true,
			"has_archive" => false,
			"rewrite" => array("slug" => "images"),
			"supports" => array("editor", "thumbnail", "title", "page-attributes")
		));
	}

	function enqueueStylesScripts() {
		wp_enqueue_style(self::$widget_id, path2url(__FILE__, "HeroLoop.css"));
		wp_enqueue_script(self::$widget_id, path2url(__FILE__, "HeroLoop.js"));
	}

	function widget($args, $instance) {
		echo $args["before_widget"];

		$posts = get_posts(array("post_type" => "image", "orderby" => "menu_order", "order" => "ASC"));
		$count = count($posts);

		foreach ($posts as $post): ?>
			<article
					class="<?php echo $post->ID === $posts[0]->ID ? "" : "hidden"; ?>"
					style="background-image: url('<?php echo get_the_post_thumbnail_url($post); ?>')">
				<p>
					<?php echo get_the_content(null, false, $post) ?>
				</p>

				<p>
					<?php if ($count > 1) for ($i = 0; $i < $count; $i++): ?>
						<a onclick="changePic(this.parentNode.parentNode.parentNode, <?php echo $i; ?>)"
						   <?php if ($posts[$i]->ID === $post->ID): ?>class="active"<?php endif; ?>>
							&#9135;
						</a>
					<?php endfor; ?>
				</p>

				<?php wp_nav_menu(array(
					"menu" => "Hero Icons",
					"container" => null,
					"fallback_cb" => false,
				)) ?>>

			</article>
		<?php endforeach;

		echo $args["after_widget"];
	}
}
