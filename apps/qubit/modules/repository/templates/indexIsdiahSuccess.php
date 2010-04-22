<h1><?php echo __('View %1%', array('%1%' => sfConfig::get('app_ui_label_repository'))) ?></h1>

<?php echo link_to_if(SecurityPriviliges::editCredentials($sf_user, 'repository'), '<h1 class="label">'.render_title($repository).'</h1>', array($repository, 'module' => 'repository', 'action' => 'edit'), array('title' => __('Edit repository'))) ?>

<?php if (isset($errorSchema)): ?>
  <div class="messages error">
    <ul>
      <?php foreach ($errorSchema as $error): ?>
        <li><?php echo $error ?></li>
      <?php endforeach; ?>
    </ul>
  </div>
<?php endif; ?>

<?php echo render_show(__('Identifier'), render_value($repository->identifier)) ?>

<?php echo render_show(__('Authorized form of name'), render_value($repository)) ?>

<div class="field">
  <h3><?php echo __('Parallel form(s) of name') ?></h3>
  <div>
    <ul>
      <?php foreach ($repository->getOtherNames(array('typeId' => QubitTerm::PARALLEL_FORM_OF_NAME_ID)) as $name): ?>
        <li><?php echo render_value($name->__toString()) ?></li>
      <?php endforeach; ?>
    </ul>
  </div>
</div>

<div class="field">
  <h3><?php echo __('Other form(s) of name') ?></h3>
  <div>
    <ul>
      <?php foreach ($repository->getOtherNames(array('typeId' => QubitTerm::OTHER_FORM_OF_NAME_ID)) as $name): ?>
        <li><?php echo render_value($name->__toString()) ?></li>
      <?php endforeach; ?>
    </ul>
  </div>
</div>

<?php foreach ($types as $type): ?>
  <?php echo render_show(__('Type'), render_value($type->term)) ?>
<?php endforeach; ?>

<div class="field">
  <h3><?php echo __('Contact information') ?></h3>
  <div class="vcard">
    <?php foreach ($contactInformation as $item): ?>
      <div>

        <?php if (SecurityPriviliges::editCredentials($sf_user, 'repository')): ?>
          <a href="<?php echo url_for(array($item, 'module' => 'actor', 'action' => 'editContactInformation')) ?>" title="<?php echo __('Edit contact information') ?>">
        <?php endif; ?>
        <h3><?php echo $item->getContactType(array('cultureFallback' => true)) ?><?php if (isset($item->primaryContact)): ?> (<?php echo __('Primary contact') ?>)<?php endif; ?></h3>
        <?php if (SecurityPriviliges::editCredentials($sf_user, 'repository')): ?>
          </a>
        <?php endif; ?>

        <?php echo get_partial('repository/contactInformation', array('contactInformation' => $item)) ?>

      </div>
    <?php endforeach; ?>
  </div>
</div>

<?php echo render_show(__('History'), render_value($repository->getHistory(array('cultureFallback' => true)))) ?>

<?php echo render_show(__('Geographical and cultural context'), render_value($repository->getGeoculturalContext(array('cultureFallback' => true)))) ?>

<?php echo render_show(__('Mandates/Sources of authority'), render_value($repository->getMandates(array('cultureFallback' => true)))) ?>

<?php echo render_show(__('Administrative structure'), render_value($repository->getInternalStructures(array('cultureFallback' => true)))) ?>

<?php echo render_show(__('Records management and collecting policies'), render_value($repository->getCollectingPolicies(array('cultureFallback' => true)))) ?>

<?php echo render_show(__('Buildings'), render_value($repository->getBuildings(array('cultureFallback' => true)))) ?>

<?php echo render_show(__('Holdings'), render_value($repository->getHoldings(array('cultureFallback' => true)))) ?>

<?php echo render_show(__('Finding aids, guides and publications'), render_value($repository->getFindingAids(array('cultureFallback' => true)))) ?>

<?php echo render_show(__('Opening times'), render_value($repository->getOpeningTimes(array('cultureFallback' => true)))) ?>

<?php echo render_show(__('Access conditions and requirements'), render_value($repository->getAccessConditions(array('cultureFallback' => true)))) ?>

<?php echo render_show(__('Accessibility'), render_value($repository->getDisabledAccess(array('cultureFallback' => true)))) ?>

<?php echo render_show(__('Research services'), render_value($repository->getResearchServices(array('cultureFallback' => true)))) ?>

<?php echo render_show(__('Reproduction services'), render_value($repository->getReproductionServices(array('cultureFallback' => true)))) ?>

<?php echo render_show(__('Public areas'), render_value($repository->getPublicFacilities(array('cultureFallback' => true)))) ?>

<?php echo render_show(__('Description identifier'), render_value($repository->descIdentifier)) ?>

<?php echo render_show(__('Institution identifier'), render_value($repository->getDescInstitutionIdentifier(array('cultureFallback' => true)))) ?>

<?php echo render_show(__('Rules and/or conventions used'), render_value($repository->getDescRules(array('cultureFallback' => true)))) ?>

<?php echo render_show(__('Status'), render_value($repository->descStatus)) ?>

<?php echo render_show(__('Level of detail'), render_value($repository->descDetail)) ?>

<?php echo render_show(__('Dates of creation, revision and deletion'), render_value($repository->getDescRevisionHistory(array('cultureFallback' => true)))) ?>

<div class="field">
  <h3><?php echo __('Language(s)') ?></h3>
  <div>
    <ul>
      <?php foreach ($repository->language as $code): ?>
        <li><?php echo format_language($code) ?></li>
      <?php endforeach; ?>
    </ul>
  </div>
</div>

<div class="field">
  <h3><?php echo __('Script(s)') ?></h3>
  <div>
    <ul>
      <?php foreach ($repository->script as $code): ?>
        <li><?php echo format_script($code) ?></li>
      <?php endforeach; ?>
    </ul>
  </div>
</div>

<?php echo render_show(__('Sources'), render_value($repository->getDescSources(array('cultureFallback' => true)))) ?>

<?php echo render_show(__('Maintenance notes'), render_value($maintenanceNote)) ?>

<?php if (SecurityPriviliges::editCredentials($sf_user, 'repository')): ?>
  <div class="actions section">

    <h2 class="element-invisible"><?php echo __('Actions') ?></h2>

    <div class="content">
      <ul class="clearfix links">
        <li><?php echo link_to(__('Edit'), array($repository, 'module' => 'repository', 'action' => 'edit'), array('title' => __(''))) ?></li>
        <li><?php echo link_to(__('Delete'), array($repository, 'module' => 'repository', 'action' => 'delete'), array('title' => __(''))) ?></li>
        <li><?php echo link_to(__('Add new'), array('module' => 'repository', 'action' => 'create'), array('title' => __(''))) ?></li>
      </ul>
    </div>

  </div>
<?php endif; ?>
