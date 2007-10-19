
<div class="pageTitle">view term</div>

<table class="detail">
<tbody>
<tr>
<th>Id: </th>
<td><?php echo $term->getId() ?></td>
</tr>
<tr>
<th>Term type: </th>
<td><?php echo $term->getTermTypeId() ?></td>
</tr>
<tr>
<th>Term name: </th>
<td><?php echo $term->getTermName() ?></td>
</tr>
<tr>
<th>Scope note: </th>
<td><?php echo $term->getScopeNote() ?></td>
</tr>
<tr>
<th>Code alpha: </th>
<td><?php echo $term->getCodeAlpha() ?></td>
</tr>
<tr>
<th>Code alpha2: </th>
<td><?php echo $term->getCodeAlpha2() ?></td>
</tr>
<tr>
<th>Code numeric: </th>
<td><?php echo $term->getCodeNumeric() ?></td>
</tr>
<tr>
<th>Sort order: </th>
<td><?php echo $term->getSortOrder() ?></td>
</tr>
<tr>
<th>Source: </th>
<td><?php echo $term->getSource() ?></td>
</tr>
<tr>
<th>Created at: </th>
<td><?php echo $term->getCreatedAt() ?></td>
</tr>
<tr>
<th>Updated at: </th>
<td><?php echo $term->getUpdatedAt() ?></td>
</tr>
</tbody>
</table>
<div class="menu-action">
<?php echo link_to(__('edit'), 'term/edit?id='.$term->getId()) ?>
</div>
<div class="menu-extra">
<?php echo link_to(__('list').' '.__('all'), 'term/list?taxonomy='.$term->getTermType()) ?></div>
