<div id="searchbox">
  <?php echo form_tag('search/keyword') ?>
    <div>
      <?php echo input_tag('query', $sf_request->getParameter('query'), "class='box'") ?>
      <div>
        <?php echo submit_tag('', array('class' => 'searchbox-submit')) ?>
      </div>
    </div>
  </form>
</div>
