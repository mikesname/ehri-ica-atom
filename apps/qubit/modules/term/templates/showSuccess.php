
<div class="pageTitle"><?php echo __('view term') ?></div>

<table class="detail">
<tbody>
<?php if ($term->getName(array('sourceCulture' => true))): ?>
  <tr><td colspan="2" class="headerCell">
  <?php if ($editCredentials) echo link_to($term->getName(), 'term/edit/?id='.$term->getId());
        else echo $term->getName(); ?>
  </td></tr>
<?php endif; ?>

<tr>
<th>Id: </th>
<td><?php echo $term->getId() ?></td>
</tr>
<tr>
<th><?php echo __('taxonomy') ?></th>
<td><?php echo $term->getTaxonomy() ?></td>
</tr>
<tr>
<th><?php echo __('code') ?></th>
<td><?php echo $term->getCode() ?></td>
</tr>

<tr>
<th><?php echo __('scope note') ?></th>
<td>
      <?php if ($scopeNotes): ?>
      <ul>
        <?php foreach ($scopeNotes as $scopeNote): ?>
          <li><?php echo $scopeNote->getContent(array('cultureFallback' => 'true')) ?></li>
        <?php endforeach; ?>
      </ul>
      <?php endif; ?>
</td>
</tr>
<tr>
<tr>
<th><?php echo __('source note'); ?></th>
<td>
      <?php if ($sourceNotes): ?>
      <ul>
        <?php foreach ($sourceNotes as $sourceNote): ?>
          <li><?php echo $sourceNote->getContent(array('cultureFallback' => 'true')) ?></li>
        <?php endforeach; ?>
      </ul>
      <?php endif; ?>
</td>
</tr>
<tr>
</tbody>
</table>
<div class="menu-action">
<?php echo link_to(__('edit'), 'term/edit?id='.$term->getId()) ?>
</div>
<div class="menu-extra">
<?php echo link_to(__('list all'), 'term/list?taxonomy='.$term->getTaxonomy()) ?></div>
