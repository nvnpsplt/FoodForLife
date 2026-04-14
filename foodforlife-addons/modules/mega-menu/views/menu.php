<div class="megamenu-modal__menu">
	<# if ( data.depth == 0 ) { #>
		<a href="#" class="media-menu-item {{ data.current === 'mega' ? 'active' : '' }}" data-panel="mega" data-title="<?php esc_attr_e( 'Mega Menu', 'foodforlife-addons' ) ?>"><?php esc_html_e( 'Mega Menu', 'foodforlife-addons' ) ?></a>
		<a href="#" class="media-menu-item {{ data.current === 'design' ? 'active' : '' }}" data-panel="design" data-title="<?php esc_attr_e( 'Mega Menu Design', 'foodforlife-addons' ) ?>"><?php esc_html_e( 'Design', 'foodforlife-addons' ) ?></a>
		<a href="#" class="media-menu-item {{ data.current === 'badges' ? 'active' : '' }}" data-panel="badges" data-title="<?php esc_attr_e( 'Badges', 'foodforlife-addons' ) ?>"><?php esc_html_e( 'Badges', 'foodforlife-addons' ) ?></a>
	<# } else if ( data.depth == 1 ) { #>
		<a href="#" class="media-menu-item {{ data.current === 'settings' ? 'active' : '' }}" data-panel="settings" data-title="<?php esc_attr_e( 'Menu Setting', 'foodforlife-addons' ) ?>"><?php esc_html_e( 'Settings', 'foodforlife-addons' ) ?></a>
		<a href="#" class="media-menu-item {{ data.current === 'content' ? 'active' : '' }}" data-panel="content" data-title="<?php esc_attr_e( 'Menu Content', 'foodforlife-addons' ) ?>"><?php esc_html_e( 'Content', 'foodforlife-addons' ) ?></a>
		<a href="#" class="media-menu-item {{ data.current === 'design' ? 'active' : '' }}" data-panel="design" data-title="<?php esc_attr_e( 'Mega Column Design', 'foodforlife-addons' ) ?>"><?php esc_html_e( 'Design', 'foodforlife-addons' ) ?></a>
	<# } else { #>
		<a href="#" class="media-menu-item {{ data.current === 'content' ? 'active' : '' }}" data-panel="content" data-title="<?php esc_attr_e( 'Menu Content', 'foodforlife-addons' ) ?>"><?php esc_html_e( 'Content', 'foodforlife-addons' ) ?></a>
	<# } #>
	<a href="#" class="media-menu-item {{ data.current === 'icon' ? 'active' : '' }}" data-panel="icon" data-title="<?php esc_attr_e( 'Menu Icon', 'foodforlife-addons' ) ?>"><?php esc_html_e( 'Icon', 'foodforlife-addons' ) ?></a>
</div>