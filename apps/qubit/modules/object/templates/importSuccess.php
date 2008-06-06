<h1>Object Successfully Imported</h1>

<?php if (!empty($errors)): ?>
	<br/>
	<h3>Warnings were encountered:</h3>
		<?php foreach ($errors as $error): ?>
			<p class="form_error"><?php echo $error ?></p>
		<?php endforeach; ?>
<?php endif; ?>

<div class="menu-action">
	<?php echo link_to (__('edit %1%', array('%1%' => sfConfig::get('app_ui_label_'.strtolower($objectType)))), strtolower($objectType).'/edit?id='.$BaseObject->getId()) ?>
</div>
