<h1><?php echo __('List %1%', array('%1%' => render_title($taxonomy))) ?></h1>

<table class="sticky-enabled">
  <thead>
    <tr>
      <th>
        <?php echo __('%1% term', array('%1%' => render_title($taxonomy))) ?>
      </th><th>
        <?php echo __('Scope note') ?>
      </th>
    </tr>
  </thead><tbody>
    <?php foreach ($terms as $term): ?>
      <tr class="<?php echo 0 == ++$row % 2 ? 'even' : 'odd' ?>">
        <td>

          <?php echo link_to($term->getName(array('cultureFallback' => true)), array($term, 'module' => 'term')) ?>

          <?php if (0 < count($term->descendants)): ?>
            <span class="note2">(<?php echo count($term->descendants) ?>)</span>
          <?php endif; ?>

          <?php if ($term->isProtected()): ?>
            <?php echo image_tag('lock_mini') ?>
          <?php endif; ?>

        </td><td>
          <ul>
            <?php foreach ($term->getNotesByType(array('noteTypeId' => QubitTerm::SCOPE_NOTE_ID)) as $note): ?>
              <li><?php echo $note->getContent(array('cultureFallback' => 'true')) ?></li>
            <?php endforeach; ?>
          </ul>
        </td>
      </tr>
    <?php endforeach; ?>
  </tbody>
</table>

<?php echo get_partial('default/pager', array('pager' => $pager)) ?>

<?php if (QubitAcl::check(QubitTaxonomy::getRoot(), 'read')): ?>
  <div class="actions section">

    <h2 class="element-invisible"><?php echo __('Actions') ?></h2>

    <div class="content">
      <ul class="clearfix links">

        <?php if (QubitAcl::check($taxonomy, 'createTerm')): ?>
          <li><?php echo link_to(__('Add new'), array('module' => 'term', 'action' => 'create', 'taxonomyId' => $taxonomy->id)) ?></li>
        <?php endif; ?>

        <li><?php echo link_to(__('List all taxonomies'), array('module' => 'term', 'action' => 'list')) ?></li>

      </ul>
    </div>

  </div>
<?php endif; ?>
