<!doctype html>
<html>
<head>
	<meta charset="<?php bloginfo('charset'); ?>"/>
	<meta name="viewport" content="width=device-width, initial-scale=1"/>
	<link rel="profile" href="https://gmpg.org/xfn/11"/>
	<link rel="stylesheet" href="<?php echo get_stylesheet_uri(); ?>"/>
	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<header>
	<?php wp_nav_menu(); ?>
</header>
