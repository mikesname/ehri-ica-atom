function addNewRow(sender)
{
  var table = $(sender).parents('table:first');
  var lastRow = table.find('tbody tr:last');
  var newRow = lastRow.clone();

  // Get the last row number (e.g.: foo[0][bar])
  var lastRowNumber = parseInt(lastRow.find("select, input").filter(":first").attr("name").match(/\d/).shift());

  // Iterate over each input and select elements
  newRow.find('input, select').each(function(i) {
    // Input values are removed
    if ($(this).is('input'))
    {
      $(this).val('');
    }
    // Select index is preserved
    else if ($(this).is('select'))
    {
      var oldSelect = lastRow.find('input, select').eq(i);
      var selectedIndex = oldSelect[0].selectedIndex;

      $(this)[0].selectedIndex = selectedIndex;
    }

    // Increment row number
    var newName = $(this).attr('name').replace(/\[\d\]/, '[' + (lastRowNumber + 1) + ']');
    $(this).attr('name', newName);
  });

  // Iterate over each cell
  newRow.find('td').each(function(i) {
    // Wrap cell with div animateNicely for jQuery.show effect
    if (0 == $(this).find('div.animateNicely').length)
    {
      $(this).wrapInner('<div class="animateNicely"></div>');
    }

    // Hide the div
    $(this).children().hide();
  });

  // Append the row to tbody
  table.children('tbody').append(newRow);

  // Show effect
  table.find('tbody tr:last div.animateNicely').show('normal');
}

function removeRow(sender)
{
  var table = $(sender).parents('table:first');
  var rows = table.find('tbody tr');
  var row = $(sender).parents('tr:first');

  if (1 < rows.length)
  {
    if (!row.children('div.animateNicely').length)
    {
      row.find('td').each(function(i) {
        if (0 == $(this).find('div.animateNicely').length)
        {
          $(this).wrapInner('<div class="animateNicely"></div>');
        }
      });
    }

    row.find('div').hide('normal', function() {
      row.remove();
    });

    var rowNumber = parseInt(row.find("select, input").filter(":first").attr("name").match(/\d/).shift());

    rowNumber--;

    row.nextAll().each(function() {
      rowNumber++;
      $(this).find('input, select').each(function() {
        var newName = $(this).attr('name').replace(/\[\d\]/, '[' + rowNumber + ']');
        $(this).attr('name', newName);
      });
    });
  }
  else
  {
    row.find('input, select').each(function() {
      $(this).val('');

      if ($(this).is('select'))
      {
        $(this)[0].selectedIndex = 0;
      }
    });
  }
}

/**
 * On page load, "multiRow" tables are prepared to add as many rows as users want
 */
Drupal.behaviors.multiRow = {
  attach: function (context)
  {
    $('table.multiRow thead tr:first').append('<th>&nbsp;</th>');
    $('table.multiRow tbody tr:first').append('<td><button name="delete" class="delete-small" onclick="removeRow(this); return false;" /></td>');

    // Add tfoot for adding new rows button
    $('table.multiRow').each(function () {
      var tfoot  = '<tfoot>';
      tfoot     += '<tr>';
      tfoot     += '<td colspan=' + ($(this).find('tbody tr:first td').length + 1) + '><a href="#" onclick="addNewRow(this); return false;">add new</a></td>';
      tfoot     += '</tr>';
      tfoot     += '</tfoot>';

      $(this).append(tfoot);
    });
  }
};
