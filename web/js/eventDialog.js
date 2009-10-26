// $Id$


/**
 * Common functions
 */
function QubitEvent(idString)
{
  this.identifier = idString;
  this.data = {
    "id": null,
    "startDate": null,
    "startTime": null,
    "endDate": null,
    "endTime": null,
    "informationObjectId": null,
    "actor": null,
    "resourceTitle": null,
    "resourceTypeId": null,
    "description": null,
    "dateDisplay": null
  }
}

function deleteEvent(index)
{
  var deleteEvents = $('body').data('deleteEvents');

  // Hide and remove this event
  $('tr#event_' + index + ' div').hide('normal', function() { $('tr#event_' + index).remove() });

  // Remove event from editEvents data cache
  delete $('body').data('cachedEvents')[index];

  // Add to list of events to delete on form submit
  if (index.substr(0,3) != 'new')
  {
    deleteEvents = deleteEvents.concat(index);
    $('body').data('deleteEvents', deleteEvents);
  }
}

function getEventAjax(eventId, dialogType)
{
  $.getJSON( Qubit.paths.eventShow + '?id=' + eventId + '&returnFormat=json',
  function(jsonData) {
    var thisEvent = new QubitEvent(eventId);

    for (column in jsonData)
    {
      thisEvent.data[column] = jsonData[column];
    }

    // cache data locally so we don't have to hit the database again
    var eventCache = $('body').data('cachedEvents');
    eventCache[eventId] = thisEvent;
    $('body').data('cachedEvents', eventCache);

    // Populate and show the dialog form
    populateEventDialog(thisEvent, dialogType);
  } );
}

function populateEventDialog(thisEvent, dialogType)
{
  var dialog = $('table#newEvent');

  // Set Id
  dialog.append('<input type="hidden" name="newEvent[id]" value="' + thisEvent.identifier + '" />');

  // Set column values
  for (fieldName in dialogType.fields)
  {
    if (dialogType.fields[fieldName].type == 'input')
    {
      dialog.find('input[name="newEvent[' + fieldName + ']"]').val(thisEvent.data[fieldName]);
    }
    else
    {
      // Select correct value in select boxes
      var selectedOption = dialog.find('select[name="newEvent[' + fieldName + ']"] option[value=' + thisEvent.data[fieldName] + ']');
      if (0 < selectedOption.length)
      {
        selectedOption.get(0).selected = true;
      }
    }
  }
}

function clearEventDialog(dialogType)
{
  // Remove "id" input
  $('table#newEvent input[name="newEvent[id]"]').remove();

  // Clear input fields
  for (fieldName in dialogType.fields)
  {
    if (dialogType.fields[fieldName].type == 'input')
    {
      $('table#newEvent input[name="newEvent[' + fieldName + ']"]').val('');
      
      // For YUI autocomplete also clear yui-ac-input value
      if (undefined != dialogType.fields[fieldName].id)
      {
        $('#' + dialogType.fields[fieldName].id).val('');
      }
    }
    else
    {
      // Select first option in all selectors
      var selector = $('table#newEvent select[name="newEvent[' + fieldName + ']"]');
      selector.get(0).options[0].selected = true;
    }
  }

  return true;
}

