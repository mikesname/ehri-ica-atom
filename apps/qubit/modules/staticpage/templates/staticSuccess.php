<div class="pageTitle"></div>

<div class="staticPageContent">
<?php echo nl2br($staticpage->getPageContent()) ?>
</div>

<?php if ($editCredentials): ?>
      <div class="editLink">[ <?php echo link_to(__('edit').' '.__('this page'), 'staticpage/edit/?id='.$staticpage->getId()); ?> ]</div>
<?php endif; ?>
