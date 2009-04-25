// $Id$

function deleteEvent(index)
{
  var deleteEvents = $('body').data('deleteEvents');

  // Hide and remove this event
  $('tr#actorEvent_' + index + ' div').hide('normal', function() { $('tr#actorEvent_' + index).remove() });

  // Remove event from actorEvent data cache
  delete $('body').data('actorEvents')[index];

  // Add to list of events to delete on form submit
  if (index.substr(0,3) != 'new')
  {
    deleteEvents = deleteEvents.concat(index);
    $('body').data('deleteEvents', deleteEvents);
  }
}

function editActorEventDialog(eventId)
{
  // Check for a local data cache for this event
  var actorEvents = $('body').data('actorEvents');

  if (actorEvents[eventId] != undefined)
  {
    // Populate actorEvent dialog with cached data, then show it
    populateActorEventDialog(actorEvents[eventId]);
    Qubit.actorEventDialog.show();
  }
  else
  {
    // If no local data cache found, do ajax call
    getActorEventAjax(eventId);
  }
}

function getActorEventAjax(eventId)
{
  $.getJSON( Qubit.paths.eventShow + '?id=' + eventId + '&returnFormat=json',
  function(jsonData) {
    // Append "inDatabase" to results
    jsonData.inDatabase = true;

    // cache data locally so we don't have to hit the database again
    var actorEvents = $('body').data('actorEvents');
    actorEvents[eventId] = jsonData;
    $('body').data('actorEvents', actorEvents);

    // Populate and show the dialog form
    populateActorEventDialog(jsonData);
    Qubit.actorEventDialog.show();
  } );
}

function populateActorEventDialog(data)
{
  var dialog = $('table#actorEvent');

  // Set Id
  dialog.append('<input type="hidden" name="editActorEvent[id]" value="' + data.id + '" />');

  // Set fields
  dialog.find('input[name="editActorEvent[newActorName]"]').val(data.newActorName);
  dialog.find('input[name="editActorEvent[year]"]').val(data.year);
  dialog.find('input[name="editActorEvent[endYear]"]').val(data.endYear);
  dialog.find('input[name="editActorEvent[dateDisplay]"]').val(data.dateDisplay);
  dialog.find('input[name="editActorEvent[description]"]').val(data.description);

  // Select correct actor in selectbox
  var actorIdOption = dialog.find('select[name="editActorEvent[actorId]"] option[value=' + data.actorId + ']');
  if (actorIdOption.length > 0)
  {
    actorIdOption.get(0).selected = true;
  }

  // Select correct place in selectbox
  var eventTypeIdOption = dialog.find('select[name="editActorEvent[eventTypeId]"] option[value=' + data.eventTypeId + ']');
  if (eventTypeIdOption.length > 0)
  {
    eventTypeIdOption.get(0).selected = true;
  }

  // Select correct place in selectbox
  var placeIdOption = dialog.find('select[name="editActorEvent[placeId]"] option[value=' + data.placeId + ']');
  if (placeIdOption.length > 0)
  {
    placeIdOption.get(0).selected = true;
  }
}

function clearActorEventDialog()
{
  var actorSelector = $('table#actorEvent select[name="editActorEvent[actorId]"]');
  var eventTypeSelector = $('table#actorEvent select[name="editActorEvent[eventTypeId]"]');
  var placeSelector = $('table#actorEvent select[name="editActorEvent[placeId]"]');

  // Clear data out of yui dialog
  $('table#actorEvent input[name="editActorEvent[newActorName]"]').val('');
  $('table#actorEvent input[name="editActorEvent[year]"]').val('');
  $('table#actorEvent input[name="editActorEvent[endYear]"]').val('');
  $('table#actorEvent input[name="editActorEvent[dateDisplay]"]').val('');
  $('table#actorEvent input[name="editActorEvent[description]"]').val('');
  $('table#actorEvent input[name="editActorEvent[id]"]').remove();
  actorSelector.get(0).options[0].selected = true;
  eventTypeSelector.get(0).options[0].selected = true;
  placeSelector.get(0).options[0].selected = true;

  return true;
}

function appendHiddenFormFields(thisForm)
{
  // Build hidden form input fields
  var newHiddens = '';
  var actorEvents = $('body').data('actorEvents');
  var deleteEvents = $('body').data('deleteEvents');
  var i = 0;

  for(var key in actorEvents)
  {
    var actorEvent = actorEvents[key];

    // Add the event id, if we're updating an event that's already in the db
    if (actorEvent.inDatabase == true)
    {
      newHiddens += '<input type="hidden" name="editActorEvents[' + i + '][id]" value="' + actorEvent.id + '" />\n';
    }

    newHiddens += '<input type="hidden" name="editActorEvents[' + i + '][actorId]" value="' + actorEvent.actorId + '" />\n';
    newHiddens += '<input type="hidden" name="editActorEvents[' + i + '][newActorName]" value="' + actorEvent.newActorName + '" />\n';
    newHiddens += '<input type="hidden" name="editActorEvents[' + i + '][eventTypeId]" value="' + actorEvent.eventTypeId + '" />\n';
    newHiddens += '<input type="hidden" name="editActorEvents[' + i + '][placeId]" value="' + actorEvent.placeId + '" />\n';
    newHiddens += '<input type="hidden" name="editActorEvents[' + i + '][year]" value="' + actorEvent.year + '" />\n';
    newHiddens += '<input type="hidden" name="editActorEvents[' + i + '][endYear]" value="' + actorEvent.endYear + '" />\n';
    newHiddens += '<input type="hidden" name="editActorEvents[' + i + '][dateDisplay]" value="' + actorEvent.dateDisplay + '" />\n';
    newHiddens += '<input type="hidden" name="editActorEvents[' + i + '][description]" value="' + actorEvent.description + '" />\n';
    i++;
  }

  for(var key in deleteEvents)
  {
    newHiddens += '<input type="hidden" name="deleteEvents[' + deleteEvents[key] + ']" value="delete" />\n';
    i++;
  }

  // Append hidden input fields
  thisForm.append(newHiddens);
}

