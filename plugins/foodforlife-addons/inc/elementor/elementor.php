<?php
/**
 * Integrate with Elementor.
 */

namespace FoodForLife\Addons;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

class Elementor {
	/**
	 * Instance
	 *
	 * @access private
	 */
	private static $_instance = null;

	/**
	 * Elementor modules
	 *
	 * @var array
	 */
	public $modules = [];

	/**
	 * Instance
	 *
	 * Ensures only one instance of the class is loaded or can be loaded.
	 *
	 * @return FoodForLife_Addons_Elementor An instance of the class.
	 */
	public static function instance() {
		if ( is_null( self::$_instance ) ) {
			self::$_instance = new self();
		}

		return self::$_instance;
	}

	/**
	 * Constructor
	 */
	public function __construct() {
		spl_autoload_register( [ $this, 'autoload' ] );

		$this->setup_hooks();
		$this->_includes();

		\FoodForLife\Addons\Elementor\Controls\AutoComplete_AjaxLoader::instance();
		\FoodForLife\Addons\Elementor\Page_Settings\Controls::instance();
		\FoodForLife\Addons\Elementor\Page_Settings\Frontend::instance();
		\FoodForLife\Addons\Elementor\Controls\Settings_Layout::instance();
		\FoodForLife\Addons\Elementor\Builder::instance();
		\FoodForLife\Addons\Elementor\Library::instance();
		if ( class_exists( 'Woocommerce' ) ) {
			\FoodForLife\Addons\Elementor\Modules\Shoppable_Images\Module::instance();
			\FoodForLife\Addons\Elementor\Modules\Product_Sale_Meta::instance();
			\FoodForLife\Addons\Elementor\AJAX\Products::instance();
			\FoodForLife\Addons\Elementor\AJAX\Categories::instance();
			\FoodForLife\Addons\Elementor\AJAX\Shoppable_Images::instance();
			\FoodForLife\Addons\Elementor\AJAX\Products_Bundle::instance();
		}

		if ( ! defined( 'ELEMENTOR_PRO_VERSION' ) ) {
			\FoodForLife\Addons\Elementor\Modules\Custom_CSS::instance();
		}
	}

	/**
	 * Auto load widgets
	 */
	public function autoload( $class ) {
		if ( 0 !== strpos( $class, __NAMESPACE__ ) ) {
			return;
		}

		$path = explode( '\\', $class );
		$filename = strtolower( array_pop( $path ) );
		$filename = str_replace( '_', '-', $filename );

		$module = array_pop( $path );

		if ( 'Modules' == $module ) {
			$filename = FOODFORLIFE_ADDONS_DIR . 'inc/elementor/modules/' . $filename . '.php';
		} elseif ( 'Widgets' == $module ) {
			$filename = FOODFORLIFE_ADDONS_DIR . 'inc/elementor/widgets/' . $filename . '.php';
		} elseif ( 'Base' == $module ) {
			$filename = FOODFORLIFE_ADDONS_DIR . 'inc/elementor/base/' . $filename . '.php';
		} elseif ( 'Controls' == $module ) {
			$filename = FOODFORLIFE_ADDONS_DIR . 'inc/elementor/controls/' . $filename . '.php';
		} elseif ( 'Traits' == $module ) {
			$filename = FOODFORLIFE_ADDONS_DIR . 'inc/elementor/widgets/traits/' . $filename . '.php';
		}

		if ( is_readable( $filename ) ) {
			include( $filename );
		}
	}

