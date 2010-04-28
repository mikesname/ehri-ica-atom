<?php use_helper('Javascript') ?>

<h1>
  <?php if (isset($sf_request->id)): ?>
    <?php echo __('Edit ISDF function') ?>
  <?php else: ?>
    <?php echo __('Create ISDF function') ?>
  <?php endif; ?>
</h1>

<h1 class="label"><?php echo render_title($func->getLabel()) ?></h1>

<?php echo $form->renderGlobalErrors() ?>

<?php if (isset($sf_request->id)): ?>
  <?php echo $form->renderFormTag(url_for(array($func, 'module' => 'function', 'action' => 'edit')), array('id' => 'editForm')) ?>
<?php else: ?>
  <?php echo $form->renderFormTag(url_for(array('module' => 'function', 'action' => 'create')), array('id' => 'editForm')) ?>
<?php endif; ?>

  <?php echo $form->renderHiddenFields() ?>

  <fieldset class="collapsible collapsed" id="identityArea">

    <legend><?php echo __('Identity area') ?></legend>

    <?php echo $form->type
      ->label(__('Type').'<span class="form-required" title="'.__('This is a mandatory element.').'">*</span>')
      ->renderRow() ?>

    <?php echo render_field($form->authorizedFormOfName
      ->label(__('Authorized form of name').'<span class="form-required" title="'.__('This is a mandatory element.').'">*</span>'), $func) ?>

    <?php echo $form->parallelName
      ->label(__('Parallel form(s) of name'))
      ->renderRow() ?>

    <?php echo $form->otherName
      ->label(__('Other form(s) of name'))
      ->renderRow() ?>

    <?php echo render_field($form->classification, $func) ?>

  </fieldset>

  <fieldset class="collapsible collapsed" id="descriptionArea">

    <legend><?php echo __('Context area') ?></legend>

    <?php echo render_field($form->dates, $func) ?>

    <?php echo render_field($form->description, $func, array('class' => 'resizable')) ?>

    <?php echo render_field($form->history, $func, array('class' => 'resizable')) ?>

    <?php echo render_field($form->legislation, $func, array('class' => 'resizable')) ?>

  </fieldset>

  <fieldset class="collapsible collapsed" id="relationshipsArea">

    <legend><?php echo __('Relationships area') ?></legend>

    <div class="form-item">
      <table class="inline" id="relatedFunctions">
        <caption><?php echo __('Related functions') ?></caption>
        <tr>
          <th style="width: 25%">
            <?php echo __('Name') ?>
          </th><th style="width: 15%">
            <?php echo __('Category') ?>
          </th><th style="width: 30%">
            <?php echo __('Description') ?>
          </th><th style="width: 20%">
            <?php echo __('Dates') ?>
          </th><th style="width: 10%; text-align: center">
            <?php echo image_tag('delete', array('align' => 'top', 'class' => 'deleteIcon')) ?>
          </th>
        </tr>
        <?php foreach ($relatedFunctions as $item): ?>
          <tr id="<?php echo url_for(array($item, 'module' => 'relation')) ?>" class="<?php echo 'related_obj_'.$item->id ?>">
            <td>
              <?php if ($func->id == $item->objectId): ?>
                <?php echo render_title($item->subject) ?>
              <?php else: ?>
                <?php echo render_title($item->object) ?>
              <?php endif; ?>
            </td><td>
              <?php echo $item->type ?>
            </td><td>
              <?php echo $item->getNoteByTypeId(QubitTerm::RELATION_NOTE_DESCRIPTION_ID) ?>
            </td><td>
              <?php if (0 < strlen($dateDisplay = $item->getNoteByTypeId(QubitTerm::RELATION_NOTE_DATE_DISPLAY_ID)) || 0 < count($dateArray = $item->getDates())): ?>
                <?php if (0 < strlen($dateDisplay)): ?>
                  <?php echo $dateDisplay ?>
                <?php elseif (2 == count($dateArray)): ?>
                  <?php echo __('%1% - %2%', array('%1%' => collapse_date($dateArray['start']), '%2%' => collapse_date($dateArray['end']))) ?>
                <?php else: ?>
                  <?php echo collapse_date(array_shift($dateArray)) ?>
                <?php endif; ?>
              <?php endif; ?>
            </td><td style="text-align: center">
              <input type="checkbox" name="deleteRelations[<?php echo $item->id ?>]" value="delete" class="multiDelete"/>
            </td>
          </tr>
        <?php endforeach; ?>
      </table>
    </div>

    <?php
    // Define template for new relation table rows added by dialog
    $editImage = image_tag('pencil', array('style' => 'align: top', 'alt' => 'edit'));
    $deleteBtn = '<button class="delete-small" name="delete" />';

    $rowTemplate = '<tr id="{relation[id]}">';
    $rowTemplate .= '<td>{relation[authorizedFormOfName]}</td>';
    $rowTemplate .= '<td>{relation[category]}</td>';
    $rowTemplate .= '<td>{relation[description]}</td>';
    $rowTemplate .= '<td>{relation[dateDisplay]}</td>';
    $rowTemplate .= '<td style="text-align: right">'.$editImage.' '.$deleteBtn.'</td>';
    $rowTemplate .= '</tr>';

    $linkToShow = url_for(array($func, 'module' => 'function'));

    echo javascript_tag(<<<EOL
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

Drupal.behaviors.dialog = {
  attach: function (context)
  {
    // Map 'q_relation' table data to dialog fields
    var relationTableMap = function (data)
    {
      var output = {};
      for (col in data)
      {
        switch(col)
        {
          case 'subject':
          case 'object':
            if ('$linkToShow' != data[col])
            {
              output['relation[authorizedFormOfName]'] = data[col];
            }
            break;

          case 'type':
            output['relation[category]'] = data[col];
            break;

          default:
            output['relation[' + col + ']'] = data[col];
        }
      }

      return output;
    }

    // Define dialog
    Qubit.dialog = new QubitDialog('functionRelation',
    {
      "displayTable": "relatedFunctions",
      "newRowTemplate": '$rowTemplate',
      "handleFieldRender": handleFieldRender,
      "relationTableMap": relationTableMap,
    }, jQuery);

    // Add edit link/icon to 'relatedFunctions' rows
    jQuery('#relatedFunctions').find('tr').each(function ()
    {
      var thisUri = this.id;

      if (undefined != thisUri)
      {
        jQuery('td:last', this).prepend('<a href="javascript:Qubit.dialog.open(\'' + thisUri + '\')">$editImage</a>');
      }
    });
  }
}
EOL
) ?>

    <!-- * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *  -->
    <!-- NOTE: The dialog.js script cuts this *entire* table and pastes   -->
    <!-- it in a YUI dialog object.                                       -->
    <!-- * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *  -->
    <table class="inline" id="functionRelation">
      <caption><?php echo __('Relationship') ?></caption>
      <tbody>
        <tr>
          <th colspan="4">
            <?php echo $form['relation[authorizedFormOfName]']
              ->label(__('Authorized form of name'))
              ->renderLabel() ?>
          </th>
        </tr><tr>
          <td colspan="4">
            <?php echo $form['relation[authorizedFormOfName]']->render(array('class' => 'form-autocomplete')) ?>
            <input class="list" type="hidden" value="<?php echo url_for(array('module' => 'function', 'action' => 'autocomplete')) ?>"/>
          </td>
        </tr><tr>
          <th colspan="4">
            <?php echo $form['relation[category]']
              ->label(__('Category'))
              ->renderLabel() ?>
          </th>
        </tr><tr>
          <td colspan="4">
            <?php echo $form['relation[category]'] ?>
          </td>
        </tr><tr>
          <th colspan="4">
            <?php echo $form['relation[description]']
              ->label(__('Description'))
              ->renderLabel() ?>
          </th>
        </tr><tr>
          <td colspan="4">
            <?php echo $form['relation[description]'] ?>
          </td>
        </tr><tr>
          <th style="width: 25%">
            <?php echo $form['relation[startDate]']
              ->label('Date&dagger;')
              ->renderLabel() ?>
          </th><th style="width: 25%">
            <?php echo $form['relation[endDate]']
              ->label('End date&dagger;')
              ->renderLabel() ?>
          </th><th colspan="2" style="width: 50%">
            <?php echo $form['relation[dateDisplay]']
              ->label('Date display&dagger;')
              ->renderLabel() ?>
          </th>
        </tr><tr>
          <td style="width: 25%">
            <?php echo $form['relation[startDate]'] ?>
          </td><td style="width: 25%">
            <?php echo $form['relation[endDate]'] ?>
          </td><td colspan="2" style="width: 50%">
            <?php echo $form['relation[dateDisplay]'] ?>
          </td>
        </tr><tr>
          <td colspan="4">
            <?php echo __('%1% - dates must be specified in ISO-8601 format (YYYY-MM-DD)', array('%1%' => '&dagger;'))?>
          </td>
        </tr>
      </tbody>
    </table>

    <div class="form-item">
      <table class="inline" id="relatedEntityDisplay">
        <caption><?php echo __('Related authority records') ?></caption>
        <tr>
          <th style="width: 25%">
            <?php echo __('Identifier/name') ?>
          </th><th style="width: 30%">
            <?php echo __('Nature of relationship') ?>
          </th><th style="width: 20%">
            <?php echo __('Dates') ?>
          </th><th style="width: 10%; text-align: center">
            <?php echo image_tag('delete', array('align' => 'top', 'class' => 'deleteIcon')) ?>
          </th>
        </tr>
        <?php foreach ($actorRelations as $item): ?>
          <tr id="<?php echo url_for(array($item, 'module' => 'relation')) ?>" class="<?php echo 'related_obj_'.$item->id ?>">
            <td>
              <?php echo render_title($item->object) ?>
            </td><td>
              <?php echo $item->getNoteByTypeId(QubitTerm::RELATION_NOTE_DESCRIPTION_ID) ?>
            </td><td>
              <?php if (0 < strlen($dateDisplay = $item->getNoteByTypeId(QubitTerm::RELATION_NOTE_DATE_DISPLAY_ID)) || 0 < count($dateArray = $item->getDates())): ?>
                <?php if (0 < strlen($dateDisplay)): ?>
                  <?php echo $dateDisplay ?>
                <?php elseif (2 == count($dateArray)): ?>
                  <?php echo __('%1% - %2%', array('%1%' => collapse_date($dateArray['start']), '%2%' => collapse_date($dateArray['end']))) ?>
                <?php else: ?>
                  <?php echo collapse_date(array_shift($dateArray)) ?>
                <?php endif; ?>
              <?php endif; ?>
            </td><td style="text-align: center">
              <input type="checkbox" name="deleteRelations[<?php echo $item->id ?>]" value="delete" class="multiDelete" />
            </td>
          </tr>
        <?php endforeach; ?>
      </table>
    </div>

    <?
    // Template for new display table rows
    $rowTemplate = '<tr id="{relatedEntity[id]}">';
    $rowTemplate .= '<td>{relatedEntity[object]}</td>';
    $rowTemplate .= '<td>{relatedEntity[description]}</td>';
    $rowTemplate .= '<td>{relatedEntity[dateDisplay]}</td>';
    $rowTemplate .= '<td style="text-align: right">'.$editImage.' '.$deleteBtn.'</td>';
    $rowTemplate .= '</tr>';

    echo javascript_tag(<<<EOL
Drupal.behaviors.dialogRelatedEntity = {
  attach: function (context)
  {
    // Define dialog
    Qubit.dialogRelatedEntity = new QubitDialog('relatedEntity',
    {
      "displayTable": "relatedEntityDisplay",
      "newRowTemplate": '$rowTemplate',
      "handleFieldRender": handleFieldRender,
    }, jQuery);

    // Add edit link/icon to 'relatedFunctions' rows
    jQuery('#relatedEntityDisplay').find('tr').each(function ()
    {
      var thisUri = this.id;
      if (undefined != thisUri)
      {
        jQuery('td:last', this).prepend('<a href="javascript:Qubit.dialogRelatedEntity.open(\'' + thisUri + '\')">$editImage</a>');
      }
    });
  }
}
EOL
) ?>

    <!-- * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *  -->
    <!-- NOTE: The dialog.js script cuts this *entire* table and pastes   -->
    <!-- it in a YUI dialog object.                                       -->
    <!-- * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *  -->
    <table class="inline" id="relatedEntity">
      <caption><?php echo __('Related authority record') ?></caption>
      <tbody>
        <tr>
          <th colspan="4">
            <?php echo $form['relatedEntity[object]']
              ->label(__('Authorized form of name'))
              ->renderLabel() ?>
          </th>
        </tr><tr>
          <td colspan="4">
            <?php echo $form['relatedEntity[object]']->render(array('class' => 'form-autocomplete')) ?>
            <input class="list" type="hidden" value="<?php echo url_for(array('module' => 'actor', 'action' => 'autocomplete')) ?>"/>
          </td>
        </tr><tr>
          <th colspan="4">
            <?php echo $form['relatedEntity[description]']
              ->label(__('Nature of relationship'))
              ->renderLabel() ?>
          </th>
        </tr><tr>
          <td colspan="4">
            <?php echo $form['relatedEntity[description]'] ?>
          </td>
        </tr><tr>
          <th style="width: 25%">
            <?php echo $form['relatedEntity[startDate]']
              ->label(__('Date&dagger;'))
              ->renderLabel() ?>
          </th><th style="width: 25%">
            <?php echo $form['relatedEntity[endDate]']
              ->label(__('End date&dagger;'))
              ->renderLabel() ?>
          </th><th colspan="2" style="width: 50%">
            <?php echo $form['relatedEntity[dateDisplay]']
              ->label(__('Date display&dagger;'))
              ->renderLabel() ?>
          </th>
        </tr><tr>
          <td style="width: 25%">
            <?php echo $form['relatedEntity[startDate]'] ?>
          </td><td style="width: 25%">
            <?php echo $form['relatedEntity[endDate]'] ?>
          </td><td colspan="2" style="width: 50%">
            <?php echo $form['relatedEntity[dateDisplay]'] ?>
          </td>
        </tr><tr>
          <td colspan="4">
            <?php echo __('%1% - dates must be specified in ISO-8601 format (YYYY-MM-DD)', array('%1%' => '&dagger;'))?>
          </td>
        </tr>
      </tbody>
    </table>

    <div class="form-item">
      <table class="inline" id="relatedResourceDisplay">
        <caption><?php echo __('Related resources') ?></caption>
        <tr>
          <th style="width: 25%">
            <?php echo __('Identifier/title') ?>
          </th><th style="width: 30%">
            <?php echo __('Nature of relationship') ?>
          </th><th style="width: 20%">
            <?php echo __('Dates') ?>
          </th><th style="width: 10%; text-align: center">
            <?php echo image_tag('delete', array('align' => 'top', 'class' => 'deleteIcon')) ?>
          </th>
        </tr>
        <?php foreach ($infoObjectRelations as $item): ?>
          <tr id="<?php echo url_for(array($item, 'module' => 'relation')) ?>" class="<?php echo 'related_obj_'.$item->id ?>">
            <td>
              <?php echo render_title($item->object) ?>
            </td><td>
              <?php echo $item->getNoteByTypeId(QubitTerm::RELATION_NOTE_DESCRIPTION_ID) ?>
            </td><td>
              <?php if (0 < strlen($dateDisplay = $item->getNoteByTypeId(QubitTerm::RELATION_NOTE_DATE_DISPLAY_ID)) || 0 < count($dateArray = $item->getDates())): ?>
                <?php if (0 < strlen($dateDisplay)): ?>
                  <?php echo $dateDisplay ?>
                <?php elseif (2 == count($dateArray)): ?>
                  <?php echo __('%1% - %2%', array('%1%' => collapse_date($dateArray['start']), '%2%' => collapse_date($dateArray['end']))) ?>
                <?php else: ?>
                  <?php echo collapse_date(array_shift($dateArray)) ?>
                <?php endif; ?>
              <?php endif; ?>
            </td><td style="text-align: center">
              <input type="checkbox" name="deleteRelations[<?php echo $item->id ?>]" value="delete" class="multiDelete" />
            </td>
          </tr>
        <?php endforeach; ?>
      </table>
    </div>

    <?
    // Template for new display table rows
    $rowTemplate = '<tr id="{relatedResource[id]}">';
    $rowTemplate .= '<td>{relatedResource[object]}</td>';
    $rowTemplate .= '<td>{relatedResource[description]}</td>';
    $rowTemplate .= '<td>{relatedResource[dateDisplay]}</td>';
    $rowTemplate .= '<td style="text-align: right">'.$editImage.' '.$deleteBtn.'</td>';
    $rowTemplate .= '</tr>';

    echo javascript_tag(<<<EOL
Drupal.behaviors.dialog2 = {
  attach: function (context)
  {
    // Define dialog
    Qubit.dialog2 = new QubitDialog('relatedResource',
    {
      "displayTable": "relatedResourceDisplay",
      "newRowTemplate": '$rowTemplate',
      "handleFieldRender": handleFieldRender,
    }, jQuery);

    // Add edit link/icon to 'relatedFunctions' rows
    jQuery('#relatedResourceDisplay').find('tr').each(function ()
    {
      var thisUri = this.id;
      if (undefined != thisUri)
      {
        jQuery('td:last', this).prepend('<a href="javascript:Qubit.dialog2.open(\'' + thisUri + '\')">$editImage</a>');
      }
    });
  }
}
EOL
) ?>

    <!-- * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *  -->
    <!-- NOTE: The dialog.js script cuts this *entire* table and pastes   -->
    <!-- it in a YUI dialog object.                                       -->
    <!-- * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *  -->
    <table class="inline" id="relatedResource">
      <caption><?php echo __('Related resource') ?></caption>
      <tbody>
        <tr>
          <th colspan="4">
            <?php echo $form['relatedResource[object]']
              ->label(__('Title'))
              ->renderLabel() ?>
          </th>
        </tr><tr>
          <td colspan="4">
            <?php echo $form['relatedResource[object]']->render(array('class' => 'form-autocomplete')) ?>
            <input class="list" type="hidden" value="<?php echo url_for(array('module' => 'informationobject', 'action' => 'autocomplete')) ?>"/>
          </td>
        </tr><tr>
          <th colspan="4">
            <?php echo $form['relatedResource[description]']
              ->label(__('Nature of relationship'))
              ->renderLabel() ?>
          </th>
        </tr><tr>
          <td colspan="4">
            <?php echo $form['relatedResource[description]'] ?>
          </td>
        </tr><tr>
          <th style="width: 25%">
            <?php echo $form['relatedResource[startDate]']
              ->label(__('Date&dagger;'))
              ->renderLabel() ?>
          </th><th style="width: 25%">
            <?php echo $form['relatedResource[endDate]']
              ->label(__('End date&dagger;'))
              ->renderLabel() ?>
          </th><th colspan="2" style="width: 50%">
            <?php echo $form['relatedResource[dateDisplay]']
              ->label(__('Date display&dagger;'))
              ->renderLabel() ?>
          </th>
        </tr><tr>
          <td style="width: 25%">
            <?php echo $form['relatedResource[startDate]'] ?>
          </td><td style="width: 25%">
            <?php echo $form['relatedResource[endDate]'] ?>
          </td><td colspan="2" style="width: 50%">
            <?php echo $form['relatedResource[dateDisplay]'] ?>
          </td>
        </tr><tr>
          <td colspan="4">
            <?php echo __('%1% - dates must be specified in ISO-8601 format (YYYY-MM-DD)', array('%1%' => '&dagger;'))?>
          </td>
        </tr>
      </tbody>
    </table>
  </fieldset>

  <fieldset class="collapsible collapsed" id="controlArea">

    <legend><?php echo __('Control area') ?></legend>

    <?php echo render_field($form->descriptionIdentifier
      ->label(__('Description identifier').'<span class="form-required" title="'.__('This is a mandatory element.').'">*</span>'), $func) ?>

    <?php echo render_field($form->institutionIdentifier
      ->label(__('Institution identifier')), $func) ?>

    <?php echo render_field($form->rules
      ->label(__('Rules and/or conventions used')), $func, array('class' => 'resizable')) ?>

    <?php echo $form->descriptionStatus
      ->label(__('Status'))
      ->renderRow() ?>

    <?php echo $form->descriptionDetail
      ->label(__('Level of detail'))
      ->renderRow() ?>

    <?php echo render_field($form->revisionHistory
      ->label(__('Dates of creation, revision or deletion')), $func, array('class' => 'resizable')) ?>

    <?php echo $form->language
      ->label(__('Language(s)'))
      ->renderRow(array('class' => 'form-autocomplete')) ?>

    <?php echo $form->script
      ->label(__('Script(s)'))
      ->renderRow(array('class' => 'form-autocomplete')) ?>

    <?php echo render_field($form->sources, $func, array('class' => 'resizable')) ?>

    <?php echo render_field($form->maintenanceNotes, $maintenanceNote, array('name' => 'content', 'class' => 'resizable')) ?>

  </fieldset>

  <div class="actions section">

    <h2 class="element-invisible"><?php echo __('Actions') ?></h2>

    <div class="content">
      <ul class="clearfix links">
        <?php if (isset($sf_request->id)): ?>
          <li><?php echo link_to(__('Cancel'), array($func, 'module' => 'function')) ?></li>
          <li><?php echo submit_tag(__('Save')) ?></li>
        <?php else: ?>
          <li><?php echo link_to(__('Cancel'), array('module' => 'function', 'action' => 'list')) ?></li>
          <li><?php echo submit_tag(__('Create')) ?></li>
        <?php endif; ?>
      </ul>
    </div>

  </div>

</form>
