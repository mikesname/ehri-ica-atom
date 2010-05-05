<?php use_helper('Date') ?>

<h1><?php echo __('Edit archival description - RAD') ?></h1>

<h1 class="label"><?php echo render_title(QubitRad::getLabel($object)) ?></h1>

<?php if (isset($sf_request->source)): ?>
  <div class="messages status">
    <?php echo __('This is a duplicate of record %1%', array('%1%' => $sourceInformationObjectLabel)) ?>
  </div>
<?php endif; ?>

<?php if (isset($sf_request->id)): ?>
  <?php echo $form->renderFormTag(url_for(array($object, 'module' => 'informationobject', 'action' => 'edit')), array('id' => 'editForm')) ?>
<?php else: ?>
  <?php echo $form->renderFormTag(url_for(array('module' => 'informationobject', 'action' => 'create')), array('id' => 'editForm')) ?>
<?php endif; ?>

  <?php echo $form->renderHiddenFields() ?>

  <?php echo input_hidden_tag('collection_type_id', QubitTerm::ARCHIVAL_MATERIAL_ID) ?>

  <fieldset class="collapsible collapsed" id="titleAndStatementOfResponsibilityArea">

    <legend><?php echo __('Title and statement of responsibility area') ?></legend>

    <?php echo render_field($form->title
      ->label(__('Title proper')), $object) ?>

    <?php echo $form->types
      ->label(__('General material designation'))
      ->renderRow() ?>

    <?php echo render_field($form->alternateTitle
      ->label(__('Parallel title')), $object) ?>

    <?php echo render_field($form->otherTitleInformation
      ->label(__('Other title information')), $otherTitleInformation, array('name' => 'value')) ?>

    <?php echo render_field($form->titleStatementOfResponsibility
      ->label(__('Statement of responsibility')), $titleStatementOfResponsibility, array('name' => 'value')) ?>

    <div class="form-item">
      <label for="notes"><?php echo __('Title notes') ?></label>
      <table class="inline">
        <tr>
          <td class="headerCell" style="width: 65%">
            <?php echo __('Note') ?>
          </td><td class="headerCell" style="width: 30%">
            <?php echo __('Title note type') ?>
          </td><td class="headerCell" style="width: 5%">
          </td>
        </tr>
        <?php if ($radTitleNotes): ?>
          <?php foreach ($radTitleNotes as $note): ?>
            <tr class="<?php echo 'related_obj_'.$note->id ?>">
              <td>
                <?php echo $note->getContent(array('cultureFallback' => 'true')) ?><span class="note"><?php echo $note->user ?>, <?php echo $note->updatedAt ?></span>
              </td><td>
                <?php echo $note->type ?>
              </td><td style="text-align: center">
                <input type="checkbox" name="delete_notes[<?php echo $note->id ?>]" value="delete" class="multiDelete"/>
              </td>
            </tr>
          <?php endforeach; ?>
        <?php endif; ?>
        <tr valign="top">
          <td>
            <?php echo input_tag('rad_title_note')?>
          </td><td>
            <?php echo select_tag('rad_title_note_type', options_for_select($radTitleNoteTypes))?>
          </td>
        </tr>
      </table>
    </div>

    <?php echo $form->levelOfDescription->renderRow() ?>

    <?php echo get_partial('informationobject/childLevels') ?>

    <div class="form-item">
      <?php echo $form->repository->renderLabel() ?>
      <?php echo $form->repository->render(array('class' => 'form-autocomplete')) ?>
      <input class="add" type="hidden" value="<?php echo url_for(array('module' => 'repository', 'action' => 'create')) ?> #authorizedFormOfName"/>
      <input class="list" type="hidden" value="<?php echo url_for($repoAcParams) ?>"/>
    </div>

    <?php echo $form->identifier->renderRow() ?>

    <?php if (isset($object->identifier)): ?>
      <div class="form-item">
        <label for="reference code"><?php echo __('Reference code') ?></label>
        <?php echo QubitRad::getReferenceCode($object) ?>
      </div>
    <?php endif; ?>

  </fieldset> <!-- #titleAndStatementOfResponsibilityArea -->

  <fieldset class="collapsible collapsed" id="editionArea">

    <legend><?php echo __('Edition area') ?></legend>

    <?php echo render_field($form->edition
      ->label(__('Edition statement')), $object) ?>

    <?php echo render_field($form->editionStatementOfResponsibility
      ->label(__('Statement of responsibility')), $editionStatementOfResponsibility, array('name' => 'value')) ?>

  </fieldset> <!-- #editionArea -->

  <fieldset class="collapsible collapsed" id="classOfMaterialSpecificDetailsArea">

    <legend><?php echo __('Class of material specific details area') ?></legend>

    <?php echo render_field($form->statementOfScaleCartographic
      ->label(__('Statement of scale (cartographic)')), $statementOfScaleCartographic, array('name' => 'value')) ?>

    <?php echo render_field($form->statementOfProjection
      ->label(__('Statement of projection (cartographic)')), $statementOfProjection, array('name' => 'value')) ?>

    <?php echo render_field($form->statementOfCoordinates
      ->label(__('Statement of coordinates (cartographic)')), $statementOfCoordinates, array('name' => 'value')) ?>

    <?php echo render_field($form->statementOfScaleArchitectural
      ->label(__('Statement of scale (architectural)')), $statementOfScaleArchitectural, array('name' => 'value')) ?>

    <?php echo render_field($form->issuingJurisdictionAndDenomination
      ->label(__('Issuing jurisdiction and denomination (philatelic)')), $issuingJurisdictionAndDenomination, array('name' => 'value')) ?>

  </fieldset> <!-- #classOfMaterialSpecificDetailsArea -->

  <fieldset class="collapsible collapsed" id="datesOfCreationArea">

    <legend><?php echo __('Dates of creation area') ?></legend>

    <?php echo get_partial('informationobject/relatedEvents', array('informationObject' => $object)) ?>

    <div class="form-item">
      <label for="">Add new name and/or date(s)</label>
      <?php echo get_component('informationobject', 'eventForm') ?>
    </div>

  </fieldset> <!-- #datesOfCreationArea -->

  <fieldset class="collapsible collapsed" id="physicalDescriptionArea">

    <legend><?php echo __('Physical description area') ?></legend>

    <?php echo render_field($form->extentAndMedium
      ->label(__('Physical description')), $object, array('class' => 'resizable')) ?>

  </fieldset> <!-- #physicalDescriptionArea -->

  <fieldset class="collapsible collapsed" id="publishersSeriesArea">

    <legend><?php echo __('Publisher\'s series area') ?></legend>

    <?php echo render_field($form->titleProperOfPublishersSeries
      ->label(__('Title proper of publisher\'s series')), $titleProperOfPublishersSeries, array('name' => 'value')) ?>

    <?php echo render_field($form->parallelTitleOfPublishersSeries
      ->label(__('Parallel title of publisher\'s series')), $parallelTitleOfPublishersSeries, array('name' => 'value')) ?>

    <?php echo render_field($form->otherTitleInformationOfPublishersSeries
      ->label(__('Other title information of publisher\'s series')), $otherTitleInformationOfPublishersSeries, array('name' => 'value')) ?>

    <?php echo render_field($form->statementOfResponsibilityRelatingToPublishersSeries
      ->label(__('Statement of responsibility relating to publisher\'s series')), $statementOfResponsibilityRelatingToPublishersSeries, array('name' => 'value')) ?>

    <?php echo render_field($form->numberingWithinPublishersSeries
      ->label(__('Numbering within publisher\'s series')), $numberingWithinPublishersSeries, array('name' => 'value')) ?>

    <?php echo render_field($form->noteOnPublishersSeries
      ->label(__('Note on publisher\'s series')), $noteOnPublishersSeries, array('class' => 'resizable', 'name' => 'value')) ?>

  </fieldset> <!-- #publishersSeriesArea -->

  <fieldset class="collapsible collapsed" id="archivalDescriptionArea">

    <legend><?php echo __('Archival description area') ?></legend>

    <?php foreach ($object->getCreators() as $creator): ?>
      <div class="field">

        <h3>
          <?php if (QubitTerm::CORPORATE_BODY_ID == $creator->entityType->id): ?>
            <?php echo __('Administrative history') ?>
          <?php else: ?>
            <?php echo __('Biographical sketch') ?>
          <?php endif; ?>
        </h3>

        <div>
          <?php echo link_to('<h3>'.render_title($creator).'</h3>', array($creator, 'module' => 'actor', 'action' => 'edit'), array('title' => __('Edit authority record'))) ?>
          <?php echo $creator->getHistory(array('cultureFallback' => 'true')) ?>
        </div>

      </div>
    <?php endforeach; ?>

    <?php echo render_field($form->archivalHistory->label(__('Custodial history')), $object, array('class' => 'resizable')) ?>

    <?php echo render_field($form->scopeAndContent, $object, array('class' => 'resizable')) ?>

  </fieldset> <!-- #archivalDescriptionArea -->

  <fieldset class="collapsible collapsed" id="notesArea">

    <legend><?php echo __('Notes area') ?></legend>

    <?php echo render_field($form->physicalCharacteristics
      ->label(__('Physical condition')), $object, array('class' => 'resizable')) ?>

    <?php echo render_field($form->acquisition
      ->label(__('Immediate source of acquisition')), $object, array('class' => 'resizable')) ?>

    <?php echo render_field($form->arrangement, $object, array('class' => 'resizable')) ?>

    <?php echo $form->language->renderRow(array('class' => 'form-autocomplete')) ?>

    <?php echo $form->script->renderRow(array('class' => 'form-autocomplete')) ?>

    <?php echo render_field($form->locationOfOriginals, $object, array('class' => 'resizable')) ?>

    <?php echo render_field($form->locationOfCopies
      ->label(__('Availability of other formats')), $object, array('class' => 'resizable')) ?>

    <?php echo render_field($form->accessConditions
      ->label(__('Restrictions on access')), $object, array('class' => 'resizable')) ?>

    <?php echo render_field($form->reproductionConditions
      ->label(__('Terms governing use, reproduction, and publication')), $object, array('class' => 'resizable')) ?>

    <?php echo render_field($form->findingAids, $object, array('class' => 'resizable')) ?>

    <?php echo render_field($form->relatedUnitsOfDescription
      ->label(__('Associated/related material')), $object, array('class' => 'resizable')) ?>

    <?php echo render_field($form->accruals, $object, array('class' => 'resizable')) ?>

    <div class="form-item">
      <label for="notes"><?php echo __('Other notes') ?></label>
      <table class="inline">
        <tr>
          <td class="headerCell" style="width: 65%">
            <?php echo __('Note') ?>
          </td><td class="headerCell" style="width: 30%">
            <?php echo __('Note type') ?>
          </td><td class="headerCell" style="width: 5%">
          </td>
        </tr>
        <?php if ($radNotes): ?>
          <?php foreach ($radNotes as $note): ?>
            <tr class="<?php echo 'related_obj_'.$note->id ?>">
              <td>
                <?php echo $note->getContent(array('cultureFallback' => 'true')) ?><span class="note"><?php echo $note->user ?>, <?php echo $note->updatedAt ?></span>
              </td><td>
                <?php echo $note->type ?>
              </td><td style="text-align: center">
                <input type="checkbox" name="delete_notes[<?php echo $note->id ?>]" value="delete" class="multiDelete"/>
              </td>
            </tr>
          <?php endforeach; ?>
        <?php endif; ?>
        <tr valign="top">
          <td>
            <?php echo input_tag('rad_note')?>
          </td><td>
            <?php echo select_tag('rad_note_type', options_for_select($radNoteTypes))?>
          </td>
        </tr>
      </table>
    </div>

  </fieldset> <!-- #notesArea -->

  <fieldset class="collapsible collapsed" id="standardNumberArea">

    <legend><?php echo __('Standard number area') ?></legend>

    <?php echo render_field($form->standardNumber, $standardNumber, array('name' => 'value')) ?>

  </fieldset> <!-- #standardNumberArea -->

  <fieldset class="collapsible collapsed">

    <legend><?php echo __('Access points') ?></legend>

    <div class="form-item">
      <?php echo $form->subjectAccessPoints
        ->label(__('Subject access points'))
        ->renderLabel() ?>
      <?php echo $form->subjectAccessPoints->render(array('class' => 'form-autocomplete')) ?>
      <?php if (QubitAcl::check(QubitTaxonomy::getById(QubitTaxonomy::SUBJECT_ID), 'createTerm')): ?>
        <input class="add" type="hidden" value="<?php echo url_for(array('module' => 'term', 'action' => 'create', 'taxonomyId' => QubitTaxonomy::SUBJECT_ID)) ?> #name"/>
      <?php endif; ?>
      <input class="list" type="hidden" value="<?php echo url_for(array('module' => 'term', 'action' => 'autocomplete', 'taxonomyId' => QubitTaxonomy::SUBJECT_ID)) ?>"/>
    </div>

    <div class="form-item">
      <?php echo $form->placeAccessPoints
        ->label(__('Place access points'))
        ->renderLabel() ?>
      <?php echo $form->placeAccessPoints->render(array('class' => 'form-autocomplete')) ?>
      <?php if (QubitAcl::check(QubitTaxonomy::getById(QubitTaxonomy::PLACE_ID), 'createTerm')): ?>
        <input class="add" type="hidden" value="<?php echo url_for(array('module' => 'term', 'action' => 'create', 'taxonomyId' => QubitTaxonomy::PLACE_ID)) ?> #name"/>
      <?php endif; ?>
      <input class="list" type="hidden" value="<?php echo url_for(array('module' => 'term', 'action' => 'autocomplete', 'taxonomyId' => QubitTaxonomy::PLACE_ID)) ?>" />
    </div>

    <div class="form-item">
      <?php echo $form->nameAccessPoints
        ->label(__('Name access points'))
        ->renderLabel() ?>
      <?php echo $form->nameAccessPoints->render(array('class' => 'form-autocomplete')) ?>
      <?php if (QubitAcl::check(QubitActor::getRoot(), 'create')): ?>
        <input class="add" type="hidden" value="<?php echo url_for(array('module' => 'actor', 'action' => 'create')) ?> #authorizedFormOfName"/>
      <?php endif; ?>
      <input class="list" type="hidden" value="<?php echo url_for(array('module' => 'actor', 'action' => 'autocomplete', 'showOnlyActors' => 'true')) ?>"/>
    </div>

  </fieldset>

  <fieldset class="collapsible collapsed">

    <legend><?php echo __('Control area') ?></legend>

    <?php echo $form->descriptionIdentifier->renderRow() ?>

    <?php echo render_field($form->institutionResponsibleIdentifier
      ->label(__('Institution identifier')), $object) ?>

    <?php echo render_field($form->rules
      ->label(__('Rules or conventions')), $object, array('class' => 'resizable')) ?>

    <?php echo $form->descriptionStatus
      ->label(__('Status'))
      ->renderRow() ?>

    <?php echo $form->descriptionDetail
      ->label(__('Level of detail'))
      ->renderRow() ?>

    <?php echo render_field($form->revisionHistory
      ->label(__('Dates of creation, revision and deletion')), $object, array('class' => 'resizable')) ?>

    <?php echo $form->languageOfDescription
      ->renderRow(array('class' => 'form-autocomplete')) ?>

    <?php echo $form->scriptOfDescription
      ->renderRow(array('class' => 'form-autocomplete')) ?>

    <?php echo render_field($form->sources, $object, array('class' => 'resizable')) ?>

  </fieldset>

  <?php echo get_partial('informationobject/adminInfo', array('form' => $form, 'informationObject' => $object)) ?>

  <?php echo get_partial('informationobject/editActions', array('informationObject' => $object)) ?>

</form>
