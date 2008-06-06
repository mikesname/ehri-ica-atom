<div id="language-selector" class="language-list">
  <?php echo form_tag($sf_context->getRouting()->getCurrentInternalUri()) ?>
		<?php echo select_language_tag('sf_culture', $sf_user->getCulture(), array('class' => 'selectbox', 'languages' => $enabledI18nLanguages)) ?>
      	<?php echo my_submit_tag(__('change')) ?>
  </form>
</div>