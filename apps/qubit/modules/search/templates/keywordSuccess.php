<?php use_helper('Text') ?>
<?php if ($query): ?>
  <h1 class="search"><?php echo __("Search for '%1%' returned %2% results", array('%1%' => $query, '%2%' => count($hits))); ?></h1>
<?php endif; ?>

<?php foreach ($results->getHits() as $hit): ?>
  <div class="search-results" style="padding-top: 5px;">
    <h3><?php echo link_to($hit->display_title, array('module' => 'informationobject', 'action' => 'show', 'id' => $hit->informationObjectId)) ?></h3>

    <div class="CRUD_summary">
    <?php if ($hit->display_scopeandcontent): ?>
      <?php echo truncate_text($hit->display_scopeandcontent, 250) ?><br />
    <?php endif; ?>

    <?php $informationObject = QubitInformationObject::getById($hit->informationObjectId) ?>
    <?php if ($informationObject->getCollectionRoot()->id != $informationObject->id): ?>
      <?php echo __('Part of').': '.link_to(render_title($informationObject->getCollectionRoot()), array('module' => 'informationobject', 'action' => 'show', 'id' => $informationObject->getCollectionRoot()->id)) ?><br />
    <?php endif; ?>

    <?php $repository = (0 < $hit->repositoryid) ? QubitRepository::getById($hit->repositoryid) : null ?>
    <?php if (null !== $repository && 0 < sfConfig::get('app_multi_repository')) : ?>
      <?php echo __('Repository').': '.link_to($repository->getAuthorizedFormOfName(array('cultureFallback' => true)),
        array('module' => 'repository', 'action' => 'show', 'id' => $repository->getId())) ?><br />
    <?php endif; ?>
    </div>

  </div>
<?php endforeach; ?>

<?php if ($results->haveToPaginate()): ?>
  <div class="pager">
    <?php if ($results->getCurrentPage() != 1): ?>
      <?php echo link_to('< '.__('previous'), array('module' => 'search', 'action' => 'keyword', 'query' => urlencode($sf_data->getRaw('query')), 'page' => ($results->getCurrentPage() -1))) ?>
    <?php endif; ?>
  <?php foreach ($results->getPages() as $page): ?>
    <?php echo ($page == $results->getCurrentPage()) ? '<strong>'.$page.'</strong>' : link_to($page, array('module' => 'search', 'action' => 'keyword', 'query' => urlencode($sf_data->getRaw('query')), 'page' => $page)) ?>
  <?php endforeach; ?>
  <?php if (count($results->getPages()) > $results->getCurrentPage()): ?>
    <?php echo link_to(__('next').' >', array('module' => 'search', 'action' => 'keyword', 'query' => urlencode($sf_data->getRaw('query')), 'page' => ($results->getCurrentPage() +1))) ?>
  <?php endif; ?>
  </div>
<?php endif; ?>

<div class="result-count">
<?php echo __('displaying %1% to %2% of %3% results', array('%1%' => $results->getFirstHit(), '%2%' => $results->getLastHit(), '%3%' => count($hits))) ?>
</div>
