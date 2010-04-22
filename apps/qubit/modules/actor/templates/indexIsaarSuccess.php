<h1><?php echo __('View authority record') ?></h1>

<?php echo link_to_if(QubitAcl::check($actor, 'update'), '<h1 class="label">'.render_title($actor).'</h1>', array($actor, 'module' => 'actor', 'action' => 'edit'), array('title' => __('Edit authority record'))) ?>

<?php if (isset($errorSchema)): ?>
  <div class="messages error">
    <ul>
      <?php foreach ($errorSchema as $error): ?>
        <li><?php echo $error ?></li>
      <?php endforeach; ?>
    </ul>
  </div>
<?php endif; ?>

<?php echo render_show(__('Type of entity'), render_value($actor->entityType)) ?>

<?php echo render_show(__('Authorized form of name'), render_value($actor->getAuthorizedFormOfName(array('cultureFallback' => true)))) ?>

<div class="field">
  <h3><?php echo __('Parallel form(s) of name') ?></h3>
  <div>
    <ul>
      <?php foreach ($actor->getOtherNames(array('typeId' => QubitTerm::PARALLEL_FORM_OF_NAME_ID)) as $name): ?>
        <li><?php echo render_value($name->__toString()) ?></li>
      <?php endforeach; ?>
    </ul>
  </div>
</div>

<div class="field">
  <h3><?php echo __('Standardized form(s) of name according to other rules') ?></h3>
  <div>
    <ul>
      <?php foreach ($actor->getOtherNames(array('typeId' => QubitTerm::STANDARDIZED_FORM_OF_NAME_ID)) as $name): ?>
        <li><?php echo render_value($name->__toString()) ?></li>
      <?php endforeach; ?>
    </ul>
  </div>
</div>

<div class="field">
  <h3><?php echo __('Other form(s) of name') ?></h3>
  <div>
    <ul>
      <?php foreach ($actor->getOtherNames(array('typeId' => QubitTerm::OTHER_FORM_OF_NAME_ID)) as $name): ?>
        <li><?php echo render_value($name->__toString()) ?></li>
      <?php endforeach; ?>
    </ul>
  </div>
</div>

<?php echo render_show(__('Identifiers for corporate bodies'), render_value($actor->corporateBodyIdentifiers)) ?>

<?php echo render_show(__('Dates of existence'), render_value($actor->getDatesOfExistence(array('cultureFallback' => true)))) ?>

<?php echo render_show(__('History'), render_value($actor->getHistory(array('cultureFallback' => true)))) ?>

<?php echo render_show(__('Places'), render_value($actor->getPlaces(array('cultureFallback' => true)))) ?>

<?php echo render_show(__('Legal status'), render_value($actor->getLegalStatus(array('cultureFallback' => true)))) ?>

<?php echo render_show(__('Functions, occupations and activities'), render_value($actor->getFunctions(array('cultureFallback' => true)))) ?>

<?php echo render_show(__('Mandates/sources of authority'), render_value($actor->getMandates(array('cultureFallback' => true)))) ?>

<?php echo render_show(__('Internal structures/genealogy'), render_value($actor->getInternalStructures(array('cultureFallback' => true)))) ?>

<?php echo render_show(__('General context'), render_value($actor->getGeneralContext(array('cultureFallback' => true)))) ?>

