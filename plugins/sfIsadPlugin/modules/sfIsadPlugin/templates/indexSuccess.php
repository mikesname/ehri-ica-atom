<h1><?php echo __('View archival description') ?></h1>

<?php echo link_to_if(QubitAcl::check($object, 'update'), '<h1 class="label">'.render_title(QubitIsad::getLabel($object)).'</h1>', array($object, 'module' => 'informationobject', 'action' => 'edit'), array('title' => __('Edit archival description'))) ?>

<?php if (isset($errorSchema)): ?>
  <div class="messages error">
    <ul>
      <?php foreach ($errorSchema as $error): ?>
        <li><?php echo $error ?></li>
      <?php endforeach; ?>
    </ul>
  </div>
<?php endif; ?>

<?php if (0 < count($object->digitalObjects)): ?>
  <?php echo get_component('digitalobject', 'show', array('digitalObject' => $object->digitalObjects[0], 'usageType' => QubitTerm::REFERENCE_ID, 'link' => $digitalObjectLink)) ?>
<?php endif; ?>

<!-- ******************************************** -->
<!--   START IDENTITY AREA                         -->
<!-- ******************************************** -->

<div class="section" id="identityArea">

  <?php echo link_to_if(SecurityPriviliges::editCredentials($sf_user, 'informationObject'), '<h2>'.__('Identity area').'</h2>', array($object, 'module' => 'informationobject', 'action' => 'edit'), array('anchor' => 'identityArea', 'title' => __('Edit identity area'))) ?>

  <?php echo render_show(__('Reference code'), render_value(QubitIsad::getReferenceCode($object))) ?>

  <?php echo render_show(__('Title'), render_value($object->getTitle(array('cultureFallback' => true)))) ?>

  <div class="field">
    <h3><?php echo __('Date(s)') ?></h3>
    <div>
      <ul>
        <?php foreach ($object->getDates() as $date): ?>
          <li>
            <?php echo date_display($date) ?> (<?php echo $date->getType(array('cultureFallback' => true)) ?>)
            <?php if (isset($date->actor)): ?>
              <?php echo link_to(render_title($date->actor), array($date->actor, 'module' => 'actor')) ?>
            <?php endif; ?>
          </li>
        <?php endforeach; ?>
      </ul>
    </div>
  </div>

  <?php echo render_show(__('Level of description'), render_value($object->levelOfDescription)) ?>

  <?php echo render_show(__('Extent and medium'), render_value($object->getExtentAndMedium(array('cultureFallback' => true)))) ?>

</div> <!-- /.section#identityArea -->

<!-- ******************************************** -->
<!--   START CONTEXT AREA                         -->
<!-- ******************************************** -->

<div class="section" id="contextArea">

  <?php echo link_to_if(SecurityPriviliges::editCredentials($sf_user, 'informationObject'), '<h2>'.__('Context area').'</h2>', array($object, 'module' => 'informationobject', 'action' => 'edit'), array('anchor' => 'contextArea', 'title' => __('Edit context area'))) ?>

  <?php echo get_partial('informationobject/creators', array('informationObject' => $object)) ?>

  <?php foreach ($functionRelations as $relation): ?>
    <div class="field">
      <h3><?php echo __('Related function')?></h3>
      <div>
        <?php echo link_to($relation->subject->getLabel(), array($relation->subject, 'module' => 'function')) ?>
      </div>
    </div>
  <?php endforeach; ?>

  <?php if (isset($object->repository)): ?>
    <?php echo render_show(__('Repository'), link_to(render_title($object->repository), array($object->repository, 'module' => 'repository'))) ?>
  <?php endif; ?>

  <?php echo render_show(__('Archival history'), render_value($object->getArchivalHistory(array('cultureFallback' => true)))) ?>

  <?php echo render_show(__('Immediate source of acquisition or transfer'), render_value($object->getAcquisition(array('cultureFallback' => true)))) ?>

</div> <!-- /.section#contextArea -->

<!-- ******************************************** -->
<!--   START CONTENT AND STRUCTURE AREA           -->
<!-- ******************************************** -->

