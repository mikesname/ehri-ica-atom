<div id="language-selector" class="language-selectbox">
  <form action="<?php echo url_for($sf_data->getRaw('sf_context')->getRouting()->getCurrentInternalUri()) ?>">
          <?php echo select_tag('sf_culture', options_for_select($enabledI18nLanguages, $sf_user->getCulture())) ?>
          <div style="">
            <?php echo submit_tag(__('change language')) ?>
          </div>
  </form>
</div>
