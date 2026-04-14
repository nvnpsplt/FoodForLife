<?php
namespace FoodForLife\Addons\Elementor\Widgets;

use FoodForLife\Addons\Elementor\Base\Carousel_Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Typography;
use Elementor\Utils;
use Elementor\Icons_Manager;
use FoodForLife\Addons\Helper;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Elementor Testimonial Carousel widget.
 *
 * Elementor widget that displays an eye-catching headlines.
 *
 * @since 1.0.0
 */
class Testimonial_Carousel_2 extends Carousel_Widget_Base {
	use \FoodForLife\Addons\Elementor\Base\Video_Base;
	use \FoodForLife\Addons\Elementor\Base\Aspect_Ratio_Base;

	/**
	 * Get widget name.
	 *
	 * Retrieve Image Box widget name.
	 *
	 * @return string Widget name.
	 */
	public function get_name() {
		return 'foodforlife-testimonial-carousel-2';
	}

	/**
	 * Get widget title
	 *
	 * Retrieve Image Box widget title
	 *
	 * @return string Widget title
	 */
	public function get_title() {
		return __( '[FoodForLife] Testimonial Carousel 2', 'foodforlife-addons' );
	}

	/**
	 * Get widget icon
	 *
	 * Retrieve Image Box widget icon
	 *
	 * @return string Widget icon
	 */
	public function get_icon() {
		return 'eicon-testimonial-carousel';
	}

	/**
	 * Get widget categories
	 *
	 * Retrieve the list of categories the widget belongs to.
	 *
	 * @return string Widget categories
	 */
	public function get_categories() {
		return [ 'foodforlife-addons' ];
	}

	/**
	 * Get widget keywords.
	 * Retrieve the list of keywords the widget belongs to.
	 *
	 * @return array Widget keywords.
	 */
	public function get_keywords() {
		return [ 'testimonial carousel', 'carousel', 'testimonial', 'foodforlife' ];
	}

	/**
	 * Scripts
	 *
	 * @return void
	 */
	public function get_script_depends() {
		return [
			'foodforlife-elementor-widgets'
		];
	}

	/**
	 * Get style depends
	 *
	 * @return array
	 */
	public function get_style_depends() {
		return [
			'foodforlife-elementor-css',
			'foodforlife-testimonial-carousel-css'
		];
	}

