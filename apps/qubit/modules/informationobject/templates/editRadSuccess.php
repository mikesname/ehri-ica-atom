<?php use_helper('DateForm') ?>
<?php use_helper('Javascript') ?>

<div class="pageTitle"><?php echo __('edit archival description - RAD') ?></div>
<?php if (isset($sf_request->id)): ?>
<?php echo $form->renderFormTag(url_for(array('module' => 'informationobject', 'action' => 'edit', 'id' => $sf_request->id)), array('id' => 'editForm')) ?>
<?php else: ?>
<?php echo $form->renderFormTag(url_for(array('module' => 'informationobject', 'action' => 'create')), array('id' => 'editForm')) ?>
<?php endif; ?>

<?php echo $form->renderHiddenFields() ?>

<?php echo input_hidden_tag('collection_type_id', QubitTerm::ARCHIVAL_MATERIAL_ID) ?>

<div class="formHeader"><?php echo render_title(QubitRad::getLabel($informationObject)) ?>
</div>

<fieldset
	class="collapsible collapsed"
	id="titleAndStatementOfResponsibilityArea"><!-- title and statement of responsibility area -->
<legend><?php echo __('title and statement of responsibility area') ?></legend>
<?php echo render_field($form->title->label(__('Title proper')), $informationObject) ?>

<?php echo $form->types->label(__('General material designation'))->renderRow() ?>

<?php echo render_field($form->alternateTitle->label(__('Parallel title')), $informationObject) ?>

<?php echo render_field($form->otherTitleInformation->label(__('Other title information')), $otherTitleInformation, array('name' => 'value')) ?>

<?php echo render_field($form->titleStatementOfResponsibility->label(__('Statement of responsibility')), $titleStatementOfResponsibility, array('name' => 'value')) ?>

<div class="form-item"><label for="notes"><?php echo __('title notes') ?></label>
<table class="inline">
	<tr>
		<td class="headerCell" style="width: 65%;"><?php echo __('note') ?></td>
		<td class="headerCell" style="width: 30%"><?php echo __('title note type') ?></td>
		<td class="headerCell" style="width: 5%;"></td>
	</tr>
	<?php if ($radTitleNotes): ?>
	<?php foreach ($radTitleNotes as $note): ?>
	<tr class="<?php echo 'related_obj_'.$note->getId() ?>">
		<td><?php echo $note->getContent(array('cultureFallback' => 'true')) ?><br />
		<span class="note"><?php echo $note->getUser() ?>, <?php echo $note->getUpdatedAt() ?></span></td>
		<td><?php echo $note->getType() ?></td>
		<td style="text-align: center;"><input type="checkbox"
			name="delete_notes[<?php echo $note->getId() ?>]" value="delete"
			class="multiDelete" /></td>
	</tr>
	<?php endforeach; ?>
	<?php endif; ?>
	<tr valign="top">
		<td><?php echo input_tag('rad_title_note')?></td>
		<td><?php echo select_tag('rad_title_note_type', options_for_select($radTitleNoteTypes))?></td>
	</tr>
</table>
</div>

	<?php echo $form->levelOfDescription->renderRow() ?>

<div class="form-item"><label for=""><?php echo __('add new child levels') ?></label>
<table class="inline multiRow">
	<thead>
		<tr>
			<th style="width: 20%"><?php echo __('identifier') ?></th>
			<th style="width: 20%"><?php echo __('level') ?></th>
			<th style="width: 60%"><?php echo __('title') ?></th>
		</tr>
	</thead>
	<tbody>
		<tr>
			<td><?php echo input_tag('updateChildLevels[0][identifier]') ?></td>
			<td><?php echo object_select_tag(new QubitInformationObject, 'getLevelOfDescriptionId', array(
                'include_blank' => true,
                'name' => 'updateChildLevels[0][levelOfDescription]',
                'related_class' => 'QubitTerm',
                'peer_method' => 'getLevelsOfDescription')) ?></td>
			<td><?php echo input_tag('updateChildLevels[0][title]') ?></td>
		</tr>
	</tbody>
</table>
</div>

<div class="form-item"><?php echo $form->repository->renderLabel() ?> <?php echo $form->repository->render(array('class' => 'form-autocomplete')) ?>
<input class="add" type="hidden"
	value="<?php echo url_for(array('module' => 'repository', 'action' => 'create')) ?> #authorized_form_of_name" />
<input class="list" type="hidden"
	value="<?php echo url_for($repoAcParams) ?>" />
</div>

<?php echo $form->identifier->renderRow() ?> <?php if ($informationObject->getIdentifier()): ?>
<div class="form-item"><label for="reference code"><?php echo __('reference code') ?></label>
<?php echo QubitRad::getReferenceCode($informationObject) ?></div>
<?php endif; ?></fieldset>
<!-- End title and statement of responsibility area -->

