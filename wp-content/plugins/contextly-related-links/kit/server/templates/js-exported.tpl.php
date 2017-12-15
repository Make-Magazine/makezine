(function(c, ns){var v=c[ns]=c[ns]||{};<?php
  foreach ($vars as $name => $value) {
    ?>v[<?php print $name; ?>]=<?php print $value; ?>;<?php
  }
?>})(Contextly,<?php print $namespace; ?>);