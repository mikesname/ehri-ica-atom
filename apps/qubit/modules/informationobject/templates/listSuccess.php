<div class="pageTitle"><?php echo __('list %1%', array('%1%' => sfConfig::get('app_ui_label_informationobject'))) ?></div>

<table class="list">
<thead>
  <tr>
    <th>
      <?php echo __('title'); ?>
      <?php if (QubitAcl::check($informationObject, QubitAclAction::CREATE_ID)): ?>
        <span class="th-link"><?php echo link_to(__('add new'), array('module' => 'informationobject', 'action' => 'create', 'parent' => url_for(array('module' => 'informationobject', 'action' => 'show', 'id' => $informationObject->id)))) ?></span>
      <?php endif; ?>
    </th>
    <?php if (sfConfig::get('app_multi_repository')): ?>
      <th><?php echo __(sfConfig::get('app_ui_label_repository')); ?></th>
    <?php else: // NOT multi-repostiory: show creators ?>
      <th><?php echo __('creator(s)') ?></th>
    <?php endif; ?>
  </tr>
</thead>
<tbody>
<?php foreach ($informationObjects as $informationObject): ?>
  <tr>
    <td>
      <?php echo link_to(render_title($informationObject), array('module' => 'informationobject', 'action' => 'show', 'id' => $informationObject->id)) ?>
      <?php $status = $informationObject->getPublicationStatus() ?>
      <?php if ($status->statusId == QubitTerm::PUBLICATION_STATUS_DRAFT_ID): ?><span class="note2"><?php echo ' ('.$status->status.')' ?></span><?php endif; ?>
    </td>
  <?php if (sfConfig::get('app_multi_repository')): // multi-repository: show related repository ?>
    <td>
      <?php if (isset($informationObject->repository)): ?>
        <?php echo link_to(render_title($informationObject->repository), array('module' => 'repository', 'action' => 'show', 'id' => $informationObject->repository->id)) ?>
      <?php endif; ?>
    </td>
  <?php else: // NOT multi-repostiory: show creators as list ?>
    <td><ul class="nobullet">
    <?php foreach ($informationObject->getCreators() as $creator): ?>
      <li><?php echo link_to(render_title($creator), array('module' => 'actor', 'action' => 'show', 'id' => $creator->id)) ?></li>
    <?php endforeach; ?>
    </ul></td>
  <?php endif; ?>
  </tr>
<?php endforeach; ?>
</tbody>
</table>

<?php echo get_partial('default/pager', array('pager' => $pager)) ?>
