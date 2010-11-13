<div class="pageTitle"><?php echo __('User interface translation'); ?></div>

<div class="translationList">

<div class="tableHeader" style="margin-bottom: 10px;"><?php echo __('%1% module', array('%1%' => sfConfig::get('app_ui_label_informationobject')))?></div>
    <ul>
    <li><?php echo link_to(__('Create (ISAD)'), array('module' => 'informationobject', 'action' => 'add', 'informationobject_template' => 'isad')) ?></li>
    <?php if ($sf_user->getCulture() == 'fr'): ?>
      <li><?php echo link_to(__('Create (RAD)'), array('module' => 'informationobject', 'action' => 'add', 'informationobject_template' => 'rad')) ?></li>
    <?php endif; ?>
    <?php if ($sampleInformationObject): ?>
      <li><?php echo link_to(__('Edit (ISAD)'), 'informationobject/editIsad?id='.$sampleInformationObject->id) ?></li>
      <?php if ($sf_user->getCulture() == 'fr'): ?>
        <li><?php echo link_to(__('Edit (RAD)'), 'informationobject/editRad?id='.$sampleInformationObject->id) ?></li>
      <?php endif; ?>
      <li><?php echo link_to(__('Edit (Dublin Core)'), 'informationobject/editDc?id='.$sampleInformationObject->id) ?></li>
      <li><?php echo link_to(__('List'), 'informationobject/list') ?></li>
      <li><?php echo link_to(__('View (ISAD)'), 'informationobject/showIsad?id='.$sampleInformationObject->id) ?></li>
      <?php if ($sf_user->getCulture() == 'fr'): ?>
        <li><?php echo link_to(__('View (RAD)'), 'informationobject/showRad?id='.$sampleInformationObject->id) ?></li>
      <?php endif; ?>
    <?php endif; ?>
    <?php if ($sampleDigitalObject): ?>
      <li><?php echo link_to(__('View digital object'), 'digitalobject/show?id='.$sampleDigitalObject->id) ?></li>
      <li><?php echo link_to(__('View digital object master'), 'digitalobject/showFullScreen?id='.$sampleDigitalObject->id) ?></li>
    <?php endif; ?>
    <?php if ($samplePhysicalObject): ?>
      <li><?php echo link_to(__('Edit physical storage'), 'physicalobject/edit?id='.$samplePhysicalObject->id) ?></li>
    <?php endif; ?>
    </ul>

<div class="tableHeader" style="margin-bottom: 10px;"><?php echo __('%1% module', array('%1%' => sfConfig::get('app_ui_label_actor')))?></div>
    <ul>
    <li><?php echo link_to(__('Create (ISAAR)'), 'actor/createIsaar') ?></li>
    <?php if ($sampleActor): ?>
      <li><?php echo link_to(__('Edit (ISAAR)'), 'actor/editIsaar?id='.$sampleActor->id) ?></li>
      <li><?php echo link_to(__('View (ISAAR)'), 'actor/showIsaar?id='.$sampleActor->id) ?></li>
    <?php endif; ?>
     <li><?php echo link_to(__('List'), 'actor/list') ?></li>
    </ul>

<div class="tableHeader" style="margin-bottom: 10px;"><?php echo __('%1% module', array('%1%' => sfConfig::get('app_ui_label_repository')))?></div>
    <ul>
    <li><?php echo link_to(__('Create (ISDIAH)'), 'repository/createIsdiah') ?></li>
    <?php if ($sampleRepository): ?>
      <li><?php echo link_to(__('Edit (ISDIAH)'), 'repository/editIsdiah?id='.$sampleRepository->id) ?></li>
      <?php if ($sampleContactInformation): ?>
        <li><?php echo link_to(__('Edit contact information'), array('module' => 'actor', 'action' => 'editContactInformation', 'id' => $sampleContactInformation->id)) ?></li>
      <?php endif; ?>
      <li><?php echo link_to(__('View (ISDIAH)'), 'repository/show?id='.$sampleRepository->id) ?></li>
    <?php endif; ?>
    <li><?php echo link_to(__('List'), 'repository/list') ?></li>
    </ul>

