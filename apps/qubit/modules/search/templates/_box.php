<div class="search section">

  <h2 class="element-invisible"><?php echo __('Search') ?></h2>

  <div class="content">
    <form action="<?php echo url_for(array('module' => 'search')) ?>">
      <?php echo input_tag('query', $sf_request->query) ?>
      <?php echo submit_tag(__('Search')) ?>
    </form>
  </div>

</div>
