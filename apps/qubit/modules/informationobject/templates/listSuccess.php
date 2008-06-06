<div class="pageTitle"><?php echo __('list %1%', array('%1%' => sfConfig::get('app_ui_label_informationobject'))); ?></div>

<table class="list">
<thead>
<tr>
  <th><?php if ($sort == 'titleUp'): ?>
    <?php echo link_to(__('title'), 'informationobject/list?repository='.$repositoryId.'&sort=titleDown') ?>
    <?php echo image_tag('up.gif', 'style="padding-bottom: 3px;"', 'sort up') ?>
  <?php else: ?>
    <?php echo link_to(__('title'), 'informationobject/list?repository='.$repositoryId.'&sort=titleUp') ?>
  <?php endif; ?>

  <?php if ($sort == 'titleDown'): ?>
    <?php echo image_tag('down.gif', 'style="padding-bottom: 3px;"', 'sort down') ?>
  <?php endif; ?>

  <?php if ($editCredentials): ?>
	<span class="th-link"><?php echo link_to(__('add new'), 'informationobject/create'); ?></span>
  <?php endif; ?>
  </th>

  <th><?php if ($sort == 'repositoryUp'): ?>
    <?php echo link_to(__(sfConfig::get('app_ui_label_repository')), 'informationobject/list?repository='.$repositoryId.'&sort=repositoryDown') ?>
    <?php echo image_tag('up.gif', 'style="padding-bottom: 3px;"', 'sort up') ?>
  <?php else: ?>
    <?php echo link_to(__(sfConfig::get('app_ui_label_repository')), 'informationobject/list?repository='.$repositoryId.'&sort=repositoryUp') ?>
  <?php endif; ?>

  <?php if ($sort == 'repositoryDown'): ?>
    <?php echo image_tag('down.gif', 'style="padding-bottom: 3px;"', 'sort down') ?>
  <?php endif; ?>
  </th>

</tr>
</thead>
<tbody>
<?php foreach ($informationObjects as $informationObject): ?>
<tr>
      <td><div style="padding-left: 17px;"<?php if (count($informationObject->getInformationObjectsRelatedByParentId()) > 0): ?> class="plus"<?php endif; ?>>
<?php if (is_null($title = $informationObject->getTitle())) $title = $informationObject->getTitle(array('sourceCulture' => true)); echo link_to($title, 'informationobject/show?id='.$informationObject->getId()) ?>
</div></td>
      <td><?php if ($informationObject->getRepository()): ?>
<?php if (is_null($repository = $informationObject->getRepository()->getAuthorizedFormOfName())) $repository = $informationObject->getRepository()->getAuthorizedFormOfName(array('sourceCulture' => true)); echo $repository ?>
<?php endif; ?></td></tr>
<?php endforeach; ?>
</tbody>
</table>

<?php if ($editCredentials): ?>
<div class="menu-action">
	<?php echo link_to (__('add new %1%', array('%1%' => sfConfig::get('app_ui_label_informationobject'))), 'informationobject/create') ?>
</div>
<?php endif; ?>
