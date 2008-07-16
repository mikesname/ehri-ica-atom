<div id="search-sidebar">
  <?php echo form_tag('search/keyword', 'class=sidebarForm') ?>
    <div>
      <?php echo input_tag('search_query', $sf_request->getParameter('search_query'), 'class="textbox"') ?>
    </div>
    <div>
      <?php echo my_submit_tag(__('search')) ?>
    </div>
  </form>
</div>
