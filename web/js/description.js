// $Id$

(function ($)
  {
    Drupal.behaviors.description = {
      attach: function (context)
        {
          $('.form-item .description', context).hide();

          $('.form-item', context).focusin(function ()
            {
              $('.form-item .description', context).hide();

              $('.description', this).show();
            });
        } };
  })(jQuery);
