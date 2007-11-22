<div id="language-selector">
  <?php echo form_tag($sf_context->getRouting()->getCurrentInternalUri()) ?>
    <table class="sidebar"><tr>
      <td><?php echo select_language_tag('sf_culture', null, array('class' => 'selectbox', 'languages' => array('en', 'es', 'fr'))) ?></td>
      <td><?php echo my_submit_tag(__('change')) ?></td>
    </tr></table>
  </form>
</div>
