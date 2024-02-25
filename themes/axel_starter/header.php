<?php

/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Axel_Starter_Theme
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>

<head>
	<meta charset="<?php bloginfo('charset'); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
	<?php wp_body_open(); ?>
	<header id="master-head" class="site-header">
		<div class="container">
			<nav class="navbar navbar-expand-lg">
				<div class="container-fluid">
					<a class="navbar-brand" href="/">AxelStarter</a>
					<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
						<span class="navbar-toggler-icon"></span>
					</button>

					<?php $menuItems = axel_starter_get_menu_items('menu-1'); ?>
					<div class="collapse navbar-collapse" id="navbarSupportedContent">
						<ul class="navbar-nav me-auto mb-2 mb-lg-0">

							<?php foreach ($menuItems as $menuItem) : ?>
								<?php if (!isset($menuItem['subitems'])) : ?>
									<li class="nav-item">
										<a class="nav-link" aria-current="page" href="<?php echo $menuItem['item']->url; ?>" target="<?php echo $menuItem['item']->target; ?>">
											<?php echo $menuItem['item']->title; ?>
										</a>
									</li>
								<?php else : ?>
									<li class=" nav-item dropdown">
										<a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
											<?php echo $menuItem['item']->title; ?>
										</a>
										<ul class="dropdown-menu">
											<?php foreach ($menuItem['subitems'] as $subItem) : ?>
												<li>
													<a class="dropdown-item" href="<?php echo $subItem->url; ?>" target="<?php echo $subItem->target; ?>">
														<?php echo $subItem->title; ?>
													</a>
												</li>
											<?php endforeach; ?>
										</ul>
									</li>
								<?php endif; ?>
							<?php endforeach; ?>
						</ul>

						<form class="d-flex" role="search">
							<input class="form-control me-2" type="search" placeholder="Search" aria-label="Search" name="q">
							<button class="btn btn-outline-success" type="submit">Search</button>
						</form>
					</div>
				</div>
			</nav>
		</div>
	</header><!-- #master-head -->