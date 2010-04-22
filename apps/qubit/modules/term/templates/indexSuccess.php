<h1><?php echo __('View term') ?></h1>

<?php echo link_to_if(QubitAcl::check($term, 'update'), '<h1 class="label">'.render_title($term).'</h1>', array($term, 'module' => 'term', 'action' => 'edit'), array('title' => __('Edit term'))) ?>

<?php echo render_show(__('Taxonomy'), $term->taxonomy) ?>

<?php echo render_show(__('Code'), $term->code) ?>

<div class="field">
  <h3><?php echo __('Scope note(s)') ?></h3>
  <div>
    <ul>
      <?php foreach ($scopeNotes as $scopeNote): ?>
        <li><?php echo $scopeNote->getContent(array('cultureFallback' => true)) ?></li>
      <?php endforeach; ?>
    </ul>
  </div>
</div>

<div class="field">
  <h3><?php echo __('Source note(s)') ?></h3>
  <div>
    <ul>
      <?php foreach ($sourceNotes as $sourceNote): ?>
        <li><?php echo $sourceNote->getContent(array('cultureFallback' => true)) ?></li>
      <?php endforeach; ?>
    </ul>
  </div>
</div>

<div class="field">
  <h3><?php echo __('Display note(s)') ?></h3>
  <div>
    <ul>
      <?php foreach ($displayNotes as $displayNote): ?>
        <li><?php echo $displayNote->getContent(array('cultureFallback' => true)) ?></li>
      <?php endforeach; ?>
    </ul>
  </div>
</div>

<div class="field">
  <h3><?php echo __('Hierarchical terms') ?></h3>
  <div>

    <?php if (QubitTerm::ROOT_ID != $term->parent->id): ?>
      <dl>
        <dt>
          <?php echo render_title($term) ?>
        </dt><dd>
          <?php echo __('BT %1%', array('%1%' => link_to(render_title($term->parent), array($term->parent, 'module' => 'term')))) ?>
        </dd>
      </dl>
    <?php endif; ?>

    <?php if (0 < count($children)): ?>
      <dl>
        <dt>
          <?php echo render_title($term) ?>
        </dt>
        <?php foreach ($children as $item): ?>
          <dd>
            <?php echo __('NT %1%', array('%1%' => link_to(render_title($item), array($item, 'module' => 'term')))) ?>
          </dd>
        <?php endforeach; ?>
      </dl>
    <?php endif; ?>

  </div>
</div>

<div class="field">
  <h3><?php echo __('Equivalent terms') ?></h3>
  <div>

    <?php if (0 < count($useFors)): ?>
      <dl>
        <dt>
          <?php echo render_title($term) ?>
        </dt>
        <?php foreach ($useFors as $useFor): ?>
          <dd>
            <?php echo __('UF %1%', array('%1%' => link_to(render_title($useFor->object), array($useFor->object, 'module' => 'term')))) ?>
          </dd>
        <?php endforeach; ?>
      </dl>
    <?php endif; ?>

    <?php if (0 < count($uses)): ?>
      <dl>
        <?php foreach ($uses as $use): ?>
          <dt>
            <?php echo render_title($term) ?>
          </dt><dd>
            <?php echo __('USE %1%', array('%1%' => link_to(render_title($use->subject), array($use->subject, 'module' => 'term')))) ?>
          </dd>
        <?php endforeach; ?>
      </dl>
    <?php endif; ?>

  </div>
</div>

<div class="field">
  <h3><?php echo __('Associated terms') ?></h3>
  <div>
    <?php if (0 < count($associateRelations)): ?>
    <dl>
      <dt>
        <?php echo render_title($term) ?>
      </dt>
      <?php foreach ($associateRelations as $associateRelation): ?>
        <dd>
          <?php echo __('RT %1%', array('%1%' => link_to(render_title($associateRelation->getOpposedObject($term->id)), array($associateRelation->getOpposedObject($term->id), 'module' => 'term')))) ?>
        </dd>
      <?php endforeach; ?>
    </dl>
    <?php endif; ?>
  </div>
</div>

<div class="actions section">

  <h2 class="element-invisible"><?php echo __('Actions') ?></h2>

  <div class="content">
    <ul class="clearfix links">

      <?php if (1 > count($uses) && (QubitAcl::check($term, 'update') || QubitAcl::check($term, 'translate'))): ?>
        <li><?php echo link_to (__('Edit'), array($term, 'module' => 'term', 'action' => 'edit')) ?></li>
      <?php endif; ?>

      <?php if (QubitAcl::check($term, 'delete') && !$term->isProtected()): ?>
        <li><?php echo link_to (__('Delete'), array($term, 'module' => 'term', 'action' => 'delete')) ?></li>
      <?php endif; ?>

      <?php if (QubitAcl::check($term->taxonomy, 'createTerm')): ?>
        <li><?php echo link_to(__('Add new'), array('module' => 'term', 'action' => 'create', 'taxonomyId' => $term->getTaxonomy()->id)) ?></li>
      <?php endif; ?>

      <li><?php echo link_to(__('List all'), array($term->taxonomy, 'module' => 'term', 'action' => 'listTaxonomy')) ?></li>

    </ul>
  </div>

</div>
