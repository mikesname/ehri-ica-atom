<div id="search-sidebar">
  <form action="<?php echo url_for(array('module' => 'search', 'action' => 'search')) ?>">
    <div>
      <?php echo input_tag('query', $sf_request->query, array('class' => 'textbox')) ?>
    </div>
    <div>
      <?php echo submit_tag(__('search')) ?>
    </div>
  </form>
</div>
