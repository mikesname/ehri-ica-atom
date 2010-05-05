<h1><?php echo __('View ISDF function') ?></h1>

<?php echo link_to_if(QubitAcl::check($func, 'update'), '<h1 class="label">'.render_title($func).'</h1>', array($func, 'module' => 'function', 'action' => 'edit'), array('title' => __('Edit function'))) ?>

<?php if (isset($errorSchema)): ?>
  <div class="messages error">
    <ul>
      <?php foreach ($errorSchema as $error): ?>
        <li><?php echo $error ?></li>
      <?php endforeach; ?>
    </ul>
  </div>
<?php endif; ?>

<div class="section" id="identityArea">

  <?php echo link_to_if(QubitAcl::check($func, 'update'), '<h2>'.__('Identity area').'</h2>', array($func, 'module' => 'function', 'action' => 'edit'), array('anchor' => 'identityArea', 'title' => __('Edit identity area'))) ?>

  <?php echo render_show(__('Type'), $func->type) ?>

  <?php echo render_show(__('Authorized form of name'), $func->getAuthorizedFormOfName(array('cultureFallback' => true))) ?>

  <div class="field">
    <h3><?php echo __('Parallel form(s) of name') ?></h3>
    <div>
      <ul>
        <?php foreach ($parallelNames as $parallelName): ?>
          <li><?php echo $parallelName ?></li>
        <?php endforeach; ?>
      </ul>
    </div>
  </div>

  <div class="field">
    <h3><?php echo __('Other form(s) of name') ?></h3>
    <div>
      <ul>
        <?php foreach ($otherNames as $otherName): ?>
          <li><?php echo $otherName ?></li>
        <?php endforeach; ?>
      </ul>
    </div>
  </div>

  <?php echo render_show(__('Classification'), $func->getClassification(array('cultureFallback' => true))) ?>

</div> <!-- /.section#identityArea -->

<!-- Context area -->
<div class="section" id="contextArea">

  <?php echo link_to_if(QubitAcl::check($func, 'update'), '<h2>'.__('Context area').'</h2>', array($func, 'module' => 'function', 'action' => 'edit'), array('anchor' => 'contextArea', 'title' => __('Edit context area'))) ?>

  <?php echo render_show(__('Dates'), $func->getDates(array('cultureFallback' => true))) ?>

  <?php echo render_show(__('Description'), $func->getDescription(array('cultureFallback' => true))) ?>

  <?php echo render_show(__('History'), $func->getHistory(array('cultureFallback' => true))) ?>

  <?php echo render_show(__('Legislation'), $func->getLegislation(array('cultureFallback' => true))) ?>

</div> <!-- /.section#contextArea -->

