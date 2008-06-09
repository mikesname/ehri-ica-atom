<div class="pageTitle"><?php echo __('list %1%', array('%1%' => sfConfig::get('app_ui_label_actor'))) ?></div>

<table class="list"><thead><tr>
  <th>
    <?php if ($sort == 'nameUp'): ?>
      <?php echo link_to(__('name'), 'actor/list?role='.$role.'&sort=nameDown') ?>
      <?php echo image_tag('up.gif', array('style' => 'padding-bottom: 3px'), 'sort up') ?>
    <?php else: ?>
      <?php echo link_to(__('name'), 'actor/list?role='.$role.'&sort=nameUp') ?>
    <?php endif; ?>
    <?php if ($sort == 'nameDown'): ?>
      <?php echo image_tag('down.gif', array('style' => 'padding-bottom: 3px'), 'sort down') ?>
    <?php endif; ?>
    <?php if ($editCredentials): ?>
      <span class="th-link"><?php echo link_to(__('add new'), 'actor/create') ?></span>
    <?php endif; ?>
  </th><th>
    <?php if ($sort == 'typeDown'): ?>
      <?php echo link_to(__('type'), 'actor/list?role='.$role.'&sort=typeUp') ?>
      <?php echo image_tag('down.gif', array('style' => 'padding-bottom: 3px'), 'sort down') ?>
    <?php else: ?>
      <?php echo link_to(__('type'), 'actor/list?role='.$role.'&sort=typeDown') ?>
    <?php endif; ?>
    <?php if ($sort == 'typeUp'): ?>
      <?php echo image_tag('up.gif', array('style' => 'padding-bottom: 3px'), 'sort up') ?>
    <?php endif; ?>
  </th>
</tr></thead><tbody><?php foreach ($actors as $actor): ?><tr>
  <td>

    <?php if (is_null($actorName = $actor->getAuthorizedFormOfName())) $actorName = $actor->getAuthorizedFormOfName(array('sourceCulture' => true)); ?>
    <div style="padding-left: 17px;"<?php if (count($actor->getActorsRelatedByParentId()) > 0) echo ' class="plus"' ?>>
      <?php if ($editCredentials): ?>
        <?php echo link_to($actorName, 'actor/show?id='.$actor->getId()) ?>
      <?php else: ?>
        <?php echo link_to($actorName, 'actor/show?id='.$actor->getId()) ?>
      <?php endif; ?>
     </div>
   </td><td>
    <?php if ($actor->getEntityTypeId()): ?>
      <?php if (is_null($entityType = $actor->getEntityType()->getName())) $entityType = $actor->getEntityType()->getName(array('sourceCulture' => true)); echo $entityType; ?>
    <?php endif; ?>
    </td>
</tr><?php endforeach; ?></tbody></table>

<?php if ($editCredentials): ?>
  <div class="menu-action">
    <?php echo link_to(__('add new %1%', array('%1%' => sfConfig::get('app_ui_label_actor'))), 'actor/create') ?>
  </div>
<?php endif; ?>
