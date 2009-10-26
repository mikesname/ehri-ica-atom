// $Id$

Qubit.treeView = Qubit.treeView || {};

Drupal.behaviors.treeView = {

  attach: function (context)
    {
      // Build tree function
      function build(objects, expands, parentId, parentNode)
      {
        while (objects.length > 0 && objects[0].parentId == parentId)
        {
          var object = objects.shift();
          var textNode = new YAHOO.widget.TextNode(object, parentNode, expands[object.id] !== undefined);
          textNode.isLeaf = object.isLeaf;
          textNode.qubit_id = object.id;

          if (object.style == 'ygtvlabel currentTextNode')
          {
            textNode.highlight();
          }

          if (Qubit.treeView.draggable)
          {
            var dd = new YAHOO.util.DDProxy(textNode.labelElId);

            dd.invalidHandleTypes = {};

            dd.onDragDrop = function (event, id)
              {
                var textNode = parentNode.tree.getNodeByElement(this.getEl());

                var newParent = parentNode.tree.getNodeByElement($('#' + id)[0]);

                if (parentNode.contentElId == newParent.contentElId)
                {
                  $('#' + id).css('font-weight', 'normal');
                  return false;
                }

                jQuery.ajax({
                  data: { parent: newParent.qubit_id },
                  type: 'POST',
                  url: textNode.href.replace(/\/(informationobject|term)\/\D*(\d+)/, '/$1/move/$2') });

                parentNode.tree.popNode(textNode);

                if (!parentNode.hasChildren())
                {
                  parentNode.isLeaf = true;
                }

                parentNode.refresh();

                $('.ygtvlabel', '#' + parentNode.getChildrenElId()).each(function ()
                  {
                    var dd = YAHOO.util.DragDropMgr.getDDById($(this).attr('id'));

                    dd.unreg();

                    dd.init($(this).attr('id'));

                    dd.invalidHandleTypes = {};
                  });

                if (newParent.expanded)
                {
                  textNode.appendTo(newParent);

                  newParent.refresh();

                  $('.ygtvlabel', '#' + newParent.getChildrenElId()).each(function ()
                    {
                      var dd = YAHOO.util.DragDropMgr.getDDById($(this).attr('id'));

                      dd.unreg();

                      dd.init($(this).attr('id'));

                      dd.invalidHandleTypes = {};
                    });
                }
                else if (newParent.isLeaf)
                {
                  newParent.isLeaf = false;
                  newParent.refresh();
                }

                if (textNode.highlightState > 0)
                {
                  // TODO: expand parent nodes to avoid getting hidden
                }
              };

            dd.onDragOver = function (e, id)
              {
                $('#' + id).css('font-weight', 'bold');
              };

            dd.onDragOut = function (e, id)
              {
                $('#' + id).css('font-weight', 'normal');
              };

            dd.endDrag = function ()
              {
              };
          }

          build(objects, expands, object.id, textNode);
        }
      }

      function loadNodeData(node, fnLoadComplete)
      {
        var nodeId = node.data.id;

        if (Qubit.treeView.expands[nodeId])
        {
          return fnLoadComplete();
        }

        jQuery.ajax({

          data: { id: nodeId },
          dataType: 'json',
          timeout: 7000,
          url: Qubit.treeView.Url,

          error: fnLoadComplete,

          success: function (data)
            {
              for (var i = 0; i < data.length; i++)
              {
                var textNode = new YAHOO.widget.TextNode(data[i], node, false);
                textNode.isLeaf = data[i].isLeaf;

                if (Qubit.treeView.draggable)
                {
                  var dd = new YAHOO.util.DDProxy(textNode.labelElId);

                  dd.invalidHandleTypes = {};

                  dd.onDragDrop = function (event, id)
                    {
                      var textNode = node.tree.getNodeByElement(this.getEl());

                      var newParent = node.tree.getNodeByElement($('#' + id)[0]);

                      if (newParent.contentElId == node.contentElId)
                      {
                        $('#' + id).css('font-weight', 'normal');
                        return false;
                      }

                      jQuery.ajax({
                        data: { parent: newParent.qubit_id },
                        type: 'POST',
                        url: textNode.href.replace(/\/(informationobject|term)\/\D*(\d+)/, '/$1/move/$2') });

                      node.tree.popNode(textNode);

                      if (!node.hasChildren())
                      {
                        node.isLeaf = true;
                      }

                      node.refresh();

                      $('.ygtvlabel', '#' + node.getChildrenElId()).each(function ()
                        {
                          var dd = YAHOO.util.DragDropMgr.getDDById($(this).attr('id'));

                          dd.unreg();

                          dd.init($(this).attr('id'));

                          dd.invalidHandleTypes = {};
                        });

                      if (newParent.expanded)
                      {
                        textNode.appendTo(newParent);

                        newParent.refresh();

                        $('.ygtvlabel', '#' + newParent.getChildrenElId()).each(function ()
                          {
                            var dd = YAHOO.util.DragDropMgr.getDDById($(this).attr('id'));

                            dd.unreg();

                            dd.init($(this).attr('id'));

                            dd.invalidHandleTypes = {};
                          });
                      }
                      else if (newParent.isLeaf)
                      {
                        newParent.isLeaf = false;
                      }

                      if (textNode.highlightState > 0)
                      {
                        // TODO: expand parent nodes to avoid getting hidden
                      }
                    };

                  dd.onDragOver = function (e, id)
                    {
                      $('#' + id).css('font-weight', 'bold');
                    };

                  dd.onDragOut = function (e, id)
                    {
                      $('#' + id).css('font-weight', 'normal');
                    };

                  dd.endDrag = function ()
                    {
                    };
                }
              }

              return fnLoadComplete();
            } });
      }

      // Create a new tree
      Qubit.treeView.treeView = new YAHOO.widget.TreeView('treeView');

      // Turn dynamic loading on for entire tree
      Qubit.treeView.treeView.setDynamicLoad(loadNodeData);

      // Build tree
      build(Qubit.treeView.objects, Qubit.treeView.expands, Qubit.treeView.objects[0].parentId, Qubit.treeView.treeView.getRoot());

      // Render tree
      Qubit.treeView.treeView.render();
    } };