<?php foreach ($actorRelations as $relation): ?>
  <div class="field">
    <h3><?php echo __('Related entity') ?></h3>
    <div>

      <?php if ($actor->id == $relation->object->id): ?>
        <?php echo link_to($relation->subject, array($relation->subject, 'module' => 'actor')) ?><?php if ($existence = $relation->subject->getDatesOfExistence(array('cultureFallback' => true))): ?> <span class="note2">(<?php echo render_value($existence) ?>)</span><?php endif; ?>
      <?php else: ?>
        <?php echo link_to($relation->object, array($relation->object, 'module' => 'actor')) ?>
        <?php if ($existence = $relation->object->getDatesOfExistence(array('cultureFallback' => true))): ?><span class="note2"> (<?php echo render_value($existence) ?>)</span><?php endif; ?>
      <?php endif; ?>

      <table class="inline" style="margin-top: 5px">

        <?php if (isset($relation->object->corporateBodyIdentifiers)): ?>
          <tr>
            <th style="text-align: left; padding: 1px">
              <?php echo __('Identifier of the related entity') ?>
            </th>
          </tr><tr>
            <td>
              <?php echo render_value($relation->object->corporateBodyIdentifiers) ?>
            </td>
          </tr>
        <?php endif; ?>

        <?php if (isset($relation->type)): ?>
          <tr>
            <th style="text-align: left; padding: 1px">
              <?php echo __('Category of the relationship') ?>
            </th>
          </tr><tr>
            <td>
              <?php echo render_value($relation->type) ?>
            </td>
          </tr>
        <?php endif; ?>

        <?php if ((null !== $dateDisplayNote = $relation->getNoteByTypeId(QubitTerm::RELATION_NOTE_DATE_DISPLAY_ID)) || 0 < count($dateArray = $relation->getDates())): ?>
          <tr>
            <th style="text-align: left; padding: 1px">
              <?php echo __('Dates of the relationship') ?>
            </th>
          </tr><tr>
            <td>
              <?php if (null !== $dateDisplayNote && 0 < strlen($dateDisplay = $dateDisplayNote->getContent(array('cultureFallback' => true)))): ?>
                <?php echo render_value($dateDisplay) ?>
              <?php elseif (2 == count($dateArray)): ?>
                <?php echo __('%1% - %2%', array('%1%' => collapse_date($dateArray['start']), '%2%' => collapse_date($dateArray['end']))) ?>
              <?php else: ?>
                <?php echo collapse_date(array_shift($dateArray)) ?>
              <?php endif; ?>
            </td>
          </tr>
        <?php endif; ?>

        <?php if (null !== $descriptionNote = $relation->getNoteByTypeId(QubitTerm::RELATION_NOTE_DESCRIPTION_ID)): ?>
          <tr>
            <th style="text-align: left; padding: 1px">
              <?php echo __('Description of relationship') ?>
            </th>
          </tr><tr>
            <td>
              <?php echo render_value($descriptionNote) ?>
            </td>
          </tr>
        <?php endif; ?>

      </table>

    </div>
  </div>
<?php endforeach; ?>

<?php foreach ($functionRelations as $relation): ?>
  <?php echo render_show(__('Related function'), link_to(render_value($relation->subject->getLabel()), array($relation->subject, 'module' => 'function'))) ?>
<?php endforeach; ?>

<?php echo render_show(__('Description identifier'), render_value($actor->descriptionIdentifier)) ?>

<?php echo render_show(__('Institution identifier'), render_value($actor->getInstitutionResponsibleIdentifier(array('cultureFallback' => true)))) ?>

<?php echo render_show(__('Rules and/or conventions used'), render_value($actor->getRules(array('cultureFallback' => true)))) ?>

<?php echo render_show(__('Status'), render_value($actor->descriptionStatus)) ?>

<?php echo render_show(__('Level of detail'), render_value($actor->descriptionDetail)) ?>

<?php echo render_show(__('Dates of creation, revision and deletion'), render_value($actor->getRevisionHistory(array('cultureFallback' => true)))) ?>

<div class="field">
  <h3><?php echo __('Language(s)') ?></h3>
  <div>
    <ul>
      <?php foreach ($actor->language as $code): ?>
        <li><?php echo format_language($code) ?></li>
      <?php endforeach; ?>
    </ul>
  </div>
</div>

<div class="field">
  <h3><?php echo __('Script(s)') ?></h3>
  <div>
    <ul>
      <?php foreach ($actor->script as $code): ?>
        <li><?php echo format_script($code) ?></li>
      <?php endforeach; ?>
    </ul>
  </div>
</div>

<?php echo render_show(__('Sources'), render_value($actor->getSources(array('cultureFallback' => true)))) ?>

<?php echo render_show(__('Maintenance notes'), render_value($maintenanceNote)) ?>

<?php if (QubitAcl::check($actor, 'create') || QubitAcl::check($actor, 'delete') || QubitAcl::check($actor, 'update')): ?>
  <div class="actions section">
  <h2 class="element-invisible"><?php echo __('Actions') ?></h2>
    <div class="content">
      <ul class="clearfix links">
        <?php if (QubitAcl::check($actor, 'update')): ?>
          <li><?php echo link_to(__('Edit'), array($actor, 'module' => 'actor', 'action' => 'edit'), array('title' => __(''))) ?></li>
        <?php endif; ?>

        <?php if (QubitAcl::check($actor, 'delete')): ?>
          <li><?php echo link_to(__('Delete'), array($actor, 'module' => 'actor', 'action' => 'delete'), array('title' => __(''))) ?></li>
        <?php endif; ?>

        <?php if (QubitAcl::check($actor, 'create')): ?>
          <li><?php echo link_to(__('Add new'), array('module' => 'actor', 'action' => 'create'), array('title' => __(''))) ?></li>
        <?php endif; ?>
      </ul>
    </div>
  </div>
<?php endif; ?>
