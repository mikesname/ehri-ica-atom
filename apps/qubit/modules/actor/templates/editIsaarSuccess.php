<?php use_helper('Javascript') ?>

<h1><?php echo __('Edit %1% - ISAAR', array('%1%' => sfConfig::get('app_ui_label_actor'))) ?></h1>

<h1 class="label"><?php echo render_title($actor) ?></h1>

<?php if (isset($sf_request->id)): ?>
  <?php echo $form->renderFormTag(url_for(array($actor, 'module' => 'actor', 'action' => 'edit')), array('id' => 'editForm')) ?>
<?php else: ?>
  <?php echo $form->renderFormTag(url_for(array('module' => 'actor', 'action' => 'create')), array('id' => 'editForm')) ?>
<?php endif; ?>

  <?php echo $form->renderHiddenFields() ?>

  <?php echo input_hidden_tag('repositoryReroute', $repositoryReroute) ?>
  <?php echo input_hidden_tag('informationObjectReroute', $informationObjectReroute) ?>

  <fieldset class="collapsible collapsed" id="identityArea">

    <legend><?php echo __('Identity area') ?></legend>

    <?php echo $form->entityType
      ->label(__('Type of entity').'<span class="form-required" title="'.__('This is a mandatory element.').'">*</span>')
      ->renderRow() ?>

    <?php echo render_field($form->authorizedFormOfName
      ->label(__('Authorized form of name').'<span class="form-required" title="'.__('This is a mandatory element.').'">*</span>'), $actor) ?>

    <?php echo $form->parallelName
      ->label(__('Parallel form(s) of name'))
      ->renderRow() ?>

    <?php echo $form->standardizedName
      ->label(__('Standardized form(s) of name according to other rules'))
      ->renderRow() ?>

    <?php echo $form->otherName
      ->label(__('Other form(s) of name'))
      ->renderRow() ?>

    <?php echo render_field($form->corporateBodyIdentifiers
      ->label(__('Identifiers for corporate bodies')), $actor) ?>

  </fieldset>

  <fieldset class="collapsible collapsed" id="descriptionArea">

    <legend><?php echo __('Description area') ?></legend>

    <?php echo render_field($form->datesOfExistence
      ->label(__('Dates of existence').'<span class="form-required" title="'.__('This is a mandatory element.').'">*</span>'), $actor) ?>

    <?php echo render_field($form->history, $actor, array('class' => 'resizable')) ?>

    <?php echo render_field($form->places, $actor, array('class' => 'resizable')) ?>

    <?php echo render_field($form->legalStatus, $actor, array('class' => 'resizable')) ?>

    <?php echo render_field($form->functions
      ->label(__('Functions, occupations and activities')), $actor, array('class' => 'resizable')) ?>

    <?php echo render_field($form->mandates
      ->label(__('Mandates/sources of authority')), $actor, array('class' => 'resizable')) ?>

    <?php echo render_field($form->internalStructures
      ->label(__('Internal structures/genealogy')), $actor, array('class' => 'resizable')) ?>

    <?php echo render_field($form->generalContext, $actor, array('class' => 'resizable')) ?>

  </fieldset>

  <fieldset class="collapsible collapsed" id="relationshipsArea">

    <legend><?php echo __('Relationships area') ?></legend>

    <div class="form-item">
      <table class="inline" id="relatedEntities">
        <caption><?php echo __('Related corporate bodies, persons or families') ?></caption>
        <tr>
          <th style="width: 25%">
            <?php echo __('Name') ?>
          </th><th style="width: 15%">
            <?php echo __('Type') ?>
          </th><th style="width: 20%">
            <?php echo __('Dates') ?>
          </th><th style="width: 30%">
            <?php echo __('Description') ?>
          </th><th style="width: 10%; text-align: center">
            <?php echo image_tag('delete', array('align' => 'top', 'class' => 'deleteIcon')) ?>
          </th>
        </tr>
        <?php foreach ($actorRelations as $item): ?>
          <tr id="<?php echo url_for(array($item, 'module' => 'relation')) ?>" class="<?php echo 'related_obj_'.$item->id ?>">
            <td>
              <?php if ($actor->id == $item->objectId): ?>
                <?php echo $item->subject->__toString() ?>
              <?php else: ?>
                <?php echo $item->object->__toString() ?>
              <?php endif; ?>
            </td><td>
              <?php echo $item->type ?>
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
            </td><td>
              <?php echo $item->getNoteByTypeId(QubitTerm::RELATION_NOTE_DESCRIPTION_ID) ?>
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

    $rowTemplate = '<tr id="{relatedActor[id]}">';
    $rowTemplate .= '<td>{relatedActor[authorizedFormOfName]}</td>';
    $rowTemplate .= '<td>{relatedActor[type]}</td>';
    $rowTemplate .= '<td>{relatedActor[dateDisplay]}</td>';
    $rowTemplate .= '<td>{relatedActor[description]}</td>';
    $rowTemplate .= '<td style="text-align: right">'.$editImage.' '.$deleteBtn.'</td>';
    $rowTemplate .= '</tr>';

    $linkToShow = url_for(array($actor, 'module' => 'actor'));

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
              output['relatedActor[authorizedFormOfName]'] = data[col];
            }
            break;

          default:
            output['relatedActor[' + col + ']'] = data[col];
        }
      }

      return output;
    }

    // Define dialog
    Qubit.dialog = new QubitDialog('actorRelation',
    {
      "displayTable": "relatedEntities",
      "newRowTemplate": '$rowTemplate',
      "handleFieldRender": handleFieldRender,
      "relationTableMap": relationTableMap,
    }, jQuery);

    // Add edit link/icon to 'relatedFunctions' rows
    jQuery('#relatedEntities').find('tr').each(function ()
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
    <!-- NOTE: The dialog.js script cuts this table and moves it to a YUI -->
    <!-- dialog object.                                                   -->
    <!-- * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *  -->
    <table class="inline" id="actorRelation">
      <caption><?php echo __('New relationship') ?></caption>
      <tbody>
        <tr>
          <th colspan="3">
            <?php echo $form['relatedActor[authorizedFormOfName]']
              ->label(__('Authorized form of name'))
              ->renderLabel() ?>
          </th>
        </tr><tr>
          <td colspan="3">
            <?php echo $form['relatedActor[authorizedFormOfName]']->render(array('class' => 'form-autocomplete')) ?>
            <input class="list" type="hidden" value="<?php echo url_for(array('module' => 'actor', 'action' => 'autocomplete')) ?>" />
          </td>
        </tr><tr>
          <th colspan="3">
            <?php echo $form['relatedActor[type]']
              ->label(__('Category of relationship'))
              ->renderLabel() ?>
          </th>
        </tr><tr>
          <td colspan="3">
            <?php echo $form['relatedActor[type]']->render(array('class' => 'form-autocomplete')) ?>
          </td>
        </tr><tr>
          <th colspan="3">
            <?php echo $form['relatedActor[description]']
              ->label(__('Description of relationship'))
              ->renderLabel() ?>
          </th>
        </tr><tr>
          <td colspan="3" style="width: 100%">
            <?php echo $form['relatedActor[description]'] ?>
          </td>
        </tr><tr>
          <th style="width: 25%">
            <?php echo $form['relatedActor[startDate]']
              ->label(__('Date&dagger;'))
              ->renderLabel() ?>
          </th><th style="width: 25%">
            <?php echo $form['relatedActor[endDate]']
              ->label(__('End date&dagger;'))
              ->renderLabel() ?>
          </th><th style="width: 50%">
            <?php echo $form['relatedActor[dateDisplay]']
              ->label(__('Date display&dagger;'))
              ->renderLabel() ?>
          </th>
        </tr><tr>
          <td style="width: 25%">
            <?php echo $form['relatedActor[startDate]'] ?>
          </td><td style="width: 25%">
            <?php echo $form['relatedActor[endDate]'] ?>
          </td><td style="width: 50%">
            <?php echo $form['relatedActor[dateDisplay]'] ?>
          </td>
        </tr><tr>
          <td colspan="3">
            <?php echo __('%1% - dates must be specified in ISO-8601 format (YYYY-MM-DD)', array('%1%' => '&dagger;'))?>
          </td>
        </tr>
      </tbody>
    </table>

    <div class="form-item">
      <table class="inline" id="relatedEvents">
        <caption><?php echo __('Related resources') ?></caption>
        <tr>
          <th style="width: 35%">
            <?php echo __('Title') ?>
          </th><th style="width: 20%">
            <?php echo __('Relationship') ?>
          </th><th style="width: 25%">
            <?php echo __('Dates') ?>
          </th><th style="width: 10%; text-align: center">
            <?php echo image_tag('delete', array('align' => 'top', 'class' => 'deleteIcon')) ?>
          </th>
        </tr>
        <?php foreach ($events as $event): ?>
          <tr id="<?php echo url_for(array($event, 'module' => 'event')) ?>" class="<?php echo 'related_obj_'.$event->id ?>">
            <td>
              <?php echo $event->informationObject->__toString() ?>
            </td><td>
              <?php echo $event->type ?>
            </td><td>
              <?php if (0 < strlen($dateDisplay = $event->getDateDisplay())): ?>
                <?php echo $dateDisplay ?>
              <?php elseif (0 < strlen($event->getStartDate()) && 0 < strlen($event->getEndDate())): ?>
                <?php echo __('%1% - %2%', array('%1%' => collapse_date($event->getStartDate()), '%2%' => collapse_date($event->getEndDate()))) ?>
              <?php elseif (0 < strlen($date = $event->getStartDate()) || 0 < strlen($date = $event->getEndDate())): ?>
                <?php echo collapse_date($date) ?>
              <?php endif; ?>
            </td><td style="text-align: right">
              <input type="checkbox" name="deleteEvents[<?php echo $event->getId() ?>]" value="delete" class="multiDelete" />
            </td>
          </tr>
        <?php endforeach; ?>
      </table>
    </div>

    <?php
    // Define template for new relation table rows added by dialog
    $rowTemplate = '<tr id="{relatedResource[id]}">';
    $rowTemplate .= '<td>{relatedResource[informationObject]}</td>';
    $rowTemplate .= '<td>{relatedResource[type]}</td>';
    $rowTemplate .= '<td>{relatedResource[dateDisplay]}</td>';
    $rowTemplate .= '<td style="text-align: right">'.$editImage.' '.$deleteBtn.'</td>';
    $rowTemplate .= '</tr>';

    echo javascript_tag(<<<EOL
Drupal.behaviors.dialog2 = {
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
    Qubit.dialog2 = new QubitDialog('resourceRelation',
    {
      "displayTable": "relatedEvents",
      "newRowTemplate": '$rowTemplate',
      "handleFieldRender": handleFieldRender,
    }, jQuery);

    // Add edit link/icon to 'relatedFunctions' rows
    jQuery('#relatedEvents').find('tr').each(function ()
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
    <!-- NOTE: The dialog.js script cuts this table and moves it to a YUI -->
    <!-- dialog object.                                                   -->
    <!-- * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *  -->
    <table id="resourceRelation" class="inline">
      <tr>
        <td colspan="3" class="headerCell" style="width: 55%">
          <?php echo $form['relatedResource[informationObject]']
            ->label(__('Title of related resource'))
            ->renderLabel() ?>
        </td>
      </tr><tr>
        <td colspan="3" class="noline">
          <?php echo $form['relatedResource[informationObject]']->render(array('class' => 'form-autocomplete')) ?>
          <input class="list" type="hidden" value="<?php echo url_for(array('module' => 'informationobject', 'action' => 'autocomplete')) ?>" />
        </td>
      </tr><tr>
        <td colspan="2" class="headerCell" style="width: 60%">
          <?php echo $form['relatedResource[type]']
            ->label(__('Nature of relationship'))
            ->renderLabel() ?>
        </td><td class="headerCell" style="width: 40%">
          <?php echo $form['relatedResource[resourceType]']
            ->label(__('Type of related resource'))
            ->renderLabel() ?>
        </td>
      </tr><tr>
        <td colspan="2" class="noline">
          <?php echo $form['relatedResource[type]']->render(array('class' => 'form-autocomplete')) ?>
        </td><td class="noline">
          <?php echo $form['relatedResource[resourceType]']->render(array('disabled' => 'true', 'class' => 'disabled')) ?>
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
        </th><th style="width: 50%">
          <?php echo $form['relatedResource[dateDisplay]']
            ->label(__('Date display&dagger;'))
            ->renderLabel() ?>
        </th>
      </tr><tr>
        <td style="width: 25%">
          <?php echo $form['relatedResource[startDate]'] ?>
        </td><td style="width: 25%">
          <?php echo $form['relatedResource[endDate]'] ?>
        </td><td style="width: 50%">
          <?php echo $form['relatedResource[dateDisplay]'] ?>
        </td>
      </tr><tr>
        <td colspan="3">
          <?php echo __('%1% - dates must be specified in ISO-8601 format (YYYY-MM-DD)', array('%1%' => '&dagger;'))?>
        </td>
      </tr>
    </table>

  </fieldset>

  <fieldset class="collapsible collapsed" id="controlArea">

    <legend><?php echo __('Control area') ?></legend>

    <?php echo render_field($form->descriptionIdentifier
      ->label(__('Description identifier').'<span class="form-required" title="'.__('This is a mandatory element.').'">*</span>'), $actor) ?>

    <?php echo render_field($form->institutionResponsibleIdentifier->label(__('Institution identifier')), $actor) ?>

    <?php echo render_field($form->rules
      ->label(__('Rules and/or conventions used')), $actor, array('class' => 'resizable')) ?>

    <?php echo $form->descriptionStatus
      ->label('Status')
      ->renderRow() ?>

    <?php echo $form->descriptionDetail
      ->label('Level of detail')
      ->renderRow() ?>

    <?php echo render_field($form->revisionHistory
      ->label(__('Dates of creation, revision and deletion')), $actor, array('class' => 'resizable')) ?>

    <?php echo $form->language
      ->label('Language(s)')
      ->renderRow(array('class' => 'form-autocomplete')) ?>

    <?php echo $form->script
      ->label('Script(s)')
      ->renderRow(array('class' => 'form-autocomplete')) ?>

    <?php echo render_field($form->sources, $actor, array('class' => 'resizable')) ?>

    <?php echo render_field($form->maintenanceNotes, $maintenanceNote, array('name' => 'content', 'class' => 'resizable')) ?>

  </fieldset>

  <div class="actions section">

    <h2 class="element-invisible"><?php echo __('Actions') ?></h2>

    <div class="content">
      <ul class="clearfix links">

        <?php if (isset($sf_request->id)): ?>

          <?php if ($repositoryReroute): ?>
            <li><?php echo link_to(__('Cancel'), array('module' => 'repository', 'id' => $repositoryReroute)) ?>
          <?php else: ?>
            <li><?php echo link_to(__('Cancel'), array($actor, 'module' => 'actor')) ?></li>
          <?php endif; ?>

          <li><?php echo submit_tag(__('Save')) ?></li>

        <?php else: ?>
          <li><?php echo link_to(__('Cancel'), array('module' => 'actor', 'action' => 'list')) ?></li>
          <li><?php echo submit_tag(__('Create')) ?></li>
        <?php endif; ?>

      </ul>
    </div>

  </div>

</form>