<!-- Edition area -->
<fieldset class="collapsible collapsed" id="editionArea"><legend><?php echo __('edition area') ?></legend>

<?php echo render_field($form->edition->label(__('Edition statement')), $informationObject) ?>

<?php echo render_field($form->editionStatementOfResponsibility->label(__('Statement of responsibility')), $editionStatementOfResponsibility, array('name' => 'value')) ?>

</fieldset>
<!-- End edition area -->

<!-- Class of material specific details area -->
<fieldset class="collapsible collapsed"
	id="classOfMaterialSpecificDetailsArea"><legend><?php echo __('class of material specific details area') ?></legend>

<?php echo render_field($form->statementOfScaleCartographic->label(__('Statement of scale (cartographic)')), $statementOfScaleCartographic, array('name' => 'value')) ?>

<?php echo render_field($form->statementOfProjection->label(__('Statement of projection (cartographic)')), $statementOfProjection, array('name' => 'value')) ?>

<?php echo render_field($form->statementOfCoordinates->label(__('Statement of coordinates (cartographic)')), $statementOfCoordinates, array('name' => 'value')) ?>

<?php echo render_field($form->statementOfScaleArchitectural->label(__('Statement of scale (architectural)')), $statementOfScaleArchitectural, array('name' => 'value')) ?>

<?php echo render_field($form->issuingJurisdictionAndDenomination->label(__('Issuing jurisdiction and denomination (philatelic)')), $issuingJurisdictionAndDenomination, array('name' => 'value')) ?>

</fieldset>
<!-- End class of material specific details area -->

<!-- Dates of creation area -->
<fieldset class="collapsible collapsed" id="datesOfCreationArea"><legend><?php echo __('dates of creation area') ?></legend>

<table id="relatedEvents" class="inline" style="margin-top: 25px;">
	<tr>
		<th style="width: 35%;"><?php echo __('Name') ?></th>
		<th style="width: 25%;"><?php echo __('Role').'/'.__('Event') ?></th>
		<th style="width: 30%;"><?php echo __('Date(s)') ?></th>
		<th style="width: 10%">&nbsp;</th>
	</tr>
	<?php if(count($actorEvents)): ?>
	<?php foreach ($actorEvents as $actorEvent): ?>
	<tr id="<?php echo 'event_'.$actorEvent->getId() ?>"
		class="<?php echo 'related_obj_'.$actorEvent->getId() ?>">
		<td>
		<div><?php if ($actorEvent->getActor()): ?> <?php echo render_title($actorEvent->getActor()); ?>
		<?php endif; ?></div>
		</td>
		<td>
		<div><?php if ($actorEvent->getActor()): ?> <?php echo $actorEvent->getType()->getRole() ?>
		<?php else: ?> <?php echo $actorEvent->getType() ?> <?php endif; ?></div>
		</td>
		<td>
		<div><?php echo date_display($actorEvent) ?></div>
		</td>
		<td style="text-align: right">
		<div><input type="checkbox"
			name="deleteEvents[<?php echo $actorEvent->getId() ?>]"
			value="delete" class="multiDelete" /></div>
		</td>
	</tr>
	<?php endforeach; ?>
	<?php endif; ?>
</table>

<div class="form-item"><?php echo include_component('informationobject', 'eventForm'); ?>
</div>

</fieldset>
<!-- End dates of creation area -->

<!-- Physical description area -->
<fieldset class="collapsible collapsed" id="physicalDescriptionArea"><legend><?php echo __('physical description area') ?></legend>

	<?php echo render_field($form->extentAndMedium->label(__('Physical description')), $informationObject, array('class' => 'resizable')) ?>

</fieldset>
<!-- End physical description area -->

<!-- Publisher's series area -->
<fieldset class="collapsible collapsed" id="publishersSeriesArea"><legend><?php echo __("publisher's series area") ?></legend>

	<?php echo render_field($form->titleProperOfPublishersSeries->label(__('Title proper of publisher\'s series')), $titleProperOfPublishersSeries, array('name' => 'value')) ?>

	<?php echo render_field($form->parallelTitleOfPublishersSeries->label(__('Parallel title of publisher\'s series')), $parallelTitleOfPublishersSeries, array('name' => 'value')) ?>

	<?php echo render_field($form->otherTitleInformationOfPublishersSeries->label(__('Other title information of publisher\'s series')), $otherTitleInformationOfPublishersSeries, array('name' => 'value')) ?>

	<?php echo render_field($form->statementOfResponsibilityRelatingToPublishersSeries->label(__('Statement of responsibility relating to publisher\'s series')), $statementOfResponsibilityRelatingToPublishersSeries, array('name' => 'value')) ?>

	<?php echo render_field($form->numberingWithinPublishersSeries->label(__('Numbering within publisher\'s series')), $numberingWithinPublishersSeries, array('name' => 'value')) ?>

	<?php echo render_field($form->noteOnPublishersSeries->label(__('Note on publisher\'s series')), $noteOnPublishersSeries, array('class' => 'resizable', 'name' => 'value')) ?>

