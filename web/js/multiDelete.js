/**
 * Replace delete checkboxes with delete icon, and dynamically hide
 * elements marked for deletion.
 *
 * @param object thisElement dom <select> element to operate on
 * @return void
 */
function multiDelete(elementName)
{
  // Hide element
  var relatedObjName = elementName.replace(/\w+\[(\d+)\]/, 'related_obj_$1');
  var parentRows = $('tr.'+relatedObjName);
  parentRows.find('div:visible').hide('normal', function() {
    parentRows.remove();
  });

  // Append hidden field to delete element on form submit
  $('form#editForm').append('<input type="hidden" name="'+elementName+'" value="delete">');
}

/**
 * On page load, replace "multiDelete" checkboxes with delete icons
 */
Drupal.behaviors.replaceMultiDelete = {
  attach: function (context)
    {
      $('input[type="checkbox"].multiDelete').each(function () {
        var elementName = $(this).attr('name');
        $(this).replaceWith('<button class="delete-small" onclick="multiDelete(\''+elementName+'\'); return false;" />');
      });

      // Remove delete icons in table headers
      $('th img.deleteIcon').replaceWith('&nbsp;');
    } };
