<?php use_helper('Javascript') ?>

<?php echo get_component('informationobject', 'treeView', array('informationObjects' => $informationObjects)) ?>

<?php echo javascript_tag(<<<EOF
Drupal.behaviors.selectTree = {
  attach: function (context)
    {
      Qubit.treeView.treeView.subscribe('labelClick', function (textNode)
        {
          $('#{$sf_request->getParameter('elementId')}', window.opener.document).val(textNode.data.id);

          window.close();
        });
    } };
EOF
) ?>
