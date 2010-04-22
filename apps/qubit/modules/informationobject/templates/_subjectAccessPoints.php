<div class="field">
  <h3><?php echo __('Subject access points') ?></h3>
  <div>
    <ul>
      <?php foreach ($informationObject->getSubjectAccessPoints() as $subject): ?>
        <li><?php echo link_to($subject->term, array($subject->term, 'module' => 'term', 'action' => 'browseTerm')) ?></li>
      <?php endforeach; ?>
    </ul>
  </div>
</div>
