<?php use_helper('Javascript') ?>
<?php $sf_response->addStylesheet('/vendor/yui/autocomplete/assets/skins/sam/autocomplete') ?>

<?php $sf_response->addJavaScript('/vendor/yui/datasource/datasource-min') ?>
<?php $sf_response->addJavaScript('/vendor/yui/connection/connection-min') ?>
<?php $sf_response->addJavaScript('/vendor/yui/animation/animation-min') ?>
<?php $sf_response->addJavaScript('/vendor/yui/json/json-min') ?>
<?php $sf_response->addJavaScript('/vendor/yui/autocomplete/autocomplete-min') ?>
<?php $sf_response->addJavaScript('/js/qubit') ?>

<style type="text/css" media="screen">
  div#relations-fieldset
  {
    overflow: visible;
  }
</style>

<script language="javascript">
//<!CDATA[
  var preferredTermFormat = ' (<?php echo __('use') ?>: %s)';

  function formatTermResults(oResultData, sQuery, sResultMatch) { 
    var sMarkup = "";
    if (sResultMatch)
    {
      sMarkup = sResultMatch;
      if (undefined != (preferredName = oResultData.preferredName))
      {
        sMarkup += preferredTermFormat.replace('%s', preferredName);
      }
    } 

    return sMarkup; 
  };

  Drupal.behaviors.subjectAutoComplete = {
    attach: function(context)
    {
      // Get results from term/list
      var myDataSource = new YAHOO.util.XHRDataSource('<?php echo url_for(array('module' => 'term', 'action' => 'list')) ?>');
      myDataSource.responseType = YAHOO.util.XHRDataSource.TYPE_JSON;
      myDataSource.responseSchema = {
        resultsList : "Results",
        fields : ["name", "id", "preferredName", "preferredId"]
      }

      // Build subject auto-complete widget
      var subjectAutoComp = new YAHOO.widget.AutoComplete("subjectAcInput","subjectAcList", myDataSource);
      subjectAutoComp.generateRequest = function(sQuery) {
        return "/query/" + sQuery + "/taxonomyId/<?php echo QubitTaxonomy::SUBJECT_ID ?>";
      }
      subjectAutoComp.animVert = true;
      subjectAutoComp.maxResultsDisplayed = 10;
      subjectAutoComp.useIFrame = true;
      subjectAutoComp.resultTypeList = false;

      // Format results
      subjectAutoComp.formatResult = formatTermResults; 

      // Define an event handler to populate a hidden form field
      // when an item gets selected
      var subjectIdField = YAHOO.util.Dom.get("subjectId");
      var subjectInput = YAHOO.util.Dom.get("subjectAcInput");
      var myHandler = function(sType, aArgs) {
        var oData = aArgs[2]; // object literal of selected item's result data
        
        // update hidden form field with the selected item's ID
        subjectIdField.value = oData.preferredId;
        if (undefined != oData.preferredName)
        {
          subjectInput.value = oData.preferredName;
        }
      };
      subjectAutoComp.itemSelectEvent.subscribe(myHandler);

      // Build place auto-complete widget
      var placeAutoComp = new YAHOO.widget.AutoComplete("placeAcInput","placeAcList", myDataSource);
      placeAutoComp.generateRequest = function(sQuery) {
        return "/query/" + sQuery + "/taxonomyId/<?php echo QubitTaxonomy::PLACE_ID ?>";
      }
      placeAutoComp.animVert = true;
      placeAutoComp.maxResultsDisplayed = 10;
      placeAutoComp.useIFrame = true;
      placeAutoComp.resultTypeList = false;

      // Format results
      placeAutoComp.formatResult = formatTermResults; 
      
      // Define an event handler to populate a hidden form field
      // when an item gets selected
      var placeIdField = YAHOO.util.Dom.get("placeId");
      var placeInput = YAHOO.util.Dom.get("placeAcInput");
      var myHandler = function(sType, aArgs) {
        var oData = aArgs[2]; // object literal of selected item's result data
        
        // update hidden form field with the selected item's ID
        placeIdField.value = oData.preferredId;
        if (undefined != oData.preferredName)
        {
          placeInput.value = oData.preferredName;
        }
      };
      placeAutoComp.itemSelectEvent.subscribe(myHandler);
      
      return;
    }
  }
//]]>
</script>
