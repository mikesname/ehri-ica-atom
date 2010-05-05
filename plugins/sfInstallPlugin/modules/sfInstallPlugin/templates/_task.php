<ol class="task-list">
  <li<?php switch ($sf_request->getParameter('action')): case 'checkSystem': ?> class="active"<?php break; case 'configureDatabase': case 'loadData': case 'configureSite': case 'finishInstall': ?> class="done"<?php endswitch; ?>>Check system</li>
  <li<?php switch ($sf_request->getParameter('action')): case 'configureDatabase': ?> class="active"<?php break; case 'loadData': case 'configureSite': case 'finishInstall': ?> class="done"<?php endswitch; ?>>Configure database</li>
  <li<?php switch ($sf_request->getParameter('action')): case 'loadData': ?> class="active"<?php break; case 'configureSite': case 'finishInstall': ?> class="done"<?php endswitch; ?>>Load data</li>
  <li<?php switch ($sf_request->getParameter('action')): case 'configureSite': ?> class="active"<?php break; case 'finishInstall': ?> class="done"<?php endswitch; ?>>Configure site</li>
</ol>
