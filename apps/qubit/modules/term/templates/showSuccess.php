
<div class="pageTitle"><?php echo __('view term') ?></div>

<table class="detail">
<tbody>
<tr>
<th>Id: </th>
<td><?php echo $term->getId() ?></td>
</tr>
<tr>
<th><?php echo __('term type') ?></th>
<td><?php echo $term->getTermTypeId() ?></td>
</tr>
<tr>
<th><?php echo __('term name') ?></th>
<td><?php echo $term->getName() ?></td>
</tr>
<tr>
<th><?php echo __('scope note') ?></th>
<td><?php echo $term->getScopeNote() ?></td>
</tr>
<tr>
<th><?php echo __('code alpha') ?></th>
<td><?php echo $term->getCodeAlpha() ?></td>
</tr>
<tr>
<th><?php echo __('code alpha2') ?></th>
<td><?php echo $term->getCodeAlpha2() ?></td>
</tr>
<tr>
<th><?php echo __('code numeric') ?></th>
<td><?php echo $term->getCodeNumeric() ?></td>
</tr>
<tr>
<th><?php echo __('sort order') ?></th>
<td><?php //DEPRECATED: echo $term->getSortOrder() ?></td>
</tr>
<tr>
<th><?php echo __('source'); ?></th>
<td><?php echo $term->getSource() ?></td>
</tr>
<tr>
</tbody>
</table>
<div class="menu-action">
<?php echo link_to(__('edit'), 'term/edit?id='.$term->getId()) ?>
</div>
<div class="menu-extra">
<?php echo link_to(__('list all'), 'term/list?taxonomy='.$term->getTermType()) ?></div>
