<div class="browse">
  <form action="<?php echo url_for(array('module' => 'browse', 'action' => 'list')) ?>">
    <?php echo select_tag('browseList', options_for_select($options, $selected)) ?>
    <?php echo submit_tag(__('Browse')) ?>
  </form>
</div>
