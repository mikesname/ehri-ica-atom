<?php use_helper('Javascript') ?>
<?php $sf_response->addJavaScript('/vendor/yui/animation/animation-min') ?>
<?php $sf_response->addJavaScript('/vendor/yui/dragdrop/dragdrop-min') ?>
<?php $sf_response->addJavaScript('/vendor/yui/connection/connection-min') ?>
<?php $sf_response->addJavaScript('/vendor/yui/container/container-min') ?>
<?php $sf_response->addJavaScript('/js/qubit') ?>
<?php $sf_response->addJavaScript('/js/addAccessPointTermDialog') ?>
<?php $sf_response->addStylesheet('/vendor/yui/container/assets/skins/sam/container') ?>

<script language="javascript">
//<!CDATA[
  /*
   * Dynamically write form elements specific to the newCreationEventDialog YUI
   * Dialog object, so we don't see them when Javascript is turned off. Include
   * them here (instead of in .js file) to allow PHP to parse i18n tags. 
   */
  
  function appendNewOption(thisSelector, thisId, thisName) 
  {
    var newOption = '<option value="'+thisId+'">'+thisName+'</option>';
    
    thisSelector.append(newOption); // append option
    thisSelector.find('option:last').get(0).selected = true; // select it
  }
  
  function showSubjectAccessPointDialog()
  {
    $('#addAccessPointTermDialog input[name=taxonomy_id]').val('<?php echo QubitTaxonomy::SUBJECT_ID ?>');
    $('#addAccessPointTermDialog').data('target', 'subjectAccessPoints');
    Qubit.addAccessPointTermDialog.show()
  }
  
  function showPlaceAccessPointDialog()
  {
    $('#addAccessPointTermDialog input[name=taxonomy_id]').val('<?php echo QubitTaxonomy::PLACE_ID ?>');
    $('#addAccessPointTermDialog').data('target', 'placeAccessPoints');
    Qubit.addAccessPointTermDialog.show()
  }
  
  Drupal.behaviors.writeAddAccessPointHTML = {
    attach: function(context) 
      {
        // Create a happy, hidden YUI dialog
        $('body').prepend(' \
          <div class="yui-skin-sam"> \
            <div id="addAccessPointTermDialog"> \
              <div class="hd"><?php echo __('Enter term and scope') ?></div> \
              <div class="bd" style="text-align: left"> \
                <form action="<?php echo url_for('term/update') ?>" method="POST"> \
                  <input type="hidden" name="responseFormat" value="json" /> \
                  <input type="hidden" name="taxonomy_id" value="<?php echo QubitTaxonomy::SUBJECT_ID ?>" /> \
                  <div class="form-item"> \
                    <label for="addSubjectTermName"><?php echo __('Term name') ?></label> \
                    <input id="addSubjectTermName" type="text" name="name" value="" /> \
                  </div> \
                  <div class="form-item"> \
                    <label for="addSubjectTermScope"><?php echo __('Scope note') ?></label> \
                    <input id="addSubjectTermScope" type="text" name="new_scope_note" value="" /> \
                  </div> \
                </form> \
              </div> \
            </div> \
          </div> \
    '   );
      
        // Move newCreationEvent table contents into yui dialog container.
        // Why? So the standard form still works if javascript is disabled
        var nceTable = $('table#newCreationEvent');
        nceTable.clone().appendTo('#newCreationEventDialog div.bd form');
        nceTable.remove();
        
        renderAccessPointTermDialog();
      
        // Write a link to open the form
        $("#addSubjectAccessPointLink").append(' ' +
          '(<a href="javascript:showSubjectAccessPointDialog()"><?php echo __('Add new') ?></a>)');
        $("#addPlaceAccessPointLink").append(' ' +
          '(<a href="javascript:showPlaceAccessPointDialog()"><?php echo __('Add new') ?></a>)');
      } };
//]]>
</script>