<!-- Relationships area -->
<div class="section" id="relationshipsArea">

  <?php echo link_to_if(QubitAcl::check($func, 'update'), '<h2>'.__('Relationships area').'</h2>', array($func, 'module' => 'function', 'action' => 'edit'), array('anchor' => 'relationshipsArea', 'title' => __('Edit relationships area'))) ?>

  <?php foreach ($functionRelations as $relation): ?>
    <div class="field">
      <h3><?php echo __('Related function') ?></h3>
      <div>

        <?php if ($func->id == $relation->object->id): ?>
          <?php echo link_to($relation->subject, array($relation->subject, 'module' => 'function')) ?>
        <?php else: ?>
          <?php echo link_to($relation->object, array($relation->object, 'module' => 'function')) ?>
        <?php endif; ?>

        <!-- Identifier -->
        <?php if (0 < strlen($identifier = $relation->object->getDescriptionIdentifier(array('cultureFallback' => true)))): ?>
          (<?php echo $identifier ?>)
        <?php endif; ?>

        <table class="inline" style="margin-top: 5px">

          <!-- Type of function -->
          <?php if (isset($relation->object->type)): ?>
            <tr>
              <th style="text-align: left; padding: 1px">
                <?php echo __('Type') ?>
              </th>
            </tr><tr>
              <td>
                <?php echo $relation->object->type ?>
              </td>
            </tr>
          <?php endif; ?>

          <!-- Category of relationship -->
          <?php if (isset($relation->type)): ?>
            <tr>
              <th style="text-align: left; padding: 1px">
                <?php echo __('Category of relationship') ?>
              </th>
            </tr><tr>
              <td>
                <?php echo $relation->type ?>
              </td>
            </tr>
          <?php endif; ?>

          <!-- Description of relationship -->
          <?php if (null !== $descriptionNote = $relation->getNoteByTypeId(QubitTerm::RELATION_NOTE_DESCRIPTION_ID)): ?>
            <tr>
              <th style="text-align: left; padding: 1px">
                <?php echo __('Description of relationship') ?>
              </th>
            </tr><tr>
              <td>
                <?php echo $descriptionNote->getContent(array('cultureFallback' => true)) ?>
              </td>
            </tr>
          <?php endif; ?>

          <!-- Dates of relationship -->
          <?php if ((null !== $dateDisplayNote = $relation->getNoteByTypeId(QubitTerm::RELATION_NOTE_DATE_DISPLAY_ID)) || 0 < count($dateArray = $relation->getDates())): ?>
            <tr>
              <th style="text-align: left; padding: 1px">
                <?php echo __('Dates of relationship') ?>
              </th>
            </tr><tr>
              <td>
                <?php if (null !== $dateDisplayNote && 0 < strlen($dateDisplay = $dateDisplayNote->getContent(array('cultureFallback' => true)))): ?>
                  <?php echo $dateDisplay ?>
                <?php elseif (2 == count($dateArray)): ?>
                  <?php echo __('%1% - %2%', array('%1%' => collapse_date($dateArray['start']), '%2%' => collapse_date($dateArray['end']))) ?>
                <?php else: ?>
                  <?php echo collapse_date(array_shift($dateArray)) ?>
                <?php endif; ?>
              </td>
            </tr>
          <?php endif; ?>

        </table>

      </div>
    </div>
  <?php endforeach; ?>

  <!-- Related corporate bodies -->
  <?php foreach ($actorRelations as $relation): ?>
    <div class="field">
      <h3><?php echo __('Related authority record') ?></h3>
      <div>
        <table class="inline" style="margin-top: 5px">

          <!-- Authorized form of name -->
          <tr>
            <th style="text-align: left; padding: 1px">
              <?php echo __('Authorized form of name') ?>
            </th>
          </tr><tr>
            <td>
              <?php echo link_to($relation->object->getAuthorizedFormOfName(array('cultureFallback' => true)), array($relation->object, 'module' => 'actor')) ?>
            </td>
          </tr>

          <!-- Identifier  -->
          <?php if (isset($relation->object->descriptionIdentifier)): ?>
            <tr>
              <th style="text-align: left; padding: 1px">
                <?php echo __('Identifier') ?>
              </th>
            </tr><tr>
              <td>
                <?php echo $relation->object->descriptionIdentifier ?>
              </td>
            </tr>
          <?php endif; ?>

          <!-- Description of relationship -->
          <?php if (null !== $descriptionNote = $relation->getNoteByTypeId(QubitTerm::RELATION_NOTE_DESCRIPTION_ID)): ?>
            <tr>
              <th style="text-align: left; padding: 1px">
                <?php echo __('Nature of relationship') ?>
              </th>
            </tr><tr>
              <td>
                <?php echo $descriptionNote->getContent(array('cultureFallback' => true)) ?>
              </td>
            </tr>
          <?php endif; ?>

          <!-- Dates of relationship -->
          <?php if ((null !== $dateDisplayNote = $relation->getNoteByTypeId(QubitTerm::RELATION_NOTE_DATE_DISPLAY_ID)) || 0 < count($dateArray = $relation->getDates())): ?>
            <tr>
              <th style="text-align: left; padding: 1px">
                <?php echo __('Dates of the relationship') ?>
              </th>
            </tr><tr>
              <td>
                <?php if (null !== $dateDisplayNote && 0 < strlen($dateDisplay = $dateDisplayNote->getContent(array('cultureFallback' => true)))): ?>
                  <?php echo $dateDisplay ?>
                <?php elseif (2 == count($dateArray)): ?>
                  <?php echo __('%1% - %2%', array('%1%' => collapse_date($dateArray['start']), '%2%' => collapse_date($dateArray['end']))) ?>
                <?php else: ?>
                  <?php echo collapse_date(array_shift($dateArray)) ?>
                <?php endif; ?>
              </td>
            </tr>
          <?php endif; ?>

        </table>
      </div>
    </div>
  <?php endforeach; ?>

  <!-- Related archival material -->
  <?php foreach ($infoObjectRelations as $relation): ?>
    <div class="field">
      <h3><?php echo __('Related resource') ?></h3>
      <div>
        <table class="inline" style="margin-top: 5px">

          <!-- Title -->
          <tr>
            <th style="text-align: left; padding: 1px">
              <?php echo __('Title') ?>
            </th>
          </tr><tr>
            <td>
              <?php echo link_to($relation->object->getTitle(array('cultureFallback' => true)), array($relation->object, 'module' => 'informationobject')) ?>
            </td>
          </tr>

          <!-- Identifier  -->
          <?php if (isset($relation->object->identifier)): ?>
            <tr>
              <th style="text-align: left; padding: 1px">
                <?php echo __('Identifier') ?>
              </th>
            </tr><tr>
              <td>
                <?php echo QubitIsad::getReferenceCode($relation->object) ?>
              </td>
            </tr>
          <?php endif; ?>

          <!-- Description of relationship -->
          <?php if (null !== $descriptionNote = $relation->getNoteByTypeId(QubitTerm::RELATION_NOTE_DESCRIPTION_ID)): ?>
            <tr>
              <th style="text-align: left; padding: 1px">
                <?php echo __('Nature of relationship') ?>
              </th>
            </tr><tr>
              <td>
                <?php echo $descriptionNote->getContent(array('cultureFallback' => true)) ?>
              </td>
            </tr>
          <?php endif; ?>

          <!-- Dates of relationship -->
          <?php if ((null !== $dateDisplayNote = $relation->getNoteByTypeId(QubitTerm::RELATION_NOTE_DATE_DISPLAY_ID)) || 0 < count($dateArray = $relation->getDates())): ?>
            <tr>
              <th style="text-align: left; padding: 1px">
                <?php echo __('Dates of the relationship') ?>
              </th>
            </tr><tr>
              <td>
                <?php if (null !== $dateDisplayNote && 0 < strlen($dateDisplay = $dateDisplayNote->getContent(array('cultureFallback' => true)))): ?>
                  <?php echo $dateDisplay ?>
                <?php elseif (2 == count($dateArray)): ?>
                  <?php echo __('%1% - %2%', array('%1%' => collapse_date($dateArray['start']), '%2%' => collapse_date($dateArray['end']))) ?>
                <?php else: ?>
                  <?php echo collapse_date(array_shift($dateArray)) ?>
                <?php endif; ?>
              </td>
            </tr>
          <?php endif; ?>

        </table>
      </div>
    </div>
  <?php endforeach; ?>