	/**
	 * Includes files which are not widgets
	 */
	private function _includes() {
		$classes = [
			'FoodForLife\Addons\Elementor\Controls\AjaxLoader'    => FOODFORLIFE_ADDONS_DIR . 'inc/elementor/controls/autocomplete-ajaxloader.php',
			'FoodForLife\Addons\Elementor\Page_Settings\Controls' => FOODFORLIFE_ADDONS_DIR . 'inc/elementor/page-settings/controls.php',
			'FoodForLife\Addons\Elementor\Page_Settings\Frontend' => FOODFORLIFE_ADDONS_DIR . 'inc/elementor/page-settings/frontend.php',
			'FoodForLife\Addons\Elementor\Controls\Settings_Layout' => FOODFORLIFE_ADDONS_DIR . 'inc/elementor/controls/settings_layout.php',
			'FoodForLife\Addons\Elementor\AJAX\Products' => FOODFORLIFE_ADDONS_DIR . 'inc/elementor/ajax/products.php',
			'FoodForLife\Addons\Elementor\AJAX\Categories' => FOODFORLIFE_ADDONS_DIR . 'inc/elementor/ajax/categories.php',
			'FoodForLife\Addons\Elementor\AJAX\Shoppable_Images' => FOODFORLIFE_ADDONS_DIR . 'inc/elementor/ajax/shoppable-images.php',
			'FoodForLife\Addons\Elementor\AJAX\Products_Bundle' => FOODFORLIFE_ADDONS_DIR . 'inc/elementor/ajax/products-bundle.php',
			'FoodForLife\Addons\Elementor\Library'  => FOODFORLIFE_ADDONS_DIR . 'inc/elementor/library/library.php',
			'FoodForLife\Addons\Elementor\Builder'  => FOODFORLIFE_ADDONS_DIR . 'inc/elementor/builder/builder.php',
			'FoodForLife\Addons\Elementor\Modules\Shoppable_Images\Module'  => FOODFORLIFE_ADDONS_DIR . 'inc/elementor/modules/shoppable-images/module.php',
			'FoodForLife\Addons\Elementor\Modules\Product_Sale_Meta'  => FOODFORLIFE_ADDONS_DIR . 'inc/elementor/modules/product-sale-meta.php',
		];

		if ( ! defined( 'ELEMENTOR_PRO_VERSION' ) ) {
			$classes['FoodForLife\Addons\Elementor\Modules\Custom_CSS'] = FOODFORLIFE_ADDONS_DIR . 'inc/elementor/modules/custom-css.php';
		}

		\FoodForLife\Addons\Auto_Loader::register( $classes );
	}

	/**
	 * Hooks to init
	 */
	protected function setup_hooks() {
		add_action( 'elementor/init', [ $this, 'init_modules' ] );

		// Widgets
		add_action( 'elementor/frontend/after_enqueue_styles', [ $this, 'register_styles' ] );

		add_action( 'elementor/frontend/before_enqueue_scripts', [ $this, 'register_scripts' ] );
		add_action( 'elementor/widgets/register', [ $this, 'init_widgets' ] );
		add_action( 'elementor/elements/categories_registered', [ $this, 'add_category' ] );

		// Register controls
		add_action( 'elementor/controls/register', [ $this, 'register_controls' ] );

		if ( ! empty( $_REQUEST['action'] ) && 'elementor' === $_REQUEST['action'] && is_admin() ) {
			add_action( 'init', [ $this, 'register_wc_hooks' ], 5 );
		}
	}

	/**
	 * Register WC hooks for Elementor editor
	 */
	public function register_wc_hooks() {
		if ( function_exists( 'wc' ) ) {
			wc()->frontend_includes();
		}
	}

	/**
	 * Init modules
	 */
	public function init_modules() {
		$this->modules['section-settings'] = \FoodForLife\Addons\Elementor\Modules\Section_Settings::instance();
	}


	/**
	 * Register autocomplete control
	 *
	 * @since 1.0.0
	 *
	 * @return void
	 */
	public function register_controls( $controls_manager ) {
		$controls_manager->register( new \FoodForLife\Addons\Elementor\Controls\AutoComplete() );
	}

