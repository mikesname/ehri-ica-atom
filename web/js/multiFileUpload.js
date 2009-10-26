var thumbWidth = 150;

// Load when DOM is ready
YAHOO.util.Event.onDOMReady(
  function() {
    var uiLayer = YAHOO.util.Dom.getRegion('selectLink');
    var overlay = YAHOO.util.Dom.get('uploaderOverlay');
    YAHOO.util.Dom.setStyle(overlay, 'width', uiLayer.right - uiLayer.left + "px");
    YAHOO.util.Dom.setStyle(overlay, 'height', uiLayer.bottom - uiLayer.top + "px");
  }
);

function handleRollOver()
{
  YAHOO.util.Dom.setStyle(YAHOO.util.Dom.get('selectLink'), 'color', "#FFFFFF");
  YAHOO.util.Dom.setStyle(YAHOO.util.Dom.get('selectLink'), 'background-color', "#000000");
}
function handleRollOut()
{
  YAHOO.util.Dom.setStyle(YAHOO.util.Dom.get('selectLink'), 'color', "#0066CC");
  YAHOO.util.Dom.setStyle(YAHOO.util.Dom.get('selectLink'), 'background-color', "#FFFFFF");
}

// Empty placeholders
function handleMouseDown()
{
}
function handleMouseUp()
{
}
function handleClick()
{
}

// Show file picker
function handleContentReady()
{
  uploader.clearFileList();

  // Allows multiple file selection in "Browse" dialog.
  uploader.setAllowMultipleFiles(true);

  /*
  // New set of file filters.
  var ff = new Array( {
    description: "Images",
    extensions: "*.jpg;*.png;*.gif;*.tif"
  }, {
    description: "Videos",
    extensions: "*.avi;*.mov;*.mpg"
  });

  // Apply new set of file filters to the uploader.
  uploader.setFileFilters(ff);
  */
}

// select files
function onFileSelect(event)
{
  if ('fileList' in event && event.fileList != null)
  {
    fileList = event.fileList;

    // Make space for a thumbnail and progress bar
    for (var i in fileList)
    {
      var fileHash = fileList[i].id;
      var fileName = fileList[i].name;
      var fileSize = fileList[i].size; // bytes

      // TODO: Look for a way for blocking repeated files before upload them.
      // Unfortunately, YUI generates different ids for same file opening browser two times.
      if (-1 < jQuery.inArray(fileHash, uploadedList))
      {
        break;
      }

      if (fileSize > maxUploadSize)
      {
        // Create an upload block for this digital object
        var uploadBlock = '<div id="upload-' + fileHash + '" class="multiFileUpload warning">';
        uploadBlock    += '<ul class=\"validation_error\"><li>Warning, ' + fileName + ' exceeds maximum upload size</li></ul>';
        uploadBlock    += '</div>';
        $('#uploads').append(uploadBlock);

        uploader.removeFile(fileHash);
      }
      else
      {
        // Create an upload block for this digital object
        var uploadBlock = '<div id="upload-' + fileHash + '" class="multiFileUpload">';
        uploadBlock    += '<div id="thumbnail-' + fileHash + '" class="digitalObject" style="width: ' + thumbWidth + 'px"></div>';
        uploadBlock    += '</div>';
        $('#uploads').append(uploadBlock);

        // Insert placeholder for thumbnail ("upload text + progress bar div")
        var progress  = '<span style="color: #999; text-align: left">' + i18nUploading + '</span>';
        progress     += '&nbsp;<a href="#" class="cancel" onclick="cancelUpload(\'' + fileHash + '\'); return false;">' + i18nCancel + '</a><br />';
        progress     += '<div class="progress-bar" style="width=: ' + thumbWidth + 'px;"></div>';
        $('#thumbnail-' + fileHash).html(progress)

        // Initialize progress bar
        var progbar = '<div style="height:5px;width:' + thumbWidth + 'px;background-color:#CCC;"></div>';
        $('#thumbnail-' + fileHash + ' div.progress-bar').html(progbar);
      }

      uploadedList[uploadedList.length] = fileHash;
    }

    // Start upload
    uploader.setSimUploadLimit(5);
    uploader.uploadAll(uploadResponsePath);
  }
}

// Update progress bar
function onUploadProgress(event)
{
  var fileHash = event["id"];
  prog = Math.round(thumbWidth * (event["bytesLoaded"] / event["bytesTotal"]));
  progbar = '<div style="background-color: #fd3; height: 5px; width: ' + prog + 'px"/>';

  $('#thumbnail-' + fileHash + ' div.progress-bar').html(progbar);
}

// Upload complete
function onUploadComplete(event)
{
  var fileHash = event["id"];
  progbar = '<div style="background-color: #0f0; height: 5px; width: ' + thumbWidth + 'px"/>';
  $('#thumbnail-' + fileHash + ' div.progress-bar').html(progbar);
}

function onUploadStart(event)
{
}

function onUploadError(event)
{
}

function onUploadCancel(event)
{
}

