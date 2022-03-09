(function ($) {
  if (typeof acf.add_action === 'undefined') {
    return;
  }

  /**
   * The hook below is fired when initializing
   * new or existing example fields.
   *
   * @param {jQuery} element
   */
  acf.add_action('ready append', function (element) {
    acf.get_fields({ type: 'dimensions' }, element).each(function () {
      const context = $( this );
      const unitsInput = $( this ).find( 'input[type=hidden].units' );

      const resetDimensionIndicatorClasses = ( indicator ) => {
        $( indicator ).removeClass( 'top' )
            .removeClass( 'left' )
            .removeClass( 'bottom' )
            .removeClass( 'right' );
      };

      $( this ).find( 'a[data-unit]' ).on( 'click', function() {
        $( this ).parent().find( '.active' ).removeClass( 'active' );
        $( this ).addClass( 'active' );
        $( unitsInput ).val( $( this ).data( 'unit' ) );
      });

      $( this ).find( '[data-direction]' ).on( 'blur', function() {
        resetDimensionIndicatorClasses( dimensionIndicator );
      });

      const dimensionIndicator = $( this ).find( '.dimension-indicator' );

      $( this ).find( '[data-direction]' ).on( 'blur', function() {
        resetDimensionIndicatorClasses( dimensionIndicator );
      });

      // Set the direction of the indicator
      $( this ).find( '[data-direction]' ).on( 'click', function() {
        const direction = $( this ).data( 'direction' );

        $( dimensionIndicator ).addClass(direction);

        context.find( 'input[data-direction="' +  direction + '"]' ).focus();
      });
    });
  });
})(jQuery);
