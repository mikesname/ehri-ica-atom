<?php use_helper('Javascript') ?>
<?php $sf_response->addJavaScript('/vendor/yui/animation/animation-min') ?>
<?php $sf_response->addJavaScript('/vendor/yui/dragdrop/dragdrop-min') ?>
<?php $sf_response->addJavaScript('/vendor/yui/connection/connection-min') ?>
<?php $sf_response->addJavaScript('/vendor/yui/container/container-min') ?>
<?php $sf_response->addJavaScript('/js/qubit') ?>
<?php $sf_response->addJavaScript('/js/actorEventDialog'); ?>
<?php $sf_response->addStylesheet('/vendor/yui/container/assets/skins/sam/container') ?>

<!-- Use a hidden image so we can grab the path in newActorEventDialog js -->
<?php echo image_tag('delete', array('id' => 'imagesDeletePng', 'style' => 'display: none')) ?>
<?php echo image_tag('pencil', array('id' => 'imagesPencilPng', 'style' => 'display: none')) ?>

<script language="javascript">
//<!CDATA[
  /*
   * Dynamically write form elements specific to the newActorEventDialog YUI
   * Dialog object, so we don't see them when Javascript is turned off. Include
   * them here (instead of in .js file) to allow PHP to parse i18n tags. 
   */
 
  // Make Qubit variables available to javascript
  Qubit.labels = ({"unknown": "<?php echo __('unknown') ?>"});
  Qubit.paths = ({"eventShow": "<?php echo url_for('event/show') ?>"});

  // Do this after newActorEventDialog.js actions
  Drupal.behaviors.writeNewActorEventHTML = {
    attach: function(context) 
      {
        // Create YUI container for form
        $('body').prepend(
          '<div class="yui-skin-sam">' +
            '<div id="actorEventDialog">' +
              '<div class="hd"><?php echo __('new event') ?></div>' + 
              '<div class="bd">' +
                '<form action="" method="POST" style="border: none">' +
                '</form>' +
              '</div>' +
            '</div>' +
          '</div>'
        );

        // build the dialog
        renderActorEventDialog();

        // Write a link to show the dialog
        $("table#actorEvents").append('<tr id="addActorEventLink"><td colspan="4"><a href="javascript:Qubit.actorEventDialog.show()"><?php echo __('add new') ?></a></td></tr>');
        
        // Add links for editing existing events
        var actorEventRows = $('table#actorEvents tr').filter(function() { return this.id.substr(0,10) == 'actorEvent' });
        actorEventRows.each(function() {
          var thisId = this.id.replace(/actorEvent_(\d+)/, '$1');
          var editLink = '<a href="javascript:editActorEventDialog(\''+thisId+'\')"><img src="'+$('img#imagesPencilPng').attr('src')+'" align="top" /></a>&nbsp;';
          $(this).find('button.delete-small').before(editLink);
        });
        
        // Initialize actorEvents data store
        $('body').data('actorEvents', new Array());
        $('body').data('deleteEvents', new Array());
        
        // Attach the appendHiddenFormFields() action to the submit form
        $('form#editForm').submit(function() {
          appendHiddenFormFields($(this));
          return true;
        });
      } };
//]]>
</script>
