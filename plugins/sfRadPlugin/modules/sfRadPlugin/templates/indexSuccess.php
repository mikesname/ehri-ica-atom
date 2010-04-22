<h1><?php echo __('View archival description') ?></h1>

<?php echo link_to_if(QubitAcl::check($object, 'update'), '<h1 class="label">'.render_title(QubitRad::getLabel($object)).'</h1>', array($object, 'module' => 'informationobject', 'action' => 'edit'), array('title' => __('Edit archival description'))) ?>

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
  <?php echo get_component('digitalobject', 'show', array( 'digitalObject' => $object->digitalObjects[0], 'usageType' => QubitTerm::REFERENCE_ID, 'link' => $digitalObjectLink)) ?>
<?php endif; ?>

<div class="section" id="titleAndStatementOfResponsibilityArea">

  <h2><?php echo __('Title and statement of responsibility area') ?></h2>

  <?php echo render_show(__('Title proper'), $object->getTitle(array('cultureFallback' => true))) ?>

  <div class="field">
    <h3><?php echo __('General material designation') ?></h3>
    <div>
      <ul>
        <?php foreach ($object->getMaterialTypes() as $materialType): ?>
          <li><?php echo $materialType->term ?></li>
        <?php endforeach; ?>
      </ul>
    </div>
  </div>

  <?php echo render_show(__('Parallel title'), $object->getAlternateTitle(array('cultureFallback' => true))) ?>

  <?php echo render_show(__('Other title information'), $object->getPropertyByName('otherTitleInformation', array('scope' => 'rad'))->getValue(array('cultureFallback' => true))) ?>

  <?php echo render_show(__('Title statements of responsibility'), $object->getPropertyByName('titleStatementOfResponsibility', array('scope' => 'rad'))->getValue(array('cultureFallback' => true))) ?>

  <div class="field">
    <h3><?php echo __('Title notes') ?></h3>
    <div>
      <ul>
        <?php foreach ($titleNotes as $note): ?>
          <li><?php echo $note->type ?>: <?php echo $note->getContent(array('cultureFallback' => true)) ?></li>
        <?php endforeach; ?>
      </ul>
    </div>
  </div>

  <?php echo render_show(__('Level of description'), $object->levelOfDescription) ?>

  <?php if (isset($object->repository)): ?>
    <?php echo render_show(__('Repository'), link_to(render_title($object->repository), array($object->repository, 'module' => 'repository'))) ?>
  <?php endif; ?>

  <?php echo render_show(__('Reference code'), QubitRad::getReferenceCode($object)) ?>

</div> <!-- /.section#titleAndStatementOfResponsibilityArea -->

<div class="section" id="editionArea">

  <h2><?php echo __('Edition area') ?></h2>

  <?php echo render_show(__('Edition statement'), $object->getEdition(array('cultureFallback' => true))) ?>

  <?php echo render_show(__('Edition statement of responsibility'), $object->getPropertyByName('editionStatementOfResponsibility', array('scope' => 'rad'))->getValue(array('cultureFallback' => true))) ?>

</div> <!-- /.section#editionArea -->

<div class="section" id="classOfMaterialSpecificDetailsArea">

  <h2><?php echo __('Class of material specific details area') ?></h2>

  <?php echo render_show(__('Statement of scale (cartographic)'), $object->getPropertyByName('statementOfScaleCartographic', array('scope' => 'rad'))->getValue(array('cultureFallback' => true))) ?>

  <?php echo render_show(__('Statement of projection (cartographic)'), $object->getPropertyByName('statementOfProjection', array('scope' => 'rad'))->getValue(array('cultureFallback' => true))) ?>

  <?php echo render_show(__('Statement of coordinates (cartographic)'), $object->getPropertyByName('statementOfCoordinates', array('scope' => 'rad'))->getValue(array('cultureFallback' => true))) ?>

  <?php echo render_show(__('Statement of scale (architectural)'), $object->getPropertyByName('statementOfScaleArchitectural', array('scope' => 'rad'))->getValue(array('cultureFallback' => true))) ?>

  <?php echo render_show(__('Issuing jurisdiction and denomination (philatelic)'), $object->getPropertyByName('issuingJursidictionAndDenomination', array('scope' => 'rad'))->getValue(array('cultureFallback' => true))) ?>

</div> <!-- /.section#classOfMaterialSpecificDetailsArea -->

<div class="section" id="datesOfCreationArea">

  <h2><?php echo __('Dates of creation area') ?></h2>

  <?php echo get_partial('informationobject/dates', array('informationObject' => $object)) ?>

  <?php echo get_partial('informationobject/creators', array('informationObject' => $object)) ?>

</div> <!-- /.section#datesOfCreationArea -->

<div class="section" id="physicalDescriptionArea">

  <h2><?php echo __('Physical description area') ?></h2>

  <?php echo render_show(__('Physical description'), $object->getExtentAndMedium(array('cultureFallback' => true))) ?>

</div> <!-- /.section#physicalDescriptionArea -->

