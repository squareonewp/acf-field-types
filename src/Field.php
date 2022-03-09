<?php

namespace SquareOne\Acf\Fields;

class Field extends \acf_field
{
    use Concerns\Asset;

    /**
     * The field defaults.
     *
     * @var array
     */
    public $defaults = [];

    /**
     * The condition the field value must meet before
     * it is valid and can be saved.
     *
     * @param bool  $valid
     * @param mixed $value
     * @param array $field
     * @param array $input
     *
     * @return bool
     */
    public function validate_value( $valid, $value, $field, $input )
    {
        return $valid;
    }

    /**
     * The field value after loading from the database.
     *
     * @param mixed $value
     * @param int   $post_id
     * @param array $field
     *
     * @return mixed
     */
    public function load_value( $value, $post_id, $field )
    {
        return $value;
    }

    /**
     * The field value before saving to the database.
     *
     * @param mixed $value
     * @param int   $post_id
     * @param array $field
     *
     * @return mixed
     */
    public function update_value( $value, $post_id, $field )
    {
        return $value;
    }

    /**
     * The action fired when deleting a field value from the database.
     *
     * @param int    $post_id
     * @param string $key
     *
     * @return void
     */
    public function delete_value( $post_id, $key )
    {
        parent::delete_value( $post_id, $key );
    }

    /**
     * The field after loading from the database.
     *
     * @param array $field
     *
     * @return array
     */
    public function load_field( $field )
    {
        return $field;
    }

    /**
     * The field before saving to the database.
     *
     * @param array $field
     *
     * @return array
     */
    public function update_field( $field )
    {
        return $field;
    }

    /**
     * The action fired when deleting a field from the database.
     *
     * @param array $field
     *
     * @return void
     */
    public function delete_field( $field )
    {
        parent::delete_field( $field );
    }

    /**
     * The assets enqueued when rendering the field.
     *
     * @return void
     */
    public function input_admin_enqueue_scripts()
    {
        wp_enqueue_style( $this->name, $this->asset( 'public/css/fields.css' ), [], null );
        wp_enqueue_script( $this->name, $this->asset( 'public/js/fields.js' ), [], null, true );
    }

    /**
     * The assets enqueued when creating a field group.
     *
     * @return void
     */
    public function field_group_admin_enqueue_scripts()
    {
        $this->input_admin_enqueue_scripts();
    }
}
