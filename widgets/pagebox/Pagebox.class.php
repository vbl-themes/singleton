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

class Pagebox extends WP_Widget {

	static $widget_name = "Page Box";
	static $widget_id = "page-box";

	function __construct() {
		$opts = array(
			"description" => "Displays the content of a page inside a widget."
		);
		parent::__construct(false, __(self::$widget_name), $opts);
	}

	function __invoke() {
		register_widget($this);
	}

	function widget($args, $instance) {
		echo $args["before_widget"];
		$page = $instance["page"] > 0 ? get_post($instance["page"]) : null;
		if ($page != null) echo get_the_content(null, false, $page);
		echo $args["after_widget"];
	}

	function update($new_instance, $old_instance) {

		$inst = $old_instance;
		$inst["page"] = strip_tags($new_instance["page"]);
		return $inst;
	}

	function form($instance) {
		$pages = get_posts(array("post_type" => "page"));

		?>
		<p>
			<label for="<?php echo $this->get_field_id("page"); ?>">Page:</label>

			<select
					name="<?php echo $this->get_field_name("page"); ?>"
					id="<?php echo $this->get_field_id("page"); ?>">

				<option value="">--- Empty ---</option>

				<?php foreach ($pages as $page): ?>
					<option value="<?php echo $page->ID; ?>"<?php if ($instance["page"] == $page->ID) echo "selected" ?>>
						<?php echo $page->post_title; ?>
					</option>
				<?php endforeach; ?>

			</select>
		</p>
	<?php }
}