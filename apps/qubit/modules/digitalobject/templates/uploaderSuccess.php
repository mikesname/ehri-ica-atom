<style>
#selectFilesLink a, #uploadFilesLink a, #clearFilesLink a {
  color: #0000CC;
  background-color: #FFFFFF;
}

#selectFilesLink a:visited, #uploadFilesLink a:visited, #clearFilesLink a:visited {
  color: #0000CC;
  background-color: #FFFFFF;
}

#uploadFilesLink a:hover, #clearFilesLink a:hover {
  color: #FFFFFF;
  background-color: #000000;
}
</style>

<div id="uiElements" style="display:inline;">
  <div id="uploaderContainer">
     <div id="uploaderOverlay" style="position:absolute; z-index:2"></div>
     <div id="selectFilesLink" style="z-index:1"><a id="selectLink" href="#">Select Files</a></div>
  </div>
  <div id="uploadFilesLink"><a id="uploadLink" onClick="upload(); return false;" href="#">Upload Files</a></div>
</div>

<div id="dataTableContainer"></div>

<div id="displayThumbs"></div>

<?php use_helper('Javascript') ?>

<?php echo javascript_tag(<<<EOD
  YAHOO.util.Event.onDOMReady(function () {
      var uiLayer = YAHOO.util.Dom.getRegion('selectLink');
      var overlay = YAHOO.util.Dom.get('uploaderOverlay');
      YAHOO.util.Dom.setStyle(overlay, 'width', uiLayer.right-uiLayer.left + "px");
      YAHOO.util.Dom.setStyle(overlay, 'height', uiLayer.bottom-uiLayer.top + "px");
  });

  YAHOO.widget.Uploader.SWFURL = '{$uploadSwfPath}';
  var uploader = new YAHOO.widget.Uploader("uploaderOverlay");

  var fileList;

  uploader.addListener('contentReady', handleContentReady);
  uploader.addListener('fileSelect', onFileSelect)
  uploader.addListener('uploadStart', onUploadStart);
  uploader.addListener('uploadProgress', onUploadProgress);
  uploader.addListener('uploadCancel', onUploadCancel);
  uploader.addListener('uploadComplete', onUploadComplete);
  uploader.addListener('uploadCompleteData', onUploadResponse);
  uploader.addListener('uploadError', onUploadError);
  uploader.addListener('rollover', handleRollOver);
  uploader.addListener('rollout', handleRollOver);
  uploader.addListener('click', handleClick);
  uploader.addListener('mouseDown', handleMouseDown);
  uploader.addListener('mouseUp', handleMouseUp);

  function handleRollOver () {
    YAHOO.util.Dom.setStyle(YAHOO.util.Dom.get('selectLink'), 'color', "#FFFFFF");
    YAHOO.util.Dom.setStyle(YAHOO.util.Dom.get('selectLink'), 'background-color', "#000000");
  }

  function handleRollOut () {
    YAHOO.util.Dom.setStyle(YAHOO.util.Dom.get('selectLink'), 'color', "#0000CC");
    YAHOO.util.Dom.setStyle(YAHOO.util.Dom.get('selectLink'), 'background-color', "#FFFFFF");
  }

  function handleMouseDown () {
  }

  function handleMouseUp () {
  }

  function handleClick () {
  }

  // Show file picker
  function handleContentReady () {
    // Allows multiple file selection in "Browse" dialog.
    uploader.setAllowMultipleFiles(true);

    // New set of file filters.
    var ff = new Array(
      {description:"Images", extensions:"*.jpg;*.png;*.gif"},
      {description:"Videos", extensions:"*.avi;*.mov;*.mpg"});

     // Apply new set of file filters to the uploader.
     uploader.setFileFilters(ff);
  }

  // select files
  function onFileSelect(event) {
    if('fileList' in event && event.fileList != null) {
      fileList = event.fileList;
      createDataTable(fileList);
    }
  }

  // Table to show all uploads
  function createDataTable(entries) {
    rowCounter = 0;
    this.fileIdHash = {};
    this.dataArr = [];
    for(var i in entries) {
      var entry = entries[i];
      entry["progress"] = "<div style='height:5px;width:100px;background-color:#CCC;'></div>";
      dataArr.unshift(entry);
    }

    for (var j = 0; j < dataArr.length; j++) {
      this.fileIdHash[dataArr[j].id] = j;
    }

    var myColumnDefs = [
      {key: "name", label: "File Name", sortable: false},
      {key: "size", label: "Size", sortable: false},
      {key: "progress", label: "Upload progress", sortable: false}
    ];

    this.myDataSource = new YAHOO.util.DataSource(dataArr);
    this.myDataSource.responseType = YAHOO.util.DataSource.TYPE_JSARRAY;
    this.myDataSource.responseSchema = {
      fields: ["id","name","created","modified","type", "size", "progress"]
    };

    this.singleSelectDataTable = new YAHOO.widget.DataTable("dataTableContainer",
      myColumnDefs, this.myDataSource, {
        caption:"Files To Upload",
        selectionMode:"single"
      }
    );
  }

  // Fire actual upload using "uploadAll" to use automatic queue for up to 4 files
  function upload() {
    if (fileList != null) {
      uploader.setSimUploadLimit(1);
      uploader.uploadAll('$uploadResponsePath');
    }
  }

  // Update progress bar
  function onUploadProgress(event) {
    rowNum = fileIdHash[event["id"]];
    prog = Math.round(100*(event["bytesLoaded"]/event["bytesTotal"]));
    progbar = "<div style='height:5px;width:100px;background-color:#CCC;'><div style='height:5px;background-color:#F00;width:" + prog + "px;'></div></div>";
    singleSelectDataTable.updateRow(rowNum, {name: dataArr[rowNum]["name"], size: dataArr[rowNum]["size"], progress: progbar});
  }

  // Upload complete
  function onUploadComplete(event) {
    rowNum = fileIdHash[event["id"]];
    prog = Math.round(100*(event["bytesLoaded"]/event["bytesTotal"]));
    progbar = "<div style='height:5px;width:100px;background-color:#CCC;'><div style='height:5px;background-color:#F00;width:100px;'></div></div>";
    singleSelectDataTable.updateRow(rowNum, {name: dataArr[rowNum]["name"], size: dataArr[rowNum]["size"], progress: progbar});
  }

  function onUploadStart(event) {
  }

  function onUploadError(event) {
  }

  function onUploadCancel(event) {
  }

  function onUploadResponse(event) {
    var thumbnail = '<div><img src="'+event['data']+'"></div>';
    document.getElementById('displayThumbs').innerHTML += thumbnail;
  }
EOD
)?>