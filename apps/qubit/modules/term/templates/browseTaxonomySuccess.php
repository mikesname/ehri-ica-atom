<h1><?php echo __('List %1%', array('%1%' => render_title($taxonomy))) ?></h1>

<table class="sticky-enabled">
  <thead>
    <tr>
      <th>

        <?php if ('termNameUp' == $sf_request->sort): ?>

          <?php echo link_to(render_title($taxonomy), array('sort' => 'termNameDown') + $sf_request->getParameterHolder()->getAll()) ?>
          <?php echo image_tag('up.gif', 'style="padding-bottom: 3px;"', 'sort up') ?>

        <?php else: ?>

          <?php echo link_to(render_title($taxonomy), array('sort' => 'termNameUp') + $sf_request->getParameterHolder()->getAll()) ?>

          <?php if ('termNameDown' == $sf_request->sort): ?>
            <?php echo image_tag('down.gif', 'style="padding-bottom: 3px;"', 'sort down') ?>
          <?php endif; ?>

        <?php endif; ?>

        <?php if (SecurityPriviliges::editCredentials($sf_user, 'term')): ?>
          <?php echo link_to(__('Add/edit'), array($taxonomy, 'module' => 'term', 'action' => 'listTaxonomy')) ?>
        <?php endif; ?>

      </th><th>
        <?php if ($sf_request->sort == 'hitsDown'): ?>

          <?php echo link_to(__('Results'), array('sort' => 'hitsUp') + $sf_request->getParameterHolder()->getAll()) ?>
          <?php echo image_tag('down.gif', 'style="padding-bottom: 3px;"', 'sort down') ?>

        <?php else: ?>

          <?php echo link_to(__('Results'), array('sort' => 'hitsDown') + $sf_request->getParameterHolder()->getAll()) ?>

          <?php if ($sf_request->sort == 'hitsUp'): ?>
            <?php echo image_tag('up.gif', 'style="padding-bottom: 3px;"', 'sort up') ?>
          <?php endif; ?>

        <?php endif; ?>
      </th>
    </tr>
  </thead><tbody>
    <?php foreach ($terms as $term): ?>
      <tr class="<?php echo 0 == ++$row % 2 ? 'even' : 'odd' ?>">
        <td>
          <?php echo link_to(render_title($term), array($term, 'module' => 'term', 'action' => 'browseTerm')) ?>
        </td><td>
          <?php echo $term->getObjectTermRelationCountByObjectClass('QubitInformationObject') ?>
        </td>
      </tr>
    <?php endforeach; ?>
  </tbody>
</table>

<?php echo get_partial('default/pager', array('pager' => $pager)) ?>