	/**
	 * Register styles
	 *
	 * @since 1.0.0
	 *
	 * @return void
	 */
	public function register_styles() {
		$debug = defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ? '' : '.min';

		wp_register_style( 'mapbox', FOODFORLIFE_ADDONS_URL . 'assets/css/mapbox.css', array(), '1.0' );
		wp_register_style( 'mapboxgl', FOODFORLIFE_ADDONS_URL . 'assets/css/mapbox-gl.css', array(), '1.0' );

		wp_register_style( 'magnific',  FOODFORLIFE_ADDONS_URL . 'assets/css/magnific-popup'. $debug . 'css', array(), FOODFORLIFE_ADDONS_VER );
		wp_register_style( 'foodforlife-slides-css',  FOODFORLIFE_ADDONS_URL . 'assets/css/elementor/slides'. $debug . '.css', array(), FOODFORLIFE_ADDONS_VER );
		wp_register_style( 'foodforlife-accordion-css',  FOODFORLIFE_ADDONS_URL . 'assets/css/elementor/accordion'. $debug . '.css', array(), FOODFORLIFE_ADDONS_VER );
		wp_register_style( 'foodforlife-store-locations-css',  FOODFORLIFE_ADDONS_URL . 'assets/css/elementor/store-locations'. $debug . '.css', array(), FOODFORLIFE_ADDONS_VER );
		wp_register_style( 'foodforlife-countdown-css',  FOODFORLIFE_ADDONS_URL . 'assets/css/elementor/countdown'. $debug . '.css', array(), FOODFORLIFE_ADDONS_VER );
		wp_register_style( 'foodforlife-brands-css',  FOODFORLIFE_ADDONS_URL . 'assets/css/elementor/brands'. $debug . '.css', array(), FOODFORLIFE_ADDONS_VER );
		wp_register_style( 'foodforlife-timeline-css',  FOODFORLIFE_ADDONS_URL . 'assets/css/elementor/timeline'. $debug . '.css', array(), FOODFORLIFE_ADDONS_VER );
		wp_register_style( 'foodforlife-navigation-menu-css',  FOODFORLIFE_ADDONS_URL . 'assets/css/elementor/navigation-menu'. $debug . '.css', array(), FOODFORLIFE_ADDONS_VER );
		wp_register_style( 'foodforlife-categories-grid-css',  FOODFORLIFE_ADDONS_URL . 'assets/css/elementor/categories-grid'. $debug . '.css', array(), FOODFORLIFE_ADDONS_VER );
		wp_register_style( 'foodforlife-products-carousel-css',  FOODFORLIFE_ADDONS_URL . 'assets/css/elementor/products-carousel'. $debug . '.css', array(), FOODFORLIFE_ADDONS_VER );
		wp_register_style( 'foodforlife-banner-css',  FOODFORLIFE_ADDONS_URL . 'assets/css/elementor/banner'. $debug . '.css', array(), FOODFORLIFE_ADDONS_VER );
		wp_register_style( 'foodforlife-marquee-css',  FOODFORLIFE_ADDONS_URL . 'assets/css/elementor/marquee'. $debug . '.css', array(), FOODFORLIFE_ADDONS_VER );
		wp_register_style( 'foodforlife-testimonial-carousel-css',  FOODFORLIFE_ADDONS_URL . 'assets/css/elementor/testimonial-carousel'. $debug . '.css', array(), FOODFORLIFE_ADDONS_VER );
		wp_register_style( 'foodforlife-icon-box-css',  FOODFORLIFE_ADDONS_URL . 'assets/css/elementor/icon-box'. $debug . '.css', array(), FOODFORLIFE_ADDONS_VER );
		wp_register_style( 'foodforlife-product-tabs-css',  FOODFORLIFE_ADDONS_URL . 'assets/css/elementor/product-tabs'. $debug . '.css', array(), FOODFORLIFE_ADDONS_VER );
		wp_register_style( 'foodforlife-lookbook-carousel-css',  FOODFORLIFE_ADDONS_URL . 'assets/css/elementor/lookbook-carousel'. $debug . '.css', array(), FOODFORLIFE_ADDONS_VER );

		wp_register_style( 'foodforlife-elementor-css',  FOODFORLIFE_ADDONS_URL . 'assets/css/elementor/elementor'. $debug . '.css', array(), FOODFORLIFE_ADDONS_VER );
	}

