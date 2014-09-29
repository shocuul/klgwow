<?php 
/**
 * Kaos Latin Gamers Header File
 * 
 */
 ?>
 <!DOCTYPE html>
 <html class="no-js"<?php language_attributes(); ?>>
 <head>
 	<meta name="viewpost" content="width=device-width"/>
 	<title><?php wp_title('|', true,'right'); ?></title>
 	<!-- HTML5 SHIV for IE --><!-- If using Modernizr you can remove this script!-->
 	<!--[if lt IE 9]>
 		<script src="//html5shiv.googlecode.com/svn/trunk/html5.js"></script>
 		<![endif]-->
 	<?php wp_head(); ?>
 </head>
 <body <?php body_class(); ?>>
 	<header class="site-header">
 		<h1>
 			<a href="<?php home_url('/'); ?>">
 			<img src="<?php bloginfo('template_directory') ?>/images/logo.png" alt="Logo Gaming" >
 			</a></h1>
 	</header>
 	<nav class="main-navigation">
 		<?php wp_nav_menu(array('theme_location'=>'primary','container'=>false)); ?>
 	</nav>


