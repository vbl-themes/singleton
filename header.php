<!doctype html>
<html>
<head>
	<meta charset="<?php bloginfo('charset'); ?>"/>
	<meta name="viewport" content="width=device-width, initial-scale=1"/>
	<link rel="profile" href="https://gmpg.org/xfn/11"/>
	<link rel="stylesheet" href="<?php echo get_stylesheet_uri(); ?>"/>
	<?php wp_head(); ?>
</head>
<body id="top" <?php body_class(); ?>>
<header>
	<?php if (has_custom_logo() && $url = wp_get_attachment_image_src(get_theme_mod("custom_logo"), "full")): ?>
		<a href="#top"><img src="<?php echo $url[0]; ?>"
							alt="<?php get_bloginfo("name"); ?>"
							height="50"/></a>
	<?php endif; ?>
	<?php wp_nav_menu(array("menu" => "Main Menu")); ?>
</header>
