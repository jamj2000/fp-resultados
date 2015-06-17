/*
* Jquery Code for Removing Dropdown Arrow.
* @by: North Web Studio
*/
(function ($) {
  Drupal.behaviors.nwsJS = {
    attach: function(context, settings) {
      $('.form-select').once('nws-arrow', function() {
        $wrap_width = $(this).outerWidth();
        $element_width = $wrap_width + 20;
        $(this).css('width',$element_width);
        $(this).wrap('<div class="nws-select"></div>');
        $(this).parent('.nws-select').css('width',$wrap_width);
      });
    }
  };
})(jQuery);