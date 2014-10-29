<?php 
/**
 * Kaos Latin Gamers Header File
 * 
 */
 ?>
 <!DOCTYPE html>
 <html <?php language_attributes(); ?>>
 <head>
 	<meta charset="<?php bloginfo('charset'); ?>"
 	<meta name="viewpost" content="width=device-width, initial-scale=1"/>
 	<title><?php wp_title('|', true,'right'); ?></title>
 	<link rel="profile" href="http://gmpg.org/xfn/11">
 	<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>">
 	<!-- HTML5 SHIV for IE --><!-- If using Modernizr you can remove this script!-->
 	<!--[if lt IE 9]>
 		<script src="//html5shiv.googlecode.com/svn/trunk/html5.js"></script>
 		<![endif]-->
 	<?php wp_head(); ?>
 </head>
 <body <?php body_class(); ?>>
 <div class="upperimage"></div>
 	<header class="site-header">
 		<h1>
 			<a href="<?php home_url('/'); ?>">
 			<img src="<?php bloginfo('template_directory') ?>/images/logo.png" class="logo" alt="Logo Gaming" >
 			</a></h1>
 			<nav class="main-navigation">
 	
 		<?php wp_nav_menu(array('theme_location'=>'primary','container'=>false)); ?>
 	</nav>
 	</header>
 	<div id="wrapper">
 	

 	


