<h1><?php echo __('View static page') ?></h1>

<h1 class="label"><?php echo render_title($staticPage) ?></h1>

<?php echo render_show(__('Title'), $staticPage->title) ?>

<?php echo render_show(__('Permalink'), $staticPage->permalink) ?>

<?php echo render_show(__('Content'), $staticPage->content) ?>

<div class="actions section">
  <h2 class="element-invisible"><?php echo __('Actions') ?></h2>
  <div class="content">
    <ul class="clearfix links">
      <li><?php echo link_to(__('Edit'), array($staticPage, 'module' => 'staticpage', 'action' => 'edit')) ?></li>
      <li><?php echo link_to(__('List all'), array('module' => 'staticpage', 'action' => 'list')) ?></li>
    </ul>
  </div>
</div>
