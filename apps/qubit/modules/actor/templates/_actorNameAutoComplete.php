<?php use_helper('Javascript') ?>
<?php $sf_response->addStylesheet('/vendor/yui/autocomplete/assets/skins/sam/autocomplete') ?>

<?php $sf_response->addJavaScript('/vendor/yui/datasource/datasource-min') ?>
<?php $sf_response->addJavaScript('/vendor/yui/connection/connection-min') ?>
<?php $sf_response->addJavaScript('/vendor/yui/animation/animation-min') ?>
<?php $sf_response->addJavaScript('/vendor/yui/json/json-min') ?>
<?php $sf_response->addJavaScript('/vendor/yui/autocomplete/autocomplete-min') ?>
<?php $sf_response->addJavaScript('/js/qubit') ?>

<div id="actorNameAutoComplete">
  <input id="actorNameAcInput" type="text" name="editActorRelation[actorName]">
  <div id="actorNameAcList"></div>
</div>

<script language="javascript">
//<!CDATA[
  Drupal.behaviors.actorAutoComplete = {
    attach: function(context)
    {
      // Get results from actor/list
      var myDataSource = new YAHOO.util.XHRDataSource('<?php echo url_for(array('module' => 'actor', 'action' => 'list')) ?>');
      myDataSource.responseType = YAHOO.util.XHRDataSource.TYPE_JSON;
      myDataSource.responseSchema = {
        resultsList : "Results",
        fields : ["name", "id"]
      }

      // Build auto-complete widget
      var myAutoComp = new YAHOO.widget.AutoComplete("actorNameAcInput","actorNameAcList", myDataSource);
      myAutoComp.generateRequest = function(sQuery) {
        return "/query/" + sQuery + "/not/<?php echo $actor->id ?>";
      }
      myAutoComp.animVert = true;
      myAutoComp.maxResultsDisplayed = 10;
      myAutoComp.useIFrame = true;
    }
  }
//]]>
</script>
