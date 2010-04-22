<h1><?php echo __('Add/edit static page') ?></h1>

<?php echo form_tag('staticpage/update') ?>

<?php echo object_input_hidden_tag($staticPage, 'getId') ?>

<table class="detail">
<tbody>
<tr>
  <td colspan="2" class="headerCell">
  <?php echo ($staticPage->getTitle()) ? link_to($staticPage->getTitle(),'staticpage/static?permalink='.$staticPage->getPermalink()): ''; ?>
  </td>
</tr>
<tr>
  <th><?php echo __('Title'); ?></th>
    <td>
      <?php if (strlen($sourceCultureValue = $staticPage->getTitle(array('sourceCulture' => 'true'))) > 0 && $sf_user->getCulture() != $staticPage->getSourceCulture()): ?>
      <div class="default-translation" id="title"><?php echo $sourceCultureValue ?></div>
      <?php endif; ?>
      <?php echo object_input_tag($staticPage, 'getTitle', array ('size' => 20)) ?>
    </td>
</tr>
<tr>
  <th><?php echo __('Permalink'); ?></th>
  <td><?php echo $staticPage->getPermalink() ?></td>
</tr>
<tr>
  <th><?php echo __('Content'); ?></th>
  <td>
      <?php if (strlen($sourceCultureValue = $staticPage->getContent(array('sourceCulture' => 'true'))) > 0 && $sf_user->getCulture() != $staticPage->getSourceCulture()): ?>
      <div class="default-translation" id="title"><?php echo $sourceCultureValue ?></div>
      <?php endif; ?>
    <?php echo object_textarea_tag($staticPage, 'getContent', array ('class' => 'resizable', 'size' => '30x10')) ?>
  </td>
</tr>
</tbody>
</table>

  <div class="actions section">
    <h2 class="element-invisible"><?php echo __('Actions') ?></h2>
    <div class="content">
      <ul class="clearfix links">
        <li><?php echo link_to(__('Cancel'), 'staticpage/list') ?></li>
        <?php if ($staticPage->getId()): ?>
        <li><?php echo submit_tag(__('Save')) ?></li>
        <?php else: ?>
        <li><?php echo submit_tag(__('Create')) ?></li>
        <?php endif; ?>
      </ul>
    </div>
  </div>

</form>
