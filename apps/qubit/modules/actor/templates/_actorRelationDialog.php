<?php use_helper('Javascript') ?>
<?php $sf_response->addJavaScript('/vendor/yui/animation/animation-min') ?>
<?php $sf_response->addJavaScript('/vendor/yui/dragdrop/dragdrop-min') ?>
<?php $sf_response->addJavaScript('/vendor/yui/connection/connection-min') ?>
<?php $sf_response->addJavaScript('/vendor/yui/container/container-min') ?>
<?php $sf_response->addJavaScript('/js/qubit') ?>
<?php $sf_response->addJavaScript('/js/actorRelationDialog'); ?>
<?php $sf_response->addStylesheet('/vendor/yui/container/assets/skins/sam/container') ?>

<!-- Use a hidden image so we can grab the path in newActorRelationDialog js -->
<?php echo image_tag('delete', array('id' => 'imagesDeletePng', 'style' => 'display: none')) ?>
<?php echo image_tag('pencil', array('id' => 'imagesPencilPng', 'style' => 'display: none')) ?>

<script language="javascript">
//<!CDATA[
  /*
   * Dynamically write form elements specific to the newActorRelationDialog YUI
   * Dialog object, so we don't see them when Javascript is turned off. Include
   * them here (instead of in .js file) to allow PHP to parse i18n tags. 
   */
  Qubit.labels = Qubit.labels || {};
  Qubit.paths  = Qubit.paths || {};
  Qubit.vars   = Qubit.vars || {};

  // Make Qubit variables available to javascript
  Qubit.paths.actorRelationShow = "<?php echo url_for('relation/showActorRelation') ?>";
  Qubit.vars.actorId = "<?php echo $sf_request->id ?>";

  // Do this after newActorRelationDialog.js actions
  Drupal.behaviors.writeNewActorRelationHTML = {
    attach: function(context) 
      {
        // Create YUI container for form
        $('body').prepend(
          '<div class="yui-skin-sam">' +
            '<div id="actorRelationDialog">' +
              '<div class="hd"><?php echo __('new relationship') ?></div>' + 
              '<div class="bd">' +
                '<form action="" method="POST" style="border: none">' +
                '</form>' +
              '</div>' +
            '</div>' +
          '</div>'
        );

        // build the dialog
        renderActorRelationDialog();

        // Write a link to show the dialog
        $("table#relatedEntities").append('<tr id="addActorRelationLink"><td colspan="5"><a href="javascript:Qubit.actorRelationDialog.show()"><?php echo __('add new') ?></a></td></tr>');
        
        // Add links for editing existing events
        var actorRelationRows = $('table#relatedEntities tr').filter(function() { return this.id.substr(0,13) == 'actorRelation' });
        actorRelationRows.each(function() {
          var thisId = this.id.replace(/actorRelation_(\d+)/, '$1');
          var editLink = '<a href="javascript:editActorRelationDialog(\''+thisId+'\', \''+Qubit.vars['actorId']+'\')"><img src="'+$('img#imagesPencilPng').attr('src')+'" align="top" /></a>&nbsp;';
          $(this).find('button.delete-small').before(editLink);
        });
        
        // Initialize actorRelations data store
        $('body').data('actorRelations', new Array());
        $('body').data('deleteRelations', new Array());
        
        // Attach the appendHiddenFormFields() action to the submit form
        $('form#editForm').submit(function() {
          appendHiddenRelationFormFields($(this));
          return true;
        });
      } };
//]]>
</script>
