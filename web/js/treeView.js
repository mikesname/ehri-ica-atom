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

              var dd = new YAHOO.util.DDProxy(textNode.labelElId);

              dd.invalidHandleTypes = {};

              dd.clickValidator = function (event)
                {
                  var textNode = parentNode.tree.getNodeByElement(this.getEl());

                  if (!Qubit.treeView.draggable || textNode.parent.isRoot())
                  {
                    YAHOO.util.Event.preventDefault(event);

                    return false;
                  }

                  return true;
                };

              dd.onDragDrop = function (event, id)
                {
                  var textNode = parentNode.tree.getNodeByElement(this.getEl());

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
                    url: getMoveActionUrl(textNode.href) });

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

            dd.startDrag = function() {
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

                  if (Qubit.treeView.currentNodeId == data[i].id)
                  {
                    textNode.labelStyle = 'ygtvlabel currentTextNode';
                  }

                  var dd = new YAHOO.util.DDProxy(textNode.labelElId);

                  dd.invalidHandleTypes = {};

                  dd.clickValidator = function (event)
                    {
                      if (!Qubit.treeView.draggable)
                      {
                        YAHOO.util.Event.preventDefault(event);

                        return false;
                      }

                      return true;
                    };

                  dd.onDragDrop = function (event, id)
                    {
                      var textNode = node.tree.getNodeByElement(this.getEl());

                      var newParent = node.tree.getNodeByElement($('#' + id)[0]);

                      if (newParent.contentElId == node.contentElId)
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
                        url: getMoveActionUrl(textNode.href) });

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
                        newParent.refresh();
                        newParent.applyParent();
                        newParent.childrenRendered = false;
                      }
                    };

                  dd.onDragOver = function (event, id)
                    {
                      var dest = $('#' + id);
                      var destEl = node.tree.getNodeByElement(dest[0]);
                      var el = node.tree.getNodeByElement(this.getEl());

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

        // 'See all' button
        $('a.seeAllNode').live('click', function()
          {
            // Set button loading message
            $(this).text(Qubit.treeView.i18nLoading);

            var parentNode = Qubit.treeView.treeView.getNodeByElement(this).parent;

            // Remove from expands
            Qubit.treeView.expands[parentNode.data.id] = null;

            parentNode.focus();

            parentNode.tree.removeChildren(parentNode);

            parentNode.expand();

            return false;
          });

        // Enable logger (useful for debugging)
        // $('body').prepend('<div id="logw" style="position: absolute; top: 10px; left: 10px; width: 320px; height: 400px;"></div>');
        // var myLogReader = new YAHOO.widget.LogReader("logw");
      } };
  })(jQuery);
