<div id="browse-sidebar">
  <?php echo form_tag('browse/list', 'class=sidebarForm') ?>
    <div>
      <?php echo select_tag('browseList', $sf_data->getRaw('optionsForSelect'), array('class' => 'selectbox')); ?>
    </div>
    <div>
      <?php echo submit_tag(__('browse')) ?>
    </div>
  </form>
</div>