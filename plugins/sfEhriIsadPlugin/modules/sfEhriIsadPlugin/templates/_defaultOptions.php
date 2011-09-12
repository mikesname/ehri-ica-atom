<script type="application/javascript">
  jQuery(document).ready(function($) {

      function setupCheckFields(text, other, checkboxes) {
            text.hide();
            var others = [],
                elemap = {};
            checkboxes.each(function(i, elem) {
                elemap[$(elem).attr("data-name")] = elem;
            });
            $.each(text.val().split("\n"), function(i, s) {
                var src = $.trim(s);
                if (src != "") {
                  if (!elemap[src])
                      others.push(src);
                  else
                      $(elemap[src]).attr("checked", "checked");
                }
            });
            other.val(others.join("\n"));

            function consolidateSources() {
              var checked = $.makeArray(checkboxes.filter(":checked").map(function(i, elem) {
                  return $(elem).attr("data-name");
              }));
              $.each(other.val().split("\n"), function(i, s) {
                if ($.trim(s) != "")
                    checked.push($.trim(s));
              });
              text.val(checked.join("\n"));
            }

          checkboxes.change(consolidateSources);
          other.bind("keyup", consolidateSources);
      }

});
</script>