</fieldset>
<!-- End publisher's series area -->

<!-- Archival description area -->
<fieldset class="collapsible collapsed" id="archivalDescriptionArea"><legend><?php echo __('archival description area') ?></legend>

<div class="form-item"><?php if ($creators): ?> <?php foreach ($creators as $creator): ?>
<div class="form-item"><label> <?php $entityTypeId = $creator->getEntityTypeId() ?>
<?php if ($entityTypeId == QubitTerm::CORPORATE_BODY_ID): ?> <?php echo __('administrative history').':' ?>
<?php elseif (($entityTypeId == QubitTerm::PERSON_ID) || ($entityTypeId == QubitTerm::FAMILY_ID)): ?>
<?php echo __('biographical sketch').':' ?> <?php else: ?> <?php echo __('history').':' ?>
<?php endif; ?> <?php echo $creator->getAuthorizedFormOfName(array('culturalFallback' => 'true')) ?>
</label>
<table class="inline" style="margin: 0;">
	<tr>
		<td><?php echo nl2br($creator->getHistory(array('cultureFallback' => 'true'))) ?></td>
		<td style="width: 20px;"><?php echo link_to(image_tag('pencil', 'align=top'), 'actor/edit?id='.$creator->getId().'&informationObjectReroute='.$informationObject->getId()) ?></td>
	</tr>
</table>
</div>
<?php endforeach; ?> <?php endif; ?> <?php echo render_field($form->archivalHistory->label(__('Custodial history')), $informationObject, array('class' => 'resizable')) ?>

<?php echo render_field($form->scopeAndContent, $informationObject, array('class' => 'resizable')) ?>

</fieldset>
<!-- End archival description area -->

<!-- Notes area -->
<fieldset class="collapsible collapsed" id="notesArea"><legend><?php echo __('notes area') ?></legend>

<?php echo render_field($form->physicalCharacteristics->label(__('Physical condition')), $informationObject, array('class' => 'resizable')) ?>

<?php echo render_field($form->acquisition->label(__('Immediate source of acquisition')), $informationObject, array('class' => 'resizable')) ?>

<?php echo render_field($form->arrangement, $informationObject, array('class' => 'resizable')) ?>

<?php echo $form->language->renderRow(array('class' => 'form-autocomplete')) ?>

<?php echo $form->script->renderRow(array('class' => 'form-autocomplete')) ?>

<?php echo render_field($form->locationOfOriginals, $informationObject, array('class' => 'resizable')) ?>

<?php echo render_field($form->locationOfCopies->label(__('Availability of other formats')), $informationObject, array('class' => 'resizable')) ?>

<?php echo render_field($form->accessConditions->label(__('Restrictions on access')), $informationObject, array('class' => 'resizable')) ?>

<?php echo render_field($form->reproductionConditions->label(__('Terms governing use, reproduction, and publication')), $informationObject, array('class' => 'resizable')) ?>

<?php echo render_field($form->findingAids, $informationObject, array('class' => 'resizable')) ?>

<?php echo render_field($form->relatedUnitsOfDescription->label(__('Associated / related material')), $informationObject, array('class' => 'resizable')) ?>

<?php echo render_field($form->accruals, $informationObject, array('class' => 'resizable')) ?>

<div class="form-item"><label for="notes"><?php echo __('other notes') ?></label>
<table class="inline">
	<tr>
		<td class="headerCell" style="width: 65%;"><?php echo __('note') ?></td>
		<td class="headerCell" style="width: 30%"><?php echo __('note type') ?></td>
		<td class="headerCell" style="width: 5%;"></td>
	</tr>
	<?php if ($radNotes): ?>
	<?php foreach ($radNotes as $note): ?>
	<tr class="<?php echo 'related_obj_'.$note->getId() ?>">
		<td><?php echo $note->getContent(array('cultureFallback' => 'true')) ?><br />
		<span class="note"><?php echo $note->getUser() ?>, <?php echo $note->getUpdatedAt() ?></span></td>
		<td><?php echo $note->getType() ?></td>
		<td style="text-align: center;"><input type="checkbox" name="delete_notes[<?php echo $note->getId() ?>]" value="delete" class="multiDelete" /></td>
	</tr>
	<?php endforeach; ?>
	<?php endif; ?>
	<tr valign="top">
		<td><?php echo input_tag('rad_note')?></td>
		<td><?php echo select_tag('rad_note_type', options_for_select($radNoteTypes))?></td>
	</tr>
