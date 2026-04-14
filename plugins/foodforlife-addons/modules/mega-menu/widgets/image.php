<?php
/**
 * Widget Image
 */

namespace FoodForLife\Addons\Modules\Mega_Menu\Widgets;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Image widget class
 */
class Image extends Widget_Base {

	/**
	 * Set the widget name
	 *
	 * @return string
	 */
	public function get_name() {
		return 'image';
	}

	/**
	 * Set the widget label
	 *
	 * @return string
	 */
	public function get_label() {
		return esc_html__( 'Image Box', 'foodforlife-addons' );
	}

	/**
	 * Default widget options
	 *
	 * @return array
	 */
	public function get_defaults() {
		return array(
			'image'  => array( 'id' => '', 'url' => '' ),
			'link'   => array( 'url' => '', 'target' => '' ),
			'button' => '',
			'style'  => 'dark',
		);
	}

	/**
	 * Render widget content
	 */
	public function render() {
		$data = $this->get_data();
		$ratio = '';
		if ( ! empty( $data['ratio'] ) ) {
			$ratio = $this->render_aspect_ratio_style();
		}

		echo '<div class="menu-widget-image ffl-hover-zoom position-relative" '. $ratio .'>';
		if ( empty( $data['link']['url'] ) ) {
			echo '<span class="ffl-ratio ffl-image-rounded-md ffl-hover-effect overflow-hidden">';
		} else {
			echo '<a href="'. $data['link']['url'] .'" class="ffl-ratio ffl-image-rounded-md ffl-hover-effect overflow-hidden">';
		}
		$this->render_image( $data['image'], 'full', array(
			'alt' => esc_html__( 'Mega Menu Image', 'foodforlife-addons' ) . $data['image']['id'],
			'class' => 'menu-widget-image__image'
		) );
		if ( empty( $data['link']['url'] ) ) {
			echo '</span>';
		} else {
			echo '</a>';
		}
		echo '</div>';

		echo '<div class="menu-widget-image__content d-flex flex-column justify-content-end position-absolute start-0 end-0 bottom-0 pb-25">';

		$class_btn = 'menu-widget-image__button ffl-button ffl-button-hover-effect fw-semibold ms-auto me-auto z-3';
		if ( ! empty( $data['style'] ) && $data['style'] == 'light' ) {
			$class_btn .= ' ffl-button-light';
		}
		$data['link']['class'] = $class_btn;
		$data['link']['target'] = $data['link']['target'] ? $data['link']['target'] : '';
		$this->render_link_open( $data['link'] );

		if ( empty( $data['link']['url'] ) ) {
			echo '<span class="'. $class_btn .'">' . wp_kses_post( $data['button'] ) . '</span>';
		} else {
			echo wp_kses_post( $data['button'] );
		}

		$this->render_link_close( $data['link'] );

		echo '</div>';

	}

	/**
	 * Render aspect ratio style
	 *
	 * @return void
	 */
    protected function render_aspect_ratio_style() {
		$data = $this->get_data();
		$aspect_ratio = 1;

        if( $data['ratio'] == 'vertical' ) {
            $aspect_ratio = 0.79;
        }

        if( $data['ratio'] == 'horizontal' ) {
            $aspect_ratio = 1.3678977272727273;
        }

        if( $data['ratio'] == 'custom' && ! empty( $data['aspect_ratio'] ) ) {
            if( ! is_numeric( $data['aspect_ratio'] ) ) {
                $cropping_split = explode( ':', $data['aspect_ratio'] );
                $width          = max( 1, (float) current( $cropping_split ) );
                $height         = max( 1, (float) end( $cropping_split ) );
                $aspect_ratio   = floatval( $width / $height );
            } else {
                $aspect_ratio = $data['aspect_ratio'];
            }
        }

        return 'style="--ffl-ratio-percent: '. round( 100 / $aspect_ratio ) . '%;"';
    }

	/**
	 * Widget setting fields.
	 */
	public function add_controls() {
		$this->add_control( array(
			'type' => 'image',
			'label' => __( 'Image', 'foodforlife-addons' ),
			'name' => 'image',
		) );

		$this->add_control( array(
			'type' => 'select',
			'name' => 'ratio',
			'label' => __( 'Image Ratio', 'foodforlife-addons' ),
			'options' => array(
				'square'     => __( 'Square', 'foodforlife-addons' ),
				'vertical'   => __( 'Vertical rectangle', 'foodforlife-addons' ),
				'horizontal' => __( 'Horizontal rectangle', 'foodforlife-addons' ),
				'custom'     => __( 'Custom', 'foodforlife-addons' ),
			),
		) );

		$this->add_control( array(
			'type' => 'text',
			'label'       => __( 'Aspect ratio (Eg: 3:4)', 'foodforlife-addons' ),
			'description' => __( 'When you choose the "Custom" ratio, the image will be cropped to fit the specified aspect ratio.', 'foodforlife-addons' ),
			'name' => 'aspect_ratio',
		) );

		$this->add_control( array(
			'type' => 'link',
			'name' => 'link',
		) );

		$this->add_control( array(
			'type' => 'text',
			'name' => 'button',
			'label' => __( 'Button Text', 'foodforlife-addons' ),
		) );

		$this->add_control( array(
			'type' => 'select',
			'name' => 'style',
			'label' => __( 'Button Style', 'foodforlife-addons' ),
			'options' => array(
				'dark'     => __( 'Dark', 'foodforlife-addons' ),
				'light'   => __( 'Light', 'foodforlife-addons' ),
			),
		) );
	}
}