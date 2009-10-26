<?php use_helper('Javascript') ?>
<?php $sf_response->addJavaScript('/vendor/yui/animation/animation-min') ?>
<?php $sf_response->addJavaScript('/vendor/yui/dragdrop/dragdrop-min') ?>
<?php $sf_response->addJavaScript('/vendor/yui/connection/connection-min') ?>
<?php $sf_response->addJavaScript('/vendor/yui/container/container-min') ?>
<?php $sf_response->addJavaScript('/js/qubit') ?>
<?php $sf_response->addJavaScript('/js/eventDialog'); ?>
<?php $sf_response->addStylesheet('/vendor/yui/container/assets/skins/sam/container') ?>

<!-- Use a hidden image so we can grab the path in eventDialog js -->
<?php echo image_tag('delete', array('id' => 'imagesDeletePng', 'style' => 'display: none')) ?>
<?php echo image_tag('pencil', array('id' => 'imagesPencilPng', 'style' => 'display: none')) ?>

<?php
 /**
  * The newEvent table is moved from the main form body to the a custom div by
  * the javascript below.  This is necessary to prevent problems with nested forms
  */
?>
    <table id="newEvent" class="inline">
      <caption><?php echo __('new event') ?></caption>
      <tr>
        <td colspan="3" class="headerCell" style="width: 55%;"><?php echo __('actor name') ?></td>
      </tr>
      <tr>
        <td colspan="3" class="noline">
          <select id="newEventActor" name="newEvent[actor]" class="form-autocomplete" />
          <input class="list" type="hidden" value="<?php echo url_for(array('module' => 'actor', 'action' => 'autocomplete')) ?>"/>
        </td>
      </tr>
      <tr>
        <td colspan="2" class="headerCell" style="width: 55%;"><?php echo __('event type') ?></td><td class="headerCell" style="width: 40%;"><?php echo __('place') ?></td>
      </tr>
      <tr>
        <td colspan="2" class="noline"><?php echo select_tag('newEvent[typeId]', options_for_select($eventTypes, $defaultEventType))?></td>
        <td class="noline">
          <select id="newEventPlace" name="newEvent[place]" class="form-autocomplete" />
          <input class="list" type="hidden" value="<?php echo url_for(array('module' => 'term', 'action' => 'autocomplete', 'taxonomyId' => '12')) ?>"/>
        </td>
      </tr>
      <tr>
        <td class="headerCell"><?php echo __('date') ?></td><td class="headerCell"><?php echo __('end date') ?></td>
        <td class="headerCell"><?php echo __('date display (defaults to date range)') ?></td></tr>
      <tr>
        <td class="noline"><?php echo input_tag('newEvent[startDate]', null, '') ?></td>
        <td class="noline"><?php echo input_tag('newEvent[endDate]', null, '') ?></td>
        <td class="noline"><?php echo input_tag('newEvent[dateDisplay]') ?></td>
      </tr>
      <tr>
        <td colspan="3" class="headerCell"><?php echo __('note') ?></td>
      </tr>
      <tr>
        <td colspan="3" class="noline"><?php echo input_tag('newEvent[description]') ?></td>
      </tr>
    </table>

<script language="javascript">
//<!CDATA[
  /*
   * Dynamically write form elements specific to the eventDialog YUI
   * Dialog object, so we don't see them when Javascript is turned off. Include
   * them here (instead of in .js file) to allow PHP to parse i18n tags.
   */

  // Make Qubit variables available to javascript
  Qubit.labels = ({"unknown": "<?php echo __('unknown') ?>"});
  Qubit.paths = ({"eventShow": "<?php echo url_for('event/show') ?>"});

  // Do this after eventDialog.js actions
  Drupal.behaviors.writeNewActorEventHTML = {
    attach: function(context)
      {
        // Create YUI container for form
        $('body').prepend(
          '<div class="yui-skin-sam">' +
            '<div id="eventDialog">' +
              '<div class="hd"><?php echo __('new event') ?></div>' +
              '<div class="bd">' +
                '<form action="" method="POST" style="border: none">' +
                '</form>' +
              '</div>' +
            '</div>' +
          '</div>'
        );

        // build the dialog
        renderInformationObjectEventDialog();

        // Write a link to show the dialog
        $("table#relatedEvents").append('<tr id="addEventLink"><td colspan="4"><a href="javascript:Qubit.eventDialog.show()"><?php echo __('add new') ?></a></td></tr>');

        // Add links for editing existing events
        var eventRows = $('table#relatedEvents tr').filter(function() { return this.id.substr(0,5) == 'event' });
        eventRows.each(function() {
          var thisId = this.id.replace(/event_(\d+)/, '$1');
          var editLink = '<a href="javascript:editInformationObjectEventDialog(\''+thisId+'\')"><img src="'+$('img#imagesPencilPng').attr('src')+'" align="top" /></a>&nbsp;';
          $(this).find('button.delete-small').before(editLink);
        });

        // Initialize newEvent data store
        $('body').data('cachedEvents', new Array());
        $('body').data('deleteEvents', new Array());

        // Attach the appendHiddenFormFields() action to the submit form
        $('form#editForm').submit(function() {
          appendHiddenEventFormFields($(this));
          return true;
        });
      } };
//]]>
</script>
