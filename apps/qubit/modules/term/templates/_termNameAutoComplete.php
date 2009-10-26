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
  var termRelationOptions =  new Array('use for', 'use', 'related term');
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

  // Setup data source
  var termDatasource = new YAHOO.util.XHRDataSource('<?php echo url_for(array('module' => 'term', 'action' => 'list')) ?>');
  termDatasource.responseType = YAHOO.util.XHRDataSource.TYPE_JSON;
  termDatasource.responseSchema = {
    resultsList : "Results",
    fields : ["name", "id", "preferredName", "preferredId"]
  }

  // Create query handler
  var queryHandler = function(sQuery)
  {
    var queryStr = "/query/" + sQuery + "/";
    queryStr += "<?php echo (null !== $term->id) ? 'id/'.$term->id : 'taxonomyId/'.$term->taxonomyId ?>";
    return queryStr;
  }

  function newTermAcField(acName, acIndex)
  {
    if (undefined == acIndex)
    {
      acIndex = '';
    }

    var acInputName = acName + "Input" + acIndex;
    var acListName  = acName + "List" + acIndex;

    var newAc = new YAHOO.widget.AutoComplete(acInputName, acListName, termDatasource);
    newAc.generateRequest = queryHandler;
    newAc.animVert = true;
    newAc.maxResultsDisplayed = 10;
    newAc.useIFrame = true;
    newAc.resultTypeList = false;

    return newAc;
  }

  var newRtCount = 1;
  function addRtRow()
  {
    var relatedTermTable = $('table#relatedTerms');

    var acRowHtml = '<tr id="newRelatedTerm' + newRtCount + '">';
    acRowHtml    += '<td>';
    acRowHtml    += '<div id="relatedTermAutoComplete' + newRtCount + '" style="padding-bottom:2em; width:95%">';
    acRowHtml    += '<input id="relatedTermAcInput' + newRtCount + '" type="text" name="new_related_term[' + newRtCount + ']" />';
    acRowHtml    += '<div id="relatedTermAcList' + newRtCount + '"></div>';
    acRowHtml    += '</div>';
    acRowHtml    += '</td>';
    acRowHtml    += '<td>';
    acRowHtml    += '<select name="related_term_type[new' + newRtCount + ']">';

    for (var i=0; i < termRelationOptions.length; i++)
    {
      acRowHtml  += '<option value="' + termRelationOptions[i] + '">' + termRelationOptions[i] + '</option>';
    };

    acRowHtml    += '</select>';
    acRowHtml    += '</td>';
    acRowHtml    += '<td style="text-align: center">';
    acRowHtml    += '<button class="delete-small" onclick="deleteNewRtRow(' + newRtCount + '); return false;" />';
    acRowHtml    += '</td>';
    acRowHtml    += '</tr>';

    var newAcRow = $(acRowHtml)
    newAcRow.find('td').wrapInner('<div class="animateNicely" style="display: none"></div>');
    $('tr#addRtRowLink').before(newAcRow);
    newTermAcField('relatedTermAc', newRtCount);

    // Show animation
    newAcRow.find('div.animateNicely').show('normal', function(i) {
      // After show animation completes, remove "animateNicely" divs
      $(this).replaceWith($(this).children());
    });

    newRtCount++;
  }

  function deleteNewRtRow(thisIndex)
  {
    var thisRow = $('tr#newRelatedTerm' + thisIndex);
    thisRow.find('td').wrapInner('<div class="animateNicely"></div>');

    thisRow.find('div.animateNicely').hide('normal', function() {
      thisRow.remove();
    });
  }

  Drupal.behaviors.broadTermAutoComplete = {
    attach: function(context)
    {
      var parentIdField = YAHOO.util.Dom.get("parentId");

      // Build broad term auto-complete widget
      var btAutoComplete = newTermAcField('broadTermAc');

      // Add " (use: preferred term)" suffix when listing a non-preferred term
      btAutoComplete.formatResult = formatTermResults;

      // Actions when a term is selected from the auto-complete list
      var broadTermHandler = function(sType, aArgs) {
        var oData = aArgs[2]; // object literal of selected item's result data

        // update hidden form field with the selected item's ID
        parentIdField.value = oData.preferredId;

        // Swap in preferred term name for a non-preferred term
        if (undefined != oData.preferredName)
        {
          YAHOO.util.Dom.get('broadTermAcInput').value = oData.preferredName;
        }
      };
      btAutoComplete.itemSelectEvent.subscribe(broadTermHandler);

      // Clear the parentId field when user types in the autocomplete field
      btAutoComplete.textboxKeyEvent.subscribe(function() {
        if (undefined != parentIdField.value)
        {
          parentIdField.value = null;
        }
      });
    }
  }

  Drupal.behaviours.relatedTermAutoComplete = {
    attach: function(context)
    {
      // Build related term auto-complete widgets
      var rtAutoComplete = newTermAcField('relatedTermAc');

      // Add an id to override the "overflow: auto" style used by default for
      // the 'fieldset-wrapper' class
      $('div#relatedTermAutoComplete').parents('div.fieldset-wrapper').attr('id', 'relations-fieldset');

      // Add an "add row" link for related terms
      var relatedTermTable = $('table#relatedTerms');
      var newRow = '<tr id="addRtRowLink"><td colspan="3"><a href="javascript:addRtRow()"><?php echo __('add row') ?></a></td></tr>';
      relatedTermTable.append(newRow);
    }
  }
//]]>
</script>
