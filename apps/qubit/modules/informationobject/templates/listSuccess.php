<div class="pageTitle"><?php echo __('list %1%', array('%1%' => sfConfig::get('app_ui_label_informationobject'))); ?></div>

<table class="list">
<thead>
<tr>
  <th>
  <?php if ($sort == 'titleUp'): ?>
    <?php echo link_to(__('title'), 'informationobject/list?repository='.$repositoryId.'&sort=titleDown&page='.$page) ?>
    <?php echo image_tag('up.gif', 'style="padding-bottom: 3px;"', 'sort up') ?>
  <?php else: ?>
    <?php echo link_to(__('title'), 'informationobject/list?repository='.$repositoryId.'&sort=titleUp&page='.$page) ?>
  <?php endif; ?>

  <?php if ($sort == 'titleDown'): ?>
    <?php echo image_tag('down.gif', 'style="padding-bottom: 3px;"', 'sort down') ?>
  <?php endif; ?>

  <?php if ($editCredentials): ?>
  <span class="th-link"><?php echo link_to(__('add new'), 'informationobject/create'); ?></span>
  <?php endif; ?>
  </th>

  <?php if($multiRepository): ?>
    <th>
    <?php if ($sort == 'repositoryUp'): ?>
      <?php echo link_to(__(sfConfig::get('app_ui_label_repository')), 'informationobject/list?repository='.$repositoryId.'&sort=repositoryDown&page='.$page) ?>
      <?php echo image_tag('up.gif', 'style="padding-bottom: 3px;"', 'sort up') ?>
    <?php else: ?>
      <?php echo link_to(__(sfConfig::get('app_ui_label_repository')), 'informationobject/list?repository='.$repositoryId.'&sort=repositoryUp&page='.$page) ?>
    <?php endif; ?>

    <?php if ($sort == 'repositoryDown'): // multi-repository: show repository (w/ sorting) ?>
      <?php echo image_tag('down.gif', 'style="padding-bottom: 3px;"', 'sort down') ?>
    <?php endif; ?>
    </th>
    <?php else: // NOT multi-repostiory: show creators (no sorting, multi-value) ?>
    <th>
      <?php echo __('creator(s)') ?>
    </th>
  <?php endif; ?>
</tr>
</thead>
<tbody>
<?php foreach ($informationObjects->getResults() as $informationObject): ?>
  <tr>
    <td>
      <?php $title = render_title($informationObject->getTitle(array('cultureFallback' => true))) ?>
      <?php echo link_to($title, 'informationobject/show?id='.$informationObject->getId()) ?>
    </td>
  <?php if($multiRepository): // multi-repository: show related repository ?>
    <td>
      <?php if ($repository = $informationObject->getRepository()): ?>
      <?php echo render_title($repository->getAuthorizedFormOfName(array('cultureFallback' => true))) ?>
      <?php endif; ?>
    </td>
  <?php else: // NOT multi-repostiory: show creators as list ?>
    <td><ul class="nobullet">
    <?php foreach ($informationObject->getCreators() as $creator): ?>
    <?php if (strlen($creatorName = $creator->getAuthorizedFormOfName(array('cultureFallback' => true))) > 0): ?>
      <li><?php echo $creatorName ?></li>
    <?php endif; ?>
    <?php endforeach; ?>
    </ul></td>
  <?php endif; ?>
  </tr>
<?php endforeach; ?>
</tbody>
</table>

<?php if ($informationObjects->haveToPaginate()): ?>
<div class="pager">
  <?php $links = $informationObjects->getLinks(); ?>
  <?php if ($informationObjects->getPage() != $informationObjects->getFirstPage()): ?>
 <?php echo link_to('< '.__('previous'), 'informationobject/list?sort='.$sort.'&page='.($informationObjects->getPage()-1)) ?>
  <?php endif; ?>
  <?php foreach ($links as $page): ?>
    <?php echo ($page == $informationObjects->getPage()) ? '<strong>'.$page.'</strong>' : link_to($page, 'informationobject/list?sort='.$sort.'&page='.$page) ?>
    <?php if ($page != $informationObjects->getCurrentMaxLink()): ?> <?php endif; ?>
  <?php endforeach ?>
  <?php if ($informationObjects->getPage() != $informationObjects->getLastPage()): ?>
 <?php echo link_to(__('next').' >', 'informationobject/list?sort='.$sort.'&page='.($informationObjects->getPage()+1)) ?>
  <?php endif; ?>
</div>
<?php endif; ?>

<div class="result-count">
<?php echo __('displaying %1% to %2% of %3% results', array('%1%' => $informationObjects->getFirstIndice(), '%2%' => $informationObjects->getLastIndice(), '%3%' => $informationObjects->getNbResults())) ?>
</div>