// This fires after successful upload
function onUploadResponse(event)
{
  var uploadFiles = eval('(' + event['data'] + ')');
  var inputTag, imageTag;

  for (i in uploadFiles)
  {
    // Ignore this event if upload was cancel
    if (!$('div#upload-' + event['id']).length)
    {
      break;
    }

    if (uploadFiles[i].error)
    {
      var warningMessage = '<ul class="validation_error"><li>' + uploadFiles[i].error + '</li></ul>';
      $('#upload-' + event['id']).html(warningMessage).addClass('warning');
      break;
    }

    var thumbnail = '<img src="' + uploadTmpDir + '/' + uploadFiles[i].thumb + '"/>';
    $('#thumbnail-' + event['id']).html(thumbnail);

    // Give thumbnail div a minimum height to prevent text from wrapping to next line
    $('#thumbnail-' + event['id']).attr('style', function(i) {
      return $(this).attr('style') + '; min-height: 100px';
    });

    if (!uploadFiles[i].canThumbnail)
    {
      var thumbDiv = $('#thumbnail-' + event['id']);
      var thumbWidth = thumbDiv.find("img").width();

      $(thumbDiv).css("background-color", "White");

      if (thumbWidth)
      {
        $(thumbDiv).width(thumbWidth);
      }
    }

    // Get the file index from the id passed by YUI
    var fileIndex = event['id'].match(/([0-9]+)$/).shift();
    if (null == fileIndex || isNaN(parseInt(fileIndex)))
    {
      fileIndex = i;
    }

    // Write upload file data
    var hiddenFields = '<input type="hidden" name="files[' + fileIndex + '][name]" value="' + uploadFiles[i].name + '" />';
    hiddenFields += '<input type="hidden" name=files[' + fileIndex + '][md5sum]" value="' + uploadFiles[i].md5sum + '" />';
    hiddenFields += '<input type="hidden" name="files[' + fileIndex + '][tmpName]" value="' + uploadFiles[i].tmpName + '" />';
    hiddenFields += '<input type="hidden" name="files[' + fileIndex + '][thumb]" value="' + uploadFiles[i].thumb + '" />';
    $('#uploadForm').append(hiddenFields);

    var uploadData = '<div class="form-item"><label>' + i18nInfoObjectTitle + '</label><input type="text" name="files[' + fileIndex + '][infoObjectTitle]" value="" style="width: 250px"/></div>';
    uploadData += '<div class="form-item"><label>' + i18nFilename + '</label>' + uploadFiles[i].name + '</div>';
    uploadData += '<div class="form-item"><label>' + i18nFilesize + '</label>' + uploadFiles[i].size + '</div>';
    uploadData += '<input type="hidden" class="md5sum" value="' + uploadFiles[i].md5sum + '" />';
    uploadData += '<input type="hidden" class="filename" value="' + uploadFiles[i].name + '" />';

    // Show warning message if exists
    uploadData += '<div class="toolbar" style="text-align: right;">';

    if (uploadFiles[i].warning)
    {
      uploadData += '<span style="color: Red;">' + uploadFiles[i].warning + '</span>&nbsp;|&nbsp;';
    }

    uploadData += '<a href="#" onclick="deleteUpload(\'' + event['id'] + '\'); return false;">' + i18nDelete + '</a>';
    uploadData += '</div>';

    $('#upload-' + event['id']).append(uploadData).addClass('ready');

    hilightRepeatedFiles();
    renumerateUploads();
  }

  uploader.removeFile(event['id']);

  //Debugging data
  //document.getElementById('uploads').innerHTML += event['data'];
}

function replacePlaceHolder(templateStr, index)
{
  var fileName = null;
  index = String(index);

  var matches = templateStr.match(/\%(d+)\%/);

  if (null != matches && 0 < matches[1].length)
  {
    while (matches[1].length > index.length)
    {
      index = '0' + index;
    }

    var fileName = templateStr.replace('%' + matches[1] + '%', index);
  }

  if (null == fileName || templateStr == fileName)
  {
    fileName = templateStr + ' ' + index;
  }

  return fileName;
}

function renumerateUploads()
{
  $('div.multiFileUpload:not(.warning)').each(function(i) {
    var newValue = replacePlaceHolder(document.getElementById('uploadForm')['title'].value, i + 1);
    $(this).find('input[type=text]').val(newValue); });
}

function hilightRepeatedFiles(force)
{
  // Count of selected files by YUI browser
  var fileCount = 0;
  for (var i in fileList)
  {
    fileCount++;
  }

  // Count of uploaded files successfully
  var fileReadyCount = $('div.multiFileUpload.ready').length;

   // Count of files which couldn't be uploaded
  var fileWarningCount = $('div.multiFileUpload.warning').length;

  // If there is any upload in progress stop function
  if (!force && (fileReadyCount < fileCount - fileWarningCount))
  {
    return;
  }

  var memMd5 = Array();

  // Iterates over all div.multiFileUploads hilighting ones with same md5sum (ignore first ocurrence)
  $('div.multiFileUpload:not(.warning)').each(function() {
    var md5sum = $(this).find("input.md5sum").val();

    // If file already exists
    if (-1 < jQuery.inArray(md5sum, memMd5))
    {
      var fileName = $('input.md5sum[value=' + md5sum + ']:first').parent().find("input.filename").val();
      $(this).find('ul.validation_error').remove();
      $(this).addClass('repeated').prepend('<ul class=\"validation_error\"><li>Warning: duplicate of ' + fileName + '</li></ul>');
    }
    else
    {
      $(this).removeClass('repeated').find('ul.validation_error').remove();
      memMd5[memMd5.length] = md5sum;
    }
  });
}

function cancelUpload(id)
{
  uploader.cancel(id);
  $('div#upload-' + id).slideUp('fast', function()
    {
      $(this).remove();
    });
}

function deleteUpload(id)
{
  // Get the file index from the id passed by YUI
  var fileIndex = id.match(/([0-9]+)$/).shift();
  if (null == fileIndex || isNaN(parseInt(fileIndex)))
  {
    return;
  }

  $('div#upload-file' + fileIndex).slideUp('fast', function() {
    // Remove the HTML block
    $(this).remove();

    // Remove hidden fields
    $('input[type=hidden][name*=\[' + fileIndex + '\]]').remove();

    hilightRepeatedFiles(1);
    renumerateUploads();
  });

  // TODO: Ajax call to remove temporary file
}
