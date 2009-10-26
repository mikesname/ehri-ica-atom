<?php use_helper('Javascript') ?>
<?php $sf_response->addJavaScript('/vendor/yui/animation/animation-min') ?>
<?php $sf_response->addJavaScript('/vendor/yui/dragdrop/dragdrop-min') ?>
<?php $sf_response->addJavaScript('/vendor/yui/connection/connection-min') ?>
<?php $sf_response->addJavaScript('/vendor/yui/container/container-debug') ?>
<?php $sf_response->addJavaScript('qubit') ?>
<?php $sf_response->addJavaScript('eventDialog'); ?>
<?php $sf_response->addStylesheet('/vendor/yui/container/assets/skins/sam/container') ?>

<!-- Use a hidden image so we can grab the path in eventDialog js -->
<?php echo image_tag('delete', array('id' => 'imagesDeletePng', 'style' => 'display: none')) ?>
<?php echo image_tag('pencil', array('id' => 'imagesPencilPng', 'style' => 'display: none')) ?>

<script language="javascript">
//<!CDATA[
  /*
   * Dynamically write form elements specific to the eventDialog YUI
   * Dialog object, so we don't see them when Javascript is turned off. Include
   * them here (instead of in .js file) to allow PHP to parse i18n tags. 
   */
  Qubit.labels = Qubit.labels || {};
  Qubit.paths  = Qubit.paths || {};
  Qubit.vars   = Qubit.vars || {};

  // Make Qubit variables available to javascript
  Qubit.labels.unknown = "<?php echo __('unknown') ?>";
  Qubit.paths.eventShow = "<?php echo url_for('event/show') ?>";

  // Do this after eventDialog.js actions
  Drupal.behaviors.writeEventDialogDiv = {
    attach: function(context) 
      {
        // Create YUI container for form
        $('body').prepend(
          '<div class="yui-skin-sam">' +
            '<div id="eventDialog">' +
              '<div class="hd"><?php echo __('Edit event') ?></div>' + 
              '<div class="bd">' +
                '<form action="" method="POST" style="border: none">' +
                '</form>' +
              '</div>' +
            '</div>' +
          '</div>'
        );

        // build the dialog
        renderIsaarEventDialog();

        // Write a link to show the dialog
        $("table#relatedEvents").append('<tr id="addEventLink"><td colspan="4"><a href="javascript:Qubit.eventDialog.show()"><?php echo __('add new') ?></a></td></tr>');
        
        // Add links for editing existing events
        var relatedEventRows = $('table#relatedEvents tr').filter(function() { return this.id.substr(0,5) == 'event' });
        relatedEventRows.each(function() {
          var thisId = this.id.replace(/event_(\d+)/, '$1');
          var editLink = '<a href="javascript:editIsaarEventDialog(\''+thisId+'\')"><img src="'+$('img#imagesPencilPng').attr('src')+'" align="top" /></a>&nbsp;';
          $(this).find('button.delete-small').before(editLink);
        });
        
        // Initialize event data stores
        $('body').data('cachedEvents', new Array());
        $('body').data('deleteEvents', new Array());
        
        // Attach the appendHiddenRelationFormFields() action to the submit form
        $('form#editForm').submit(function() {
          appendHiddenEventFormFields($(this));
          return true;
        });
      } };
//]]>
</script>
