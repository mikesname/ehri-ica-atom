<h1><?php echo $title ?></h1>

<?php if ($sf_user->hasFlash('error')): ?>
  <div class="messages error">
    <h3><?php echo __('Error encountered') ?></h3>
    <div><?php echo $sf_user->getFlash('error') ?></div>
  </div>
<?php endif; ?>

<?php echo $form->renderFormTag(url_for(array('module' => 'object', 'action' => 'import')), array('enctype' => 'multipart/form-data')) ?>

  <fieldset>

    <legend><?php echo $title ?></legend>

    <div class="form-item">
      <label><?php echo __('Select a file to import') ?></label>
      <input name="file" type="file"/>
    </div>

    <?php if ('csv' == $type): ?>
      <div class="form-item">
        <label><?php echo __('Type') ?></label>
        <select name="schema">
          <option value=""><?php echo __('Auto-detect') ?></option>
          <option value="isad">ISAD(G)</option>
          <option value="rad">RAD</option>
          <option value="isdiah">ISDIAH</option>
        </select>
      </div>
    <?php endif; ?>

    <div class="form-item">
      <label>
        <input name="noindex" type="checkbox"/>
        <?php echo __('Do not index imported items') ?>
      </label>
    </div>

  </fieldset>

  <div class="actions section">

    <h2 class="element-invisible"><?php echo __('Actions') ?></h2>

    <div class="content">
      <ul class="clearfix links">
        <li><input class="form-submit" type="submit" value="<?php echo __('Import') ?>"/></li>
      </ul>
    </div>

  </div>

</form>
