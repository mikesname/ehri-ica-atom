<div class="section tabs">
  <h2 class="element-invisible"><?php echo __('Actor Browse Options') ?></h2>
  <div class="content">
    <ul class="clearfix links">
      <?php if (('updatedUp' == $sf_request->sort) || ('updatedDown' == $sf_request->sort)): ?>
      <li><?php echo link_to(__('Alphabetic'), array('sort' => 'nameUp') + $sf_request->getParameterHolder()->getAll()) ?></li> 
      <li class="active"><?php echo link_to(__('Recent updates'), array('sort' => 'updatedUp') + $sf_request->getParameterHolder()->getAll()) ?></li>
      <?php else: ?>
      <li class="active"><?php echo link_to(__('Alphabetic'), array('sort' => 'nameUp') + $sf_request->getParameterHolder()->getAll()) ?></li> 
      <li><?php echo link_to(__('Recent updates'), array('sort' => 'updatedDown') + $sf_request->getParameterHolder()->getAll()) ?></li>
      <?php endif; ?>
    </ul>
  </div>
</div>

<h1><?php echo __('Browse %1%', array('%1%' => sfConfig::get('app_ui_label_actor'))) ?></h1>

<table class="sticky-enabled">
  <thead>
    <tr>
      <th>
        <?php echo __('Name') ?>
        <?php if ('nameUp' == $sf_request->sort): ?>
          <?php echo link_to((image_tag('down.gif')), array('sort' => 'nameDown') + $sf_request->getParameterHolder()->getAll()) ?>
        <?php elseif ('nameDown' == $sf_request->sort): ?>
          <?php echo link_to((image_tag('up.gif')), array('sort' => 'nameUp') + $sf_request->getParameterHolder()->getAll()) ?>
        <?php else: ?>
          <?php echo link_to((image_tag('down.gif')), array('sort' => 'nameDown') + $sf_request->getParameterHolder()->getAll()) ?>
        <?php endif; ?>
      </th>
      <th>
      <?php if (('updatedUp' == $sf_request->sort) || ('updatedDown' == $sf_request->sort)): ?>
        <?php echo __('Updated') ?>
        <?php if ('updatedUp' == $sf_request->sort): ?>
          <?php echo link_to((image_tag('up.gif')), array('sort' => 'updatedDown') + $sf_request->getParameterHolder()->getAll()) ?>
        <?php elseif ('updatedDown' == $sf_request->sort): ?>
          <?php echo link_to((image_tag('down.gif')), array('sort' => 'updatedUp') + $sf_request->getParameterHolder()->getAll()) ?>
        <?php else: ?>
          <?php echo link_to((image_tag('up.gif')), array('sort' => 'updatedDown') + $sf_request->getParameterHolder()->getAll()) ?>
        <?php endif; ?>
      <?php else: ?>
        <?php echo __('Type') ?>
        <?php if ('typeDown' == $sf_request->sort): ?>
          <?php echo link_to((image_tag('up.gif')), array('sort' => 'typeUp') + $sf_request->getParameterHolder()->getAll()) ?>
        <?php else: ?>
          <?php echo link_to((image_tag('down.gif')), array('sort' => 'typeDown') + $sf_request->getParameterHolder()->getAll()) ?>
        <?php endif; ?>
      <?php endif; ?>
      </th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($pager->getResults() as $actor): ?>
      <tr class="<?php echo 0 == ++$row % 2 ? 'even' : 'odd' ?>">
      <td>
      <div>
        <?php echo link_to(render_title($actor), array($actor, 'module' => 'actor')) ?>
     </div>
     </td>
    <td>    
    <?php if (('updatedUp' == $sf_request->sort) || ('updatedDown' == $sf_request->sort)): ?>
      <?php echo $actor->updatedAt ?>
    <?php else: ?>
      <?php if ($actor->getEntityTypeId()): ?>
        <?php if (is_null($entityType = $actor->getEntityType()->getName())) $entityType = $actor->getEntityType()->getName(array('sourceCulture' => true)); echo $entityType; ?>
      <?php endif; ?>
    <?php endif; ?>
    </td>
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>

<?php echo get_partial('default/pager', array('pager' => $pager)) ?>

<div class="search">
  <form action="<?php echo url_for(array('module' => 'actor', 'action' => 'list')) ?>">
    <?php echo input_tag('query', $sf_request->query) ?>
    <?php echo submit_tag(__('Search %1%', array('%1%' => sfConfig::get('app_ui_label_actor')))) ?>
  </form>
</div>
