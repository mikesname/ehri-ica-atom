<?php use_helper('Javascript') ?>
<?php $sf_response->addStylesheet('/vendor/yui/autocomplete/assets/skins/sam/autocomplete') ?>

<?php $sf_response->addJavaScript('/vendor/yui/datasource/datasource-min') ?>
<?php $sf_response->addJavaScript('/vendor/yui/connection/connection-min') ?>
<?php $sf_response->addJavaScript('/vendor/yui/animation/animation-min') ?>
<?php $sf_response->addJavaScript('/vendor/yui/json/json-min') ?>
<?php $sf_response->addJavaScript('/vendor/yui/autocomplete/autocomplete-min') ?>
<?php $sf_response->addJavaScript('/js/qubit') ?>

<script language="javascript">
//<!CDATA[
  function replaceTitleAutoCompleteInput()
  {
    // only works with first auto-complete field on page for now
    var firstAcInput = $('input.titleAutoComplete').eq(0);
    
    firstAcInput.wrap('<div class="autoCompleteInput"></div>');
    firstAcInput.attr('id', 'titleAcInput').removeClass('titleAutoComplete');
    firstAcInput.after('<div id="titleAcList"></div>');
  }

  Drupal.behaviors.titleAutoComplete = {
    attach: function(context)
    {
      replaceTitleAutoCompleteInput();

      // Get results from actor/list
      var myDataSource = new YAHOO.util.XHRDataSource('<?php echo url_for(array('module' => 'informationobject', 'action' => 'list')) ?>');
      myDataSource.responseType = YAHOO.util.XHRDataSource.TYPE_JSON;
      myDataSource.responseSchema = {
        resultsList : "Results",
        fields : ["name", "id"]
      }

      // Build auto-complete widget
      var myAutoComp = new YAHOO.widget.AutoComplete("titleAcInput","titleAcList", myDataSource);
      myAutoComp.animVert = true;
      myAutoComp.maxResultsDisplayed = 10;
      myAutoComp.useIFrame = true;
    }
  }
//]]>
</script>
