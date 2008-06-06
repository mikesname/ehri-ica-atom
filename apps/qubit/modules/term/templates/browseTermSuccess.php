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
  <?php echo __("Browse for '%1%' in '%2%' returned %3% results", array('%1%' => $termName, '%2%' => $taxonomyName, '%3%' => count($informationObjects))) ?>
  </th>

</tr>
</thead>
<tbody>
<?php foreach ($informationObjects as $informationObject): ?>
<tr><td>
<?php echo link_to($informationObject->getLabel(), 'informationobject/show?id='.$informationObject->getId()) ?>

<?php if ($informationObject->getCollectionRoot()->getId() !== $informationObject->getId()): ?>
  <?php if (is_null($rootTitle = $informationObject->getCollectionRoot()->getTitle())) $rootTitle = $informationObject->getCollectionRoot()->getTitle(array('sourceCulture' => true)); ?>
  <br />
  <?php echo __('Part of: ')?>
  <?php echo link_to($rootTitle, 'informationobject/show?id='.$informationObject->getCollectionRoot()->getId()) ?></td>
<?php endif; ?>

</td></tr>
<?php endforeach; ?>
</tbody>
</table>

<div class="menu-extra">
  <?php echo link_to(__('browse all %1%', array('%1%' => $taxonomyName)), 'term/browse?taxonomyId='.$term->getTaxonomyId()); ?>
</div>
