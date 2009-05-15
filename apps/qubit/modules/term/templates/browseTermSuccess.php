<div class="pageTitle">
<?php if (is_null($taxonomyName = $term->getTaxonomy()->getName())) $taxonomyName = $term->getTaxonomy()->getName(array('sourceCulture' => true)); ?>
<?php echo __('list %1%', array('%1%' => $taxonomyName)) ?> -
<?php if (is_null($termName = $term->getName())) $termName = $term->getName(array('sourceCulture' => true)); ?>
<?php echo $termName ?>
</div>

<table class="list">
<thead>

<tr>
  <th>
  <?php echo __("Browse for '%1%' in '%2%' returned %3% results", array('%1%' => $termName, '%2%' => $taxonomyName, '%3%' => $informationObjects->getNbResults())) ?><br />
  </th>
</tr>
</thead>
<tbody>
<?php foreach ($informationObjects->getResults() as $informationObject): ?>
<tr><td>
<?php echo link_to($informationObject->getLabel(), 'informationobject/show?id='.$informationObject->getId()) ?>

<?php if ($informationObject->getCollectionRoot()->getId() !== $informationObject->getId()): ?>
  <?php if (is_null($rootTitle = $informationObject->getCollectionRoot()->getTitle())) $rootTitle = $informationObject->getCollectionRoot()->getTitle(array('sourceCulture' => true)); ?>
  <br />
  <?php echo __('Part of').': ' ?>
  <?php echo link_to($rootTitle, 'informationobject/show?id='.$informationObject->getCollectionRoot()->getId()) ?>
<?php endif; ?>

<?php if ($multiRepository): ?>
  <?php if ($repository = $informationObject->getRepository(array('inherit' => true))): ?>
     <br />
     <?php echo __('Repository').': ' ?>
       <?php echo link_to($repository, array('module' => 'repository', 'action' => 'show', 'id' => $repository->getId())) ?>
  <?php endif; ?>
<?php endif; ?>

</td>

</td></tr>
<?php endforeach; ?>
</tbody>
</table>

<?php if ($informationObjects->haveToPaginate()): ?>
<div class="pager">
  <?php $links = $informationObjects->getLinks(); ?>
  <?php if ($informationObjects->getPage() != $informationObjects->getFirstPage()): ?>
    <?php echo link_to('< '.__('previous'), 'term/browse?termId='.$termId.'&sortColumn='.$sortColumn.'&sortDirection='.$sortDirection.'&page='.($informationObjects->getPage()-1)) ?>
  <?php endif; ?>
  <?php foreach ($links as $page): ?>
    <?php echo ($page == $informationObjects->getPage()) ? '<strong>'.$page.'</strong>' : link_to($page, 'term/browse?termId='.$termId.'&sortColumn='.$sortColumn.'&sortDirection='.$sortDirection.'&page='.$page) ?>
    <?php if ($page != $informationObjects->getCurrentMaxLink()): ?> <?php endif ?>
  <?php endforeach ?>
  <?php if ($informationObjects->getPage() != $informationObjects->getLastPage()): ?>
    <?php echo link_to(__('next').' >', 'term/browse?termId='.$termId.'&sortColumn='.$sortColumn.'&sortDirection='.$sortDirection.'&page='.($informationObjects->getLastPage()+1)) ?>
  <?php endif; ?>
</div>
<?php endif ?>

<div class="result-count">
<?php echo __('displaying %1% to %2% of %3% results', array('%1%' => $informationObjects->getFirstIndice(), '%2%' => $informationObjects->getLastIndice(), '%3%' => $informationObjects->getNbResults())) ?>
</div>


<div class="menu-extra">
  <?php echo link_to(__('browse all %1%', array('%1%' => $taxonomyName)), 'term/browse?taxonomyId='.$term->getTaxonomyId()); ?>
</div>
