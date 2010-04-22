<?php use_helper('Date') ?>

<h1><?php echo __('Edit resource metadata - Dublin Core') ?></h1>

<h1 class="label"><?php echo render_title(QubitDc::getLabel($object)) ?></h1>

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

  <?php echo $form->identifier
    ->help(__('The unambiguous reference code used to uniquely identify this resource.')) 
    ->label(__('Identifier').' <span class="form-required" title="'.__('This is a mandatory element.').'">*</span>')
    ->renderRow() ?>

  <?php echo render_field($form->title
    ->help(__('The name given to this resource.')) 
    ->label(__('Title').' <span class="form-required" title="'.__('This is a mandatory element.').'">*</span>'), $object) ?>

  <div class="form-item">
    <label for="events"><?php echo __('Names and dates') ?></label>
    <?php echo get_partial('informationobject/relatedEvents', array('informationObject' => $object)) ?>
    <?php echo get_component('informationobject', 'eventForm') ?>
    <div class="description">
      <?php echo __('<strong>Event: add new names and/or dates</strong><br /><p>Use the <i>Actor name</i> field to link a person or organization to this resource. Search for an existing name in the authority records by typing the first few characters of the name. Alternatively, type a new name to create and link to a new authority record.</p><p>The <i>Event type</i> field identifies the type of activity that established the relation between the actor and resource (e.g. creation, publication, contribution).</p><p>The time and location of the event are identified in the <i>Date</i> and <i>Place</i> fields. Search for an existing name in the Place taxonomy by typing the first few characters.</p><p>Use YYYY-MM-DD format for the <i>Date</i> field. The <i>End Date</i> field can be used to indicate a date range. The <i>Date Display</i> field can be used to enter free-text date information.</p><p>All Event fields are optional, e.g. enter just a name or just a date if other Event information is not known.</p>') ?>
    </div>
  </div>

  <div class="form-item">
    <?php echo $form->subjectAccessPoints
      ->label(__('Subject'))
      ->renderLabel() ?>
    <?php echo $form->subjectAccessPoints->render(array('class' => 'form-autocomplete')) ?>
    <?php if (QubitAcl::check(QubitTaxonomy::getById(QubitTaxonomy::SUBJECT_ID), 'createTerm')): ?>
      <input class="add" type="hidden" value="<?php echo url_for(array('module' => 'term', 'action' => 'create', 'taxonomyId' => QubitTaxonomy::SUBJECT_ID)) ?> #name"/>
    <?php endif; ?>
    <input class="list" type="hidden" value="<?php echo url_for(array('module' => 'term', 'action' => 'autocomplete', 'taxonomyId' => QubitTaxonomy::SUBJECT_ID)) ?>"/>
    <?php echo $form->subjectAccessPoints
      ->help(__('The topic of the resource. Search for an existing term in the Subject taxonomy by typing the first few characters of the term name. Alternatively, type a new name to create and link to a new subject term.'))
      ->renderHelp() ?>
  </div>

  <?php echo render_field($form->scopeAndContent
    ->help(__('An abstract, table of contents or description of the resource’s scope and contents.'))
    ->label(__('Description')), $object, array('class' => 'resizable')) ?>

  <?php echo $form->types
    ->help(__('The nature or genre of the resource.<p>Assign as many types as applicable. The <i>Type</i> options are limited to the DCMI Type vocabulary.</p><p>Assign the <i>Collection</i> value if this resource is the top-level for a set of lower-level (child) resources.</p><p>Please note: if this resource is linked to a digital object, the <i>image</i>, <i>text</i>, <i>sound</i> or <i>moving image</i> types are added automatically upon output, so do not duplicate those values here.</p>'))
    ->label(__('Type'))
    ->renderRow() ?>

  <div class="form-item">
    <label for=""><?php echo __('Child levels (if describing a collection)') ?></label>
    <table class="inline multiRow">
      <thead>
        <tr>
          <th style="width: 20%">
            <?php echo __('Identifier') ?>
          </th><th style="width: 80%">
            <?php echo __('Title') ?>
          </th>
        </tr>
      </thead><tbody>
        <tr>
          <td>
            <?php echo input_tag('updateChildLevels[0][identifier]') ?>
          </td><td>
            <?php echo input_tag('updateChildLevels[0][title]') ?>
          </td>
        </tr>
      </tbody>
    </table>
    <div class="description">
      <?php echo __('<strong>Child levels</strong><br />Use these two fields to add lower levels to a collection level description. Click <i>Add new</i> to create as many child levels as necessary.</p><p>These fields can also be used to add any number of intermediate levels of description (e.g. series, file, etc) between the top and bottom levels in a descriptive hierarchy. Use the hierarchy treeview to re-order hierarchy levels as necessary.</p><p><i>Identifier</i>: The unambiguous reference code used to uniquely identify the child-level resource.</p><p><i>Title</i>: The name given to the child-level resource.</p>') ?>
    </div> 
  </div>

  <?php echo render_field($form->extentAndMedium
    ->help(__('The file format, physical medium, or dimensions of the resource.<p>Please note: if this resource is linked to a digital object, the Internet Media Types (MIME) will be added automatically upon output, so don\'t duplicate those values here.</p>'))
    ->label(__('Format')), $object, array('class' => 'resizable')) ?>

  <?php echo render_field($form->locationOfOriginals
    ->help(__('Related material(s) from which this resource is derived.'))
    ->label(__('Source')), $object, array('class' => 'resizable')) ?>

  <?php echo $form->language
    ->help(__('Language(s) of this resource.'))
    ->renderRow(array('class' => 'form-autocomplete')) ?>

  <div class="form-item">
    <?php echo $form->repository
      ->label(__('Relation (isLocatedAt)').' <span class="form-required" title="'.__('This is a mandatory element for this resource or one its higher descriptive levels (if part of a collection hierarchy).').'">*</span>')
      ->renderLabel() ?>
    <?php echo $form->repository->render(array('class' => 'form-autocomplete')) ?>
    <input class="add" type="hidden" value="<?php echo url_for(array('module' => 'repository', 'action' => 'create')) ?> #authorizedFormOfName"/>
    <input class="list" type="hidden" value="<?php echo url_for($repoAcParams) ?>"/>
    <?php echo $form->repository
      ->help(__('The name of the organization which has custody of the resource.<p>Search for an existing name in the organization records by typing the first few characters of the name. Alternatively, type a new name to create and link to a new organization record.</p>'))
      ->renderHelp() ?>
  </div>
  
  <div class="form-item">
    <?php echo $form->placeAccessPoints
      ->label(__('Coverage (spatial)'))
      ->renderLabel() ?>
    <?php echo $form->placeAccessPoints->render(array('class' => 'form-autocomplete')) ?>
    <?php if (QubitAcl::check(QubitTaxonomy::getById(QubitTaxonomy::PLACE_ID), 'createTerm')): ?>
      <input class="add" type="hidden" value="<?php echo url_for(array('module' => 'term', 'action' => 'create', 'taxonomyId' => QubitTaxonomy::PLACE_ID)) ?> #name"/>
    <?php endif; ?>
    <input class="list" type="hidden" value="<?php echo url_for(array('module' => 'term', 'action' => 'autocomplete', 'taxonomyId' => QubitTaxonomy::PLACE_ID)) ?>"/>
    <?php echo $form->placeAccessPoints
      ->help(__('The name of a place or geographic area which is a topic of the resource or relevant to its jurisdiction.<p>Search for an existing term in the Place taxonomy by typing the first few characters of the place name. Alternatively, type a new name to create and link to a new place.</p><p>Please note: if you entered a place of creation, publication or contribution that will be output automatically, so don’t repeat that place name here.</p>'))
      ->renderHelp() ?>
  </div>

  <?php echo render_field($form->accessConditions
    ->help(__('Information about rights held in and over the resource (e.g. copyright, access conditions, etc.).'))
    ->label(__('Rights')), $object, array('class' => 'resizable')) ?>

  <?php echo get_partial('informationobject/adminInfo', array('form' => $form, 'informationObject' => $object)) ?>

  <?php echo get_partial('informationobject/editActions', array('informationObject' => $object)) ?>

</form>
