<?php

/*
 */

class sfDrupalWidgetFormSchemaFormatter extends sfWidgetFormSchemaFormatter
{
  // Heredocs cannot be used to initialize class members:
  // http://php.net/manual/en/language.types.string.php#language.types.string.syntax.nowdoc
  protected
    $errorListFormatInARow = "<div class=\"messages error\">\n  <ul>\n    %errors%\n  </ul>\n</div>\n",
    $helpFormat = "<div class=\"description\">\n  %help%\n</div>\n",
    $rowFormat = "<div class=\"form-item\">\n  %label%\n  %error%%field%\n  %help%%hidden_fields%\n</div>\n";
}
