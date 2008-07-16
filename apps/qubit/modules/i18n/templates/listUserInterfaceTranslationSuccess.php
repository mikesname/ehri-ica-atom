<div class="pageTitle"><?php echo __('user interface translation'); ?></div>

<div class="translationList">


<div class="tableHeader" style="margin-bottom: 10px;"><?php echo __('%1% module', array('%1%' => sfConfig::get('app_ui_label_informationobject')))?></div>
    <ul>
    <li><?php echo link_to(__('create (ISAD)'), 'informationobject/create') ?></li>
    <li><?php echo link_to(__('edit (ISAD)'), 'informationobject/edit?template=isad&id='.$sampleInformationObject->getId()) ?></li>
    <li><?php echo link_to(__('edit (Dublin Core)'), 'informationobject/edit?template=dublincore&id='.$sampleInformationObject->getId()) ?></li>
    <li><?php echo link_to(__('list'), 'informationobject/list') ?></li>
    <li><?php echo link_to(__('view (ISAD)'), 'informationobject/show?template=isad&id='.$sampleInformationObject->getId()) ?></li>
    <li><?php echo link_to(__('view digital object'), 'digitalobject/show?id='.$sampleDigitalObject->getId()) ?></li>
    <li><?php echo link_to(__('view digital object master'), 'digitalobject/showFullScreen?id='.$sampleDigitalObject->getId()) ?></li>
    <li><?php echo link_to(__('edit physical object'), 'physicalobject/edit?id='.$samplePhysicalObject->getId()) ?></li>
    </ul>

<div class="tableHeader" style="margin-bottom: 10px;"><?php echo __('%1% module', array('%1%' => sfConfig::get('app_ui_label_actor')))?></div>
    <ul>
    <li><?php echo link_to(__('edit (ISAAR)'), 'actor/edit?template=isaar&id='.$sampleActor->getId()) ?></li>
    <li><?php echo link_to(__('list'), 'actor/list') ?></li>
    <li><?php echo link_to(__('view (ISAAR)'), 'actor/show?template=isaar&id='.$sampleActor->getId()) ?></li>
    </ul>

<div class="tableHeader" style="margin-bottom: 10px;"><?php echo __('%1% module', array('%1%' => sfConfig::get('app_ui_label_repository')))?></div>
    <ul>
    <li><?php echo link_to(__('edit (ISDIAH)'), 'repository/edit?template=isiah&id='.$sampleRepository->getId()) ?></li>
    <li><?php echo link_to(__('edit contact information'), 'actor/editContactInformation?id='.$sampleRepository->getPrimaryContact()->getId()) ?></li>
    <li><?php echo link_to(__('list'), 'repository/list') ?></li>
    <li><?php echo link_to(__('view (ISDIAH)'), 'repository/show?template=isiah&id='.$sampleRepository->getId()) ?></li>
    </ul>

<div class="tableHeader" style="margin-bottom: 10px;"><?php echo __('term module')?></div>
    <ul>
    <li><?php echo link_to(__('list'), 'term/list') ?></li>
    <li><?php echo link_to(__('edit'), 'term/edit?id='.$sampleTerm->getId().'&taxonomyId=0') ?></li>
    </ul>

<div class="tableHeader" style="margin-bottom: 10px;"><?php echo __('admin module')?></div>
    <ul>
    <li><?php echo __('users')?></li>
      <ul>
      <li><?php echo link_to(__('login'), '/login/') ?></li>
      <li><?php echo link_to(__('view user profile'), 'user/show?id='.$sf_user->getUserID()) ?></li>
      <li><?php echo link_to(__('edit user profile'), 'user/edit?id='.$sf_user->getUserID()) ?></li>
      <li><?php echo link_to(__('reset password'), 'user/passwordEdit?id='.$sf_user->getUserID()) ?><?php echo __(' (warning: this form is active, click \'cancel\' after translating)') ?></li>
      </ul>
    <li><?php echo __('static pages')?></li>
      <ul>
      <li><?php echo link_to(__('list staticpage'), 'staticpage/list') ?></li>
      <li><?php echo link_to(__('edit staticpage'), 'staticpage/edit?id='.$sampleStaticPage->getId()) ?></li>
      <li><?php echo link_to(__('view staticpage'), '/homepage/') ?></li>
      </ul>
    <li><?php echo __('settings')?></li>
      <ul>
      <li><?php echo link_to(__('site settings'), 'settings/list') ?></li>
      </ul>
    <li><?php echo __('import/export')?></li>
      <ul>
      <li><?php echo link_to(__('import/export'), 'object/importexport') ?></li>
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
