<div class="pageTitle"><?php echo __('list %1%', array('%1%' => sfConfig::get('app_ui_label_repository'))); ?></div>

<table class="list">
<thead>
<tr>
  <th><?php if ($sort == 'nameUp'): ?>
    <?php echo link_to(__('name'), 'repository/list?country='.$country.'&sort=nameDown&page='.$page) ?>
    <?php echo image_tag('up.gif', 'style="padding-bottom: 3px;"', 'sort up') ?>
  <?php else: ?>
    <?php echo link_to(__('name'), 'repository/list?country='.$country.'&sort=nameUp&page='.$page) ?>
  <?php endif; ?>

  <?php if ($sort == 'nameDown'): ?>
    <?php echo image_tag('down.gif', 'style="padding-bottom: 3px;"', 'sort down') ?>
  <?php endif; ?>

  <?php if ($editCredentials): ?>
  <span class="th-link"><?php echo link_to(__('add new'), 'repository/create'); ?></span>
  <?php endif; ?>
  </th>

  <th><?php if ($sort == 'typeUp'): ?>
    <?php echo link_to(__('type'), 'repository/list?country='.$country.'&sort=typeDown&page='.$page) ?>
    <?php echo image_tag('up.gif', 'style="padding-bottom: 3px;"', 'sort up') ?>
  <?php else: ?>
    <?php echo link_to(__('type'), 'repository/list?country='.$country.'&sort=typeUp&page='.$page) ?>
  <?php endif; ?>

  <?php if ($sort == 'typeDown'): ?>
    <?php echo image_tag('down.gif', 'style="padding-bottom: 3px;"', 'sort down') ?>
  <?php endif; ?>
  </th>

  <th>
  <?php if ($sort == 'countryDown'): ?>
    <?php echo __('country') ?>

    <!-- hide sort option until it is working...
    <?php echo link_to(__('country'), 'repository/list?country='.$country.'&sort=countryUp&page='.$page) ?>
    <?php echo image_tag('down.gif', 'style="padding-bottom: 3px;"', 'sort down') ?>
    -->
  <?php else: ?>
    <?php echo __('country') ?>
    <!-- hide sort option until it is working...
    <?php echo link_to(__('country'), 'repository/list?country='.$country.'&sort=countryDown&page='.$page) ?>
    -->
  <?php endif; ?>

  <?php if ($sort == 'countryUp'): ?>
    <!-- hide sort option until it is working...
    <?php echo image_tag('up.gif', 'style="padding-bottom: 3px;"', 'sort up') ?>
    -->
  <?php endif; ?>
  </th>

</tr>
</thead>
<tbody>
<?php foreach ($repositories->getResults() as $repository): ?>
<tr>
  <td>
  <?php $repositoryName = $repository->getAuthorizedFormOfName(array('cultureFallback' => true)); ?>
  <?php if ($editCredentials): ?>
    <?php echo link_to(render_title($repositoryName), 'repository/show?id='.$repository->getId()) ?>
  <?php else: ?>
    <?php echo link_to(render_title($repositoryName), 'repository/show?id='.$repository->getId()) ?>
  <?php endif; ?>
  </td>
  <td>
  <?php if ($repository->getTypeId()): ?>
    <?php if (is_null($repositoryType = $repository->getType()->getName())) $repositoryType = $repository->getType()->getName(array('sourceCulture' => true)); echo $repositoryType; ?>
  <?php endif; ?>
  </td>
  <td><?php echo $repository->getCountry() ?></td>
  </tr>
<?php endforeach; ?>
</tbody>
</table>

<?php if ($repositories->haveToPaginate()): ?>
<div class="pager">
  <?php $links = $repositories->getLinks(); ?>
  <?php if ($repositories->getPage() != $repositories->getFirstPage()): ?>
 <?php echo link_to('< '.__('previous'), 'repository/list?sort='.$sort.'&page='.($repositories->getPage()-1)) ?>
  <?php endif; ?>
  <?php foreach ($links as $page): ?>
    <?php echo ($page == $repositories->getPage()) ? '<strong>'.$page.'</strong>' : link_to($page, 'repository/list?sort='.$sort.'&page='.$page) ?>
    <?php if ($page != $repositories->getCurrentMaxLink()): ?> <?php endif ?>
  <?php endforeach ?>
  <?php if ($repositories->getPage() != $repositories->getLastPage()): ?>
 <?php echo link_to(__('next').' >', 'repository/list?sort='.$sort.'&page='.($repositories->getPage()+1)) ?>
  <?php endif; ?>
</div>
<?php endif ?>

<div class="result-count">
<?php echo __('displaying %1% to %2% of %3% results', array('%1%' => $repositories->getFirstIndice(), '%2%' => $repositories->getLastIndice(), '%3%' => $repositories->getNbResults())) ?>
</div>

