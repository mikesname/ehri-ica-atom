/**
 * Replace delete checkboxes with delete icon, and dynamically hide
 * elements marked for deletion.
 *
 * @param object thisElement dom <select> element to operate on
 * @return void
 */
function multiDelete(thisObj, elementName)
{
  var thisForm = $(thisObj).parents('form');

  // Hide element
  var relatedObjName = elementName.replace(/\w+\[(\d+)\]/, 'related_obj_$1');
  var parentRows = $(thisObj).parents('table:first').find('.' + relatedObjName);

  // Add an "animateNicely" div to each td to make "hide" animation play nicely
  parentRows.find('td').each(function (i) {
    // Only add to rows that don't already have an animateNicely div
    if (0 == $(this).find('div.animateNicely').length) {
      if ('' == $.trim($(this).text())) {
        // Add a &nbsp; if <td> has no contents because hide() doesn't seem to
        // operate on <div>s that only contain whitespace
        $(this).html('<div class="animateNicely">&nbsp;</div>');
      } else {
        $(this).wrapInner('<div class="animateNicely"></div>');
      }
    }
  });

  parentRows.find('div:visible').hide('normal', function() {
    parentRows.remove();
  });

  // Append hidden field to delete element on form submit
  thisForm.append('<input type="hidden" name="' + elementName + '" value="delete">');
}

/**
 * On page load, replace "multiDelete" checkboxes with delete icons
 */
Drupal.behaviors.replaceMultiDelete = {
  attach: function (context)
  {
    $('input[type="checkbox"].multiDelete').each(function () {
      var elementName = $(this).attr('name');
      $(this).replaceWith('<button name="delete" class="delete-small" onclick="multiDelete(this, \'' + elementName + '\'); return false;" />');
    });

    // Remove delete icons in table headers
    $('th img.deleteIcon').replaceWith('&nbsp;');
  }
};
