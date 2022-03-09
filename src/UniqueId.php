<?php

namespace SquareOne\Acf\Fields;

/**
 * Class UniqueId
 *
 * @package SquareOne\Acf\Fields
 * @author  Jarrod Noonan <jarrod@noonanwebgroup.com>
 */
class UniqueId extends Field
{
    use Concerns\Asset;

    /**
     * The field name.
     *
     * @var string
     */
    public $name = 'unique_id';

    /**
     * The field label.
     *
     * @var string
     */
    public $label = 'Unique ID';

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
        echo sprintf(
            '<input type="hidden" name="%s" value="%s" readonly>',
            esc_attr( $field[ 'name' ] ),
            esc_attr( $field[ 'value' ] )
        );
    }

    /**
     * @param array $field
     *
     * @return array|mixed|string
     */
    public function update_field( $field )
    {
        if ( ! empty( $value ) ) {
            return $value;
        }

        return uniqid();
    }

}
