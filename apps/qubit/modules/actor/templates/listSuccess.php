<div class="pageTitle"><?php echo __('list %1%', array('%1%' => sfConfig::get('app_ui_label_actor'))) ?></div>

<table class="list"><thead><tr>
  <th>
    <?php if ($sort == 'nameUp'): ?>
      <?php echo link_to(__('name'), 'actor/list?role='.$role.'&sort=nameDown&page='.$page) ?>
      <?php echo image_tag('up.gif', array('style' => 'padding-bottom: 3px'), 'sort up') ?>
    <?php else: ?>
      <?php echo link_to(__('name'), 'actor/list?role='.$role.'&sort=nameUp&page='.$page) ?>
    <?php endif; ?>
    <?php if ($sort == 'nameDown'): ?>
      <?php echo image_tag('down.gif', array('style' => 'padding-bottom: 3px'), 'sort down') ?>
    <?php endif; ?>
    <?php if ($editCredentials): ?>
      <span class="th-link"><?php echo link_to(__('add new'), 'actor/create') ?></span>
    <?php endif; ?>
  </th><th>
    <?php if ($sort == 'typeDown'): ?>
      <?php echo link_to(__('type'), 'actor/list?role='.$role.'&sort=typeUp&page='.$page) ?>    
      <?php echo image_tag('down.gif', array('style' => 'padding-bottom: 3px'), 'sort down') ?>
    <?php else: ?>
      <?php echo link_to(__('type'), 'actor/list?role='.$role.'&sort=typeDown&page='.$page) ?>
    <?php endif; ?>
    <?php if ($sort == 'typeUp'): ?>
      <?php echo image_tag('up.gif', array('style' => 'padding-bottom: 3px'), 'sort up') ?>
    <?php endif; ?>
  </th>
</tr></thead><tbody><?php foreach ($actors->getResults() as $actor): ?><tr>
  <td>

    <div>
      <?php if ($editCredentials): ?>
        <?php echo link_to(render_title($actor->getAuthorizedFormOfName(array('cultureFallback' => true))), 'actor/show?id='.$actor->getId()) ?>
      <?php else: ?>
        <?php echo link_to(render_title($actor->getAuthorizedFormOfName(array('cultureFallback' => true))), 'actor/show?id='.$actor->getId()) ?>
      <?php endif; ?>
     </div>
   </td><td>
    <?php if ($actor->getEntityTypeId()): ?>
      <?php if (is_null($entityType = $actor->getEntityType()->getName())) $entityType = $actor->getEntityType()->getName(array('sourceCulture' => true)); echo $entityType; ?>
    <?php endif; ?>
    </td>
</tr><?php endforeach; ?></tbody></table>

<?php if ($actors->haveToPaginate()): ?>
<div class="pager">
  <?php $links = $actors->getLinks(); ?>
  <?php if ($actors->getPage() != $actors->getFirstPage()): ?>
 <?php echo link_to('< '.__('previous'), 'actor/list?sort='.$sort.'&page='.($actors->getPage()-1)) ?>
  <?php endif; ?>
  <?php foreach ($links as $page): ?>
    <?php echo ($page == $actors->getPage()) ? '<strong>'.$page.'</strong>' : link_to($page, 'actor/list?sort='.$sort.'&page='.$page) ?>
    <?php if ($page != $actors->getCurrentMaxLink()): ?> <?php endif ?>
  <?php endforeach ?>
  <?php if ($actors->getPage() != $actors->getLastPage()): ?>
 <?php echo link_to(__('next').' >', 'actor/list?sort='.$sort.'&page='.($actors->getPage()+1)) ?>
  <?php endif; ?>
</div>
<?php endif ?>

<div class="result-count">
<?php echo __('displaying %1% to %2% of %3% results', array('%1%' => $actors->getFirstIndice(), '%2%' => $actors->getLastIndice(), '%3%' => $actors->getNbResults())) ?>
</div>

