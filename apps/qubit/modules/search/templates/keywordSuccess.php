<?php use_helper('Text') ?>
<?php if ($query): ?>
  <h1 class="search"><?php echo __("search for '%1%' returned %2% results", array('%1%' => $query, '%2%' => count($hits))); ?></h1>
<?php endif; ?>

<?php foreach ($hits as $hit): ?>

  <div class="search-results" style="padding-top: 5px;">

    <h3><?php echo link_to($hit->display_title, 'informationobject/show?id='.$hit->informationObjectId) ?></h3>

    <div class="CRUD_summary">
    <?php if ($hit->display_scopeandcontent): ?>
      <?php echo truncate_text($hit->display_scopeandcontent, 250) ?><br />
    <?php endif; ?>
    <?php if ($hit->collectionid !== $hit->informationObjectId) : ?>
      <?php echo __('Part of').': '.link_to($hit->collectiontitle, 'informationobject/show?id='.$hit->collectionid) ?>
    <?php endif; ?>
    </div>

  </div>

<?php endforeach; ?>