</div> <!-- /.section#relationshipsArea -->

<!-- Control area -->
<div class="section" id="controlArea">

  <?php echo link_to_if(QubitAcl::check($func, 'update'), '<h2>'.__('Control area').'</h2>', array($func, 'module' => 'function', 'action' => 'edit'), array('anchor' => 'controlArea', 'title' => __('Edit control area'))) ?>

  <?php echo render_show(__('Description identifier'), $func->descriptionIdentifier) ?>

  <?php echo render_show(__('Institution identifier'), $func->getInstitutionIdentifier(array('cultureFallback' => true))) ?>

  <?php echo render_show(__('Rules and/or conventions used'), $func->getRules(array('cultureFallback' => true))) ?>

  <?php echo render_show(__('Status'), $func->descriptionStatus) ?>

  <?php echo render_show(__('Level of detail'), $func->descriptionDetail) ?>

  <?php echo render_show(__('Dates of creation, revision or deletion'), $func->getRevisionHistory(array('cultureFallback' => true))) ?>

  <div class="field">
    <h3><?php echo __('Language(s)') ?></h3>
    <div>
      <ul>
        <?php foreach ($func->language as $code): ?>
          <li><?php echo format_language($code) ?></li>
        <?php endforeach; ?>
      </ul>
    </div>
  </div>

  <div class="field">
    <h3><?php echo __('Script(s)') ?></h3>
    <div>
      <ul>
        <?php foreach ($func->script as $code): ?>
          <li><?php echo format_script($code) ?></li>
        <?php endforeach; ?>
      </ul>
    </div>
  </div>

  <?php echo render_show(__('Sources'), $func->getSources(array('cultureFallback' => true))) ?>

  <div class="field">
    <h3><?php echo __('Maintenance notes') ?></h3>
    <div>
      <?php if (isset($maintenanceNotes[0])): ?>
        <?php echo $maintenanceNotes[0]->getContent(array('cultureFallback' => true)) ?>
      <?php endif; ?>
    </div>
  </div>

</div> <!-- /.section#controlArea -->


<?php if ((QubitAcl::check($func, 'update')) || (QubitAcl::check($func, 'delete')) || (QubitAcl::check($func, 'create'))): ?>
  <div class="actions section">
    <h2 class="element-invisible"><?php echo __('Actions') ?></h2>
    <div class="content">
      <ul class="clearfix links">
  <?php if (QubitAcl::check($func, 'update')): ?>
        <li><?php echo link_to(__('Edit'), array($func, 'module' => 'function', 'action' => 'edit'), array('title' => __('Edit this function'))) ?></li>
  <?php endif; ?>
  <?php if (QubitAcl::check($func, 'delete')): ?>
        <li><?php echo link_to(__('Delete'), array($func, 'module' => 'function', 'action' => 'delete'), array('title' => __('Delete this function'))) ?></li>
  <?php endif; ?>
  <?php if (QubitAcl::check($func, 'create')): ?>
        <li><?php echo link_to(__('Add new'), array('module' => 'function', 'action' => 'create'), array('title' => __('Add new function'))) ?></li>
  <?php endif; ?>
      </ul>
    </div>
  </div>
<?php endif; ?>
