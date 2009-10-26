<div id="browse-sidebar">
  <?php echo form_tag(array('module' => 'browse', 'action' => 'list')) ?>
    <div>
      <?php echo select_tag('browseList', $optionsForSelect) ?>
    </div>
    <div>
      <?php echo submit_tag(__('browse')) ?>
    </div>
  </form>
</div>
