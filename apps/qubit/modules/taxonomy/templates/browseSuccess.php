<h1><?php echo __('Browse %1%', array('%1%' => render_title($resource))) ?></h1>

<table class="sticky-enabled">
  <thead>
    <tr>
      <th>
        <?php if ('termNameUp' == $sf_request->sort): ?>
          <?php echo link_to(render_title($resource), array('sort' => 'termNameDown') + $sf_request->getParameterHolder()->getAll(), array('title' => __('Sort'))) ?>
          <?php echo image_tag('up.gif') ?>
        <?php else: ?>

          <?php echo link_to(render_title($resource), array('sort' => 'termNameUp') + $sf_request->getParameterHolder()->getAll(), array('title' => __('Sort'))) ?>

          <?php if ('termNameDown' == $sf_request->sort): ?>
            <?php echo image_tag('down.gif') ?>
          <?php endif; ?>

        <?php endif; ?>
      </th><th>
        <?php if ($sf_request->sort == 'hitsDown'): ?>
          <?php echo link_to(__('Results'), array('sort' => 'hitsUp') + $sf_request->getParameterHolder()->getAll(), array('title' => __('Sort'))) ?>
          <?php echo image_tag('down.gif') ?>
        <?php else: ?>

          <?php echo link_to(__('Results'), array('sort' => 'hitsDown') + $sf_request->getParameterHolder()->getAll(), array('title' => __('Sort'))) ?>

          <?php if ($sf_request->sort == 'hitsUp'): ?>
            <?php echo image_tag('up.gif') ?>
          <?php endif; ?>

        <?php endif; ?>
      </th>
    </tr>
  </thead><tbody>
    <?php foreach ($terms as $item): ?>
      <tr class="<?php echo 0 == ++$row % 2 ? 'even' : 'odd' ?>">
        <td>
          <?php echo link_to(render_title($item), array($item, 'module' => 'term', 'action' => 'browseTerm')) ?>
        </td><td>
          <?php echo $item->countRelatedInformationObjects() ?>
        </td>
      </tr>
    <?php endforeach; ?>
  </tbody>
</table>

<?php echo get_partial('default/pager', array('pager' => $pager)) ?>

<div class="actions section">

  <h2 class="element-invisible"><?php echo __('Actions') ?></h2>

  <div class="content">
    <ul class="clearfix links">
      <?php if (QubitAcl::check($resource, array('edit', 'createTerm'))): ?>
        <li><?php echo link_to(__('Add new'), array('module' => 'term', 'action' => 'add', 'taxonomy' => url_for(array($resource, 'module' => 'taxonomy')))) ?></li>
      <?php endif; ?>
    </ul>
  </div>

</div>