<div class="section" id="contentAndStructureArea">

  <?php echo link_to_if(SecurityPriviliges::editCredentials($sf_user, 'informationObject'), '<h2>'.__('Content and structure area').'</h2>', array($object, 'module' => 'informationobject', 'action' => 'edit'), array('anchor' => 'contentAndStructureArea', 'title' => __('Edit content and structure area'))) ?>

  <?php echo render_show(__('Scope and content'), render_value($object->getScopeAndContent(array('cultureFallback' => true)))) ?>

  <?php echo render_show(__('Appraisal, destruction and scheduling'), render_value($object->getAppraisal(array('cultureFallback' => true)))) ?>

  <?php echo render_show(__('Accruals'), render_value($object->getAccruals(array('cultureFallback' => true)))) ?>

  <?php echo render_show(__('System of arrangement'), render_value($object->getArrangement(array('cultureFallback' => true)))) ?>

</div> <!-- /.section#contentAndStructureArea -->

<!-- ******************************************** -->
<!--   START CONDITIONS OF ACCESS AND USE AREA    -->
<!-- ******************************************** -->

<div class="section" id="conditionsOfAccessAndUseArea">

  <?php echo link_to_if(SecurityPriviliges::editCredentials($sf_user, 'informationObject'), '<h2>'.__('Conditions of access and use area').'</h2>', array($object, 'module' => 'informationobject', 'action' => 'edit'), array('anchor' => 'conditionsOfAccessAndUseArea', 'title' => __('Edit conditions of access and use area'))) ?>

  <?php echo render_show(__('Conditions governing access'), render_value($object->getAccessConditions(array('cultureFallback' => true)))) ?>

  <?php echo render_show(__('Conditions governing reproduction'), render_value($object->getReproductionConditions(array('cultureFallback' => true)))) ?>

  <div class="field">
    <h3><?php echo __('Language of material') ?></h3>
    <div>
      <ul>
        <?php foreach ($object->language as $code): ?>
          <li><?php echo format_language($code) ?></li>
        <?php endforeach; ?>
      </ul>
    </div>
  </div>

  <div class="field">
    <h3><?php echo __('Script of material') ?></h3>
    <div>
      <ul>
        <?php foreach ($object->script as $code): ?>
          <li><?php echo format_script($code) ?></li>
        <?php endforeach; ?>
      </ul>
    </div>
  </div>

  <?php echo render_show(__('Physical characteristics and technical requirements'), render_value($object->getPhysicalCharacteristics(array('cultureFallback' => true)))) ?>

  <?php echo render_show(__('Finding aids'), render_value($object->getFindingAids(array('cultureFallback' => true)))) ?>

</div> <!-- /.section#conditionsOfAccessAndUseArea -->

<!-- ******************************************** -->
<!--   START ALLIED MATERIALS AREA                -->
<!-- ******************************************** -->

<div class="section" id="alliedMaterialsArea">

  <?php echo link_to_if(SecurityPriviliges::editCredentials($sf_user, 'informationObject'), '<h2>'.__('Allied materials area').'</h2>', array($object, 'module' => 'informationobject', 'action' => 'edit'), array('anchor' => 'alliedMaterialsArea', 'title' => __('Edit alied materials area'))) ?>

  <?php echo render_show(__('Existence and location of originals'), render_value($object->getLocationOfOriginals(array('cultureFallback' => true)))) ?>

  <?php echo render_show(__('Existence and location of copies'), render_value($object->getLocationOfCopies(array('cultureFallback' => true)))) ?>

  <?php echo render_show(__('Related units of description'), render_value($object->getRelatedUnitsOfDescription(array('cultureFallback' => true)))) ?>

  <?php foreach ($publicationNotes as $publicationNote): ?>
    <?php echo render_show(__('Publication note'), render_value($publicationNote->getContent(array('cultureFallback' => true)))) ?>
  <?php endforeach; ?>

</div> <!-- /.section#alliedMaterialsArea -->

<!-- ******************************************** -->
<!--   START NOTES AREA                           -->
<!-- ******************************************** -->

