<?php
/**
 * A view template for a theme-header.
 *
 * @package Wonderpress Theme
 */

?>
<header id="theme-header" class="theme-header">

	<div class="theme-header__logo">
		<?php
		wonder_link(
			array(
				'url' => home_url(),
				'content' => 'Home',
				'title' => 'Return home',
			)
		);
		?>
	</div>

	<nav class="theme-header__nav" role="navigation">
		<ul class="theme-header__nav-list">
			<?php
			$menu_items = wonder_get_menu_array( 'header-menu' );
			foreach ( $menu_items as $menu_item ) {
				?>
			<li class="theme-header__nav-list-item">
				<?php
				wonder_link(
					array(
						'classes' => 'theme-header__nav-list-item-link',
						'content' => $menu_item['title'],
						'url' => $menu_item['url'],
						'title' => $menu_item['title'],
					)
				);

				if ( $menu_item['children'] ) {
					?>
				<ul class="theme-header__nav-list">
					<?php foreach ( $menu_item['children'] as $child_menu_item ) { ?>
					<li class="theme-header__nav-list-item">
						<?php
						wonder_link(
							array(
								'classes' => 'theme-header__nav-list-item-link',
								'content' => $child_menu_item['title'],
								'url' => $child_menu_item['url'],
								'title' => $child_menu_item['title'],
							)
						);
						?>
					</li>
					<?php } ?>
				</ul>
				<?php } ?>
			</li>
			<?php } ?>
		</ul>
	</nav>
</header>