	/**
	 * Register styles
	 */
	public function register_scripts() {
		$debug = defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ? '' : '.min';
		wp_register_script( 'foodforlife-image-slide', FOODFORLIFE_ADDONS_URL . 'assets/js/image-slide.js', ['jquery'], FOODFORLIFE_ADDONS_VER, true );
		wp_register_script( 'foodforlife-eventmove', FOODFORLIFE_ADDONS_URL . 'assets/js/jquery.event.move.js', ['jquery'], FOODFORLIFE_ADDONS_VER, true );

		wp_register_script( 'mapbox', FOODFORLIFE_ADDONS_URL  . 'assets/js/mapbox.min.js', array(), '1.0', true );
		wp_register_script( 'mapboxgl', FOODFORLIFE_ADDONS_URL  . 'assets/js/mapbox-gl.min.js', array(), '1.0', true );
		wp_register_script( 'mapbox-sdk', FOODFORLIFE_ADDONS_URL  . 'assets/js/mapbox-sdk.min.js', array(), '1.0', true );

		wp_register_script( 'foodforlife-counter-widget', FOODFORLIFE_ADDONS_URL . 'assets/js/elementor/counter'. $debug . '.js', ['jquery', 'underscore', 'elementor-frontend', 'regenerator-runtime'], FOODFORLIFE_ADDONS_VER, true );
		wp_register_script( 'foodforlife-contact-form-widget', FOODFORLIFE_ADDONS_URL . 'assets/js/elementor/contact-form'. $debug . '.js', ['jquery', 'underscore', 'elementor-frontend', 'regenerator-runtime'], FOODFORLIFE_ADDONS_VER, true );
		wp_register_script( 'foodforlife-accordion-widget', FOODFORLIFE_ADDONS_URL . 'assets/js/elementor/accordion'. $debug . '.js', ['jquery', 'underscore', 'elementor-frontend', 'regenerator-runtime'], FOODFORLIFE_ADDONS_VER, true );
		wp_register_script( 'foodforlife-store-locations-widget', FOODFORLIFE_ADDONS_URL . 'assets/js/elementor/store-locations'. $debug . '.js', ['jquery', 'underscore', 'elementor-frontend', 'regenerator-runtime'], FOODFORLIFE_ADDONS_VER, true );
		wp_register_script( 'foodforlife-countdown-widget', FOODFORLIFE_ADDONS_URL . 'assets/js/elementor/countdown'. $debug . '.js', ['jquery', 'underscore', 'elementor-frontend', 'regenerator-runtime'], FOODFORLIFE_ADDONS_VER, true );
		wp_register_script( 'foodforlife-brands-widget', FOODFORLIFE_ADDONS_URL . 'assets/js/elementor/brands'. $debug . '.js', ['jquery', 'underscore', 'elementor-frontend', 'regenerator-runtime'], FOODFORLIFE_ADDONS_VER, true );

		if ( get_option( 'foodforlife_recently_viewed_enable', 'yes' ) === 'yes' ) {
			wp_register_script( 'foodforlife-product-recently-viewed-widget', FOODFORLIFE_ADDONS_URL . 'assets/js/elementor/product-recently-viewed'. $debug . '.js', ['jquery', 'underscore', 'elementor-frontend', 'regenerator-runtime'], FOODFORLIFE_ADDONS_VER, true );
		}
	
		wp_register_script( 'foodforlife-products-carousel-widget', FOODFORLIFE_ADDONS_URL . 'assets/js/elementor/products-carousel'. $debug . '.js', ['jquery', 'underscore', 'elementor-frontend', 'regenerator-runtime'], FOODFORLIFE_ADDONS_VER, true );
		wp_register_script( 'foodforlife-categories-grid-widget', FOODFORLIFE_ADDONS_URL . 'assets/js/elementor/categories-grid'. $debug . '.js', ['jquery', 'underscore', 'elementor-frontend', 'regenerator-runtime'], FOODFORLIFE_ADDONS_VER, true );
		wp_register_script( 'foodforlife-subscribe-form-widget', FOODFORLIFE_ADDONS_URL . 'assets/js/elementor/subscribe-form'. $debug . '.js', ['jquery', 'underscore', 'elementor-frontend', 'regenerator-runtime'], FOODFORLIFE_ADDONS_VER, true );
		wp_register_script( 'foodforlife-banner-widget', FOODFORLIFE_ADDONS_URL . 'assets/js/elementor/banner'. $debug . '.js', ['jquery', 'underscore', 'elementor-frontend', 'regenerator-runtime'], FOODFORLIFE_ADDONS_VER, true );
		wp_register_script( 'foodforlife-marquee-widget', FOODFORLIFE_ADDONS_URL . 'assets/js/elementor/marquee'. $debug . '.js', ['jquery', 'underscore', 'elementor-frontend', 'regenerator-runtime'], FOODFORLIFE_ADDONS_VER, true );
		wp_register_script( 'foodforlife-shoppable-images-widget', FOODFORLIFE_ADDONS_URL . 'assets/js/elementor/shoppable-images'. $debug . '.js', ['jquery', 'underscore', 'elementor-frontend', 'regenerator-runtime'], FOODFORLIFE_ADDONS_VER, true );
		wp_register_script( 'foodforlife-product-tabs-widget', FOODFORLIFE_ADDONS_URL . 'assets/js/elementor/product-tabs'. $debug . '.js', ['jquery', 'underscore', 'elementor-frontend', 'regenerator-runtime'], FOODFORLIFE_ADDONS_VER, true );
		wp_register_script( 'foodforlife-product-grid-widget', FOODFORLIFE_ADDONS_URL . 'assets/js/elementor/product-grid'. $debug . '.js', ['jquery', 'underscore', 'elementor-frontend', 'regenerator-runtime'], FOODFORLIFE_ADDONS_VER, true );
		wp_register_script( 'foodforlife-shoppable-video-widget', FOODFORLIFE_ADDONS_URL . 'assets/js/elementor/shoppable-video'. $debug . '.js', ['jquery', 'underscore', 'elementor-frontend', 'regenerator-runtime'], FOODFORLIFE_ADDONS_VER, true );

		wp_register_script( 'foodforlife-elementor-widgets', FOODFORLIFE_ADDONS_URL . 'assets/js/elementor/elementor-widgets'. $debug . '.js', ['jquery', 'underscore', 'elementor-frontend', 'regenerator-runtime'], FOODFORLIFE_ADDONS_VER, true );
	}


