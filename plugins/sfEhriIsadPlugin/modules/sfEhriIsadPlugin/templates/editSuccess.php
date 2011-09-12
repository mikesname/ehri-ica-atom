<h1><?php echo __('Edit archival description - ISAD') ?></h1>

<h1 class="label"><?php echo render_title($isad) ?></h1>

<?php if (isset($sf_request->source)): ?>
  <div class="messages status">
    <?php echo __('This is a duplicate of record %1%', array('%1%' => $sourceInformationObjectLabel)) ?>
  </div>
<?php endif; ?>

<?php echo $form->renderGlobalErrors() ?>

<?php if (isset($sf_request->getAttribute('sf_route')->resource)): ?>
  <?php echo $form->renderFormTag(url_for(array($resource, 'module' => 'informationobject', 'action' => 'edit')), array('id' => 'editForm')) ?>
<?php else: ?>
  <?php echo $form->renderFormTag(url_for(array('module' => 'informationobject', 'action' => 'add')), array('id' => 'editForm')) ?>
<?php endif; ?>

  <?php echo $form->renderHiddenFields() ?>

  <fieldset class="collapsible collapsed" id="identityArea">

    <legend><?php echo __('Identity area') ?></legend>

    <?php echo render_show(__('Reference code'), $isad->referenceCode) ?>

    <?php echo $form->identifier
      ->help(__('Provide a specific local reference code, control number, or other unique identifier. The country and repository code will be automatically added from the linked repository record to form a full reference code.'))
      ->label(__('Identifier').' <span class="form-required" title="'.__('This is a mandatory element.').'">*</span>')
      ->renderRow() ?>

    <?php echo render_field($form->title
      ->help(__('Provide either a formal title or a concise supplied title in accordance with the rules of multilevel description and national conventions.'))
      ->label(__('Title').' <span class="form-required" title="'.__('This is a mandatory element.').'">*</span>'), $resource) ?>

    <?php echo $form->otherName
      ->help(__('Alternate forms of name'))
      ->label('Other form(s) of name')
      ->renderRow() ?>

    <?php echo get_partial('event', $eventComponent->getVarHolder()->getAll()) ?>

    <?php echo $form->levelOfDescription
      ->help(__('Record the level of this unit of description.'))
      ->label(__('Level of description').' <span class="form-required" title="'.__('This is a mandatory element.').'">*</span>')
      ->renderRow() ?>

    <?php echo get_partial('informationobject/childLevels', array('help' => __('<strong>Identifier:</strong> Provide a specific local reference code, control number, or other unique identifier.<br/><strong>Level of description:</strong> Record the level of this unit of description.<br/><strong>Title:</strong> Provide either a formal title or a concise supplied title in accordance with the rules of multilevel description and national conventions.'))) ?>

    <?php echo render_field($form->extentAndMedium
      ->help(__('Record the extent of the unit of description by giving the number of physical or logical units in arabic numerals and the unit of measurement. Give the specific medium (media) of the unit of description. Seperate multiple extents with a linebreak.'))
      ->label(__('Extent and medium').' <span class="form-required" title="'.__('This is a mandatory element.').'">*</span>'), $resource, array('class' => 'resizable')) ?>

  </fieldset> <!-- /#identityArea -->

  <fieldset class="collapsible collapsed" id="contextArea">

    <legend><?php echo __('Context area') ?></legend>

    <div class="form-item">
      <?php echo $form->creators
        ->label(__('Name of creator(s)').' <span class="form-required" title="'.__('This archival description, or one of its higher levels, requires at least one creator.').'">*</span>')
        ->renderLabel() ?>
      <?php echo $form->creators->render(array('class' => 'form-autocomplete')) ?>
      <?php echo $form->creators
        ->help(__('Record the name of the organization(s) or the individual(s) responsible for the creation, accumulation and maintenance of the records in the unit of description. Search for an existing name in the authority records by typing the first few characters of the name. Alternatively, type a new name to create and link to a new authority record.'))
        ->renderHelp() ?>
      <input class="add" type="hidden" value="<?php echo url_for(array('module' => 'actor', 'action' => 'add')) ?> #authorizedFormOfName"/>
      <input class="list" type="hidden" value="<?php echo url_for(array('module' => 'actor', 'action' => 'autocomplete')) ?>"/>
    </div>

    <div class="form-item">
      <?php echo $form->repository->renderLabel() ?>
      <?php echo $form->repository->render(array('class' => 'form-autocomplete')) ?>
      <input class="add" type="hidden" value="<?php echo url_for(array('module' => 'repository', 'action' => 'add')) ?> #authorizedFormOfName"/>
      <input class="list" type="hidden" value="<?php echo url_for($repoAcParams) ?>"/>
      <?php echo $form->repository
        ->help(__('Record the name of the organization which has custody of the archival material. Search for an existing name in the archival institution records by typing the first few characters of the name. Alternatively, type a new name to create and link to a new archival institution record.'))
        ->renderHelp(); ?>
    </div>

    <?php echo render_field($form->archivalHistory
      ->help(__('Record the successive transfers of ownership, responsibility and/or custody of the unit of description and indicate those actions, such as history of the arrangement, production of contemporary finding aids, re-use of the records for other purposes or software migrations, that have contributed to its present structure and arrangement. Give the dates of these actions, insofar as they can be ascertained. If the archival history is unknown, record that information.')), $resource, array('class' => 'resizable')) ?>

    <?php echo render_field($form->acquisition
      ->help(__('Record the source from which the unit of description was acquired and the date and/or method of acquisition if any or all of this information is not confidential. If the source is unknown, record that information. Optionally, add accession numbers or codes.'))
      ->label(__('Immediate source of acquisition or transfer')), $resource, array('class' => 'resizable')) ?>

  </fieldset> <!-- /#contextArea -->

  <fieldset class="collapsible collapsed" id="contentAndStructureArea">

    <legend><?php echo __('Content and structure area') ?></legend>

    <?php echo render_field($form->scopeAndContent
      ->help(__('Give a summary of the scope (such as, time periods, geography) and content, (such as documentary forms, subject matter, administrative processes) of the unit of description, appropriate to the level of description.')), $resource, array('class' => 'resizable')) ?>

    <?php echo render_field($form->appraisal
      ->help(__('Record appraisal, destruction and scheduling actions taken on or planned for the unit of description, especially if they may affect the interpretation of the material.'))
      ->label(__('Appraisal, destruction and scheduling')), $resource, array('class' => 'resizable')) ?>

    <?php echo render_field($form->accruals
      ->help(__('Indicate if accruals are expected. Where appropriate, give an estimate of their quantity and frequency.')), $resource, array('class' => 'resizable')) ?>

    <?php echo render_field($form->arrangement
      ->help(__('Specify the internal structure, order and/or the system of classification of the unit of description. Note how these have been treated by the archivist. For electronic records, record or reference information on system design.'))
      ->label(__('System of arrangement')), $resource, array('class' => 'resizable')) ?>

  </fieldset> <!-- /#contentAndStructureArea -->

  <fieldset class="collapsible collapsed" id="conditionsOfAccessAndUseArea">

    <legend><?php echo __('Conditions of access and use area') ?></legend>

    <?php echo render_field($form->accessConditions
      ->help(__('Specify the law or legal status, contract, regulation or policy that affects access to the unit of description. Indicate the extent of the period of closure and the date at which the material will open when appropriate.'))
      ->label(__('Conditions governing access')), $resource, array('class' => 'resizable')) ?>

    <?php echo render_field($form->reproductionConditions
      ->help(__('Give information about conditions, such as copyright, governing the reproduction of the unit of description after access has been provided. If the existence of such conditions is unknown, record this. If there are no conditions, no statement is necessary.'))
      ->label(__('Conditions governing reproduction')), $resource, array('class' => 'resizable')) ?>

    <?php echo $form->language
      ->help(__('Record the language(s) of the materials comprising the unit of description'))
      ->renderRow(array('class' => 'form-autocomplete')) ?>

    <?php echo $form->script
      ->help(__('Record the script(s) of the materials comprising the unit of description'))
      ->renderRow(array('class' => 'form-autocomplete')) ?>

    <?php echo render_field($form->physicalCharacteristics
      ->help(__('Indicate any important physical conditions, such as preservation requirements, that affect the use of the unit of description. Note any software and/or hardware required to access the unit of description.'))
      ->label(__('Physical characteristics and technical requirements')), $resource, array('class' => 'resizable')) ?>

    <?php echo render_field($form->findingAids
      ->help(__('Give information about any finding aids that the repository or records creator may have that provide information relating to the context and contents of the unit of description. If appropriate, include information on where to obtain a copy.')), $resource, array('class' => 'resizable')) ?>

 </fieldset> <!-- /#conditionsOfAccessAndUseArea -->

 <fieldset class="collapsible collapsed" id="alliedMaterialsArea">

    <legend><?php echo __('Allied materials area') ?></legend>

    <?php echo render_field($form->locationOfOriginals
      ->help(__('If the original of the unit of description is available (either in the institution or elsewhere) record its location, together with any significant control numbers. If the originals no longer exist, or their location is unknown, give that information.'))
      ->label(__('Existence and location of originals')), $resource, array('class' => 'resizable')) ?>

    <?php echo render_field($form->locationOfCopies
      ->help(__('If the copy of the unit of description is available (either in the institution or elsewhere) record its location, together with any significant control numbers.'))
      ->label(__('Existence and location of copies')), $resource, array('class' => 'resizable')) ?>

    <?php echo render_field($form->relatedUnitsOfDescription
      ->help(__('Record information about units of description in the same repository or elsewhere that are related by provenance or other association(s). Use appropriate introductory wording and explain the nature of the relationship . If the related unit of description is a finding aid, use the finding aids element of description (3.4.5) to make the reference to it.'))
      ->label(__('Related units of description')), $resource, array('class' => 'resizable')) ?>

    <div class="form-item">

      <table>
        <thead>
          <tr>
            <th style="width: 90%">
              <?php echo __('Publication notes') ?>
            </th><th style="width: 10%; text-align: right">
              <?php echo image_tag('delete', array('align' => 'top', 'class' => 'deleteIcon')) ?>
            </th>
          </tr>
        </thead><tbody>

          <?php foreach ($resource->getNotesByType(array('noteTypeId' => QubitTerm::PUBLICATION_NOTE_ID)) as $item): ?>
            <tr class="<?php echo 'related_obj_'.$item->id ?>">
              <td>
                <div class="animateNicely">
                  <?php echo $item->getContent(array('cultureFallback' => 'true')) ?>
                </div>
              </td><td style="text-align: right">
                <div class="animateNicely">
                  <input type="checkbox" name="delete_notes[<?php echo $item->id ?>]" value="delete" class="multiDelete"/>
                </div>
              </td>
            </tr>
          <?php endforeach; ?>

          <tr>
            <td>
              <textarea name="new_publication_note" class="multiInstanceTr resizable" size="30x2"></textarea>
            </td><td style="text-align: right">
              &nbsp;
            </td>
          </tr>

        </tbody>
      </table>

      <div class="description">
        <?php echo __('Record a citation to, and/or information about a publication that is about or based on the use, study, or analysis of the unit of description. Include references to published facsimiles or transcriptions.') ?>
      </div>

    </div>

  </fieldset> <!-- /#alliedMaterialsArea -->

  <fieldset class="collapsible collapsed" id="notesArea">

    <legend><?php echo __('Notes area') ?></legend>

    <div class="form-item">

      <table>
        <thead>
          <tr>
            <th style="width: 90%">
              <?php echo __('Notes') ?>
            </th><th style="width: 10%; text-align: right">
              <?php echo image_tag('delete', array('align' => 'top', 'class' => 'deleteIcon')) ?>
            </th>
          </tr>
        </thead><tbody>

          <?php foreach ($resource->getNotesByType(array('noteTypeId' => QubitTerm::GENERAL_NOTE_ID)) as $item): ?>
            <tr class="<?php echo 'related_obj_'.$item->id ?>">
              <td>
                <div class="animateNicely">
                  <?php echo $item->getContent(array('cultureFallback' => 'true')) ?>
                </div>
              </td><td style="text-align: right">
                <div class="animateNicely">
                  <input type="checkbox" name="delete_notes[<?php echo $item->id ?>]" value="delete" class="multiDelete"/>
                </div>
              </td>
            </tr>
          <?php endforeach; ?>

          <tr>
            <td>
              <textarea name="new_note" class="multiInstanceTr resizable" size="30x2"></textarea>
            </td><td style="text-align: right">
              &nbsp;
            </td>
          </tr>

        </tbody>
      </table>

      <div class="description">
        <?php echo __('Record specialized or other important information not accommodated by any of the defined elements of description.') ?>
      </div>

    </div>

  </fieldset> <!-- /#notesArea -->

  <fieldset class="collapsible collapsed" id="accessPointsArea">

    <legend><?php echo __('Access points') ?></legend>

    <div class="form-item">
      <?php echo $form->subjectAccessPoints
        ->label(__('Subject access points'))
        ->renderLabel() ?>
      <?php echo $form->subjectAccessPoints->render(array('class' => 'form-autocomplete')) ?>
      <?php if (QubitAcl::check(QubitTaxonomy::getById(QubitTaxonomy::SUBJECT_ID), 'createTerm')): ?>
        <input class="add" type="hidden" value="<?php echo url_for(array('module' => 'term', 'action' => 'add', 'taxonomy' => url_for(array(QubitTaxonomy::getById(QubitTaxonomy::SUBJECT_ID), 'module' => 'taxonomy')))) ?> #name"/>
      <?php endif; ?>
      <input class="list" type="hidden" value="<?php echo url_for(array('module' => 'term', 'action' => 'autocomplete', 'taxonomy' => url_for(array(QubitTaxonomy::getById(QubitTaxonomy::SUBJECT_ID), 'module' => 'taxonomy')))) ?>"/>
    </div>

    <div class="form-item">
      <?php echo $form->placeAccessPoints
        ->label(__('Place access points'))
        ->renderLabel() ?>
      <?php echo $form->placeAccessPoints->render(array('class' => 'form-autocomplete')) ?>
      <?php if (QubitAcl::check(QubitTaxonomy::getById(QubitTaxonomy::PLACE_ID), 'createTerm')): ?>
        <input class="add" type="hidden" value="<?php echo url_for(array('module' => 'term', 'action' => 'add', 'taxonomy' => url_for(array(QubitTaxonomy::getById(QubitTaxonomy::PLACE_ID), 'module' => 'taxonomy')))) ?> #name"/>
      <?php endif; ?>
      <input class="list" type="hidden" value="<?php echo url_for(array('module' => 'term', 'action' => 'autocomplete', 'taxonomy' => url_for(array(QubitTaxonomy::getById(QubitTaxonomy::PLACE_ID), 'module' => 'taxonomy')))) ?>"/>
    </div>

    <div class="form-item">
      <?php echo $form->nameAccessPoints
        ->label(__('Name access points'))
        ->renderLabel() ?>
      <?php echo $form->nameAccessPoints->render(array('class' => 'form-autocomplete')) ?>
      <?php if (QubitAcl::check(QubitActor::getRoot(), 'create')): ?>
        <input class="add" type="hidden" value="<?php echo url_for(array('module' => 'actor', 'action' => 'add')) ?> #authorizedFormOfName"/>
      <?php endif; ?>
      <input class="list" type="hidden" value="<?php echo url_for(array('module' => 'actor', 'action' => 'autocomplete', 'showOnlyActors' => 'true')) ?>"/>
    </div>

  </fieldset>

  <fieldset class="collapsible collapsed" id="descriptionControlArea">

    <legend><?php echo __('Control area') ?></legend>

    <?php echo $form->descriptionIdentifier
      ->help(__('Record a unique description identifier in accordance with local and/or national conventions. If the description is to be used internationally, record the code of the country in which the description was created in accordance with the latest version of ISO 3166 - Codes for the representation of names of countries. Where the creator of the description is an international organisation, give the organisational identifier in place of the country code.'))
      ->label(__('Description identifier'))
      ->renderRow() ?>

    <?php echo render_field($form->institutionResponsibleIdentifier
      ->help(__('Record the full authorised form of name(s) of the agency(ies) responsible for creating, modifying or disseminating the description or, alternatively, record a code for the agency in accordance with the national or international agency code standard.'))
      ->label(__('Institution identifier')), $resource) ?>

    <?php echo render_field($form->rules
      ->help(__('Record the international, national and/or local rules or conventions followed in preparing the description.'))
      ->label(__('Rules or conventions')), $resource, array('class' => 'resizable')) ?>

    <?php echo $form->descriptionStatus
      ->label(__('Status'))
      ->help(__('Record the current status of the description, indicating whether it is a draft, finalized and/or revised or deleted.'))
      ->renderRow() ?>

    <?php echo $form->descriptionDetail
      ->help(__('Record whether the description consists of a minimal, partial or full level of detail in accordance with relevant international and/or national guidelines and/or rules.'))
      ->label(__('Level of detail'))
      ->renderRow() ?>

    <?php echo render_field($form->revisionHistory
      ->help(__('Record the date(s) the entry was prepared and/or revised.'))
      ->label(__('Dates of creation, revision and deletion')), $resource, array('class' => 'resizable')) ?>

    <?php echo $form->languageOfDescription
      ->help(__('Indicate the language(s) used to create the description of the archival material.'))
      ->label(__('Language(s)'))->renderRow(array('class' => 'form-autocomplete')) ?>

    <?php echo $form->scriptOfDescription
      ->help(__('Indicate the script(s) used to create the description of the archival material.'))
      ->label(__('Script(s)'))->renderRow(array('class' => 'form-autocomplete')) ?>

    <?php echo render_field($form->sources, $resource, array('class' => 'resizable')) ?>

    <div class="form-item">

      <table>
        <thead>
          <tr>
            <th>
              <?php echo __('Archivist\'s notes') ?>
            </th><th style="text-align: right">
              <?php echo image_tag('delete', array('align' => 'top', 'class' => 'deleteIcon')) ?>
            </th>
          </tr>
        </thead><tbody>

          <?php foreach ($resource->getNotesByType(array('noteTypeId' => QubitTerm::ARCHIVIST_NOTE_ID)) as $item): ?>
            <tr class="<?php echo 'related_obj_'.$item->id ?>">
              <td>
                <div class="animateNicely">
                  <?php echo $item->getContent(array('cultureFallback' => 'true')) ?>
                </div>
              </td><td style="text-align: right">
                <div class="animateNicely">
                  <input type="checkbox" name="delete_notes[<?php echo $item->id ?>]" value="delete" class="multiDelete"/>
                </div>
              </td>
            </tr>
          <?php endforeach; ?>

          <tr>
            <td>
              <textarea name="new_archivist_note" class="multiInstanceTr resizable" size="30x2"></textarea>
            </td><td style="text-align: right">
              &nbsp;
            </td>
          </tr>

        </tbody>
      </table>

      <div class="description">
        <?php echo __('Record notes on sources consulted in preparing the description and who prepared it.') ?>
      </div>

    </div>

    <?php echo $form->ehriScope
    ->help(__('Extent of collection covering the Holocaust'))
    ->label('Scope')
    ->renderRow() ?>

    <?php echo $form->ehriPriority
    ->help(__('Priority field for EHRI use'))
    ->label('Priority')
    ->renderRow() ?>

    <?php echo $form->ehriCopyrightIssue
    ->help(__('Repository has issues with copyright'))
    ->label('Copyright')
    ->renderRow() ?>



  </fieldset> <!-- /#descriptionControlArea -->

  <?php echo get_partial('informationobject/adminInfo', array('form' => $form, 'resource' => $resource)) ?>

  <?php echo get_partial('informationobject/editActions', array('resource' => $resource)) ?>

</form>
