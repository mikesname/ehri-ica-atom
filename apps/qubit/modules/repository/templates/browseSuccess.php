<div class="section tabs" id="browseTabs">
  <h2 class="element-invisible"><?php echo __('Repository Browse Options') ?></h2>
  <div class="content">
    <ul class="clearfix links">
      <?php if (('updatedUp' == $sf_request->sort) || ('updatedDown' == $sf_request->sort)): ?>
      <li><?php echo link_to(__('Alphabetic'), array('sort' => 'nameUp') + $sf_request->getParameterHolder()->getAll()) ?></li> 
      <li class="active"><?php echo link_to(__('Recent updates'), array('sort' => 'updatedUp') + $sf_request->getParameterHolder()->getAll()) ?></li>
      <?php else: ?>
      <li class="active"><?php echo link_to(__('Alphabetic'), array('sort' => 'nameUp') + $sf_request->getParameterHolder()->getAll()) ?></li> 
      <li><?php echo link_to(__('Recent updates'), array('sort' => 'updatedDown') + $sf_request->getParameterHolder()->getAll()) ?></li>
      <?php endif; ?>
    </ul>
  </div>
</div>

<h1><?php echo __('Browse %1%', array('%1%' => sfConfig::get('app_ui_label_repository'))) ?></h1>

<table class="sticky-enabled">
  <thead>
    <tr>
      <th>
        <?php echo __('Name') ?>
        <?php if ('nameUp' == $sf_request->sort): ?>
          <?php echo link_to((image_tag('down.gif')), array('sort' => 'nameDown') + $sf_request->getParameterHolder()->getAll()) ?>
        <?php elseif ('nameDown' == $sf_request->sort): ?>
          <?php echo link_to((image_tag('up.gif')), array('sort' => 'nameUp') + $sf_request->getParameterHolder()->getAll()) ?>
        <?php else: ?>
          <?php echo link_to((image_tag('down.gif')), array('sort' => 'nameDown') + $sf_request->getParameterHolder()->getAll()) ?>
        <?php endif; ?>
      </th>
      <?php if (('updatedUp' == $sf_request->sort) || ('updatedDown' == $sf_request->sort)): ?>
        <th><?php echo __('Updated') ?>
        <?php if ('updatedUp' == $sf_request->sort): ?>
          <?php echo link_to((image_tag('up.gif')), array('sort' => 'updatedDown') + $sf_request->getParameterHolder()->getAll()) ?>
        <?php elseif ('updatedDown' == $sf_request->sort): ?>
          <?php echo link_to((image_tag('down.gif')), array('sort' => 'updatedUp') + $sf_request->getParameterHolder()->getAll()) ?>
        <?php else: ?>
          <?php echo link_to((image_tag('up.gif')), array('sort' => 'updatedDown') + $sf_request->getParameterHolder()->getAll()) ?>
        <?php endif; ?>
        </th>
      <?php else: ?>
      <th>
        <?php echo __('Type') ?>
      </th>
      <th>
        <?php echo __('Country') ?>
      </th>
      <?php endif; ?>
    </tr>
  </thead>
  <tbody>
  <?php foreach ($repositories->getResults() as $repository): ?>
      <tr class="<?php echo 0 == ++$row % 2 ? 'even' : 'odd' ?>">
        <td>
          <?php echo link_to(render_title($repository), array($repository, 'module' => 'repository')) ?>
        </td>
      <?php if (('updatedUp' == $sf_request->sort) || ('updatedDown' == $sf_request->sort)): ?>
        <td><?php echo $repository->updatedAt ?>
        </td>
      <?php else: ?>
        <td>
          <ul>
            <?php foreach ($repository->getTermRelations(QubitTaxonomy::REPOSITORY_TYPE_ID) as $relation): ?>
              <li><?php echo $relation->term ?></li>
            <?php endforeach; ?>
          </ul>
        </td>
        <td>
          <?php echo $repository->getCountry() ?>
        </td>
      <?php endif; ?>
      </tr>
    <?php endforeach; ?>
  </tbody>
</table>

<div class="result-count">
<?php echo __('displaying %1% to %2% of %3% results', array('%1%' => $repositories->getFirstIndice(), '%2%' => $repositories->getLastIndice(), '%3%' => $repositories->getNbResults())) ?>
</div>

<?php if ($repositories->haveToPaginate()): ?>
  <div class="pager section">
    <h2 class="element-invisible"><?php echo __('Pages') ?></h2>
    <div class="content">
    <?php $links = $repositories->getLinks(); ?>

    <?php if ($repositories->getPage() != $repositories->getFirstPage()): ?>
      <?php echo link_to(__('Previous'), array('page' => $repositories->getPage() - 1) + $sf_request->getParameterHolder()->getAll(), array('rel' => 'prev', 'title' => __('Go to previous page'))) ?>
    <?php endif; ?>
    <?php foreach ($links as $page): ?>
      <?php echo ($page == $repositories->getPage()) ? '<strong>'.$page.'</strong>' : link_to($page, array('page' => $page) + $sf_request->getParameterHolder()->getAll(), array('title' => __('Go to page %1%', array('%1%' => $page)))) ?>
      <?php if ($page != $repositories->getCurrentMaxLink()): ?> <?php endif ?>
    <?php endforeach ?>
    <?php if ($repositories->getPage() != $repositories->getLastPage()): ?>
      <?php echo link_to(__('Next'), array('page' => $repositories->getPage() + 1) + $sf_request->getParameterHolder()->getAll(), array('rel' => 'next', 'title' => __('Go to next page'))) ?>
    <?php endif; ?>
    <div>
  </div>
<?php endif ?>

<div class="itemsPerPage section">
</div>

<div class="search">
  <form action="<?php echo url_for(array('module' => 'actor', 'action' => 'list')) ?>">
    <?php echo input_tag('query', $sf_request->query) ?>
    <?php echo submit_tag(__('Search ').sfConfig::get('app_ui_label_repository')) ?>
  </form>
</div>
