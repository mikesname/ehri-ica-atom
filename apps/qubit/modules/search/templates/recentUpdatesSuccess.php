<h1><?php echo __('Recent updates'); ?></h1>

<div style="width: 99%">
<div class="table-control">
<form method="POST" action="<?php echo url_for(array('module' => 'search', 'action' => 'recentUpdates')) ?>">
  <?php echo __('Show updates to %1% in the last %2% days', array(
    '%1%' => select_tag('type', options_for_select($objectTypeList, $objectType), array('style' => 'width: auto')),
    '%2%' => input_tag('days', $numberOfDays, array('class' => 'textbox', 'style' => 'width: 3em', 'maxlength' => '3'))
  )); ?>
  <?php echo submit_tag('search', array('class' => 'form-submit', 'style' => 'float: none')) ?>
</form>
</div>
</div>

<table class="list">
<thead>
  <tr>
    <th><?php echo __($nameColumnDisplay); ?></th>
    <?php if('informationobject' == $objectType && 0 < sfConfig::get('app_multi_repository')): ?>
      <th><?php echo __('Repository') ?></th>
    <?php elseif('term' == $objectType): ?>
      <th><?php echo __('Taxonomy'); ?></th>
    <?php endif; ?>
    <th style="width: 110px"><?php echo __('Updated'); ?></th>
  </tr>
</thead>
<tbody>
<?php foreach ($pager->getResults() as $result): ?>
  <tr class="<?php echo 0 == ++$row % 2 ? 'even' : 'odd' ?>">
    <td>
    <?php if ('informationobject' == $objectType): ?>
      <?php $title = render_title($result->getTitle(array('cultureFallback' => true))) ?>
      <?php echo link_to($title, array('module' => 'informationobject', 'id' => $result->getId())) ?>
      <?php $status = $result->getPublicationStatus() ?>
      <?php if ($status->statusId == QubitTerm::PUBLICATION_STATUS_DRAFT_ID): ?><span class="note2"><?php echo ' ('.$status->status.')' ?></span><?php endif; ?>
    <?php elseif ('actor' == $objectType || 'repository' == $objectType): ?>
      <?php $name = render_title($result->getAuthorizedFormOfName(array('cultureFallback' => true))) ?>
      <?php echo link_to($name, array('module' => $objectType, 'id' => $result->getId())) ?>
    <?php elseif ('term' == $objectType): ?>
      <?php $name = render_title($result->getName(array('cultureFallback' => true))) ?>
      <?php echo link_to($name, array('module' => 'term', 'id' => $result->getId())) ?>
    <?php endif; ?>
    </td>

    <?php if('informationobject' == $objectType && 0 < sfConfig::get('app_multi_repository')): ?>
    <td>
      <?php if(null !== $repository = $result->getRepository(array('inherit' => true))): ?>
      <?php echo $repository->getAuthorizedFormOfName(array('cultureFallback' => true)) ?>
      <?php endif; ?>
    </td>
    <?php elseif('term' == $objectType): ?>
    <td>
      <?php echo $result->getTaxonomy()->getName(array('cultureFallback' => true)) ?>
    </td>
    <?php endif; ?>
    <td>
      <?php echo $result->getUpdatedAt() ?>
    </td>
<?php endforeach; ?>
</tbody>
</table>

<?php echo get_partial('default/pager', array('pager' => $pager)) ?>
