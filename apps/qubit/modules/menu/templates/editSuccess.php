<div class="pageTitle"><?php echo __('%1% menu', array('%1%' => $formAction)) ?></div>

<?php if($menuForm->hasGlobalErrors()): ?>
<div>
  <?php echo $menuForm->renderGlobalErrors() ?>
</div>
<?php endif; ?>

<form action="<?php echo url_for('menu/'.$formAction) ?>" method="POST">
  <input type="hidden" name="id" value="<?php echo $menu->getId() ?>">
  <input type="hidden" name="page" value="<?php echo $page ?>">
  <table class="detail">
    <thead>
      <tr>
        <td colspan="2" class="headerCell">
        <?php if ($formAction == 'edit'): ?>
          <?php echo __('"%1%" menu', array('%1%' => $menu->getName(array('sourceCulture' => true)))) ?>
          <?php if ($menu->isProtected()): ?>
            <?php echo image_tag('lock', array('alt' => __('protected'))) ?>
          <?php endif; ?>
        <?php else: ?>
          <?php echo __('New menu') ?>
        <?php endif; ?>
        </td>
      </tr>
    </thead>
    <tbody>
      
      <tr>
        <th>
          <?php echo $menuForm['name']->renderLabel(null, 
            array('title' => __('The name of this menu. The menu name is used internally and is not visible to users.'), 'class' => 'required_field')) ?>
        </th>
        <td>
          <?php if (strlen($error = $menuForm['name']->renderError())): ?>
            <?php echo $error ?>
          <?php endif; ?>
          <?php echo $menuForm['name']->render() ?>
        </td>
      </tr>

      <tr>
        <th>
          <?php echo $menuForm['label']->renderLabel(null, 
            array('title' => __('This is the button or link label that users see.  For menu items that are not visible (i.e. are organizational only) this should be left blank.'))) ?>
        </th>
        <td>
          <?php if (strlen($error = $menuForm['label']->renderError())): ?>
            <?php echo $error ?>
          <?php elseif (strlen($sourceCultureValue = $menu->getLabel(array('sourceCulture' => true))) > 0 && $culture != $menu->getSourceCulture()): ?>
            <div class="default-translation" title="<?php echo __('source text') ?>"><?php echo nl2br($sourceCultureValue) ?></div>
          <?php endif; ?>
          <?php echo $menuForm['label']->render() ?>
        </td>
      </tr>

      <tr>
        <th>
          <?php echo $menuForm['path']->renderLabel(null, 
            array('title' => __('This can be an external URL (starts with http(s)://) or an internal, symfony path (e.g. module/action).'))) ?>
        </th>
        <td>
          <?php if (strlen($error = $menuForm['path']->renderError())): ?>
            <?php echo $error ?>
          <?php endif; ?>
          <span class="description">
            <?php echo 'http'.($sf_request->isSecure() ? 's' : '').'://'.$sf_request->getHost().$sf_request->getRelativeUrlRoot().'/...' ?>
          </span>
          <?php echo $menuForm['path']->render() ?>
        </td>
      </tr>
      
      <tr>
        <th>
          <?php echo $menuForm['description']->renderLabel(null, 
            array('title' => __('A brief description of the menu and it\'s purpose.'))) ?>
        </th>
        <td>
          <?php if (strlen($error = $menuForm['description']->renderError())): ?>
            <?php echo $error ?>
          <?php elseif (strlen($sourceCultureValue = $menu->getDescription(array('sourceCulture' => true))) > 0 && $culture != $menu->getSourceCulture()): ?>
            <div class="default-translation" title="<?php echo __('source text') ?>"><?php echo nl2br($sourceCultureValue) ?></div>
          <?php endif; ?>
          <?php echo $menuForm['description']->render() ?>
        </td>
      </tr>
      
      <tr>
        <th>
          <?php echo $menuForm['parentId']->renderLabel(null, 
            array('title' => __('Move before'))) ?>
        </th>
        <td>
          <?php if (strlen($error = $menuForm['parentId']->renderError())): ?>
            <?php echo $error ?>
          <?php endif;  ?>
          <?php echo $menuForm['parentId']->render() ?>
        </td>
      </tr>
    </tbody>
    <tfoot>
      <tr><td colspan="2"><?php echo __('* This field is required.') ?></td></tr>
    </tfoot>
  </table>
    
  <!-- include empty div at bottom of form to bump the fixed button-block and allow user to scroll past it -->
  <div id="button-block-bump"></div>
  
  <div id="button-block">
    <div class="menu-action">
      <?php if (!$menu->isProtected()): ?>
      &nbsp;<?php echo link_to(__('delete'), 'menu/delete?id='.$menu->getId(), 'post=true&confirm='.__('this action will delete this menu and all it\'s descendants. Are you sure?')) ?>
      <?php endif; ?>
      &nbsp;<?php echo link_to(__('cancel'), 'menu/list?page='.$page) ?>
      <?php echo submit_tag(__('save'), array('class' => 'form-submit')) ?>
    </div>

    <div class="menu-extra">
      <?php echo link_to(__('add new'), 'menu/create'); ?>
      <?php echo link_to(__('list all'), 'menu/list?page='.$page); ?>
    </div>
  </div>
</form>