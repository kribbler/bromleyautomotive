<!doctype html>
<html>
	<head>
		<title><?php bloginfo('name'); ?> | <?php is_front_page() ? bloginfo('description') : wp_title(''); ?></title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<?php wp_head(); ?>
	</head>
	<body <?php body_class();?>>

	<header id="header-banner">
	<div class="container-fluid" id="menu_tablet">
		<div class="row">
			<div class="span3">
				<a href="<?php echo site_url();?>">
					<img src="<?php echo get_stylesheet_directory_uri().'/images/logo.png';?>" alt="<?php echo esc_attr(get_bloginfo('sitename'));?>" class="logo">
				</a>
			</div>
			<div class="span8 align-right">
				<div class="container-fluid">
					<div class="row">
						<?php
							if(has_nav_menu('header-secondary-menu-smaller')){
								wp_nav_menu(array(
									'theme_location' => 'header-secondary-menu-smaller',
									'container' => '',
									'menu_class' => 'header_secondary_menu',
									'menu_id' => 'navigation-header-secondary',
									'depth' => 3,
								));
							}
						?>
						<?php dynamic_sidebar( 'header-top-right' ); ?>
						<?php dynamic_sidebar( 'social-links' ); ?>
					</div>
					<div class="row">
						<div id="menu" role="navigation">
							<nav><?php
								if(has_nav_menu('header-main-menu-smaller')){
									wp_nav_menu(array(
										'theme_location' => 'header-main-menu-smaller',
										'container' => '',
										'menu_class' => 'header_main_menu',
										'menu_id' => 'menu-main-navigation',
										'depth' => 3,
										'walker' => new Et_Navigation
									));
								}
							?>
							</nav>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<div class="container-fluid" id="menu_phone">
		<div class="row">
			<div class="span3">
				<a href="<?php echo site_url();?>">
					<img src="<?php echo get_stylesheet_directory_uri().'/images/logo-mobile.png';?>" alt="<?php echo esc_attr(get_bloginfo('sitename'));?>" class="logo">
				</a>
			</div>

			<div class="span3">
				<span id="activate_mobile_menu">MENU</span>
				<div id="mobile_menu_holder">
					<div id="mobile_close"></div>
					<?php
					if(has_nav_menu('mobile-menu')){
						wp_nav_menu(array(
							'theme_location' => 'mobile-menu',
							'container' => '',
							'menu_class' => 'mobile_menu',
							'menu_id' => 'mobile-menu',
							'depth' => 3,
						));
					}
					?>
				</div>
			</div>

			<div class="span4">
				<?php dynamic_sidebar( 'header-top-right' ); ?>
				<?php dynamic_sidebar( 'social-links' ); ?>
			</div>
		</div>
	</div>

	<div class="container" id="menu_desktop">
		<div class="row">
			<div class="span2">
				<a href="<?php echo site_url();?>">
					<img src="<?php echo get_stylesheet_directory_uri().'/images/logo.png';?>" alt="<?php echo esc_attr(get_bloginfo('sitename'));?>" class="logo">
				</a>
			</div>
			<div class="span9">
				<div class="container-fluid">
					<div class="row">
						<div class="span12 align-right">
							<?php dynamic_sidebar( 'header-top-right' ); ?>
						</div>
					</div>
					
					<div class="row desktop_menus">
						<div class="span12">
							<?php
								if(has_nav_menu('header-secondary-menu')){
									wp_nav_menu(array(
										'theme_location' => 'header-secondary-menu',
										'container' => '',
										'menu_class' => 'header_secondary_menu',
										'menu_id' => 'navigation-header-secondary',
										'depth' => 3,
									));
								}
							?>
						</div>
					</div>

					<div class="row desktop_menus">
						<div class="span12">
							<div id="menu" role="navigation">
							<nav><?php
								if(has_nav_menu('header-main-menu')){
									wp_nav_menu(array(
										'theme_location' => 'header-main-menu',
										'container' => '',
										'menu_class' => 'header_main_menu',
										'menu_id' => 'menu-main-navigation',
										'depth' => 3,
										'walker' => new Et_Navigation
									));
								}
							?>
							</nav></div>
						</div>
					</div>
				</div>
			</div>
			<div class="span1">
				<?php dynamic_sidebar( 'social-links' ); ?>
			</div>
		</div>
	</div>
	</header>
	<div class="page-body-content">
	