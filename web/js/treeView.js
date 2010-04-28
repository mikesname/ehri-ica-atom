// $Id$

(function ($)
  {
    Qubit.treeView = Qubit.treeView || {};

    function getMoveActionUrl(href)
    {
      return href.replace(/(\d+)([;!\/]).*/, '$1$2default/move');
    }

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

              if (object.style == 'ygtvlabel currentTextNode')
              {
                textNode.highlight();
                Qubit.treeView.currentNodeId = object.id;
              }

              addDragNDrop(textNode, parentNode);

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

              data: { id: nodeId, limit: 10 },
              dataType: 'json',
              timeout: 15000,
              url: Qubit.treeView.Url,

              error: fnLoadComplete,

              success: function (data)
                {
                  for (var i = 0; i < data.length; i++)
                  {
                    var textNode = new YAHOO.widget.TextNode(data[i], node, false);
                    textNode.isLeaf = data[i].isLeaf;

                    if (Qubit.treeView.currentNodeId == data[i].id)
                    {
                      textNode.labelStyle = 'ygtvlabel currentTextNode';
                    }

                    addDragNDrop(textNode, node);
                  }

                  return fnLoadComplete();
                }
              });
            }

            function addDragNDrop(textNode, parentNode)
            {
              var dd = new YAHOO.util.DDProxy(textNode.labelElId);

              dd.invalidHandleTypes = {};

              dd.clickValidator = function (event)
                {
                  if (!Qubit.treeView.draggable || textNode.parent.isRoot())
                  {
                    YAHOO.util.Event.preventDefault(event);

                    return false;
                  }

                  return true;
                };

              dd.onDragDrop = function (event, id)
                {
                  var newParent = parentNode.tree.getNodeByElement($('#' + id)[0]);

                  if (parentNode.contentElId == newParent.contentElId)
                  {

                    return false;
                  }

                  if ($(textNode.getEl()).has(newParent.getEl()).length)
                  {

                    return false;
                  }

                  jQuery.ajax({
                    data: { parent: newParent.href },
                    type: 'POST',
                    url: getMoveActionUrl(textNode.href)
                  });

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
                    newParent.applyParent();
                    newParent.childrenRendered = false;
                  }
                };

            dd.onDragOver = function (event, id)
            {
              var dest = $('#' + id);
              var destEl = parentNode.tree.getNodeByElement(dest[0]);
              var el = parentNode.tree.getNodeByElement(this.getEl());

              if (el.parent.getElId() == destEl.getElId() || dest.hasClass('currentTextNode'))
              {

                return false;
              }

              if ($(el.getEl()).has(destEl.getEl()).length)
              {

                return false;
              }

              dest.addClass('onDragOver');
            };

            dd.onDragOut = function (event, id)
            {
              $('#' + id).removeClass('onDragOver');
            };

            dd.startDrag = function()
            {
              var el = $(this.getEl());
              var proxyEl = $(this.getDragEl());

              el.addClass('onDrag');
              proxyEl.html(el.html());
              proxyEl.addClass('proxyTextNode');
            };

            dd.endDrag = function ()
            {
              $(this.getEl()).removeClass('onDrag');
            };
          }

          function seeAll(oArgs)
          {
            var node = oArgs.node;
            var parentNode = node.parent;

            if (jQuery(node.getContentEl()).children('a').hasClass('seeAllNode'))
            {
              // If current object is the last in the treeview, it may be out
              // proper order, so reload data from position 9 (offset 8)
              var offset = 10;
              var lastChild = parentNode.children[parentNode.children.length-2];
              if (Qubit.treeView.currentNodeId == lastChild.data.id)
              {
                offset = 9;
              }

              // Show loading text
              $(node.getContentEl()).children('a').text(Qubit.treeView.i18nLoading);

              // Mark node as loading
              node.isLoading = true;
              node.tree.locked = true;
              $(node.getToggleEl()).addClass('ygtvloading').removeClass('ygtvln');

              jQuery.ajax({
                data: { 'id': parentNode.data.id, 'offset': offset },
                dataType: 'json',
                url: Qubit.treeView.Url,

                success: function (data)
                  {
                    if (9 == offset)
                    {
                      Qubit.treeView.treeView.removeNode(lastChild);
                    }

                    for (var i = 0; i < data.length; i++)
                    {
                      var textNode = new YAHOO.widget.TextNode(data[i], parentNode, false);
                      textNode.isLeaf = data[i].isLeaf;

                      if (Qubit.treeView.currentNodeId == data[i].id) 
                      {
                        textNode.labelStyle = 'ygtvlabel currentTextNode';
                        textNode.highlight();
                      }
                    }

                    // Turn off loading state 
                    node.isLoading = false;
                    node.tree.locked = false;

                    Qubit.treeView.treeView.removeNode(node);

                    for (i in parentNode.children)
                    {
                      addDragNDrop(parentNode.children[i], parentNode);
                    }

                    parentNode.refresh();
                  }
              });

              // Don't jump to the top of the page (default behaviour)
              oArgs.event.preventDefault();
            }
          }

          // Create a new tree
          Qubit.treeView.treeView = new YAHOO.widget.TreeView('treeView');

          // Turn dynamic loading on for entire tree
          Qubit.treeView.treeView.setDynamicLoad(loadNodeData);

          // On click listener for 'See all' behaviour
          Qubit.treeView.treeView.subscribe("clickEvent", seeAll);

          // Build tree
          build(Qubit.treeView.objects, Qubit.treeView.expands, Qubit.treeView.objects[0].parentId, Qubit.treeView.treeView.getRoot());

          // Render tree
          Qubit.treeView.treeView.render();


          // Enable logger (useful for debugging)
          // $('body').prepend('<div id="logw" style="position: absolute; top: 10px; left: 10px; width: 320px; height: 400px;"></div>');
          // var myLogReader = new YAHOO.widget.LogReader("logw");
        } 
    };
  })(jQuery);