function appendHiddenEventFormFields(thisForm)
{
  // Build hidden form input fields
  var newHiddens = '';
  var cachedEvents = $('body').data('cachedEvents');
  var deleteEvents = $('body').data('deleteEvents');
  var i = 0;

  for(var key in cachedEvents)
  {
    var thisEvent = cachedEvents[key];

    // Convert all event data into a hidden input fields
    for (var name in thisEvent.data)
    {
      // Don't include "id" if parameter == null
      if ('id' == name && null == thisEvent.data.id)
      {
        continue;
      }

      newHiddens += '<input type="hidden" name="updateEvents[' + i + '][' + name + ']" value="' + thisEvent.data[name] + '" />\n';
    }
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

function submitEventDialog(formData, dialogType, i)
{
  var cachedEvents = $('body').data('cachedEvents');

  dialogType.loadData(formData, i);

  var thisEvent = new QubitEvent(dialogType.id);

  // Set the event id if dialogueType.id is not a derived identifier
  if ('new' != dialogType.id.substr(0, 3))
  {
    thisEvent.data.id = dialogType.id;
  }

  // Get form values
  for (fieldName in dialogType.fields)
  {
    thisEvent.data[fieldName] = dialogType.fields[fieldName].value;
  }

  // cache event data locally
  cachedEvents[thisEvent.identifier] = thisEvent;
  $('body').data('cachedEvents', cachedEvents);

  return thisEvent;
}

/**
 * Functions specific to ISAAR event dialog
 */
function editIsaarEventDialog(eventId)
{
  // Check for a local data cache for this event
  var eventCache = $('body').data('cachedEvents');
  var dialogType = new Qubit.IsaarEventDialog();

  if (eventCache[eventId] != undefined)
  {
    // Populate event dialog with cached data, then show it
    populateEventDialog(eventCache[eventId], dialogType);
  }
  else
  {
    // If no local data cache found, do ajax call
    getEventAjax(eventId, dialogType);
  }

  Qubit.eventDialog.show();
}

function updateIsaarEventList(thisEvent)
{
  // Calculate name to display
  var resourceTitle = thisEvent.data.resourceTitle;
  // Determine the date(s) to show in the creation events table
  var dateDisplay = thisEvent.data.dateDisplay;
  if (0 == dateDisplay.length && 0 < thisEvent.data.startDate.length)
  {
    dateDisplay = thisEvent.data.startDate;
    if (thisEvent.data.endDate.length > 0)
    {
      dateDisplay += ' - ' + thisEvent.data.endDate;
    }
  }

  // Get event type text
  var eventTypeDisplay = '';
  if (0 < thisEvent.data.typeId)
  {
    var eventTypeSelector = $('table#newEvent select[name="newEvent[typeId]"]');
    eventTypeDisplay = eventTypeSelector.find('option[value="' + thisEvent.data.typeId + '"]').text();
  }

  // Create html string for row
  var eventRowHtml = '<td><div>' + resourceTitle + '</div></td><td><div>' + eventTypeDisplay + '<div></td><td><div>' + dateDisplay + '<div></td><td style="text-align: right"><div><a href="javascript:editIsaarEventDialog(\'' + thisEvent.identifier + '\')"><img src="' + $('img#imagesPencilPng').attr('src') + '" align="top" /></a>&nbsp;<a href="javascript:deleteEvent(\'' + thisEvent.identifier + '\')"><img src="' + $('img#imagesDeletePng').attr('src') + '" align="top" /></a></div></td>';

  // Test if we are editing an existing event row
  var existingRow = $('table#relatedEvents tr#event_' + thisEvent.identifier);
  if (existingRow.length)
  {
    existingRow.html(eventRowHtml); // Write new row HTML
  }
  else
  {
    // Build a new row to append to the creationEvents Table
    var newRow = $('<tr id="event_' + thisEvent.identifier + '">' + eventRowHtml + '</tr>');

    // Append new row (hidden), then use fancy jquery "show" effect to reveal it
    $('div', newRow).hide();
    newRow.insertBefore('table#relatedEvents tr#addEventLink');
    $('div', newRow).show('normal');
  }
}

Qubit.IsaarEventDialog = function()
{
  this.id = null;

  this.fields = {
    "typeId": {"type": "select", "value": null},
    "resourceTypeId": {"type": "select", "value": null},
    "resourceTitle": {"type": "input", "value": null},
    "startDate": {"type": "input", "value": null},
    "endDate": {"type": "input", "value": null},
    "dateDisplay": {"type": "input", "value": null}
  };

  this.loadData = function(formData, i) {
    // Get a unique id (derive one if form doesn't provide one)
    this.id = (formData['newEvent[id]'] != undefined) ? formData['newEvent[id]'] : 'new' + i;

    this.fields.typeId.value = formData['newEvent[typeId]'];
    this.fields.resourceTypeId.value = formData['newEvent[resourceTypeId]'];
    this.fields.resourceTitle.value = formData['newEvent[resourceTitle]'];
    this.fields.startDate.value = formData['newEvent[startDate]'];
    this.fields.endDate.value = formData['newEvent[endDate]'];
    this.fields.dateDisplay.value = formData['newEvent[dateDisplay]'];
  }
}

function renderIsaarEventDialog(context)
{
  var i = 0; // Counter
  var dialogType = new Qubit.IsaarEventDialog();

  // Write data from dialog to informationobject/edit form for submission.
  var handleSubmit = function() {
    thisEvent = submitEventDialog(this.getData(), dialogType, i++); // Save the data to the main form
    this.hide(); // Hide dialog
    updateIsaarEventList(thisEvent); // Update the list of related events
    clearEventDialog(dialogType); // Clear the dialog form
  };

  var handleCancel = function() {
    this.cancel();
    clearEventDialog(dialogType);
  };

  // Move newEvent table contents into yui dialog container.
  // This ensures that the standard form still works if javascript is disabled
  var newEventTable = $('table#newEvent');
  newEventTable.clone().appendTo('div#eventDialog div.bd form');
  newEventTable.remove();

  // Instantiate the Dialog
  Qubit.eventDialog = new YAHOO.widget.Dialog("eventDialog",
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

  Qubit.eventDialog.render();
}

/**
 * Functions specific to information object event dialog
 */
function editInformationObjectEventDialog(eventId)
{
  // Check for a local data cache for this event
  var eventCache = $('body').data('cachedEvents');
  var dialogType = new Qubit.InformationObjectEventDialog();

  if (eventCache[eventId] != undefined)
  {
    // Populate event dialog with cached data, then show it
    populateEventDialog(eventCache[eventId], dialogType);
  }
  else
  {
    // If no local data cache found, do ajax call
    getEventAjax(eventId, dialogType);
  }

  Qubit.eventDialog.show();
}

function updateInformationObjectEventList(thisEvent)
{
  // Get the actor name to show in the creation events table
  var nameDisplay = $('#newEventActor').val();

  // Determine the date(s) to show in the creation events table
  var dateDisplay = thisEvent.data.dateDisplay;
  if (0 == dateDisplay.length && 0 < thisEvent.data.startDate.length)
  {
    dateDisplay = thisEvent.data.startDate;
    if (0 < thisEvent.data.endDate.length)
    {
      dateDisplay += ' - ' + thisEvent.data.endDate;
    }
  }

  // Get event type text
  var eventTypeDisplay = '';
  if (0 < thisEvent.data.typeId)
  {
    var eventTypeSelector = $('table#newEvent select[name="newEvent[typeId]"]');
    eventTypeDisplay = eventTypeSelector.find('option[value="' + thisEvent.data.typeId + '"]').text();
  }

  // Create html string for row
  var eventRowHtml = '<td><div>' + nameDisplay + '</div></td><td><div>' + eventTypeDisplay + '<div></td><td><div>' + dateDisplay + '<div></td><td style="text-align: right"><div><a href="javascript:editInformationObjectEventDialog(\'' + thisEvent.identifier + '\')"><img src="' + $('img#imagesPencilPng').attr('src') + '" align="top" /></a>&nbsp;<a href="javascript:deleteEvent(\'' + thisEvent.identifier + '\')"><img src="' + $('img#imagesDeletePng').attr('src') + '" align="top" /></a></div></td>';

  // Test if we are editing an existing event row
  var existingRow = $('table#relatedEvents tr#event_' + thisEvent.identifier);
  if (0 < existingRow.length)
  {
    existingRow.html(eventRowHtml); // Write new row HTML
  }
  else
  {
    // Build a new row to append to the creationEvents Table
    var newRow = $('<tr id="event_' + thisEvent.identifier + '">' + eventRowHtml + '</tr>');

    // Append new row (hidden), then use fancy jquery "show" effect to reveal it
    $('div', newRow).hide();
    newRow.insertBefore('table#relatedEvents tr#addEventLink');
    $('div', newRow).show('normal');
  }
}

Qubit.InformationObjectEventDialog = function()
{
  this.id = null;

  this.fields = {
    "typeId": {"type": "select", "value": null},
    "place": {"type": "select", "value": null, "id": "newEventPlace"},
    "actor": {"type": "input", "value": null, "id": "newEventActor"},
    "startDate": {"type": "input", "value": null},
    "endDate": {"type": "input", "value": null},
    "dateDisplay": {"type": "input", "value": null},
    "description": {"type": "input", "value": null}
  };

  this.loadData = function(formData, i) {
    // Get a unique id (derive one if form doesn't provide one)
    this.id = (formData['newEvent[id]'] != undefined) ? formData['newEvent[id]'] : 'new' + i;

    this.fields.typeId.value = formData['newEvent[typeId]'];
    this.fields.place.value = formData['newEvent[place]'];
    this.fields.actor.value = formData['newEvent[actor]'];
    this.fields.startDate.value = formData['newEvent[startDate]'];
    this.fields.endDate.value = formData['newEvent[endDate]'];
    this.fields.dateDisplay.value = formData['newEvent[dateDisplay]'];
    this.fields.description.value = formData['newEvent[description]'];
  }
}

function renderInformationObjectEventDialog(context)
{
  var i = 0; // Counter
  var dialogType = new Qubit.InformationObjectEventDialog();

  // Write data from dialog to informationobject/edit form for submission.
  var handleSubmit = function() {
    thisEvent = submitEventDialog(this.getData(), dialogType, i++); // Save the data to the main form
    this.hide(); // Hide dialog
    updateInformationObjectEventList(thisEvent); // Update the list of related events
    clearEventDialog(dialogType); // Clear the dialog form
  };

  var handleCancel = function() {
    this.cancel();
    clearEventDialog(dialogType);
  };

  // Move newEvent table contents into yui dialog container.
  // This ensures that the standard form still works if javascript is disabled
  var newEventTable = $('table#newEvent');
  newEventTable.appendTo('div#eventDialog div.bd form');

  // Instantiate the Dialog
  Qubit.eventDialog = new YAHOO.widget.Dialog("eventDialog",
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

  Qubit.eventDialog.render();
}
