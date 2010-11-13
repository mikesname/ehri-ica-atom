<div class="browse">
  <form action="<?php echo url_for(array('module' => 'browse', 'action' => 'list')) ?>">
    <?php echo select_tag('browseList', options_for_select($options, $selected)) ?>
    <input class="form-submit" type="submit" value="<?php echo __('Browse') ?>"/>
  </form>
</div>
