<div class="pageTitle"><?php echo __('list users'); ?></div>

<table class="list">
<thead>
<tr>
  <th><?php echo __('user name'); ?> <span class="th-link"><?php echo link_to(__('add new'), 'user/create') ?></span></th>
  <th><?php echo __('email'); ?></th>
  <th><?php echo __('user roles'); ?></th>
</tr>
</thead>
<tbody>
<?php foreach ($users->getResults() as $user): ?>
<tr>
      <td><?php echo link_to($user->getUsername(), 'user/edit?id='.$user->getId()) ?></td>
      <td><?php echo $user->getEmail() ?></td>
      <td><?php foreach ($user->getRoles() as $role): ?>
            <?php echo $role ?><br />
          <?php endforeach; ?>
      </td>
</tr>
<?php endforeach; ?>
</tbody>
</table>

<?php if ($users->haveToPaginate()): ?>
<div class="pager">
  <?php $links = $users->getLinks(); ?>
  <?php if ($users->getPage() != $users->getFirstPage()): ?>
 <?php echo link_to('< '.__('previous'), 'user/list?page='.($users->getPage()-1)) ?>
  <?php endif; ?>
  <?php foreach ($links as $page): ?>
    <?php echo ($page == $users->getPage()) ? '<strong>'.$page.'</strong>' : link_to($page, 'user/list?page='.$page) ?>
    <?php if ($page != $users->getCurrentMaxLink()): ?> <?php endif ?>
  <?php endforeach ?>
  <?php if ($users->getPage() != $users->getLastPage()): ?>
 <?php echo link_to(__('next').' >', 'user/list?page='.($users->getPage()+1)) ?>
  <?php endif; ?>
</div>
<?php endif ?>

<div class="result-count">
<?php echo __('displaying %1% to %2% of %3% results', array('%1%' => $users->getFirstIndice(), '%2%' => $users->getLastIndice(), '%3%' => $users->getNbResults())) ?>
</div>

<div class="menu-action" style="padding-top: 10px;">
<?php echo link_to (__('add new user'), 'user/create') ?>
</div>