<div class="tableHeader" style="margin-bottom: 10px;"><?php echo __('Term module')?></div>
    <ul>
    <li><?php echo link_to(__('List'), 'taxonomy/list') ?></li>
    <?php if ($sampleTerm): ?>
      <li><?php echo link_to(__('Edit'), 'term/edit?id='.$sampleTerm->id) ?></li>
    <?php endif; ?>
    </ul>

<div class="tableHeader" style="margin-bottom: 10px;"><?php echo __('Search')?></div>
    <ul>
    <li><?php echo link_to(__('Search results'), 'search/keyword?query=foo') ?></li>
    </ul>

<div class="tableHeader" style="margin-bottom: 10px;"><?php echo __('Import/export module')?></div>
    <ul>
      <li><?php echo link_to(__('Import/export'), 'object/importexport') ?></li>
    </ul>

<div class="tableHeader" style="margin-bottom: 10px;"><?php echo __('Admin module')?></div>
    <ul>
    <li><?php echo __('Users')?></li>
      <ul>
      <li><?php echo link_to(__('Login'), array('module' => 'user', 'action' => 'login')) ?></li>
      <li><?php echo link_to(__('View user profile'), array('module' => 'user', 'id' => $sf_user->getUserID())) ?></li>
      <li><?php echo link_to(__('Edit user profile'), array('module' => 'user', 'action' => 'edit', 'id' => $sf_user->getUserID())) ?></li>
      <li><?php echo link_to(__('Reset password'), array('module' => 'user', 'action' => 'passwordEdit', 'id' => $sf_user->getUserID())) ?> <?php echo __(' (warning: this form is active, click \'cancel\' after translating)') ?></li>
      </ul>
    <li><?php echo __('Static pages')?></li>
      <ul>
      <li><?php echo link_to(__('List static page'), array('module' => 'staticpage', 'action' => 'list')) ?></li>
      <?php if ($sampleStaticPage): ?>
        <li><?php echo link_to(__('Edit static page'), array('module' => 'staticpage', 'action' => 'edit', 'id' => $sampleStaticPage->id)) ?></li>
      <?php endif; ?>
      <li><?php echo link_to(__('View static page'), array('module' => 'staticpage', 'action' => 'static', 'permalink' => $sampleStaticPage->getPermalink())) ?></li>
    </ul>
    <li><?php echo __('Settings')?></li>
    <ul>
      <li><?php echo link_to(__('Site settings'), 'settings/list') ?></li>
    </ul>
    <li><?php echo __('Menu')?></li>
    <ul>
      <li><?php echo link_to(__('Edit menu'), array('module' => 'menu', 'action' => 'edit', 'id' => $sampleMenu->id)) ?></li>
      <li><?php echo link_to(__('Site menu list'), 'menu/list') ?></li>
    </ul>
    <li><?php echo __('Error messages')?></li>
    <ul>
      <li><?php echo link_to(__('Not found message'), 'admin/error404') ?></li>
      <li><?php echo link_to(__('Permission message'), 'admin/secure') ?></li>
      <li><?php echo link_to(__('Locked term message'), 'admin/termPermission') ?></li>
      <li><?php echo link_to(__('Translation permission'), 'admin/translatePermission') ?></li>
    </ul>
    </ul>

<div class="tableHeader" style="margin-bottom: 10px;"><?php echo __('Internationalization module')?></div>
    <ul>
    <li><?php echo link_to(__('User interface translation list'), 'i18n/listUserInterfaceTranslation') ?> <?php echo ' ('.__('This page').')' ?></li>
    <li><?php echo link_to(__('Default content translation list'), 'i18n/listDefaultContentTranslation') ?></li>
    <li><?php echo link_to(__('New content translation'), 'i18n/listNewContentTranslation') ?></li>
    </ul>
</div>
