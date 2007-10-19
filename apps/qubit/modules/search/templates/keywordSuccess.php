<?php use_helper('Text') ?>
<h1 id="first"><?php echo __('search'); ?></h1>

<div id="search-info">
<?php if ($query) echo __("search for '%1%' resulted in %2% results", array('%1%' => $query, '%2%' => count($hits))); ?>
</div>

<?php foreach ($hits as $hit): ?>

  <div class="search-results">

    <h3><?php echo link_to($hit->display_title, 'informationobject/show?id='.$hit->informationObjectId) ?></h3>

    <div class="CRUD_summary">
      <?php echo truncate_text($hit->display_scopeandcontent, 250) ?>
    </div>

  </div>

<?php endforeach; ?>