	/**
	 * Register heading widget controls.
	 * Adds different input fields to allow the user to change and customize the widget settings.
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function register_controls() {
		$this->section_content();
		$this->section_style();
	}

	// Tab Content
	protected function section_content() {
		$this->start_controls_section(
			'section_content',
			[
				'label' => __( 'Content', 'foodforlife-addons' ),
			]
		);

		$repeater = new \Elementor\Repeater();

		$repeater->add_control(
			'testimonial_rating',
			[
				'label'   => esc_html__( 'Rating', 'foodforlife-addons' ),
				'type'    => Controls_Manager::SELECT,
				'options' => [
					'0'    => __( 'None', 'foodforlife-addons' ),
					'1'    => __( '1 Star', 'foodforlife-addons' ),
					'2'    => __( '2 Stars', 'foodforlife-addons' ),
					'3'    => __( '3 Stars', 'foodforlife-addons' ),
					'4'    => __( '4 Stars', 'foodforlife-addons' ),
					'5'    => __( '5 Stars', 'foodforlife-addons' ),
				],
				'default' => 5,
				'separator' => 'before',
			]
		);

		$repeater->add_control(
			'image',
			[
				'label'    => __( 'Image', 'foodforlife-addons' ),
				'type' => Controls_Manager::MEDIA,
				'media_types' => [ 'image' ],
			]
		);

		$repeater->add_control(
			'testimonial_content',
			[
				'label' => __( 'Content', 'foodforlife-addons' ),
				'type' => Controls_Manager::TEXTAREA,
				'dynamic' => [
					'active' => true,
				],
				'rows' => '10',
				'default' => __( 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.', 'foodforlife-addons' ),
			]
		);

		$repeater->add_control(
			'testimonial_name',
			[
				'label' => __( 'Name', 'foodforlife-addons' ),
				'type' => Controls_Manager::TEXT,
				'default' => __( 'John Doe', 'foodforlife-addons' ),
				'label_block' => true,
				'dynamic' => [
					'active' => true,
				],
			]
		);

		$repeater->add_control(
			'testimonial_address',
			[
				'label' => __( 'Address', 'foodforlife-addons' ),
				'type' => Controls_Manager::TEXT,
				'default' => __( 'Los Angeles, CA', 'foodforlife-addons' ),
				'label_block' => true,
				'dynamic' => [
					'active' => true,
				],
			]
		);

		$this->add_control(
			'testimonials',
			[
				'label'       => __( 'Testimonials', 'foodforlife-addons' ),
				'type'        => Controls_Manager::REPEATER,
				'fields'      => $repeater->get_controls(),
				'title_field' => '{{{ testimonial_name }}}',
				'default' => [
					[
						'testimonial_name'    => __( 'Name #1', 'foodforlife-addons' ),
					],
					[
						'testimonial_name'    => __( 'Name #2', 'foodforlife-addons' ),
					],
					[
						'testimonial_name'    => __( 'Name #3', 'foodforlife-addons' ),
					],
				],
				'separator' => 'before',
			]
		);

		$this->end_controls_section();

		// Carousel Settings
		$this->start_controls_section(
			'section_slider_options',
			[
				'label' => __( 'Carousel Settings', 'foodforlife-addons' ),
			]
		);

		$controls = [
			'slides_to_show'  => 1,
			'slides_to_scroll' => 1,
			'space_between'   => 30,
			'navigation'      => 'arrows',
			'autoplay'        => '',
			'autoplay_speed'  => 3000,
			'animation_speed' => 800,
			'infinite'        => '',
		];

		$this->register_carousel_controls($controls);

		$this->end_controls_section();
	}

	// Tab Style
	protected function section_style() {
		$this->start_controls_section(
			'section_style_item',
			[
				'label' => __( 'Testimonial Item', 'foodforlife-addons' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'rating_heading',
			[
				'label' => esc_html__( 'Rating', 'foodforlife-addons' ),
				'type'  => Controls_Manager::HEADING,
			]
		);

		$this->add_responsive_control(
			'rating_size',
			[
				'label'     => __( 'Size', 'foodforlife-addons' ),
				'type'      => Controls_Manager::SLIDER,
				'range'     => [
					'px' => [
						'max' => 200,
						'min' => 0,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .foodforlife-testimonial-carousel-2__rating.star-rating' => 'font-size: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'rating_gap',
			[
				'label' => __( 'Gap', 'foodforlife-addons' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 200,
					]
				],
				'default' => [],
				'selectors' => [
					'{{WRAPPER}} .foodforlife-testimonial-carousel-2__rating.star-rating' => '--ffl-rating-spacing: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'rating_color',
			[
				'label'     => esc_html__( 'Color Active', 'foodforlife-addons' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .foodforlife-testimonial-carousel-2__rating.star-rating .user-rating' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_responsive_control(
			'rating_spacing',
			[
				'label'     => esc_html__( 'Spacing', 'foodforlife-addons' ),
				'type'      => Controls_Manager::SLIDER,
				'range'     => [
					'px' => [
						'min' => 0,
						'max' => 200,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .foodforlife-testimonial-carousel-2__rating' => 'margin-bottom: {{SIZE}}{{UNIT}}',
				],
			]
		);

		$this->add_control(
			'content_heading',
			[
				'label' => esc_html__( 'Content', 'foodforlife-addons' ),
				'type'  => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_control(
			'content_color',
			[
				'label'     => esc_html__( 'Color', 'foodforlife-addons' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .foodforlife-testimonial-carousel-2__content' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'content_typography',
				'selector' => '{{WRAPPER}} .foodforlife-testimonial-carousel-2__content',
			]
		);

		$this->add_responsive_control(
			'content_padding',
			[
				'label'      => __( 'Padding', 'foodforlife-addons' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .foodforlife-testimonial-carousel-2__content' => 'padding-top: {{TOP}}{{UNIT}}; padding-inline-end: {{RIGHT}}{{UNIT}}; padding-bottom: {{BOTTOM}}{{UNIT}}; padding-inline-start: {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'content_spacing',
			[
				'label'     => esc_html__( 'Spacing', 'foodforlife-addons' ),
				'type'      => Controls_Manager::SLIDER,
				'range'     => [
					'px' => [
						'min' => 0,
						'max' => 200,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .foodforlife-testimonial-carousel-2__content' => 'margin-bottom: {{SIZE}}{{UNIT}}',
				],
			]
		);

		$this->add_control(
			'image_heading',
			[
				'label' => esc_html__( 'Image', 'foodforlife-addons' ),
				'type'  => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->register_aspect_ratio_controls();

		$this->add_control(
			'image_border_radius',
			[
				'label'      => __( 'Border Radius', 'foodforlife-addons' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors'  => [
					'{{WRAPPER}} .foodforlife-testimonial-carousel-2__image' => '--ffl-image-rounded: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'.rtl {{WRAPPER}} .foodforlife-testimonial-carousel-2__image' => '--ffl-image-rounded: {{TOP}}{{UNIT}} {{LEFT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{RIGHT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'image_width',
			[
				'label'     => __( 'Width', 'foodforlife-addons' ),
				'type'      => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .foodforlife-testimonial-carousel-2__image' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'image_spacing',
			[
				'label'     => esc_html__( 'Spacing', 'foodforlife-addons' ),
				'type'      => Controls_Manager::SLIDER,
				'range'     => [
					'px' => [
						'min' => 0,
						'max' => 200,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .foodforlife-testimonial-carousel-2__content' => 'margin-bottom: {{SIZE}}{{UNIT}}',
				],
			]
		);

		$this->add_control(
			'name_heading',
			[
				'label' => esc_html__( 'Name', 'foodforlife-addons' ),
				'type'  => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_control(
			'name_color',
			[
				'label'     => esc_html__( 'Color', 'foodforlife-addons' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .foodforlife-testimonial-carousel-2__name' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'name_typography',
				'selector' => '{{WRAPPER}} .foodforlife-testimonial-carousel-2__name',
			]
		);

		$this->add_control(
			'address_heading',
			[
				'label' => esc_html__( 'Address', 'foodforlife-addons' ),
				'type'  => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_control(
			'address_color',
			[
				'label'     => esc_html__( 'Color', 'foodforlife-addons' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .foodforlife-testimonial-carousel-2__address' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'address_typography',
				'selector' => '{{WRAPPER}} .foodforlife-testimonial-carousel-2__address',
			]
		);

		$this->end_controls_section();

		$this->section_style_carousel();
	}

	protected function section_style_carousel() {
		$this->start_controls_section(
			'section_carousel_style',
			[
				'label'     => __( 'Carousel Settings', 'foodforlife-addons' ),
				'tab'       => Controls_Manager::TAB_STYLE,
			]
		);

		$this->register_carousel_style_controls();

		$this->end_controls_section();
	}

	/**
	 * Render heading widget output on the frontend.
	 * Written in PHP and used to generate the final HTML.
	 *
	 * @access protected
	 */
	protected function render() {
		$settings = $this->get_settings_for_display();

		$col = $settings['slides_to_show'];
		$col_tablet = ! empty( $settings['slides_to_show_tablet'] ) ? $settings['slides_to_show_tablet'] : $col;
		$col_mobile = ! empty( $settings['slides_to_show_mobile'] ) ? $settings['slides_to_show_mobile'] : $col;

		$this->add_render_attribute( 'container', 'class', [ 'foodforlife-testimonial-carousel-2' ] );
		$this->add_render_attribute( 'wrapper', 'class', [ 'foodforlife-carousel--elementor', 'swiper' ] );
		$this->add_render_attribute( 'wrapper', 'data-desktop', $col );
		$this->add_render_attribute( 'wrapper', 'data-tablet', $col_tablet );
		$this->add_render_attribute( 'wrapper', 'data-mobile', $col_mobile );
		$this->add_render_attribute( 'wrapper', 'style', $this->render_space_between_style() );
		$this->add_render_attribute( 'wrapper', 'style', $this->render_aspect_ratio_style() );

		$this->add_render_attribute( 'inner', 'class', [ 'foodforlife-testimonial-carousel-2__inner', 'swiper-wrapper' ] );
		$this->add_render_attribute( 'item', 'class', [ 'foodforlife-testimonial-carousel-2__item', 'swiper-slide', 'overflow-hidden', 'd-flex', 'flex-column', 'align-items-center', 'justify-content-center', 'text-center' ] );

		$this->add_render_attribute( 'rating', 'class', [ 'foodforlife-testimonial-carousel-2__rating', 'star-rating', 'fs-14', 'mb-15' ] );

		$this->add_render_attribute( 'content', 'class', [ 'foodforlife-testimonial-carousel-2__content', 'fw-medium', 'fs-24', 'text-dark', 'mb-30' ] );
		$this->add_render_attribute( 'image', 'class', [ 'foodforlife-testimonial-carousel-2__image', 'ffl-ratio', 'overflow-hidden', 'mb-10' ] );
		$this->add_render_attribute( 'name', 'class', [ 'foodforlife-testimonial-carousel-2__name', 'fw-semibold', 'fs-14', 'text-dark' ] );
		$this->add_render_attribute( 'address', 'class', [ 'foodforlife-testimonial-carousel-2__address', 'fs-14' ] );
	?>
		<div <?php echo $this->get_render_attribute_string( 'container' );?>>
			<div <?php echo $this->get_render_attribute_string( 'wrapper' );?>>
				<div <?php echo $this->get_render_attribute_string( 'inner' );?>>
				<?php foreach( $settings['testimonials'] as $index => $testimonial ) : ?>
					<div <?php echo $this->get_render_attribute_string( 'item' );?>>
						<div <?php echo $this->get_render_attribute_string( 'rating' ); ?>><?php echo $this->star_rating_html( $testimonial['testimonial_rating'] ); ?></div>
						<?php if(  ! empty( $testimonial['testimonial_content'] ) ) : ?>
							<div <?php echo $this->get_render_attribute_string( 'content' );?>><?php echo wp_kses_post( $testimonial['testimonial_content'] ); ?></div>
						<?php endif; ?>
						<?php if ( ! empty( $testimonial['image']['url'] ) ) : ?>
							<div <?php echo $this->get_render_attribute_string( 'image' );?>>
								<?php
									$settings['image'] = $testimonial['image'];
									$settings['image_size'] = 'full';
									echo wp_kses_post( \Elementor\Group_Control_Image_Size::get_attachment_image_html( $settings ) );
								?>
							</div>
						<?php endif; ?>
						<?php if( ! empty( $testimonial['testimonial_name'] ) || ! empty( $testimonial['testimonial_address'] ) ) : ?>
							<div class="foodforlife-testimonial-carousel-2__meta">
								<?php if( ! empty( $testimonial['testimonial_name'] ) ) : ?>
									<span <?php echo $this->get_render_attribute_string( 'name' );?>><?php echo wp_kses_post( $testimonial['testimonial_name'] ); ?></span>
								<?php endif; ?>
								<?php if( ! empty( $testimonial['testimonial_name'] ) && ! empty( $testimonial['testimonial_address'] ) ) : ?>
									<span>-</span>
								<?php endif; ?>
								<?php if( ! empty( $testimonial['testimonial_address'] ) ) : ?>
									<span <?php echo $this->get_render_attribute_string( 'address' );?>><?php echo wp_kses_post( $testimonial['testimonial_address'] ); ?></span>
								<?php endif; ?>
							</div>
						<?php endif; ?>
					</div>
				<?php endforeach; ?>
				</div>
				<?php echo '<div class="swiper-arrows">' . $this->render_arrows() . '</div>'; ?>
				<?php echo $this->render_pagination(); ?>
			</div>
		</div>
	<?php
	}

	public function star_rating_html( $count ) {
		$html = '<span class="max-rating rating-stars">'
		        . \FoodForLife\Addons\Helper::inline_svg('icon=star')
		        . \FoodForLife\Addons\Helper::inline_svg('icon=star')
		        . \FoodForLife\Addons\Helper::inline_svg('icon=star')
		        . \FoodForLife\Addons\Helper::inline_svg('icon=star')
		        . \FoodForLife\Addons\Helper::inline_svg('icon=star')
		        . '</span>';
		$html .= '<span class="user-rating rating-stars" style="width:' . ( ( $count / 5 ) * 100 ) . '%">'
				. \FoodForLife\Addons\Helper::inline_svg('icon=star')
				. \FoodForLife\Addons\Helper::inline_svg('icon=star')
				. \FoodForLife\Addons\Helper::inline_svg('icon=star')
				. \FoodForLife\Addons\Helper::inline_svg('icon=star')
				. \FoodForLife\Addons\Helper::inline_svg('icon=star')
		         . '</span>';

		$html .= '<span class="screen-reader-text">';

		$html .= '</span>';

		return $html;
	}
}