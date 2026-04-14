<?php
namespace FoodForLife\Addons\Elementor\Builder\Widgets;

use Elementor\Controls_Manager;
use Elementor\Widget_Base;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Box_Shadow;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

class Product_Share extends Widget_Base {
	use \FoodForLife\Addons\Elementor\Builder\Traits\Product_Id_Trait;

	public function get_name() {
		return 'foodforlife-product-share';
	}

	public function get_title() {
		return esc_html__( '[FoodForLife] Product Share', 'foodforlife-addons' );
	}

	public function get_icon() {
		return 'eicon-share';
	}

	public function get_keywords() {
		return [ 'woocommerce', 'shop', 'social', 'share', 'product' ];
	}

	public function get_categories() {
		return [ 'foodforlife-addons-product' ];
	}

	protected function register_controls() {
		$this->start_controls_section(
			'section_content_settings',
			[
				'label' => __( 'Content', 'foodforlife-addons' ),
			]
		);

		$this->add_control(
			'icon',
			[
				'label' => __( 'Icon', 'foodforlife-addons' ),
				'type' => Controls_Manager::ICONS,
			]
		);

		$this->add_control(
			'text',
			[
				'label' => __( 'Text', 'foodforlife-addons' ),
				'type' => Controls_Manager::TEXT,
				'placeholder' => __( 'Share', 'foodforlife-addons' ),
				'label_block' => true,
			]
		);

		$this->add_control(
			'socials',
			[
				'label' => esc_html__( 'Select socials', 'foodforlife-addons' ),
				'type' => Controls_Manager::SELECT2,
				'label_block' => true,
				'multiple' => true,
				'options' => [
					'facebook'    => esc_html__( 'Facebook', 'foodforlife-addons' ),
					'twitter'     => esc_html__( 'Twitter', 'foodforlife-addons' ),
					'googleplus'  => esc_html__( 'Google Plus', 'foodforlife-addons' ),
					'pinterest'   => esc_html__( 'Pinterest', 'foodforlife-addons' ),
					'tumblr'      => esc_html__( 'Tumblr', 'foodforlife-addons' ),
					'reddit'      => esc_html__( 'Reddit', 'foodforlife-addons' ),
					'linkedin'    => esc_html__( 'Linkedin', 'foodforlife-addons' ),
					'stumbleupon' => esc_html__( 'StumbleUpon', 'foodforlife-addons' ),
					'digg'        => esc_html__( 'Digg', 'foodforlife-addons' ),
					'telegram'    => esc_html__( 'Telegram', 'foodforlife-addons' ),
					'whatsapp'    => esc_html__( 'WhatsApp', 'foodforlife-addons' ),
					'vk'          => esc_html__( 'VK', 'foodforlife-addons' ),
					'email'       => esc_html__( 'Email', 'foodforlife-addons' ),
				],
				'default' => [ 'facebook', 'twitter', 'tumblr', 'whatsapp', 'email' ],
				'separator' => 'before',
			]
		);

		$this->add_control(
			'whatsapp_number',
			[
				'label' => esc_html__( 'WhatsApp Phone Number', 'foodforlife-addons' ),
				'type' => Controls_Manager::TEXT,
				'label_block' => true,
				'conditions' => [
					'terms' => [
						[
							'name' => 'socials',
							'operator' => 'contains',
							'value' => 'whatsapp',
						],
					],
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_product_style',
			[
				'label' => esc_html__( 'Style', 'foodforlife-addons' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'icon_color',
			[
				'label' => esc_html__( 'Icon Color', 'foodforlife-addons' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .foodforlife-extra-link-item .foodforlife-svg-icon' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'icon_size',
			[
				'label' => esc_html__( 'Icon Size', 'foodforlife-addons' ),
				'type' => Controls_Manager::SLIDER,
				'default' => [
					'unit' => 'px',
				],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .foodforlife-extra-link-item .foodforlife-svg-icon' => 'font-size: {{SIZE}}{{UNIT}}',
				],
			]
		);

		$this->add_control(
			'icon_spacing',
			[
				'label' => esc_html__( 'Icon Spacing', 'foodforlife-addons' ),
				'type' => Controls_Manager::SLIDER,
				'default' => [
					'unit' => 'px',
				],
				'selectors' => [
					'{{WRAPPER}} .foodforlife-extra-link-item' => 'gap: {{SIZE}}{{UNIT}}',
				],
			]
		);

		$this->add_control(
			'link_heading',
			[
				'label' => esc_html__( 'Link', 'foodforlife-addons' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'text_typography',
				'selector' => '{{WRAPPER}} .foodforlife-extra-link-item',
			]
		);

		$this->add_control(
			'link_color',
			[
				'label' => esc_html__( 'Link Color', 'foodforlife-addons' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .foodforlife-extra-link-item' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'link_hover_color',
			[
				'label' => esc_html__( 'Hover Link Color', 'foodforlife-addons' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .foodforlife-extra-link-item:hover' => 'color: {{VALUE}}',
				],
			]
		);

		$this->end_controls_section();
	}

	protected function render() {
		$settings = $this->get_settings_for_display();
		global $product;

		$product = $this->get_product();

		if ( ! $product ) {
			return;
		}

		if ( \FoodForLife\Addons\Elementor\Builder\Helper::is_elementor_editor_mode() ) {
			$this->get_product_share_button( $settings );
		} else {
			if( ! empty( $settings['socials'] ) ) {
				$this->get_product_share_button( $settings );
			}
		}

		if( ! empty( $settings['socials'] ) ) {
			add_action( 'wp_footer', [ $this, 'product_share_content' ], 40 );
		}
	}

	public function get_product_share_button( $settings ) {
		echo '<div class="foodforlife-product-extra-link">';
			echo '<a href="#" class="foodforlife-extra-link-item foodforlife-extra-link-item--share d-inline-flex align-items-center gap-10 lh-normal text-base text-hover-color" data-toggle="modal" data-target="product-share-modal-'. esc_attr( $this->get_id() ) .'">';
				if( ! empty( $settings['icon']['value'] ) ) {
					echo '<span class="foodforlife-svg-icon foodforlife-svg-icon--share">' . \Elementor\Icons_Manager::try_get_icon_html( $settings['icon'], [ 'aria-hidden' => 'true' ] ) . '</span>';
				} else {
					echo \FoodForLife\Addons\Helper::get_svg( 'share' );
				}

				if( ! empty( $settings['text'] ) ) {
					echo esc_html( $settings['text'] );
				} else {
					echo esc_html__( 'Share', 'foodforlife' );
				}
			echo '</a>';
		echo '</div>';
	}

	/**
	 * Product Share content
	 */
	public function product_share_content() {
		$settings = $this->get_settings_for_display();
		if( empty( $settings['socials'] ) ) {
			return;
		}

		?>
		<div class="product-share-modal modal product-extra-link-modal" data-id="product-share-modal-<?php echo esc_attr( $this->get_id() ); ?>">
			<div class="modal__backdrop"></div>
			<div class="modal__container">
				<div class="modal__wrapper">
					<div class="modal__header">
						<h3 class="modal__title h5"><?php esc_html_e( 'Copy link', 'foodforlife' ); ?></h3>
						<a href="#" class="modal__button-close">
							<?php echo \FoodForLife\Addons\Helper::get_svg( 'close', 'ui' ); ?>
						</a>
					</div>
					<div class="modal__content">
						<div class="product-share__copylink">
							<form class="ffl-responsive d-flex align-items-center gap-10 mb-20">
								<input class="product-share__copylink--link foodforlife-copylink__link flex-1" type="text" value="<?php echo esc_url( get_permalink( get_the_ID() ) ); ?>" readonly="readonly" />
								<button class="product-share__copylink--button foodforlife-copylink__button ffl-button ffl-button-icon" data-icon="<?php echo esc_attr( \FoodForLife\Addons\Helper::get_svg( 'copy' ) ); ?>" data-icon_copied="<?php echo esc_attr( \FoodForLife\Addons\Helper::inline_svg( ['icon' => 'check', 'class' => 'has-vertical-align'] ) ); ?>"><?php echo \FoodForLife\Addons\Helper::get_svg( 'copy' ); ?></button>
							</form>
						</div>
						<div class="product-share__share">
							<div class="product-share__copylink-heading h6 mb-15 mt-0"><?php echo esc_html__( 'Share', 'foodforlife' ); ?></div>
							<?php echo ! empty( $this->share_socials( $settings['socials'], $settings['whatsapp_number'] ) ) ? $this->share_socials( $settings['socials'], $settings['whatsapp_number'] ) : '' ; ?>
						</div>
					</div>
				</div>
			</div>
			<span class="modal__loader"><span class="foodforlifeSpinner"></span></span>
		</div>
		<?php
	}

	/**
	 * Button Share
	 *
	 * @since 1.0.0
	 *
	 * @return void
	 */
	public function share_socials( $socials, $whatsapp_number ) {
		if ( ! class_exists( '\FoodForLife\Addons\Helper' ) && ! method_exists( '\FoodForLife\Addons\Helper','share_link' )) {
			return;
		}

		$args = array();
		if ( ( ! empty( $socials ) ) ) {
			$output = array();

			foreach ( $socials as $social => $value ) {
				if( $value == 'whatsapp' ) {
					$args['whatsapp_number'] = $whatsapp_number;
				}

				if( $value == 'facebook' ) {
					$args[$value]['icon'] = 'facebook-f';
				}

				$output[] = \FoodForLife\Addons\Helper::share_link( $value, $args, false );
			}

			return sprintf( '<ul class="post__socials-share d-flex align-items-center flex-wrap gap-10 my-0 py-0 list-unstyled">%s</ul>', implode( '', $output )	);
		};
	}
}
