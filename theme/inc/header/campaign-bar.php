<?php
/**
 * Campaign Bar functions and definitions.
 *
 * @package FoodForLife
 */

namespace FoodForLife\Header;

use FoodForLife\Helper;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Campaign Bar initial
 *
 */
class Campaign_Bar {

	/**
	 * Countdown time
	 *
	 * @var $countdown_time
	 */
	protected static $countdown_time = null;
	/**
	 * Instantiate the object.
	 *
	 * @since 1.0.0
	 *
	 * @return void
	 */
	public function __construct() {
	}

	/**
	 * Display campaign bar item.
	 *
	 * @since 1.0.0
	 *
	 * @param array $items
	 */
	public static function content( $type ) {
		if( $type == 'countdown' ) {
			self::countdown();
		} elseif( $type == 'slides' ) {
			self::slides();
		}
	}

	/**
	 * Display campaign bar item.
	 *
	 * @since 1.0.0
	 *
	 * @param array $items
	 */
	public static function slides() {
		$items = (array) \FoodForLife\Helper::get_option( 'campaign_items' );

		if( empty( $items) ) {
			return;
		}

		$args_swiper = array(
			'slidesPerView' => array(
				'desktop' => 1,
				'tablet' => 1,
				'mobile' => 1,
			),
			'spaceBetween' => array(
				'desktop' => 15,
				'tablet' => 15,
				'mobile' => 15,
			),
			'loop' => true,
			'autoplay' => true,
			'speed' => 400,
		);

		echo '<div class="campaign-bar__container foodforlife-swiper swiper h-100 w-100" data-swiper="'. esc_attr( json_encode( $args_swiper ) ) .'" data-desktop="1" data-tablet="1" data-mobile="1">';
		echo '<div class="campaign-bar__items swiper-wrapper align-items-center text-center">';

		foreach ( $items as $id => $item ) {
			$args = wp_parse_args( $item, array(
				'text'   => '',
			) );

			$args = apply_filters( 'foodforlife_campaign_item_args', $args, $id );

			echo '<div class="campaign-bar__item swiper-slide">';
				echo '<div class="campaign-bar__text w-100 fs-13 px-20">'. wp_kses_post( $args['text'] ) . '</div>';
			echo '</div>';
		}

		echo '</div>';
		echo \FoodForLife\Icon::get_svg( 'left-mini', 'ui', 'class=swiper-button-text swiper-button-prev z-3' );
		echo \FoodForLife\Icon::get_svg( 'right-mini', 'ui', 'class=swiper-button-text swiper-button-next z-3' );
		echo '</div>';
	}

	public static function countdown() {
		$expire = self::get_countdown_time();
		$now  = strtotime( current_time( 'Y-m-d H:i:s' ) );
		$expire = strtotime( \FoodForLife\Helper::get_option( 'campaign_date' ) );
		$expire = $expire > $now ? $expire - $now : 0;
		$expire = apply_filters( 'foodforlife_countdown_campaign_expire', $expire );

		if( empty( $expire ) ) {
			return;
		}

		$image = \FoodForLife\Helper::get_option( 'campaign_image' );
		$text = \FoodForLife\Helper::get_option( 'campaign_text' );
		$times = array(
			'weeks'    	=> esc_html__( 'weeks', 'foodforlife' ),
			'week'    	=> esc_html__( 'week', 'foodforlife' ),
			'days'    	=> esc_html__( 'days', 'foodforlife' ),
			'day'    	=> esc_html__( 'day', 'foodforlife' ),
			'hours'   	=> esc_html__( 'hours', 'foodforlife' ),
			'hour'   	=> esc_html__( 'hour', 'foodforlife' ),
			'minutes' 	=> esc_html__( 'mins', 'foodforlife' ),
			'minute' 	=> esc_html__( 'min', 'foodforlife' ),
			'seconds' 	=> esc_html__( 'secs', 'foodforlife' ),
			'second' 	=> esc_html__( 'sec', 'foodforlife' )
		);

		$image = ! empty( $image ) ? '<img src="'. esc_url( $image ) .'" alt="'. esc_attr__( 'Campaign Image', 'foodforlife' ) .'">' : '';

		echo '<div class="campaign-bar__countdown d-flex flex-wrap align-items-center justify-content-center column-gap-5 row-gap-3 text-center fs-13">';
			echo '<div class="campaign-bar__text lh-normal">' . $image . $text . '</div>';
			echo "<div class='campaign-bar__countdown foodforlife-countdown d-inline-flex fw-medium lh-1' data-expire='". esc_attr( $expire ) ."' data-text='". esc_attr( wp_json_encode( $times ) ) ."'></div>";
		echo '</div>';
	}

	public static function get_countdown_time() {
		if( isset( self::$countdown_time ) ) {
			return self::$countdown_time;
		}
		$now  = strtotime( current_time( 'Y-m-d H:i:s' ) );
		$expire = strtotime( \FoodForLife\Helper::get_option( 'campaign_date' ) );
		$expire = $expire > $now ? $expire - $now : 0;
		self::$countdown_time = apply_filters( 'foodforlife_countdown_shortcode_second', $expire );
		return self::$countdown_time;
	}

}
