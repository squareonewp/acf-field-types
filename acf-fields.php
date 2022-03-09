<?php

/**
 * Plugin Name: Advanced Custom Fields: SquareOne
 * Plugin URI:  https://github.com/SquareOneWP/acf-field-types
 * Description: Necessary ACF field types for the SquareOne theme.
 * Version:     1.0.0
 * Author:      Jarrod Noonan
 * Author URI:  hhttps://github.com/squareone-jarrod
 */

add_filter( 'after_setup_theme', new class {
    /**
     * Invoke the plugin.
     *
     * @return void
     */
    public function __invoke()
    {
        if ( file_exists( $composer = __DIR__ . '/vendor/autoload.php' ) ) {
            require_once $composer;
        }

        $this->register();
    }

    /**
     * Register the field type with ACF.
     *
     * @return void
     */
    protected function register()
    {
        foreach ( [ 'acf/include_field_types', 'acf/register_fields' ] as $hook ) {
            add_filter( $hook, function () {
                return new \SquareOne\Acf\Fields\Dimensions(
                    plugin_dir_url( __FILE__ ),
                    plugin_dir_path( __FILE__ )
                );
            } );

            add_filter( $hook, function () {
                return new \SquareOne\Acf\Fields\UniqueId(
                    plugin_dir_url( __FILE__ ),
                    plugin_dir_path( __FILE__ )
                );
            } );
        }
    }
} );
