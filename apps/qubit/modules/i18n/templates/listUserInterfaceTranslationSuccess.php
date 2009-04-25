<div class="pageTitle"><?php echo __('user interface translation'); ?></div>

<div class="translationList">


<div class="tableHeader" style="margin-bottom: 10px;"><?php echo __('%1% module', array('%1%' => sfConfig::get('app_ui_label_informationobject')))?></div>
    <ul>
    <li><?php echo link_to(__('create (ISAD)'), array('module' => 'informationobject', 'action' => 'create', 'informationobject_template' => 'isad')) ?></li>
    <?php if ($sf_user->getCulture() == 'fr'): ?>
      <li><?php echo link_to(__('create (RAD)'), array('module' => 'informationobject', 'action' => 'create', 'informationobject_template' => 'rad')) ?></li>
    <?php endif; ?>
    <?php if ($sampleInformationObject): ?>
      <li><?php echo link_to(__('edit (ISAD)'), 'informationobject/editIsad?id='.$sampleInformationObject->getId()) ?></li>
      <?php if ($sf_user->getCulture() == 'fr'): ?>
        <li><?php echo link_to(__('edit (RAD)'), 'informationobject/editRad?id='.$sampleInformationObject->getId()) ?></li>
      <?php endif; ?>
      <li><?php echo link_to(__('edit (Dublin Core)'), 'informationobject/editDc?id='.$sampleInformationObject->getId()) ?></li>
      <li><?php echo link_to(__('list'), 'informationobject/list') ?></li>
      <li><?php echo link_to(__('view (ISAD)'), 'informationobject/showIsad?id='.$sampleInformationObject->getId()) ?></li>
      <?php if ($sf_user->getCulture() == 'fr'): ?>
        <li><?php echo link_to(__('view (RAD)'), 'informationobject/showRad?id='.$sampleInformationObject->getId()) ?></li>
      <?php endif; ?>
    <?php endif; ?>
    <?php if ($sampleDigitalObject): ?>
      <li><?php echo link_to(__('view digital object'), 'digitalobject/show?id='.$sampleDigitalObject->getId()) ?></li>
      <li><?php echo link_to(__('view digital object master'), 'digitalobject/showFullScreen?id='.$sampleDigitalObject->getId()) ?></li>
    <?php endif; ?>
    <?php if ($samplePhysicalObject): ?>
      <li><?php echo link_to(__('edit physical storage'), 'physicalobject/edit?id='.$samplePhysicalObject->getId()) ?></li>
    <?php endif; ?>
    </ul>

<div class="tableHeader" style="margin-bottom: 10px;"><?php echo __('%1% module', array('%1%' => sfConfig::get('app_ui_label_actor')))?></div>
    <ul>
    <li><?php echo link_to(__('create (ISAAR)'), 'actor/createIsaar') ?></li>
    <?php if ($sampleActor): ?>
      <li><?php echo link_to(__('edit (ISAAR)'), 'actor/editIsaar?id='.$sampleActor->getId()) ?></li>
      <li><?php echo link_to(__('view (ISAAR)'), 'actor/showIsaar?id='.$sampleActor->getId()) ?></li>
    <?php endif; ?>
     <li><?php echo link_to(__('list'), 'actor/list') ?></li>
    </ul>

<div class="tableHeader" style="margin-bottom: 10px;"><?php echo __('%1% module', array('%1%' => sfConfig::get('app_ui_label_repository')))?></div>
    <ul>
    <li><?php echo link_to(__('create (ISDIAH)'), 'repository/createIsdiah') ?></li>
    <?php if ($sampleRepository): ?>
      <li><?php echo link_to(__('edit (ISDIAH)'), 'repository/editIsdiah?id='.$sampleRepository->getId()) ?></li>
      <?php if ($sampleContactInformation): ?>
        <li><?php echo link_to(__('edit contact information'), array('module' => 'actor', 'action' => 'editContactInformation', 'id' => $sampleContactInformation->getId())) ?></li>
      <?php endif; ?>
      <li><?php echo link_to(__('view (ISDIAH)'), 'repository/show?id='.$sampleRepository->getId()) ?></li>
    <?php endif; ?>
    <li><?php echo link_to(__('list'), 'repository/list') ?></li>
    </ul>

