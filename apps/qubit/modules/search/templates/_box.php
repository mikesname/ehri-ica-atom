<div id="search-sidebar">
  <?php echo form_tag('search/keyword', 'class=sidebarForm') ?>
    <div>
      <?php echo input_tag('query', $sf_request->getParameter('query'), 'class="textbox"') ?>
    </div>
    <div>
      <?php echo submit_tag(__('search'), array('class' => 'form-submit')) ?>
    </div>
  </form>
</div>
