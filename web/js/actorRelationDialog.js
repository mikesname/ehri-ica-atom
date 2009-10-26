// $Id$

function deleteRelation(index)
{
  var deleteRelations = $('body').data('deleteRelations');
  var thisRow = $('tr#actorRelation_' + index);

  // Add a "&nbsp;" if <td> has no contents because hide() doesn't seem to
  // animate smoothly for divs that only contain whitespace
  thisRow.find('div.animateNicely').each(function (i) {
    if ('' == $.trim($(this).text())) {
      $(this).html('&nbsp;');
    }
  });

  // Hide and remove this event
  thisRow.find('div:visible').hide('normal', function() { thisRow.remove() });

  // Remove event from actorRelation data cache
  delete $('body').data('actorRelations')[index];

  // Add to list of events to delete on form submit
  if (index.substr(0,3) != 'new')
  {
    deleteRelations = deleteRelations.concat(index);
    $('body').data('deleteRelations', deleteRelations);
  }
}

function editActorRelationDialog(relationId, actorId)
{
  // Check for a local data cache for this event
  var actorRelations = $('body').data('actorRelations');
  if (actorRelations[relationId] != undefined)
  {
    // Populate actorRelation dialog with cached data, then show it
    populateActorRelationDialog(actorRelations[relationId]);
    Qubit.actorRelationDialog.show();
  }
  else
  {
    // If no local data cache found, do ajax call
    getRelationAjax(relationId, actorId);
  }
}

function getRelationAjax(relationId, actorId)
{
  $.getJSON( Qubit.paths.actorRelationShow + '?id=' + relationId + '&fromActorId=' + actorId,
  function(jsonData) {
    // Append "inDatabase" to results
    jsonData.inDatabase = true;

    // cache data locally so we don't have to hit the database again
    var actorRelations = $('body').data('actorRelations');
    actorRelations[relationId] = jsonData;
    $('body').data('actorRelations', actorRelations);

    // Populate and show the dialog form
    populateActorRelationDialog(jsonData);
    Qubit.actorRelationDialog.show();
  } );
}

function appendHiddenRelationFormFields(thisForm)
{
  // Build hidden form input fields
  var newHiddens = '';
  var actorRelations = $('body').data('actorRelations');
  var deleteRelations = $('body').data('deleteRelations');
  var i = 0;

  for(var key in actorRelations)
  {
    var actorRelation = actorRelations[key];

    // Add the event id, if we're updating an event that's already in the db
    if (actorRelation.inDatabase == true)
    {
      newHiddens += '<input type="hidden" name="updateActorRelations[' + i + '][id]" value="' + actorRelation.id + '" />\n';
    }

    newHiddens += '<input type="hidden" name="updateActorRelations[' + i + '][categoryId]" value="' + actorRelation.typeId + '" />\n';
    newHiddens += '<input type="hidden" name="updateActorRelations[' + i + '][actorName]" value="' + actorRelation.actorName + '" />\n';
    newHiddens += '<input type="hidden" name="updateActorRelations[' + i + '][startDate]" value="' + actorRelation.startDate + '" />\n';
    newHiddens += '<input type="hidden" name="updateActorRelations[' + i + '][endDate]" value="' + actorRelation.endDate + '" />\n';
    newHiddens += '<input type="hidden" name="updateActorRelations[' + i + '][dateDisplay]" value="' + actorRelation.dateDisplay + '" />\n';
    newHiddens += '<input type="hidden" name="updateActorRelations[' + i + '][description]" value="' + actorRelation.description + '" />\n';
    i++;
  }

  for(var key in deleteRelations)
  {
    newHiddens += '<input type="hidden" name="deleteRelations[' + deleteRelations[key] + ']" value="delete" />\n';
    i++;
  }

  // Append hidden input fields
  thisForm.append(newHiddens);

  return false;
}