<div class="section" id="notesArea">

  <?php echo link_to_if(SecurityPriviliges::editCredentials($sf_user, 'informationObject'), '<h2>'.__('Notes area').'</h2>', array($object, 'module' => 'informationobject', 'action' => 'edit'), array('anchor' => 'notesArea', 'title' => __('Edit notes area'))) ?>

  <?php foreach ($notes as $note): ?>
    <?php echo render_show(__('Note'), render_value($note->getContent(array('cultureFallback' => true)))) ?>
  <?php endforeach; ?>

</div> <!-- /.section#notesArea -->

<!-- ******************************************** -->
<!--   START ACCESS POINTS                        -->
<!-- ******************************************** -->

<div class="section">

  <?php echo link_to_if(SecurityPriviliges::editCredentials($sf_user, 'informationObject'), '<h2>'.__('Access points').'</h2>', array($object, 'module' => 'informationobject', 'action' => 'edit'), array('anchor' => 'accessPointsArea', 'title' => __('Edit access points'))) ?>

  <?php echo get_partial('informationobject/subjectAccessPoints', array('informationObject' => $object)) ?>

  <?php echo get_partial('informationobject/placeAccessPoints', array('informationObject' => $object)) ?>

  <?php echo get_partial('informationobject/nameAccessPoints', array('informationObject' => $object)) ?>

</div> <!-- /.section -->

<!-- ******************************************** -->
<!--   START CONTROL AREA                         -->
<!-- ******************************************** -->

<div class="section" id="descriptionControlArea">

  <?php echo link_to_if(SecurityPriviliges::editCredentials($sf_user, 'informationObject'), '<h2>'.__('Description control area').'</h2>', array($object, 'module' => 'informationobject', 'action' => 'edit'), array('anchor' => 'descriptionControlArea', 'title' => __('Edit description control area'))) ?>

  <?php echo render_show(__('Description identifier'), render_value($object->getDescriptionIdentifier(array('cultureFallback' => true)))) ?>

  <?php echo render_show(__('Institution identifier'), render_value($object->getInstitutionResponsibleIdentifier(array('cultureFallback' => true)))) ?>

  <?php echo render_show(__('Rules and/or conventions used'), render_value($object->getRules(array('cultureFallback' => true)))) ?>

  <?php echo render_show(__('Status'), render_value($object->descriptionStatus)) ?>

  <?php echo render_show(__('Level of detail'), render_value($object->descriptionDetail)) ?>

  <?php echo render_show(__('Dates of creation revision deletion'), render_value($object->getRevisionHistory(array('cultureFallback' => true)))) ?>

  <div class="field">
    <h3><?php echo __('Language(s)') ?></h3>
    <div>
      <ul>
        <?php foreach ($object->languageOfDescription as $code): ?>
          <li><?php echo format_language($code) ?></li>
        <?php endforeach; ?>
      </ul>
    </div>
  </div>

  <div class="field">
    <h3><?php echo __('Script(s)') ?></h3>
    <div>
      <ul>
        <?php foreach ($object->scriptOfDescription as $code): ?>
          <li><?php echo format_script($code) ?></li>
        <?php endforeach; ?>
      </ul>
    </div>
  </div>

  <?php echo render_show(__('Sources'), render_value($object->getSources(array('cultureFallback' => true)))) ?>

  <?php foreach ($archivistsNotes as $archivistsNote): ?>
    <?php echo render_show(__('Archivist\'s note'), render_value($archivistsNote->getContent(array('cultureFallback' => true)))) ?>
  <?php endforeach; ?>

</div> <!-- /.section#descriptionControlArea -->

<!-- ******************************************** -->
<!--   START DIGITAL OBJECT METADATA              -->
<!-- ******************************************** -->

<?php if (0 < count($object->digitalObjects)): ?>
  <?php echo get_partial('digitalobject/metadata', array('digitalObject' => $object->digitalObjects[0])) ?>
<?php endif; ?>

<?php echo get_partial('informationobject/actions', array('informationObject' => $object)) ?>
