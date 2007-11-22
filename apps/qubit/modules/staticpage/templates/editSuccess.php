<div class="pageTitle"><?php echo __('add').' / '.__('edit').' '.__('static page'); ?></div>

<?php echo form_tag('staticpage/update') ?>

<?php echo object_input_hidden_tag($staticpage, 'getId') ?>

<table class="detail">
<tbody>
<tr><td colspan="2" class="headerCell">
<?php echo ($staticpage->getTitle()) ? link_to($staticpage->getTitle(),'staticpage/static?permalink='.$staticpage->getPermalink()): ''; ?>
</td></tr>
<tr>
  <th><?php echo __('title'); ?>:</th>
  <td><?php echo object_input_tag($staticpage, 'getTitle', array ('size' => 20,)) ?></td>
</tr>
<tr>
<th><?php echo __('permalink'); ?>: </th>
<td><?php echo $staticpage->getPermalink() ?></td>
</tr>
<tr>
  <th><?php echo __('page content'); ?>:</th>
  <td><?php echo object_textarea_tag($staticpage, 'getPageContent', array ('size' => '30x10',)) ?></td>
</tr>
<tr>
  <th><?php echo __('stylesheet'); ?>:</th>
  <td><?php echo object_input_tag($staticpage, 'getStylesheet', array ('size' => 20,)) ?></td>
</tr>
</tbody>
</table>
<div class="menu-action">
<?php if ($staticpage->getId()): ?>
  &#160;<?php echo link_to(__('delete'), 'staticpage/delete?id='.$staticpage->getId(), 'post=true&confirm='.__('are you sure?')) ?>
  &#160;<?php echo link_to(__('cancel'), 'staticpage/list') ?>
<?php else: ?>
  &#160;<?php echo link_to(__('cancel'), 'staticpage/list') ?>
<?php endif; ?>
<?php echo my_submit_tag(__('save'), array('style' => 'width: auto;')) ?>
</div>
</form>
