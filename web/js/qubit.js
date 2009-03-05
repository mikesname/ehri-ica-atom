// $Id$

var Qubit = Qubit || {};

Drupal.behaviors.adminActions = {
  attach: function (context)
    {
      $('.sf_admin_td_actions select', context).change(function ()
        {
          var javascript = $('option:selected', this).attr('javascript');
          $('option:first', this).attr('selected', true);
          eval(javascript);
        });
    } };
