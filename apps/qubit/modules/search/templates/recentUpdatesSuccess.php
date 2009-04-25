<div class="pageTitle"><?php echo __('recent updates'); ?></div>

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
  <th>
  <?php if ($sort == 'nameUp'): ?>
    <?php echo link_to(__($nameColumnDisplay), array_merge($defaultParamList, array('sort' => 'nameDown'))) ?>
    <?php echo image_tag('up.gif', 'style="padding-bottom: 3px;"', 'sort up') ?>
  <?php else: ?>
    <?php echo link_to(__($nameColumnDisplay), array_merge($defaultParamList, array('sort' => 'nameUp'))) ?>
  <?php endif; ?>
  <?php if ($sort == 'nameDown'): ?>
    <?php echo image_tag('down.gif', 'style="padding-bottom: 3px;"', 'sort down') ?>
  <?php endif; ?>
  </th>

  <?php if('informationobject' == $objectType && 0 < sfConfig::get('app_multi_repository')): ?>
  <th>
    <?php echo __('repository') ?>
  </th>
  <?php elseif('term' == $objectType): ?>
  <th>
    <?php echo __('taxonomy') ?>
  </th>
  <?php endif; ?>

  <th style="width: 110px">
  <?php if ($sort == 'updatedDown'): ?>
    <?php echo link_to(__('updated'), array_merge($defaultParamList, array('sort' => 'updatedUp'))) ?>
    <?php echo image_tag('down.gif', 'style="padding-bottom: 3px;"', 'sort down') ?>
  <?php else: ?>
    <?php echo link_to(__('updated'), array_merge($defaultParamList, array('sort' => 'updatedDown'))) ?>
  <?php endif; ?>

  <?php if ($sort == 'updatedUp'): ?>
    <?php echo image_tag('up.gif', 'style="padding-bottom: 3px;"', 'sort up') ?>
  <?php endif; ?>
  </th>
</tr>
</thead>
<tbody>
<?php foreach ($pager->getResults() as $result): ?>
  <tr>
    <td>
    <?php if ('informationobject' == $objectType): ?>
      <?php $title = render_title($result->getTitle(array('cultureFallback' => true))) ?>
      <?php echo link_to($title, array('module' => 'informationobject', 'action' => 'show', 'id' => $result->getId())) ?>
    <?php elseif ('actor' == $objectType || 'repository' == $objectType): ?>
      <?php $name = render_title($result->getAuthorizedFormOfName(array('cultureFallback' => true))) ?>
      <?php echo link_to($name, array('module' => $objectType, 'action' => 'show', 'id' => $result->getId())) ?>
    <?php elseif ('term' == $objectType): ?>
      <?php $name = render_title($result->getName(array('cultureFallback' => true))) ?>
      <?php echo link_to($name, array('module' => 'term', 'action' => 'show', 'id' => $result->getId())) ?>
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
      <?php echo format_date('Y-m-d H:i', $result->getUpdatedAt()) ?>
    </td>
<?php endforeach; ?>
</tbody>
</table>

<?php if ($pager->haveToPaginate()): ?>
<div class="pager">
  <?php $links = $pager->getLinks(); ?>
  <?php if ($pager->getPage() != $pager->getFirstPage()): ?>
 <?php echo link_to('< '.__('previous'), array_merge($defaultParamList, array('page' => ($pager->getPage()-1)))) ?>
  <?php endif; ?>
  <?php foreach ($links as $page): ?>
    <?php echo ($page == $pager->getPage()) ? '<strong>'.$page.'</strong>' : link_to($page, array_merge($defaultParamList, array('page' => $page))) ?>
    <?php if ($page != $pager->getCurrentMaxLink()): ?> <?php endif; ?>
  <?php endforeach ?>
  <?php if ($pager->getPage() != $pager->getLastPage()): ?>
 <?php echo link_to(__('next').' >', array_merge($defaultParamList, array('page' => ($pager->getPage()+1)))) ?>
  <?php endif; ?>
</div>
<?php endif; ?>

<div class="result-count">
<?php echo __('displaying %1% to %2% of %3% results', array('%1%' => $pager->getFirstIndice(), '%2%' => $pager->getLastIndice(), '%3%' => $pager->getNbResults())) ?>
</div>