</table>
</div>
</fieldset>
<!-- End notes area -->

<!-- Standard number area -->
<fieldset class="collapsible collapsed" id="standardNumberArea"><legend><?php echo __('standard number area') ?></legend>

	<?php echo render_field($form->standardNumber, $standardNumber, array('name' => 'value')) ?>

</fieldset>
<!-- End standard number area -->

<!-- Access Points -->
<fieldset class="collapsible collapsed"><legend><?php echo __('access points') ?></legend>

<div class="form-item"><?php echo $form->subjectAccessPoints->label(__('subject access points'))->renderLabel() ?>
	<?php echo $form->subjectAccessPoints->render(array('class' => 'form-autocomplete')) ?>
<input class="add" type="hidden"
	value="<?php echo url_for(array('module' => 'term', 'action' => 'create', 'taxonomyId' => QubitTaxonomy::SUBJECT_ID)) ?> #name" />
<input class="list" type="hidden"
	value="<?php echo url_for(array('module' => 'term', 'action' => 'autocomplete', 'taxonomyId' => QubitTaxonomy::SUBJECT_ID)) ?>" />
</div>

<div class="form-item"><?php echo $form->placeAccessPoints->label(__('place access points'))->renderLabel() ?>
	<?php echo $form->placeAccessPoints->render(array('class' => 'form-autocomplete')) ?>
<input class="add" type="hidden"
	value="<?php echo url_for(array('module' => 'term', 'action' => 'create', 'taxonomyId' => QubitTaxonomy::PLACE_ID)) ?> #name" />
<input class="list" type="hidden"
	value="<?php echo url_for(array('module' => 'term', 'action' => 'autocomplete', 'taxonomyId' => QubitTaxonomy::PLACE_ID)) ?>" />
</div>

<div class="form-item"><?php echo $form->nameAccessPoints->label(__('name access points'))->renderLabel() ?>
	<?php echo $form->nameAccessPoints->render(array('class' => 'form-autocomplete')) ?>
<input class="add" type="hidden"
	value="<?php echo url_for(array('module' => 'actor', 'action' => 'create')) ?> #authorized_form_of_name" />
<input class="list" type="hidden"
	value="<?php echo url_for(array('module' => 'actor', 'action' => 'autocomplete')) ?>" />
</div>
</fieldset>
<!-- End Access Points-->

<!-- Control Area -->
<fieldset class="collapsible collapsed"><legend><?php echo __('control area') ?></legend>

<?php echo $form->descriptionIdentifier->renderRow() ?> <?php echo render_field($form->institutionResponsibleIdentifier->label(__('Institution identifier')), $informationObject) ?>

<?php echo render_field($form->rules->label(__('Rules or conventions')), $informationObject, array('class' => 'resizable')) ?>

<?php echo $form->descriptionStatus->label(__('Status'))->renderRow() ?>

<?php echo $form->descriptionDetail->label(__('Level of detail'))->renderRow() ?>

<?php echo render_field($form->revisionHistory->label(__('Dates of creation, revision and deletion')), $informationObject, array('class' => 'resizable')) ?>

<?php echo $form->languageOfDescription->renderRow(array('class' => 'form-autocomplete')) ?>

<?php echo $form->scriptOfDescription->renderRow(array('class' => 'form-autocomplete')) ?>

<?php echo render_field($form->sources, $informationObject, array('class' => 'resizable')) ?>

</fieldset>
<!-- End Control Area -->

<div class="admin-info">
<table>
	<tr>
		<td><?php echo $form->publicationStatus->label(__('Publication Status'))->renderRow() ?></td>
		<td>
		<div class="form-item"><label for="source language"><?php echo __('source language') ?></label>
		<?php if ($sourceLanguage = $informationObject->getSourceCulture()): ?>
		<?php if ($sourceLanguage == $sf_user->getCulture()): ?> <?php echo format_language($sourceLanguage) ?>
		<?php else: ?>
		<div class="default-translation"><?php echo link_to(format_language($sourceLanguage), $sf_data->getRaw('sf_context')->getRouting()->getCurrentInternalUri(), array('query_string' => 'sf_culture='.$sourceLanguage)) ?>
		</div>
		<?php endif; ?> <?php else: ?> <?php echo format_language($sf_user->getCulture()) ?>
		<?php endif;?></div>
		</td>
	</tr>
</table>
</div>

		<?php if ($sf_context->getActionName() == 'create'): ?>
<!--set initial form focus -->
		<?php echo javascript_tag(<<<EOF
  $('[name=title]').focus();
EOF
		) ?>
		<?php endif; ?>

		<?php echo get_partial('editActions', array('informationObject' => $informationObject)) ?>

</form>
