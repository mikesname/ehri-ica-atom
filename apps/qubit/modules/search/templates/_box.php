<div class="search section">

  <h2 class="element-invisible"><?php echo __('Search') ?></h2>

  <div class="content">
    <form action="<?php echo url_for(array('module' => 'search')) ?>">
      <input name="query" value="<?php echo esc_entities($sf_request->query) ?>"/>
      <input class="form-submit" type="submit" value="<?php echo __('Search') ?>"/>
    </form>
  </div>

</div>