<div class="section" id="publishersSeriesArea">

  <h2><?php echo __('Publisher\'s series area') ?></h2>

  <?php echo render_show(__('Title proper of publisher\'s series'), $object->getPropertyByName('titleProperOfPublishersSeries', array('scope' => 'rad'))->getValue(array('cultureFallback' => true))) ?>

  <?php echo render_show(__('Parallel titles of publisher\'s series'), $object->getPropertyByName('parallelTitlesOfPublishersSeries', array('scope' => 'rad'))->getValue(array('cultureFallback' => true))) ?>

  <?php echo render_show(__('Other title information of publisher\'s series'), $object->getPropertyByName('otherTitleInformationOfPublishersSeries', array('scope' => 'rad'))->getValue(array('cultureFallback' => true))) ?>

  <?php echo render_show(__('Statement of responsibility relating to publisher\'s series'), $object->getPropertyByName('statementOfResponsibilityRelatingToPublishersSeries', array('scope' => 'rad'))->getValue(array('cultureFallback' => true))) ?>

  <?php echo render_show(__('Numbering within publisher\'s series'), $object->getPropertyByName('numberingWithinPublishersSeries', array('scope' => 'rad'))->getValue(array('cultureFallback' => true))) ?>

  <?php echo render_show(__('Note on publisher\'s series'), $object->getPropertyByName('noteOnPublishersSeries', array('scope' => 'rad'))->getValue(array('cultureFallback' => true))) ?>

</div> <!-- /.section#publishersSeriesArea -->

<div class="section" id="archivalDescriptionArea">

  <h2><?php echo __('Archival description area') ?></h2>

  <?php echo render_show(__('Custodial history'), $object->getArchivalHistory(array('cultureFallback' => true))) ?>

  <?php echo render_show(__('Scope and content'), $object->getScopeAndContent(array('cultureFallback' => true))) ?>

</div> <!-- /.section#archivalDescriptionArea -->

<div class="section" id="notesArea">

  <h2><?php echo __('Notes area') ?></h2>

  <?php echo render_show(__('Physical condition'), $object->getPhysicalCharacteristics(array('cultureFallback' => true))) ?>

  <?php echo render_show(__('Immediate source of acquisition'), $object->getAcquisition(array('cultureFallback' => true))) ?>

  <?php echo render_show(__('Appraisal, destruction and scheduling'), $object->getAppraisal(array('cultureFallback' => true))) ?>

  <?php echo render_show(__('Arrangement'), $object->getArrangement(array('cultureFallback' => true))) ?>

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

  <?php echo render_show(__('Location of originals'), $object->getLocationOfOriginals(array('cultureFallback' => true))) ?>

  <?php echo render_show(__('Availability of other formats'), $object->getLocationOfCopies(array('cultureFallback' => true))) ?>

  <?php echo render_show(__('Restrictions on access'), $object->getAccessConditions(array('cultureFallback' => true))) ?>

  <?php echo render_show(__('Terms governing use, reproduction, and publication'), $object->getReproductionConditions(array('cultureFallback' => true))) ?>

  <?php echo render_show(__('Finding aids'), $object->getFindingAids(array('cultureFallback' => true))) ?>

  <?php echo render_show(__('Associated / related material'), $object->getRelatedUnitsOfDescription(array('cultureFallback' => true))) ?>

  <?php echo render_show(__('Accruals'), $object->getAccruals(array('cultureFallback' => true))) ?>

  <div class="field">
    <h3><?php echo __('Other notes') ?></h3>
    <div>
      <?php foreach ($notes as $note): ?>
        <?php echo $note->type ?>: <?php echo $note->getContent(array('cultureFallback' => true)) ?>
      <?php endforeach; ?>
    </div>
  </div>

</div> <!-- /.section#notesArea -->

<div class="section" id="standardNumberArea">

  <h2><?php echo __('Standard number area') ?></h2>

  <?php echo render_show(__('Standard number'), $object->getPropertyByName('standardNumber', array('scope' => 'rad'))->getValue(array('cultureFallback' => true))) ?>

</div> <!-- /.section#standardNumberArea -->

<div class="section">

  <h2><?php echo __('Access points') ?></h2>

  <?php echo get_partial('informationobject/subjectAccessPoints', array('informationObject' => $object)) ?>

  <?php echo get_partial('informationobject/placeAccessPoints', array('informationObject' => $object)) ?>

  <?php echo get_partial('informationobject/nameAccessPoints', array('informationObject' => $object)) ?>

</div> <!-- /.section -->

<div class="section">

  <h2><?php echo __('Control area') ?></h2>

  <?php echo render_show(__('Description record identifier'), $object->descriptionIdentifier) ?>

  <?php echo render_show(__('Institution identifier'), $object->getInstitutionResponsibleIdentifier(array('cultureFallback' => true))) ?>

  <?php echo render_show(__('Rules or conventions'), $object->getRules(array('cultureFallback' => true))) ?>

  <?php echo render_show(__('Status'), $object->descriptionStatus) ?>

  <?php echo render_show(__('Detail'), $object->descriptionDetail) ?>

  <?php echo render_show(__('Dates of creation, revision and deletion'), $object->getRevisionHistory(array('cultureFallback' => true))) ?>

  <div class="field">
    <h3><?php echo __('Language of description') ?></h3>
    <div>
      <ul>
        <?php foreach ($object->languageOfDescription as $code): ?>
          <li><?php echo format_language($code) ?></li>
        <?php endforeach; ?>
      </ul>
    </div>
  </div>

  <div class="field">
    <h3><?php echo __('Script of description') ?></h3>
    <div>
      <ul>
        <?php foreach ($object->scriptOfDescription as $code): ?>
          <li><?php echo format_script($code) ?></li>
        <?php endforeach; ?>
      </ul>
    </div>
  </div>

  <?php echo render_show(__('Sources'), $object->getSources(array('cultureFallback' => true))) ?>

</div> <!-- /.section -->

<?php if (0 < count($object->digitalObjects)): ?>
  <?php echo get_partial('digitalobject/metadata', array('digitalObject' => $object->digitalObjects[0])) ?>
<?php endif; ?>

<?php echo get_partial('informationobject/actions', array('informationObject' => $object)) ?>