	/**
	 * Init Widgets
	 */
	public function init_widgets() {
		$widgets_manager = \Elementor\Plugin::instance()->widgets_manager;

		$widgets_manager->register( new \FoodForLife\Addons\Elementor\Widgets\Heading() );
		$widgets_manager->register( new \FoodForLife\Addons\Elementor\Widgets\Button() );
		$widgets_manager->register( new \FoodForLife\Addons\Elementor\Widgets\Counter() );
		$widgets_manager->register( new \FoodForLife\Addons\Elementor\Widgets\Image_Box() );
		$widgets_manager->register( new \FoodForLife\Addons\Elementor\Widgets\Contact_Form() );
		$widgets_manager->register( new \FoodForLife\Addons\Elementor\Widgets\Accordion() );
		$widgets_manager->register( new \FoodForLife\Addons\Elementor\Widgets\Store_Locations() );
		$widgets_manager->register( new \FoodForLife\Addons\Elementor\Widgets\Subscribe_Box() );
		$widgets_manager->register( new \FoodForLife\Addons\Elementor\Widgets\Social_Icons() );
		$widgets_manager->register( new \FoodForLife\Addons\Elementor\Widgets\Countdown() );
		$widgets_manager->register( new \FoodForLife\Addons\Elementor\Widgets\Timeline() );
		$widgets_manager->register( new \FoodForLife\Addons\Elementor\Widgets\Navigation_Menu() );
		$widgets_manager->register( new \FoodForLife\Addons\Elementor\Widgets\Subscribe_Group() );
		$widgets_manager->register( new \FoodForLife\Addons\Elementor\Widgets\Slides() );
		$widgets_manager->register( new \FoodForLife\Addons\Elementor\Widgets\Banner() );
		$widgets_manager->register( new \FoodForLife\Addons\Elementor\Widgets\Marquee() );
		$widgets_manager->register( new \FoodForLife\Addons\Elementor\Widgets\Dismiss_Popup_Button() );
		$widgets_manager->register( new \FoodForLife\Addons\Elementor\Widgets\Code_Discount() );
		$widgets_manager->register( new \FoodForLife\Addons\Elementor\Widgets\Short_Content() );
		$widgets_manager->register( new \FoodForLife\Addons\Elementor\Widgets\Icon_Box() );
		$widgets_manager->register( new \FoodForLife\Addons\Elementor\Widgets\Icon_Box_Carousel() );
		$widgets_manager->register( new \FoodForLife\Addons\Elementor\Widgets\Promo_Card() );
		$widgets_manager->register( new \FoodForLife\Addons\Elementor\Widgets\Banner_Carousel() );
		$widgets_manager->register( new \FoodForLife\Addons\Elementor\Widgets\Tiktok_Video_Carousel() );
		$widgets_manager->register( new \FoodForLife\Addons\Elementor\Widgets\Posts_Carousel() );
		$widgets_manager->register( new \FoodForLife\Addons\Elementor\Widgets\Image_Carousel() );
		$widgets_manager->register( new \FoodForLife\Addons\Elementor\Widgets\Image_Box_Carousel() );
		$widgets_manager->register( new \FoodForLife\Addons\Elementor\Widgets\Image_Before_After() );
		$widgets_manager->register( new \FoodForLife\Addons\Elementor\Widgets\Content_Preview_Tabs() );
		$widgets_manager->register( new \FoodForLife\Addons\Elementor\Widgets\Navigation_Bar_Item() );
		$widgets_manager->register( new \FoodForLife\Addons\Elementor\Widgets\FoodForLife_Widget_Image() );
		$widgets_manager->register( new \FoodForLife\Addons\Elementor\Widgets\Split_Hero_Slider() );

		if ( class_exists( 'Woocommerce' ) ) {
			$widgets_manager->register( new \FoodForLife\Addons\Elementor\Widgets\Brands() );
			$widgets_manager->register( new \FoodForLife\Addons\Elementor\Widgets\Currencies() );
			$widgets_manager->register( new \FoodForLife\Addons\Elementor\Widgets\Languages() );
			$widgets_manager->register( new \FoodForLife\Addons\Elementor\Widgets\Categories_Grid() );
			$widgets_manager->register( new \FoodForLife\Addons\Elementor\Widgets\Categories_Carousel() );
			$widgets_manager->register( new \FoodForLife\Addons\Elementor\Widgets\Products_Carousel() );
			$widgets_manager->register( new \FoodForLife\Addons\Elementor\Widgets\Banner_Products() );
			$widgets_manager->register( new \FoodForLife\Addons\Elementor\Widgets\Testimonial_Carousel() );
			$widgets_manager->register( new \FoodForLife\Addons\Elementor\Widgets\Testimonial_Carousel_2() );
			$widgets_manager->register( new \FoodForLife\Addons\Elementor\Widgets\Shoppable_Images() );
			$widgets_manager->register( new \FoodForLife\Addons\Elementor\Widgets\Shoppable_Images_Carousel() );
			$widgets_manager->register( new \FoodForLife\Addons\Elementor\Widgets\Product_List() );
			$widgets_manager->register( new \FoodForLife\Addons\Elementor\Widgets\Product_Tabs() );
			$widgets_manager->register( new \FoodForLife\Addons\Elementor\Widgets\Product_Tabs_Carousel() );
			$widgets_manager->register( new \FoodForLife\Addons\Elementor\Widgets\Products_Bundle() );
			$widgets_manager->register( new \FoodForLife\Addons\Elementor\Widgets\Lookbook_Carousel() );
			$widgets_manager->register( new \FoodForLife\Addons\Elementor\Widgets\Product_Sale_Tabs() );
			$widgets_manager->register( new \FoodForLife\Addons\Elementor\Widgets\Product_Grid() );
			$widgets_manager->register( new \FoodForLife\Addons\Elementor\Widgets\Product_Showcase() );
			$widgets_manager->register( new \FoodForLife\Addons\Elementor\Widgets\Shoppable_Video_Carousel() );
			$widgets_manager->register( new \FoodForLife\Addons\Elementor\Widgets\Lookbook_Products() );
			$widgets_manager->register( new \FoodForLife\Addons\Elementor\Widgets\Product_Deals_Carousel() );
			$widgets_manager->register( new \FoodForLife\Addons\Elementor\Widgets\Product_Highlight_Slider() );
			$widgets_manager->register( new \FoodForLife\Addons\Elementor\Widgets\Product_Spotlight_Grid() );

			if ( get_option( 'foodforlife_recently_viewed_enable', 'yes' ) === 'yes' ) {
				$widgets_manager->register( new \FoodForLife\Addons\Elementor\Widgets\Product_Recently_Viewed() );
				$widgets_manager->register( new \FoodForLife\Addons\Elementor\Widgets\Product_Recently_Viewed_Carousel() );
			}

		}

	}

	/**
	 * Add FoodForLife category
	 */
	public function add_category( $elements_manager ) {
		$elements_manager->add_category(
			'foodforlife-addons',
			[
				'title' => __( 'FoodForLife', 'foodforlife-addons' )
			]
		);

		$elements_manager->add_category(
			'foodforlife-addons-footer',
			[
				'title' => __( 'FoodForLife Footer', 'foodforlife-addons' )
			]
		);

		$elements_manager->add_category(
			'foodforlife-addons-navigation',
			[
				'title' => __( 'FoodForLife Navigation', 'foodforlife-addons' )
			]
		);

		$elements_manager->add_category(
			'foodforlife-addons-popup',
			[
				'title' => __( 'FoodForLife Popup', 'foodforlife-addons' )
			]
		);
	}
}