function submitActorRelationDialog(thisData, i)
{
  var relationCategorySelector = $('table#actorRelation select[name="editActorRelation[categoryId]"]');

  // Get an id  or assign an id of "newX" for new events
  var thisId = (thisData['editActorRelation[id]'] != undefined) ? thisData['editActorRelation[id]'] : 'new' + i;

  // cache event data locally
  var actorRelations = $('body').data('actorRelations');
  var inDatabase = (actorRelations[thisId] == undefined || actorRelations[thisId].inDatabase != true) ? false : true;
  actorRelations[thisId] = {
    "id": thisId,
    "typeId": thisData['editActorRelation[categoryId]'],
    "actorName": thisData['editActorRelation[actorName]'],
    "startDate": thisData['editActorRelation[startDate]'],
    "endDate": thisData['editActorRelation[endDate]'],
    "dateDisplay": thisData['editActorRelation[dateDisplay]'],
    "description": thisData['editActorRelation[description]'],
    "inDatabase": inDatabase
  };
  $('body').data('actorRelations', actorRelations);

  // Determine the selected category text
  categoryDisplay = relationCategorySelector.find('option:selected').text();

  // Determine the date(s) to show in the creation events table
  var dateDisplay = thisData['editActorRelation[dateDisplay]'];
  var startDate = thisData['editActorRelation[startDate]'];
  var endDate = thisData['editActorRelation[endDate]'];
  if (dateDisplay.length == 0)
  {
    if (startDate.length > 0 && endDate.length > 0)
    {
      dateDisplay = startDate + ' - ' + endDate;
    }
    else if (startDate.length > 0)
    {
      dateDisplay = startDate;
    }
    else if (endDate.length > 0)
    {
      dateDisplay = endDate;
    }
  }

  // Create html string for row
  var eventRowHtml = '<td><div class="animateNicely">' + thisData['editActorRelation[actorName]'] + '</div></td>';
  eventRowHtml    += '<td><div class="animateNicely">' + categoryDisplay + '</div></td>';
  eventRowHtml    += '<td><div class="animateNicely">' + dateDisplay + '</div></td>';
  eventRowHtml    += '<td><div class="animateNicely">' + thisData['editActorRelation[description]'] + '</div></td>';
  eventRowHtml    += '<td style="text-align: right"><div class="animateNicely"><a href="javascript:editActorRelationDialog(\'' + thisId + '\', \'' + Qubit.vars['actorId'] + '\')"><img src="' + $('img#imagesPencilPng').attr('src') + '" align="top" /></a> <a href="javascript:deleteRelation(\'' + thisId + '\')"><img src="' + $('img#imagesDeletePng').attr('src') + '" align="top" /></a></div></td>';

  // Test if we are editing an existing event row
  var existingRow = $('table#relatedEntities tr#actorRelation_' + thisId);
  if (existingRow.length)
  {
    existingRow.html(eventRowHtml); // Write new row HTML
  }
  else
  {
    // Build a new row to append to the creationEvents Table
    var newRow = $('<tr id="actorRelation_' + thisId + '">' + eventRowHtml + '</tr>');

    // Append new row (hidden), then use fancy jquery "show" effect to reveal it
    $('div', newRow).hide();
    newRow.insertBefore('table#relatedEntities tr#addActorRelationLink');
    $('div', newRow).show('normal');
  }
}

function populateActorRelationDialog(data)
{
  var dialog = $('table#actorRelation');

  // Set Id
  dialog.append('<input type="hidden" name="editActorRelation[id]" value="' + data.id + '" />');

  // Set fields
  dialog.find('input[name="editActorRelation[actorName]"]').val(data.actorName);
  dialog.find('input[name="editActorRelation[startDate]"]').val(data.startDate);
  dialog.find('input[name="editActorRelation[endDate]"]').val(data.endDate);
  dialog.find('input[name="editActorRelation[dateDisplay]"]').val(data.dateDisplay);
  dialog.find('textarea[name="editActorRelation[description]"]').val(data.description);

  // Select correct category
  var categoryOption = dialog.find('select[name="editActorRelation[categoryId]"] option[value=' + data.typeId + ']');
  if (categoryOption.length > 0)
  {
    categoryOption.get(0).selected = true;
  }
}

function clearActorRelationDialog()
{
  var relationCategorySelector = $('table#actorRelation select[name="editActorRelation[categoryId]"]');

  // Clear data out of yui dialog
  $('table#actorRelation input[name="editActorRelation[actorName]"]').val('');
  $('table#actorRelation input[name="editActorRelation[startDate]"]').val('');
  $('table#actorRelation input[name="editActorRelation[endDate]"]').val('');
  $('table#actorRelation input[name="editActorRelation[dateDisplay]"]').val('');
  $('table#actorRelation textarea[name="editActorRelation[description]"]').val('');
  $('table#actorRelation input[name="editActorRelation[id]"]').remove();
  relationCategorySelector.get(0).options[0].selected = true;

  return true;
}

function renderActorRelationDialog(context)
{
  var i = 0; // Counter

  // Write data from dialog to form to submit with page submit
  var handleSubmit = function() {
    submitActorRelationDialog(this.getData(), i++); // Save the data to the main form
    this.hide(); // Hide dialog
    clearActorRelationDialog(); // Clear the dialog form
  };

  var handleCancel = function() {
    this.cancel();
    clearActorRelationDialog();
  };

  // Move actorRelation table contents into yui dialog container.
  // This ensures that the standard form still works if javascript is disabled
  var actorRelationTable = $('table#actorRelation');
  actorRelationTable.clone().appendTo('div#actorRelationDialog div.bd form');
  actorRelationTable.remove();
  $('fieldset#newActorEventFields').remove();

  // Instantiate the Dialog
  Qubit.actorRelationDialog = new YAHOO.widget.Dialog("actorRelationDialog",
  {
    width: "480px",
    zIndex: "100",
    fixedcenter: true,
    visible: false,
    modal: true,
    constraintoviewport: true,
    postmethod: 'none',
    buttons: [ { text: "Submit", handler: handleSubmit, isDefault: true },
                { text: "Cancel", handler: handleCancel } ],
    effect: { effect: YAHOO.widget.ContainerEffect.FADE, duration: 0.25 }
  } );

  Qubit.actorRelationDialog.render();
}
