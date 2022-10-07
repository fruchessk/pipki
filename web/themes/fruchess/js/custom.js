(function ($) {
  Drupal.behaviors.myModuleBehavior = {
    attach: function (context, settings) {
      $(context).find('.field--name-field-kartinka').once('myCustomBehavior').click(function () {
        alert('Hello');
      });
    }
  };
})(jQuery);