function submitActorEventDialog(thisData, i)
{
  var actorSelector = $('table#actorEvent select[name="editActorEvent[actorId]"]');
  var eventTypeSelector = $('table#actorEvent select[name="editActorEvent[eventTypeId]"]');
  var placeSelector = $('table#actorEvent select[name="editActorEvent[placeId]"]');

  // Get an id  or assign an id of "newX" for new events
  var thisId = (thisData['editActorEvent[id]'] != undefined) ? thisData['editActorEvent[id]'] : 'new' + i;

  // cache event data locally
  var actorEvents = $('body').data('actorEvents');
  var inDatabase = (actorEvents[thisId] == undefined || actorEvents[thisId].inDatabase != true) ? false : true;
  actorEvents[thisId] = {
    "id": thisId,
    "actorId": thisData['editActorEvent[actorId]'],
    "newActorName": thisData['editActorEvent[newActorName]'],
    "eventTypeId": thisData['editActorEvent[eventTypeId]'],
    "placeId": thisData['editActorEvent[placeId]'],
    "year": thisData['editActorEvent[year]'],
    "endYear": thisData['editActorEvent[endYear]'],
    "dateDisplay": thisData['editActorEvent[dateDisplay]'],
    "description": thisData['editActorEvent[description]'],
    "inDatabase": inDatabase
  };
  $('body').data('actorEvents', actorEvents);

  // Determine the actor name to show in the creation events table
  var actorId = thisData['editActorEvent[actorId]'];
  var nameDisplay = '';
  if (actorId > 0)
  {
    nameDisplay = actorSelector.find('option:selected').text();
  }
  else if (thisData['editActorEvent[newActorName]'].length > 0)
  {
    nameDisplay = thisData['editActorEvent[newActorName]'];
  }

  // Determine the date(s) to show in the creation events table
  var dateDisplay = thisData['editActorEvent[dateDisplay]'];
  if (dateDisplay.length == 0 && thisData['editActorEvent[year]'].length > 0)
  {
    dateDisplay = thisData['editActorEvent[year]'];
    if (thisData['editActorEvent[endYear]'].length > 0)
    {
      dateDisplay += ' - ' + thisData['editActorEvent[endYear]'];
    }
  }

  // Get event type text
  var eventTypeId = thisData['editActorEvent[eventTypeId]'];
  var eventTypeDisplay = '';
  if (eventTypeId.length > 0)
  {
    eventTypeDisplay = eventTypeSelector.find('option:selected').text()
  }

  // Create html string for row
  var eventRowHtml = '<td><div>' + nameDisplay + '</div></td><td><div>' + eventTypeDisplay + '<div></td><td><div>' + dateDisplay + '<div></td><td style="text-align: right"><div><a href="javascript:editActorEventDialog(\'' + thisId + '\')"><img src="' + $('img#imagesPencilPng').attr('src') + '" align="top" /></a><a href="javascript:deleteEvent(\'' + thisId + '\')"><img src="' + $('img#imagesDeletePng').attr('src') + '" align="top" /></a></div></td>';

  // Test if we are editing an existing event row
  var existingRow = $('table#actorEvents tr#actorEvent_' + thisId);
  if (existingRow.length)
  {
    existingRow.html(eventRowHtml); // Write new row HTML
  }
  else
  {
    // Build a new row to append to the creationEvents Table
    var newRow = $('<tr id="actorEvent_' + thisId + '">' + eventRowHtml + '</tr>');

    // Append new row (hidden), then use fancy jquery "show" effect to reveal it
    $('div', newRow).hide();
    newRow.insertBefore('table#actorEvents tr#addActorEventLink');
    $('div', newRow).show('normal');
  }
}

function renderActorEventDialog(context)
{
  var i = 0; // Counter

  // Write data from dialog to informationobject/edit form for submission.
  var handleSubmit = function() {
    submitActorEventDialog(this.getData(), i++); // Save the data to the main form
    this.hide(); // Hide dialog
    clearActorEventDialog(); // Clear the dialog form
  };

  var handleCancel = function() {
    this.cancel();
    clearActorEventDialog();
  };

  // Move editActorEvent table contents into yui dialog container.
  // This ensures that the standard form still works if javascript is disabled
  var actorEventTable = $('table#actorEvent');
  actorEventTable.clone().appendTo('div#actorEventDialog div.bd form');
  actorEventTable.remove();
  $('label[for=newActorEvent]').remove();
  $('fieldset#newActorEventFields').remove();

  // Instantiate the Dialog
  Qubit.actorEventDialog = new YAHOO.widget.Dialog("actorEventDialog",
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

  Qubit.actorEventDialog.render();
}
