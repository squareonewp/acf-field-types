<?php

namespace SquareOne\Acf\Fields;

/**
 * Class Dimensions
 *
 * @package SquareOne\Acf\Fields
 * @author  Jarrod Noonan <jarrod@noonanwebgroup.com>
 */
class Dimensions extends Field
{
    use Concerns\Asset;

    /**
     * The field name.
     *
     * @var string
     */
    public $name = 'dimensions';

    /**
     * The field label.
     *
     * @var string
     */
    public $label = 'Dimensions';

    /**
     * The field category.
     *
     * @var string
     */
    public $category = 'basic';

    /**
     * The field defaults.
     *
     * @var array
     */
    public $defaults = [
        'unit'          => 'px',
        'units'         => [ 'px', '%', 'em', 'rem' ],
        'return_format' => 'string',
    ];

    /**
     * Create a new field instance.
     *
     * @param string $uri
     * @param string $path
     *
     * @return void
     */
    public function __construct( $uri, $path )
    {
        $this->uri = $uri;
        $this->path = $path;

        parent::__construct();
    }

    /**
     * The rendered field type.
     *
     * @param array $field
     *
     * @return void
     */
    public function render_field( $field )
    {
        ?>

        <div class="dimensions sq-flex sq-space-x-2 sq-justify-end sq-uppercase sq-mb-2 sq-text-xs sq--mt-5">
            <?php foreach ( $this->get_units( $field ) as $unit ): ?>
                <a href="#" data-unit="<?php echo sanitize_text_field( $unit ); ?>"
                   class="sq-text-gray-400 <?php echo $this->defaults[ 'unit' ] === $unit ? 'active' : ''; ?>">
                    <?php echo sanitize_text_field( $unit ); ?>
                </a>
            <?php endforeach; ?>
        </div>

        <div class="sq-flex sq-space-x-3 sq-items-center">

            <div class="dimension-indicator">
                <div data-direction="left" class="dimension-indicator__left"></div>
                <div data-direction="top" class="dimension-indicator__top"></div>
                <div data-direction="bottom" class="dimension-indicator__bottom"></div>
                <div data-direction="right" class="dimension-indicator__right"></div>
            </div>

            <?php

            echo sprintf(
                '<input
                class="acf-field-input units"
                type="hidden"
                name="%s[unit]"
                value="%s"
            />',
                $field[ 'name' ],
                $field[ 'value' ][ 'unit' ] ?? 'px',
            );

            echo sprintf(
                '<input
                class="acf-field-input sq-border-gray-300 acf-example-field-input"
                type="text"
                placeholder="0"
                name="%s[top]"
                data-direction="top"
                value="%s"
            />',
                $field[ 'name' ],
                $field[ 'value' ][ 'top' ] ?? '',
            );

            echo sprintf(
                '<input
                class="acf-field-input sq-border-gray-300 acf-example-field-input"
                type="text"
                placeholder="0"
                name="%s[left]"
                data-direction="left"
                value="%s"
            />',
                $field[ 'name' ],
                $field[ 'value' ][ 'left' ] ?? ''
            );

            echo sprintf(
                '<input
                class="acf-field-input sq-border-gray-300 acf-example-field-input"
                type="text"
                placeholder="0"
                name="%s[bottom]"
                data-direction="bottom"
                value="%s"
            />',
                $field[ 'name' ],
                $field[ 'value' ][ 'bottom' ] ?? ''
            );

            echo sprintf(
                '<input
                class="acf-field-input sq-border-gray-300 acf-example-field-input"
                type="text"
                placeholder="0"
                name="%s[right]"
                data-direction="right"
                value="%s"
            />',
                $field[ 'name' ],
                $field[ 'value' ][ 'right' ] ?? ''
            );
            ?>
        </div>

        <?php
    }

    /**
     * The rendered field type settings.
     *
     * @param array $field
     *
     * @return void
     */
    public function render_field_settings( $field )
    {
        acf_render_field_setting( $field, [
            'label'         => __( 'Return Format', 'squareone-acf-field-types' ),
            'name'          => 'return_format',
            'instructions'  => __( 'The format of the returned data.', 'squareone-acf-field-types' ),
            'type'          => 'select',
            'ui'            => '1',
            'choices'       => [
                'array'  => 'Array',
                'string' => 'String',
            ],
            'default_value' => 'array',
        ] );

        acf_render_field_setting( $field, [
            'label'         => __( 'Units', 'squareone-acf-field-types' ),
            'name'          => 'units',
            'instructions'  => __( 'Separate each unit on a new line', 'squareone-acf-field-types' ),
            'type'          => 'textarea',
            'default_value' => implode( PHP_EOL, [
                'px',
                '%',
                'em',
                'rem',
                'vh',
            ] ),
        ] );
    }

    /**
     * The formatted field value.
     *
     * @param mixed $value
     * @param int   $post_id
     * @param array $field
     *
     * @return mixed
     */
    public function format_value( $value, $post_id, $field )
    {
        if ( $field[ 'return_format' ] === 'string' ) {
            if ( ! isset( $value[ 'top' ], $value[ 'right' ], $value[ 'left' ], $value[ 'bottom' ] ) ) {
                return "0 0 0 0"; // Default
            }

            return implode( ' ', [
                ( $value[ 'top' ] ?: '0' ) . $value[ 'unit' ],
                ( $value[ 'right' ] ?: '0' ) . $value[ 'unit' ],
                ( $value[ 'bottom' ] ?: '0' ) . $value[ 'unit' ],
                ( $value[ 'left' ] ?: '0' ) . $value[ 'unit' ],
            ] );
        }

        return $value;
    }

    /**
     * @param $field
     *
     * @return false|mixed|string[]
     */
    private function get_units( $field )
    {
        if ( ! isset( $field[ 'units' ] ) || empty( $field[ 'units' ] ) ) {
            return $this->defaults[ 'units' ];
        }

        if ( is_string( $field[ 'units' ] ) ) {
            return explode( PHP_EOL, $field[ 'units' ] );
        }

        return $field[ 'units' ];
    }
}
