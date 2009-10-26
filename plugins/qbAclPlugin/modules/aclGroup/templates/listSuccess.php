<div class="options-list"><?php echo link_to('users', array('module' => 'user', 'action' => 'list')) ?><a class="active">groups</a></div>

<div class="pageTitle"><?php echo __('list groups'); ?></div>

<table class="list">
<thead>
<tr>
  <th>
    <?php echo __('group'); ?>
    <span class="th-link"><?php echo link_to(__('add new'), array('module' => 'aclGroup', 'action' => 'create')) ?></span>
  </th>
  <th><?php echo __('members'); ?></th>
</tr>
</thead>
<tbody>
<?php foreach ($pager->getResults() as $group): ?>
<tr>
  <td>
    <?php echo link_to($group->getName(array('cultureFallback' => true)), array('module' => 'aclGroup', 'action' => 'edit', 'id' => $group->id)) ?>
    <?php echo ($group->isProtected()) ? image_tag('lock_mini') : '' ?>
  </td>
  <td><?php echo count($group->getAclUserGroups()) ?></td>
</tr>
<?php endforeach; ?>
</tbody>
</table>

<?php if ($pager->haveToPaginate()): ?>
<div class="pager">
  <?php $links = $pager->getLinks(); ?>
  <?php if ($pager->getPage() != $pager->getFirstPage()): ?>
    <?php echo link_to('< '.__('previous'), array('module' => 'aclGroup', 'action' => 'list', 'page' => $pager->getPage()-1)) ?>
  <?php endif; ?>
  <?php foreach ($links as $page): ?>
    <?php if ($page == $pager->getPage()): ?>
      <strong><?php echo $page ?></strong>
    <?php else: ?>
      <?php echo link_to($page, array('module' => 'aclGroup', 'action' => 'list', 'page' => $page)) ?>
    <?php endif; ?>
    <?php if ($page != $pager->getCurrentMaxLink()): ?> <?php endif ?>
  <?php endforeach ?>
  <?php if ($pager->getPage() != $pager->getLastPage()): ?>
    <?php echo link_to(__('next').' >', array('module' => 'aclGroup', 'action' => 'list', 'page' => $pager->getPage()+1)) ?>
  <?php endif; ?>
</div>
<?php endif ?>

<div class="result-count">
<?php if (0 < $pager->getNbResults()): ?>
  <?php echo __('displaying %1% to %2% of %3% results', array('%1%' => $pager->getFirstIndice(), '%2%' => $pager->getLastIndice(), '%3%' => $pager->getNbResults())) ?>
<?php else: ?>
  <?php echo __('no results found') ?>
<?php endif; ?>
</div>
