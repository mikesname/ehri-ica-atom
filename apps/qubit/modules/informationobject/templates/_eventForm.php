<?php

use_helper('Javascript');

// Define template for new relation table rows added by dialog
$editImage = image_tag('pencil', array('style' => 'align: top', 'alt' => 'edit'));
$deleteBtn = '<button class="delete-small" name="delete" />';

$rowTemplate = '<tr id="{updateEvent[id]}">';
$rowTemplate .= '<td>{updateEvent[actor]}</td>';
$rowTemplate .= '<td>{updateEvent[typeId]}</td>';
$rowTemplate .= '<td>{updateEvent[dateDisplay]}</td>';
$rowTemplate .= '<td style="text-align: right">'.$editImage.' '.$deleteBtn.'</td>';
$rowTemplate .= '</tr>';

// Omit edit button if object is being duplicated
$addEditButtonJsCode = null;
if (false == isset($sf_request->source))
{
  $addEditButtonJsCode = <<<EOF
// Add edit link/icon to 'relatedFunctions' rows
jQuery('#relatedEvents').find('tr').each(function ()
{
  var thisUri = this.id;

  if (undefined != thisUri)
  {
    jQuery('td:last', this).prepend('<a href="javascript:Qubit.dialog.open(\'' + thisUri + '\')">$editImage</a>');
  }
});
EOF;
}

echo javascript_tag(<<<EOL
Drupal.behaviors.dialog = {
  attach: function (context)
  {
    // Add special rendering rules
    var handleFieldRender = function(obj, fname)
    {
      var matches = fname.match(/(\w+)\[(\w+)\]/);
      if (null == matches)
      {
        return obj.renderField(fname);
      }

      switch (matches[2])
      {
        case 'dateDisplay':
          if (0 < obj.getField('dateDisplay').value.length)
          {
            return obj.getField('dateDisplay').value;
          }
          else if (0 < obj.getField('startDate').value.length && 0 < obj.getField('endDate').value.length)
          {
            return obj.getField('startDate').value + ' - ' + obj.getField('endDate').value;
          }
          else
          {
            return obj.getField('startDate').value;
          }

          break;

        default:
          return obj.renderField(fname);
      }
    }

    // Define dialog
    Qubit.dialog = new QubitDialog('updateEvent',
    {
      "displayTable": "relatedEvents",
      "newRowTemplate": '$rowTemplate',
      "handleFieldRender": handleFieldRender
    }, jQuery);

    $addEditButtonJsCode
  }
}
EOL
) ?>

<!-- * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *  -->
<!-- NOTE: The dialog.js script cuts this table and moves it to a YUI -->
<!-- dialog object.                                                   -->
<!-- * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *  -->
<table id="updateEvent" class="inline">
  <caption><?php echo __('Event') ?></caption>
  <tr>
    <td colspan="3" class="headerCell" style="width: 55%;"><?php echo __('Actor name') ?></td>
  </tr><tr>
    <td colspan="3" class="noline">
      <select id="updateEventActor" name="updateEvent[actor]" class="form-autocomplete"></select>
      <?php if (QubitAcl::check(QubitActor::getRoot(), 'create')): ?>
        <input class="add" type="hidden" value="<?php echo url_for(array('module' => 'actor', 'action' => 'create')) ?> #authorizedFormOfName"/>
      <?php endif; ?>
      <input class="list" type="hidden" value="<?php echo url_for(array('module' => 'actor', 'action' => 'autocomplete')) ?>"/>
    </td>
  </tr><tr>
    <td colspan="2" class="headerCell" style="width: 55%;">
      <?php echo __('Event type') ?></td><td class="headerCell" style="width: 40%;"><?php echo __('Place') ?>
    </td>
  </tr><tr>
    <td colspan="2" class="noline">
      <?php echo select_tag('updateEvent[typeId]', options_for_select($eventTypes, $defaultEventType))?>
    </td><td class="noline">
      <select id="updateEventPlace" name="updateEvent[place]" class="form-autocomplete"></select>
      <?php if (QubitAcl::check(QubitTaxonomy::getById(QubitTaxonomy::PLACE_ID), 'createTerm')): ?>
        <input class="add" type="hidden" value="<?php echo url_for(array('module' => 'term', 'action' => 'create', 'taxonomyId' => QubitTaxonomy::PLACE_ID)) ?> #name"/>
      <?php endif; ?>
      <input class="list" type="hidden" value="<?php echo url_for(array('module' => 'term', 'action' => 'autocomplete', 'taxonomyId' => QubitTaxonomy::PLACE_ID)) ?>"/> </td>
  </tr><tr>
    <td class="headerCell">
      <?php echo __('Date') ?>
    </td><td class="headerCell">
      <?php echo __('End date') ?>
    </td><td class="headerCell">
      <?php echo __('Date display (defaults to date range)') ?>
    </td>
  </tr><tr>
    <td class="noline">
      <?php echo input_tag('updateEvent[startDate]') ?>
    </td><td class="noline">
      <?php echo input_tag('updateEvent[endDate]') ?>
    </td><td class="noline">
      <?php echo input_tag('updateEvent[dateDisplay]') ?>
    </td>
  </tr><tr>
    <td colspan="3" class="headerCell">
      <?php echo __('Event note') ?>
    </td>
  </tr><tr>
    <td colspan="3" class="noline">
      <?php echo input_tag('updateEvent[description]') ?>
    </td>
  </tr>
</table>
