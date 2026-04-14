# FoodForLife — WooCommerce Theme Ecosystem

A premium WooCommerce theme by **ResilByte** with 32 demo layouts, Elementor integration, and a one-click demo importer.

## Repository Structure

```
├── theme/                        # WordPress Theme (wp-content/themes/foodforlife/)
│   ├── functions.php
│   ├── style.css
│   ├── inc/                      # Core PHP classes
│   ├── assets/                   # CSS, JS, fonts
│   ├── woocommerce/              # WooCommerce template overrides
│   └── template-parts/           # Template partials
│
├── plugins/                      # WordPress Plugins (wp-content/plugins/)
│   ├── foodforlife-addons/       # Elementor widgets, product tabs, addons
│   └── foodforlife-demo-importer/  # One-click demo import engine
│
├── importer/                     # Demo Content (served via GitHub raw URLs)
│   ├── demo-content/             # 32 demo packages (XML, widgets, customizer, previews)
│   ├── library/                  # Elementor template library
│   └── library-woo/              # WooCommerce template library
│
└── .gitignore
```

## Installation

### Theme
Copy the `theme/` folder to `wp-content/themes/foodforlife/`.

### Plugins
Copy each plugin folder from `plugins/` to `wp-content/plugins/`:
- `foodforlife-addons/`
- `foodforlife-demo-importer/`

### Demo Import
Activate the theme and both plugins, then go to **FoodForLife → Import Demo Data** in WP Admin.

## Requirements

- WordPress 6.0+
- WooCommerce 8.0+
- PHP 7.4+
- Elementor (recommended)
