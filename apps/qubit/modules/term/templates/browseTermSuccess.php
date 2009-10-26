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
  <?php echo __("Browse for '%1%' in '%2%' returned %3% results", array('%1%' => $termName, '%2%' => $taxonomyName, '%3%' => $pager->getNbResults())) ?><br />
  </th>
</tr>
</thead>
<tbody>
<?php foreach ($pager->getResults() as $informationObject): ?>
<tr><td>
<?php echo link_to($informationObject->getLabel(), 'informationobject/show?id='.$informationObject->getId()) ?>

<br /><?php echo truncate_text($informationObject->scopeAndContent, 250) ?>

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

<?php echo get_partial('default/pager', array('pager' => $pager)) ?>

<div class="menu-extra">
  <?php echo link_to(__('browse all %1%', array('%1%' => $taxonomyName)), 'term/browse?taxonomyId='.$term->getTaxonomyId()); ?>
</div>