<div class="tableHeader" style="margin-bottom: 10px;"><?php echo __('term module')?></div>
    <ul>
    <li><?php echo link_to(__('list'), 'term/list') ?></li>
    <?php if ($sampleTerm): ?>
      <li><?php echo link_to(__('edit'), 'term/edit?id='.$sampleTerm->getId()) ?></li>
    <?php endif; ?>
    </ul>

<div class="tableHeader" style="margin-bottom: 10px;"><?php echo __('search')?></div>
    <ul>
    <li><?php echo link_to(__('search results'), 'search/keyword?query=foo') ?></li>
    </ul>

<div class="tableHeader" style="margin-bottom: 10px;"><?php echo __('import/export module')?></div>
    <ul>
      <li><?php echo link_to(__('import/export'), 'object/importexport') ?></li>
    </ul>

<div class="tableHeader" style="margin-bottom: 10px;"><?php echo __('admin module')?></div>
    <ul>
    <li><?php echo __('users')?></li>
      <ul>
      <li><?php echo link_to(__('login'), array('module' => 'user', 'action' => 'login')) ?></li>
      <li><?php echo link_to(__('view user profile'), array('module' => 'user', 'action' => 'show', 'id' => $sf_user->getUserID())) ?></li>
      <li><?php echo link_to(__('edit user profile'), array('module' => 'user', 'action' => 'edit', 'id' => $sf_user->getUserID())) ?></li>
      <li><?php echo link_to(__('reset password'), array('module' => 'user', 'action' => 'passwordEdit', 'id' => $sf_user->getUserID())) ?> <?php echo __(' (warning: this form is active, click \'cancel\' after translating)') ?></li>
      </ul>
    <li><?php echo __('static pages')?></li>
      <ul>
      <li><?php echo link_to(__('list static page'), array('module' => 'staticpage', 'action' => 'list')) ?></li>
      <?php if ($sampleStaticPage): ?>
        <li><?php echo link_to(__('edit static page'), array('module' => 'staticpage', 'action' => 'edit', 'id' => $sampleStaticPage->getId())) ?></li>
      <?php endif; ?>
      <li><?php echo link_to(__('view static page'), array('module' => 'staticpage', 'action' => 'static', 'permalink' => $sampleStaticPage->getPermalink())) ?></li>
    </ul>
    <li><?php echo __('settings')?></li>
    <ul>
      <li><?php echo link_to(__('site settings'), 'settings/list') ?></li>
    </ul>
    <li><?php echo __('menu')?></li>
    <ul>
      <li><?php echo link_to(__('edit menu'), array('module' => 'menu', 'action' => 'edit', 'id' => $sampleMenu->getId())) ?></li>
      <li><?php echo link_to(__('site menu list'), 'menu/list') ?></li>
    </ul>
    <li><?php echo __('error messages')?></li>
    <ul>
      <li><?php echo link_to(__('not found message'), 'admin/error404') ?></li>
      <li><?php echo link_to(__('permission message'), 'admin/secure') ?></li>
      <li><?php echo link_to(__('locked term message'), 'admin/termPermission') ?></li>
      <li><?php echo link_to(__('translation permission'), 'admin/translatePermission') ?></li>
    </ul>
    </ul>

<div class="tableHeader" style="margin-bottom: 10px;"><?php echo __('internationalization module')?></div>
    <ul>
    <li><?php echo link_to(__('user interface translation list'), 'i18n/listUserInterfaceTranslation') ?> <?php echo ' ('.__('this page').')' ?></li>
    <li><?php echo link_to(__('default content translation list'), 'i18n/listDefaultContentTranslation') ?></li>
    <li><?php echo link_to(__('new content translation'), 'i18n/listNewContentTranslation') ?></li>
    </ul>
</div>