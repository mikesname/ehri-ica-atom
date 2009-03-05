<?php use_helper('Javascript') ?>
<?php $sf_response->addJavaScript('/vendor/yui/yahoo-dom-event/yahoo-dom-event') ?>
<?php $sf_response->addJavaScript('/vendor/yui/animation/animation-min') ?>
<?php $sf_response->addJavaScript('/vendor/yui/dragdrop/dragdrop-min') ?>
<?php $sf_response->addJavaScript('/vendor/yui/connection/connection-min') ?>
<?php $sf_response->addJavaScript('/vendor/yui/container/container-min') ?>
<?php $sf_response->addJavaScript('/js/qubit') ?>
<?php $sf_response->addJavaScript('/js/newActorEventDialog'); ?>
<?php $sf_response->addStylesheet('/vendor/yui/container/assets/skins/sam/container') ?>

<!-- Use a hidden image so we can grab the path in newActorEventDialog js -->
<?php echo image_tag('delete', array('id' => 'imagesDeletePng', 'style' => 'display: none')) ?>

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
            '<div id="newActorEventDialog">' +
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
        $("table#actorEvents").append('<tr id="addActorEventLink"><td colspan="4"><a href="javascript:Qubit.newActorEventDialog.show()"><?php echo __('add new') ?></a></td></tr>');
      } };
//]]>
</script>
